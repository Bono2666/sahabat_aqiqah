<?php
/**
 * Audit Perubahan WordPress — jalankan via novamira/execute-php
 *
 * Menghasilkan laporan JSON berisi 4 kategori:
 * 1. Backup (WPvivid + UpdraftPlus)
 * 2. Update Plugin/Theme/Core (proxy berbasis file mtime)
 * 3. Update Content (post_modified + jumlah revisi)
 * 4. Bug Fix / custom code (mtime file di theme & mu-plugins)
 *
 * CARA PAKAI:
 * require_once WP_CONTENT_DIR . '/novamira-sandbox/audit-perubahan-wordpress.php';
 * echo json_encode( generate_change_report( 30 ), JSON_PRETTY_PRINT );
 *
 * CATATAN: Ini pendekatan "proxy" karena WordPress tidak punya log
 * perubahan bawaan. Untuk hasil akurat + siapa yang mengubah,
 * pasang plugin activity log (WP Activity Log / Simple History).
 */

if ( ! function_exists( 'generate_change_report' ) ) {
function generate_change_report( $days = 30 ) {
	global $wpdb;
	$cutoff      = time() - ( $days * DAY_IN_SECONDS );
	$cutoff_date = date( 'Y-m-d H:i:s', $cutoff );
	$report      = array();

	// 1. BACKUP — cek WPvivid dan UpdraftPlus, dua-duanya dilaporkan kalau ada aktivitas
	$backups = array();

	// WPvivid
	$wpvivid_list = get_option( 'wpvivid_backup_list', array() );
	if ( is_array( $wpvivid_list ) ) {
		foreach ( $wpvivid_list as $b ) {
			$ts = isset( $b['create_time'] ) ? intval( $b['create_time'] ) : 0;
			if ( $ts >= $cutoff ) {
				$backups[] = array(
					'plugin' => 'WPvivid',
					'date'   => date( 'Y-m-d H:i', $ts ),
					'type'   => $b['type'] ?? 'unknown',
					'result' => $b['backup']['result'] ?? 'unknown',
					'files'  => isset( $b['backup']['files'] ) ? count( $b['backup']['files'] ) : 0,
				);
			}
		}
	}

	// UpdraftPlus (key = unix timestamp)
	$updraft_history = get_option( 'updraft_backup_history', array() );
	if ( is_array( $updraft_history ) ) {
		foreach ( $updraft_history as $ts => $b ) {
			$ts = intval( $ts );
			if ( $ts >= $cutoff ) {
				$file_count = 0;
				foreach ( array( 'plugins', 'themes', 'uploads', 'others' ) as $part ) {
					if ( isset( $b[ $part ] ) && is_array( $b[ $part ] ) ) {
						$file_count += count( $b[ $part ] );
					}
				}
				if ( isset( $b['db'] ) ) {
					$file_count++;
				}
				$backups[] = array(
					'plugin' => 'UpdraftPlus',
					'date'   => date( 'Y-m-d H:i', $ts ),
					'type'   => 'scheduled/manual',
					'result' => 'completed',
					'files'  => $file_count,
				);
			}
		}
	}

	usort( $backups, fn( $a, $b ) => strcmp( $b['date'], $a['date'] ) );
	$report['backups'] = $backups;

	// 2. PLUGIN activity (mtime proxy)
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	$plugin_activity = array();
	foreach ( get_plugins() as $file => $data ) {
		$folder = dirname( $file );
		if ( $folder === '.' ) {
			$folder = basename( $file, '.php' );
		}
		$full_path = WP_PLUGIN_DIR . '/' . $folder;
		$max_mtime = 0;
		if ( is_dir( $full_path ) ) {
			$rii = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $full_path, FilesystemIterator::SKIP_DOTS ) );
			foreach ( $rii as $f ) {
				if ( $f->isFile() ) {
					$max_mtime = max( $max_mtime, $f->getMTime() );
				}
			}
		}
		if ( $max_mtime >= $cutoff ) {
			$plugin_activity[] = array(
				'name'          => $data['Name'],
				'version'       => $data['Version'],
				'last_modified' => date( 'Y-m-d H:i', $max_mtime ),
			);
		}
	}
	usort( $plugin_activity, fn( $a, $b ) => strcmp( $b['last_modified'], $a['last_modified'] ) );
	$report['plugin_theme_activity'] = $plugin_activity;

	// THEME
	require_once ABSPATH . 'wp-admin/includes/theme.php';
	$theme     = wp_get_theme();
	$theme_dir = $theme->get_stylesheet_directory();
	$max_mtime = 0;
	if ( is_dir( $theme_dir ) ) {
		$rii = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $theme_dir, FilesystemIterator::SKIP_DOTS ) );
		foreach ( $rii as $f ) {
			if ( $f->isFile() ) {
				$max_mtime = max( $max_mtime, $f->getMTime() );
			}
		}
	}
	$report['theme'] = array(
		'name'          => $theme->get( 'Name' ),
		'version'       => $theme->get( 'Version' ),
		'last_modified' => $max_mtime >= $cutoff ? date( 'Y-m-d H:i', $max_mtime ) : 'no changes in range',
	);

	// CORE
	global $wp_version;
	$version_file = ABSPATH . 'wp-includes/version.php';
	$core_mtime   = file_exists( $version_file ) ? filemtime( $version_file ) : 0;
	$report['wp_core'] = array(
		'version'                     => $wp_version,
		'version_file_last_modified' => date( 'Y-m-d H:i', $core_mtime ),
		'likely_updated_in_range'    => ( $core_mtime >= $cutoff ),
	);

	// 3. CONTENT changes
	$posts = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT ID, post_title, post_type, post_status, post_modified
			 FROM {$wpdb->posts}
			 WHERE post_modified >= %s
			 AND post_type NOT IN ('revision','nav_menu_item','customize_changeset','oembed_cache','wp_global_styles')
			 AND post_status NOT IN ('auto-draft','trash')
			 ORDER BY post_modified DESC",
			$cutoff_date
		)
	);
	$content = array();
	foreach ( $posts as $p ) {
		$content[] = array(
			'id'                   => $p->ID,
			'title'                => $p->post_title,
			'type'                 => $p->post_type,
			'status'               => $p->post_status,
			'last_modified'        => $p->post_modified,
			'revisions_in_history' => count( wp_get_post_revisions( $p->ID ) ),
		);
	}
	$report['content_changes'] = $content;

	// 4. BUG FIX / custom code (mtime proxy — theme + mu-plugins)
	$dirs = array(
		'theme'      => get_stylesheet_directory(),
		'mu-plugins' => WPMU_PLUGIN_DIR,
	);
	$code_changes = array();
	foreach ( $dirs as $label => $dir ) {
		if ( ! is_dir( $dir ) ) {
			$code_changes[ $label ] = 'directory not found';
			continue;
		}
		$files = array();
		$rii   = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS ) );
		foreach ( $rii as $f ) {
			if ( $f->isFile() && preg_match( '/\.(php|css|js)$/', $f->getFilename() ) ) {
				$m = $f->getMTime();
				if ( $m >= $cutoff ) {
					$files[] = array(
						'path'     => str_replace( ABSPATH, '', $f->getPathname() ),
						'modified' => date( 'Y-m-d H:i', $m ),
					);
				}
			}
		}
		usort( $files, fn( $a, $b ) => strcmp( $b['modified'], $a['modified'] ) );
		$code_changes[ $label ] = $files;
	}
	$report['code_changes'] = $code_changes;

	return $report;
}
}
