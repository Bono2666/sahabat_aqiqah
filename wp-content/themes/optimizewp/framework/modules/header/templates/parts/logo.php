<?php do_action('optimize_mikado_before_site_logo'); ?>

<div class="mkdf-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php optimize_mikado_inline_style($logo_styles); ?>>
        <img <?php echo optimize_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_attr_e( 'logo', 'optimizewp' ); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img <?php echo optimize_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_attr_e( 'dark logo', 'optimizewp' ); ?>"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img <?php echo optimize_mikado_get_inline_attrs($logo_dimensions_attr); ?> class="mkdf-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_attr_e( 'light logo', 'optimizewp' ); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('optimize_mikado_after_site_logo'); ?>