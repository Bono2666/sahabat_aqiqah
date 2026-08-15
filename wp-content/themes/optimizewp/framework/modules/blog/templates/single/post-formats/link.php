<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkdf-post-content">
		<div class="mkdf-post-text">
			<div class="mkdf-post-text-inner clearfix">
				<div class="mkdf-post-mark">
					<span aria-hidden="true" class="icon_link"></span>
				</div>
				<div class="mkdf-post-info">
					<?php optimize_mikado_post_info(array('date' => 'yes', 'like' => 'yes', 'comments' => 'yes', 'category' => 'yes')) ?>
				</div>
				<h3 class="mkdf-post-title">
					<a href="<?php echo esc_url(get_post_meta(get_the_ID(), "mkdf_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h3>
			</div>
		</div>
		<?php the_content(); ?>
		<div class="mkdf-category-share-holder clearfix">
			<?php do_action('optimize_mikado_before_blog_article_closed_tag'); ?>
			<?php if(optimize_mikado_core_installed()) { ?>
			<div class="mkdf-share-icons-single">
				<?php $post_info_array['share'] = optimize_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
				<?php if($post_info_array['share'] == 'yes'): ?>
					<span class="mkdf-share-label"><?php esc_html_e('Share', 'optimizewp'); ?></span>
				<?php endif; ?>
				<?php echo optimize_mikado_get_social_share_html(array(
					'type'      => 'list',
					'icon_type' => 'normal'
				)); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</article>