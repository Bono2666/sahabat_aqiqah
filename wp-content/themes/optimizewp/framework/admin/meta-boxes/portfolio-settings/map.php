<?php

if(!function_exists('optimize_mikado_map_portfolio_settings')) {
    function optimize_mikado_map_portfolio_settings() {
        $meta_box = optimize_mikado_create_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__( 'Portfolio Settings', 'optimizewp' ),
            'name'  => 'portfolio_settings_meta_box'
        ));

        optimize_mikado_create_meta_box_field(array(
            'name'        => 'mkdf_portfolio_single_template_meta',
            'type'        => 'select',
            'label' => esc_html__( 'Portfolio Type', 'optimizewp' ),
            'description' => esc_html__( 'Choose a default type for Single Project pages', 'optimizewp' ),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'optimizewp' ),
                'small-images'      => esc_html__('Portfolio small images', 'optimizewp' ),
                'small-slider'      => esc_html__('Portfolio small slider', 'optimizewp' ),
                'big-images'        => esc_html__('Portfolio big images', 'optimizewp' ),
                'big-slider'        => esc_html__('Portfolio big slider', 'optimizewp' ),
                'custom'            => esc_html__('Portfolio custom', 'optimizewp' ),
                'full-width-custom' => esc_html__('Portfolio full width custom', 'optimizewp' ),
                'gallery'           => esc_html__('Portfolio gallery', 'optimizewp' )
            )
        ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        optimize_mikado_create_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label' => esc_html__( 'Back To Link', 'optimizewp' ),
            'description' => esc_html__( 'Choose spage to link from portfolio Single Project page', 'optimizewp' ),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        optimize_mikado_create_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'text',
            'label' => esc_html__( 'Portfolio External Link', 'optimizewp' ),
            'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'optimizewp' ),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

	    optimize_mikado_create_meta_box_field(array(
		    'name'        => 'portfolio_overlay_color',
		    'type'        => 'color',
		    'label' => esc_html__( 'Overlay Color', 'optimizewp' ),
		    'description' => esc_html__( 'Choose color for portfolio overlay. This color will be used for hover overlays in all portfolio shortcodes', 'optimizewp' ),
		    'parent'      => $meta_box,
		    'options'     => array(
			    'default'            => esc_html__('Default', 'optimizewp' ),
			    'large_width'        => esc_html__('Large width', 'optimizewp' ),
			    'large_height'       => esc_html__('Large height', 'optimizewp' ),
			    'large_width_height' => esc_html__('Large width/height', 'optimizewp' )
		    )
	    ));
    }

    add_action('optimize_mikado_meta_boxes_map', 'optimize_mikado_map_portfolio_settings');
}