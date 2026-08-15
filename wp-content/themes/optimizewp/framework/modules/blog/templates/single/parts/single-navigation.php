<?php if(optimize_mikado_options()->getOptionValue('blog_single_navigation') == 'yes'){ ?>
	<?php $navigation_blog_through_category = optimize_mikado_options()->getOptionValue('blog_navigation_through_same_category') ?>
	<div class="mkdf-blog-single-navigation clearfix">
		<div class="mkdf-blog-single-navigation-inner clearfix">
			<?php if($has_prev_post) : ?>
				<div class="mkdf-blog-single-prev clearfix <?php if($prev_post_has_image) { echo esc_attr('mkdf-single-nav-with-image'); } ?>">
					<?php if($prev_post_has_image) : ?>
						<div class="mkdf-single-nav-image-holder">
							<a href="<?php echo esc_url($prev_post['link']); ?>">
								<?php echo optimize_mikado_kses_img($prev_post['image']); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="mkdf-single-nav-content-holder">
						<h6>
							<a href="<?php echo esc_url($prev_post['link']); ?>">
								<?php echo esc_html($prev_post['title']); ?>
							</a>
						</h6>
						<a href="<?php echo esc_url($prev_post['link']) ?>">
							<?php echo optimize_mikado_icon_collections()->renderIcon('arrow_carrot-left_alt2', 'font_elegant') ?>
							<span><?php esc_html_e('Previous', 'optimizewp') ?></span>
						</a>
					</div>
				</div> <!-- close div.blog_prev -->
			<?php endif; ?>
			<?php if($has_next_post) : ?>
				<div class="mkdf-blog-single-next clearfix <?php if($next_post_has_image) { echo esc_attr('mkdf-single-nav-with-image'); } ?>">
					<?php if($next_post_has_image) : ?>
						<div class="mkdf-single-nav-image-holder">
							<a href="<?php echo esc_url($next_post['link']); ?>">
								<?php echo optimize_mikado_kses_img($next_post['image']); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="mkdf-single-nav-content-holder">
						<h6>
							<a href="<?php echo esc_url($next_post['link']); ?>">
								<?php echo esc_html($next_post['title']); ?>
							</a>
						</h6>
						<a href="<?php echo esc_url($next_post['link']) ?>">
							<span><?php esc_html_e('Next', 'optimizewp') ?></span>
							<?php echo optimize_mikado_icon_collections()->renderIcon('arrow_carrot-right_alt2', 'font_elegant') ?>
						</a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php } ?>