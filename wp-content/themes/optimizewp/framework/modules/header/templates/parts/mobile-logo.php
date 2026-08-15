<?php do_action('optimize_mikado_before_mobile_logo'); ?>

<div class="mkdf-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php optimize_mikado_inline_style($logo_styles); ?>>
        <img <?php echo optimize_mikado_get_inline_attrs($logo_dimensions_attr); ?> src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_attr_e( 'mobile-logo', 'optimizewp' ); ?>"/>
    </a>
</div>

<?php do_action('optimize_mikado_after_mobile_logo'); ?>