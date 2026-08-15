<?php

//Carousels

$carousel_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('carousels'),
        'title' => esc_html__( 'Carousel', 'optimizewp' ),
        'name' => 'carousel_meta'
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_carousel_image',
            'type'        => 'image',
            'label' => esc_html__( 'Carousel Image', 'optimizewp' ),
            'description' => esc_html__( 'Choose carousel image (min width needs to be 215px)', 'optimizewp' ),
            'parent'      => $carousel_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_carousel_hover_image',
            'type'        => 'image',
            'label' => esc_html__( 'Carousel Hover Image', 'optimizewp' ),
            'description' => esc_html__( 'Choose carousel hover image (min width needs to be 215px)', 'optimizewp' ),
            'parent'      => $carousel_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_carousel_item_link',
            'type'        => 'text',
            'label' => esc_html__( 'Link', 'optimizewp' ),
            'description' => esc_html__( 'Enter the URL to which you want the image to link to (e.g. http://www.example.com)', 'optimizewp' ),
            'parent'      => $carousel_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_carousel_item_target',
            'type'        => 'selectblank',
            'label' => esc_html__( 'Target', 'optimizewp' ),
            'description' => esc_html__( 'Specify where to open the linked document', 'optimizewp' ),
            'parent'      => $carousel_meta_box,
            'options' => array(
            	'_self' => esc_html__('Self', 'optimizewp' ),
            	'_blank' => esc_html__('Blank', 'optimizewp' )
        	)
        )
    );