<?php

$general_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__( 'General', 'optimizewp' ),
        'name' => 'general_meta'
    )
);


    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_page_background_color_meta',
            'type' => 'color',
            'default_value' => '',
            'label' => esc_html__( 'Page Background Color', 'optimizewp' ),
            'description' => esc_html__( 'Choose background color for page content', 'optimizewp' ),
            'parent' => $general_meta_box
        )
    );
	
	optimize_mikado_create_meta_box_field(
		array(
			'name' => 'mkdf_page_padding_meta',
			'type' => 'text',
			'default_value' => '',
			'label' => esc_html__( 'Page Padding', 'optimizewp' ),
			'description' => esc_html__( 'Insert padding in format 10px 10px 10px 10px', 'optimizewp' ),
			'parent' => $general_meta_box
		)
	);

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_page_slider_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => esc_html__( 'Slider Shortcode', 'optimizewp' ),
            'description' => esc_html__( 'Paste your slider shortcode here', 'optimizewp' ),
            'parent' => $general_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_page_transition_type',
            'type'        => 'selectblank',
            'label' => esc_html__( 'Page Transition', 'optimizewp' ),
            'description' => esc_html__( 'Choose the type of transition to this page', 'optimizewp' ),
            'parent'      => $general_meta_box,
            'default_value' => '',
            'options'     => array(
                'no-animation' => esc_html__('No animation', 'optimizewp' ),
                'fade' => esc_html__('Fade', 'optimizewp' )
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_page_comments_meta',
            'type'        => 'selectblank',
            'label' => esc_html__( 'Show Comments', 'optimizewp' ),
            'description' => esc_html__( 'Enabling this option will show comments on your page', 'optimizewp' ),
            'parent'      => $general_meta_box,
            'options'     => array(
                'yes' => esc_html__('Yes', 'optimizewp' ),
                'no' => esc_html__('No', 'optimizewp' ),
            )
        )
    );