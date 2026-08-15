<?php

$footer_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__( 'Footer', 'optimizewp' ),
        'name' => 'footer_meta'
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_disable_footer_meta',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__( 'Disable Footer for this Page', 'optimizewp' ),
            'description' => esc_html__( 'Enabling this option will hide footer on this page', 'optimizewp' ),
            'parent' => $footer_meta_box,
        )
    );