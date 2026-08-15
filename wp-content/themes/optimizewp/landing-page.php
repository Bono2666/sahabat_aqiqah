<?php
/*
Template Name: Landing Page
*/
$sidebar = optimize_mikado_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
	    <?php if (!optimize_mikado_is_ajax_request()) optimize_mikado_wp_title(); ?>

        <?php
        /**
         * optimize_mikado_header_meta hook
         *
         * @see optimize_mikado_header_meta() - hooked with 10
         * @see mkd_user_scalable_meta() - hooked with 10
         */
	    if (!optimize_mikado_is_ajax_request()) do_action('optimize_mikado_header_meta');
        ?>

	    <?php if (!optimize_mikado_is_ajax_request()) wp_head(); ?>
    </head>

<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">

<?php
if((!optimize_mikado_is_ajax_request()) && optimize_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") {
	$ajax_class = optimize_mikado_options()->getOptionValue('smooth_pt_true_ajax') === 'no' ? 'mkdf-mimic-ajax' : 'mkdf-ajax';
?>
<div class="mkdf-smooth-transition-loader <?php echo esc_attr($ajax_class); ?>">
    <div class="mkdf-st-loader">
        <div class="mkdf-st-loader1">
            <?php optimize_mikado_loading_spinners(); ?>
        </div>
    </div>
</div>
<?php } ?>

<div class="mkdf-wrapper">
	<div class="mkdf-wrapper-inner">
		<div class="mkdf-content">
            <?php if(optimize_mikado_is_ajax_enabled()) { ?>
            <div class="mkdf-meta">
                <?php do_action('optimize_mikado_ajax_meta'); ?>
                <span id="mkdf-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
                <div class="mkdf-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
            </div>
            <?php } ?>
			<div class="mkdf-content-inner">
				<?php optimize_mikado_get_title(); ?>
				<?php get_template_part('slider');?>
				<div class="mkdf-full-width">
					<div class="mkdf-full-width-inner">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php if(($sidebar == 'default')||($sidebar == '')) : ?>
								<?php the_content(); ?>
								<?php do_action('optimize_mikado_page_after_content'); ?>
							<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
								<div <?php echo optimize_mikado_sidebar_columns_class(); ?>>
									<div class="mkdf-column1 mkdf-content-left-from-sidebar">
										<div class="mkdf-column-inner">
											<?php the_content(); ?>
											<?php do_action('optimize_mikado_page_after_content'); ?>
										</div>
									</div>
									<div class="mkdf-column2">
										<?php get_sidebar(); ?>
									</div>
								</div>
							<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
								<div <?php echo optimize_mikado_sidebar_columns_class(); ?>>
									<div class="mkdf-column1">
										<?php get_sidebar(); ?>
									</div>
									<div class="mkdf-column2 mkdf-content-right-from-sidebar">
										<div class="mkdf-column-inner">
											<?php the_content(); ?>
											<?php do_action('optimize_mikado_page_after_content'); ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>