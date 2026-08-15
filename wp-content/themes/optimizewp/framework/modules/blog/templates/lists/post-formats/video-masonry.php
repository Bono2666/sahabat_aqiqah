<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-image">
			<?php optimize_mikado_get_module_template_part('templates/parts/video', 'blog'); ?>
		</div>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner">
				<div class="mkdf-post-info">
					<?php optimize_mikado_post_info(array('date' => 'yes')) ?>
				</div>
				<?php optimize_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php
				optimize_mikado_excerpt($excerpt_length);
				$args_pages = array(
					'before'      => '<div class="mkdf-single-links-pages"><div class="mkdf-single-links-pages-inner">',
					'after'       => '</div></div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '%'
				);

				wp_link_pages($args_pages);
				?>
			</div>
			<div class="mkdf-author-desc clearfix">
				<div class="mkdf-image-name">
					<div class="mkdf-author-image">
						<a href="<?php echo esc_url(optimize_mikado_get_author_posts_url()) ?>">
							<?php echo optimize_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
						</a>
					</div>
					<div class="mkdf-author-name-holder">
						<h5 class="mkdf-author-name">
							<a href="<?php echo esc_url(optimize_mikado_get_author_posts_url()); ?>">
								<span><?php esc_html_e('by', 'optimizewp'); ?></span>
								<span itemprop="author">
									<?php echo esc_html(optimize_mikado_get_the_author_name()); ?>
								</span>
							</a>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>