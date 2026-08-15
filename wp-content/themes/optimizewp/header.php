<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php if (!optimize_mikado_is_ajax_request()) optimize_mikado_wp_title(); ?>
    <?php
    /**
     * @see optimize_mikado_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    ?>
	<?php if (!optimize_mikado_is_ajax_request()) do_action('optimize_mikado_header_meta'); ?>

	<?php if (!optimize_mikado_is_ajax_request()) wp_head(); ?>
</head>

<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
<?php if (!optimize_mikado_is_ajax_request()) optimize_mikado_get_side_area(); ?>


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
	    <?php if (!optimize_mikado_is_ajax_request()) optimize_mikado_get_header(); ?>

	    <?php if ((!optimize_mikado_is_ajax_request()) && optimize_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='mkdf-back-to-top'  href='#'>
                <span class="mkdf-icon-stack">
                     <?php echo optimize_mikado_icon_collections()->renderIcon('arrow_carrot-up', 'font_elegant'); ?>
                </span>
                  <span class="mkdf-back-to-top-inner">
                    <span class="mkdf-back-to-top-text"><?php esc_html_e('Top', 'optimizewp'); ?></span>
                </span>
            </a>
        <?php } ?>

        <div class="mkdf-content" <?php optimize_mikado_content_elem_style_attr(); ?>>
            <?php if(optimize_mikado_is_ajax_enabled()) { ?>
            <div class="mkdf-meta">
                <?php do_action('optimize_mikado_ajax_meta'); ?>
                <span id="mkdf-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
                <div class="mkdf-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
            </div>
            <?php } ?>
            <div class="mkdf-content-inner">