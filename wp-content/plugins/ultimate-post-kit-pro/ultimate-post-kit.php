<?php

/**
 * Plugin Name: Ultimate Post Kit Pro
 * Plugin URI: https://bdthemes.com/ultimate-post-kit/
 * Secret Key: 83a5bb0e2ad5164690bc7a42ae592cf5
 * Description: <a href="https://bdthemes.com/ultimate-post-kit/">Ultimate Post Kit</a> is a packed of post related elementor widgets. This plugin gives you post related widget features for elementor page builder plugin.
 * Version: 2.10.0
 * Author: BdThemes
 * Author URI: https://bdthemes.com/
 * Text Domain: ultimate-post-kit
 * Domain Path: /languages
 * License: GPL3
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.6.5
 * @fs_premium_only /modules/classic-list/, /modules/welsh-list/, /modules/forbes-tabs/, /modules/grove-timeline/, /modules/hansel-slider/, /modules/holux-tabs/, /modules/kalon-grid/, /modules/kalon-carousel/, /modules/optick-slider/, /modules/pixina-grid/, /modules/pixina-carousel/, /modules/post-calendar/, /modules/soft-timeline/, /modules/snap-timeline/, /modules/social-link/, /modules/wixer-grid/, /modules/wixer-carousel/, /modules/atlas-slider/, /modules/berlin-slider/, /modules/sline-slider/, /modules/foxico-slider/, /modules/reading-progress-circle/, /modules/single-author/, /modules/single-category/, /modules/single-comments/, /modules/single-date/, /modules/single-title/, /assets/css/upk-classic-list.css, /assets/css/upk-classic-list.rtl.css, /assets/css/upk-welsh-list.css, /assets/css/upk-welsh-list.rtl.css, /assets/css/upk-forbes-tabs.css, /assets/css/upk-forbes-tabs.rtl.css, /assets/css/upk-grove-timeline.css, /assets/css/upk-grove-timeline.rtl.css, /assets/css/upk-hansel-slider.css, /assets/css/upk-hansel-slider.rtl.css, /assets/css/upk-holux-tabs.css, /assets/css/upk-holux-tabs.rtl.css, /assets/css/upk-kalon-grid.css, /assets/css/upk-kalon-grid.rtl.css, /assets/css/upk-kalon-carousel.css, /assets/css/upk-kalon-carousel.rtl.css, /assets/css/upk-optick-slider.css, /assets/css/upk-optick-slider.rtl.css, /assets/css/upk-pixina-grid.css, /assets/css/upk-pixina-grid.rtl.css, /assets/css/upk-pixina-carousel.css, /assets/css/upk-pixina-carousel.rtl.css, /assets/css/upk-post-calendar.css, /assets/css/upk-post-calendar.rtl.css, /assets/css/upk-soft-timeline.css, /assets/css/upk-soft-timeline.rtl.css, /assets/css/upk-snap-timeline.css, /assets/css/upk-snap-timeline.rtl.css, /assets/css/upk-social-link.css, /assets/css/upk-social-link.rtl.css, /assets/css/upk-wixer-grid.css, /assets/css/upk-wixer-grid.rtl.css, /assets/css/upk-wixer-carousel.css, /assets/css/upk-wixer-carousel.rtl.css, /assets/css/upk-atlas-slider.css, /assets/css/upk-atlas-slider.rtl.css, /assets/css/upk-berlin-slider.css, /assets/css/upk-berlin-slider.rtl.css, /assets/css/upk-sline-slider.css, /assets/css/upk-sline-slider.rtl.css, /assets/css/upk-foxico-slider.css, /assets/css/upk-foxico-slider.rtl.css, /assets/css/upk-reading-progress-circle.css, /assets/css/upk-reading-progress-circle.rtl.css, /assets/js/widgets/upk-forbes-tabs.js, /assets/js/widgets/upk-forbes-tabs.min.js, /assets/js/widgets/upk-grove-timeline.js, /assets/js/widgets/upk-grove-timeline.min.js, /assets/js/widgets/upk-hansel-slider.js, /assets/js/widgets/upk-hansel-slider.min.js, /assets/js/widgets/upk-holux-tabs.js,/assets/js/widgets/upk-holux-tabs.min.js,  /assets/js/widgets/upk-kalon-carousel.js, /assets/js/widgets/upk-kalon-carousel.min.js, /assets/js/widgets/upk-optick-slider.js, /assets/js/widgets/upk-optick-slider.min.js, /assets/js/widgets/upk-pixina-carousel.js, /assets/js/widgets/upk-pixina-carousel.min.js, /assets/js/widgets/upk-post-calendar.js, /assets/js/widgets/upk-post-calendar.min.js, /assets/js/widgets/upk-wixer-carousel.js, /assets/js/widgets/upk-wixer-carousel.min.js, /assets/js/widgets/upk-atlas-slider.js, /assets/js/widgets/upk-atlas-slider.min.js, /assets/js/widgets/upk-berlin-slider.js, /assets/js/widgets/upk-berlin-slider.min.js, /assets/js/widgets/upk-sline-slider.js, /assets/js/widgets/upk-sline-slider.min.js, /assets/js/widgets/upk-foxico-slider.js, /assets/js/widgets/upk-foxico-slider.min.js, /assets/js/widgets/upk-reading-progress-circle.js, /assets/js/widgets/upk-reading-progress-circle.min.js
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Some pre define value for easy use
define( 'BDTUPK_VER', '2.10.0' );
define( 'BDTUPK__FILE__', __FILE__ );
define( 'BDTUPK_PNAME', basename( dirname( BDTUPK__FILE__ ) ) );
define( 'BDTUPK_PBNAME', plugin_basename( BDTUPK__FILE__ ) );
define( 'BDTUPK_PATH', plugin_dir_path( BDTUPK__FILE__ ) );
define( 'BDTUPK_MODULES_PATH', BDTUPK_PATH . 'modules/' );
define( 'BDTUPK_INC_PATH', BDTUPK_PATH . 'includes/' );
define( 'BDTUPK_URL', plugins_url( '/', BDTUPK__FILE__ ) );
define( 'BDTUPK_ASSETS_URL', BDTUPK_URL . 'assets/' );
define( 'BDTUPK_ASSETS_PATH', BDTUPK_PATH . 'assets/' );
define( 'BDTUPK_MODULES_URL', BDTUPK_URL . 'modules/' );
define( 'BDTUPK_ADM_PATH', BDTUPK_PATH . 'admin/' );
define( 'BDTUPK_ADM_ASSETS_URL', BDTUPK_URL . 'admin/assets/' );

if ( function_exists( 'upk_fs' ) ) {
    upk_fs()->set_basename( true, __FILE__ );
} else {
    
    if ( !function_exists( 'upk_fs' ) ) {
        // Create a helper function for easy SDK access.
        function upk_fs()
        {
            global  $upk_fs ;
            
            if ( !isset( $upk_fs ) ) {
                // Activate multisite network integration.
                if ( !defined( 'WP_FS__PRODUCT_8719_MULTISITE' ) ) {
                    define( 'WP_FS__PRODUCT_8719_MULTISITE', true );
                }
                // Include Freemius SDK.
                class ultimatepostbabiatoUPKE {
					public function can_use_premium_code__premium_only() {
						return true;
					}
					public function is__premium_only() {
						return true;
					}
					public function is_premium() {
						return true;
					}
					public function is_plan() {
						return true;
					}
                    public function is_trial() {
						return false;
					}
                    public function is_paying() {
						return true;
					}
                    public function is_trial_utilized() {
						return false; 
					}
                    public function is_not_paying() {
						return false;
					}
				}

                $upk_fs = new ultimatepostbabiatoUPKE();
            }
            
            return $upk_fs;
        }
        
        // Init Freemius.
        upk_fs();
        // Signal that SDK was initiated.
        do_action( 'upk_fs_loaded' );
    }
    
    // Notice class
    require BDTUPK_ADM_PATH . 'admin-notice.php';
    // Widgets filters here
    require BDTUPK_INC_PATH . 'ultimate-post-kit-filters.php';
    if ( !class_exists( 'UltimatePostKit\\Admin' ) ) {
        require BDTUPK_ADM_PATH . 'admin.php';
    }
    // Helper function here
    require dirname( __FILE__ ) . '/includes/helper.php';
    require dirname( __FILE__ ) . '/includes/utils.php';
    /**
     * Plugin load here correctly
     * Also loaded the language file from here
     */
    function ultimate_post_kit_load_plugin()
    {
        load_plugin_textdomain( 'ultimate-post-kit', false, basename( dirname( __FILE__ ) ) . '/languages' );
        
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', 'ultimate_post_kit_fail_load' );
            return;
        }
        
        // Element pack widget and assets loader
        require BDTUPK_PATH . 'loader.php';
    }
    
    add_action( 'plugins_loaded', 'ultimate_post_kit_load_plugin' );
    /**
     * Check Elementor installed and activated correctly
     */
    function ultimate_post_kit_fail_load()
    {
        $screen = get_current_screen();
        if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
            return;
        }
        $plugin = 'elementor/elementor.php';
        
        if ( _is_elementor_installed() ) {
            if ( !current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
            $admin_message = '<p>' . esc_html__( 'Ops! Ultimate Post Kit not working because you need to activate the Elementor plugin first.', 'ultimate-post-kit' ) . '</p>';
            $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'ultimate-post-kit' ) ) . '</p>';
        } else {
            if ( !current_user_can( 'install_plugins' ) ) {
                return;
            }
            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $admin_message = '<p>' . esc_html__( 'Ops! Ultimate Post Kit not working because you need to install the Elementor plugin', 'ultimate-post-kit' ) . '</p>';
            $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'ultimate-post-kit' ) ) . '</p>';
        }
        
        echo  '<div class="error">' . $admin_message . '</div>' ;
    }
    
    /**
     * Check the elementor installed or not
     */
    if ( !function_exists( '_is_elementor_installed' ) ) {
        function _is_elementor_installed()
        {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();
            return isset( $installed_plugins[$file_path] );
        }
    
    }
}