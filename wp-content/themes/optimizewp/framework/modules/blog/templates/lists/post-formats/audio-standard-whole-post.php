<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<?php optimize_mikado_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
		<?php optimize_mikado_get_module_template_part('templates/parts/audio', 'blog'); ?>
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner">
				<div class="mkdf-post-info">
					<?php optimize_mikado_post_info(array('date'     => 'yes',
					                                      'category' => 'yes',
					                                      'comments' => 'yes',
					                                      'like'     => 'yes'
					)) ?>
				</div>
				<?php optimize_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<div class="mkdf-post-excerpt">
					<?php the_content(); ?>
				</div>
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
				<?php if(optimize_mikado_core_installed()) { ?>
				<div class="mkdf-share-icons">
					<?php $post_info_array['share'] = optimize_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
					<?php if($post_info_array['share'] == 'yes'): ?>
						<span class="mkdf-share-label"><?php esc_html_e('Share', 'optimizewp'); ?></span>
					<?php endif; ?>
					<?php echo optimize_mikado_get_social_share_html(array('type'      => 'list',
					                                                       'icon_type' => 'normal'
					)); ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</article>