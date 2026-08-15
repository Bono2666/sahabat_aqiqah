<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<?php optimize_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner">
				<?php optimize_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
				<?php optimize_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<div class="mkdf-post-info">
					<?php optimize_mikado_post_info(array('date' => 'yes', 'author' => 'yes', 'category' => 'yes', 'comments' => 'yes', 'share' => 'yes', 'like' => 'yes')) ?>
				</div>
				<?php
					optimize_mikado_excerpt();
					$args_pages = array(
							'before'           => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
							'after'            => '</div></div>',
							'link_before'      => '<span>',
							'link_after'       => '</span>',
							'pagelink'         => '%'
					);

					wp_link_pages($args_pages);
				?>
				<?php optimize_mikado_get_module_template_part('templates/parts/social-share', 'blog'); ?>
			</div>
		</div>
	</div>
</article>