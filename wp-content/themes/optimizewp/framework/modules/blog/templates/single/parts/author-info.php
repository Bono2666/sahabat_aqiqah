<?php
$author_info_box   = esc_attr(optimize_mikado_options()->getOptionValue('blog_author_info'));
$author_info_email = esc_attr(optimize_mikado_options()->getOptionValue('blog_author_info_email'));
$social_networks   = optimize_mikado_get_user_custom_fields();

?>
<?php if($author_info_box === 'yes') { ?>
	<div class="mkdf-author-description">
		<div class="mkdf-author-description-inner clearfix">
			<div class="mkdf-author-description-image">
				<a href="<?php echo esc_url(optimize_mikado_get_author_posts_url()); ?>">
					<?php echo optimize_mikado_kses_img(get_avatar(get_the_author_meta('ID'), 102)); ?>
				</a>
			</div>
			<div class="mkdf-author-description-text-holder">
				<h4 class="mkdf-author-name">
					<a href="<?php echo esc_url(optimize_mikado_get_author_posts_url()); ?>">
						<span itemprop="author">
							<?php echo esc_html(optimize_mikado_get_the_author_name()); ?>
						</span>
					</a>
				</h4>

				<?php if(get_the_author_meta('position') !== '') : ?>
					<div class="mkdf-author-position-holder">
						<h6 class="mkdf-author-position"><?php echo esc_html(get_the_author_meta('position')); ?></h6>
					</div>
				<?php endif; ?>

				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))) { ?>
					<p class="mkdf-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="mkdf-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
				<?php if(is_array($social_networks) && count($social_networks)) { ?>

					<div class="mkdf-author-social-holder clearfix">
						<?php foreach($social_networks as $network) { ?>
							<a href="<?php echo esc_url($network['link']) ?>" target="blank">
								<?php echo optimize_mikado_icon_collections()->renderIcon($network['class'], 'font_elegant'); ?>
							</a>
						<?php } ?>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>