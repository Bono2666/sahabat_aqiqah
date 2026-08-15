<?php

//Testimonials

$testimonial_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('testimonials'),
        'title' => esc_html__( 'Testimonial', 'optimizewp' ),
        'name' => 'testimonial_meta'
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name'        	=> 'mkdf_testimonial_title',
            'type'        	=> 'text',
            'label' => esc_html__( 'Title', 'optimizewp' ),
            'description' => esc_html__( 'Enter testimonial title', 'optimizewp' ),
            'parent'      	=> $testimonial_meta_box,
        )
    );


    optimize_mikado_create_meta_box_field(
        array(
            'name'        	=> 'mkdf_testimonial_author',
            'type'        	=> 'text',
            'label' => esc_html__( 'Author', 'optimizewp' ),
            'description' => esc_html__( 'Enter author name', 'optimizewp' ),
            'parent'      	=> $testimonial_meta_box,
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        	=> 'mkdf_testimonial_author_position',
            'type'        	=> 'text',
            'label' => esc_html__( 'Job Position', 'optimizewp' ),
            'description' => esc_html__( 'Enter job position', 'optimizewp' ),
            'parent'      	=> $testimonial_meta_box,
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        	=> 'mkdf_testimonial_text',
            'type'        	=> 'text',
            'label' => esc_html__( 'Text', 'optimizewp' ),
            'description' => esc_html__( 'Enter testimonial text', 'optimizewp' ),
            'parent'      	=> $testimonial_meta_box,
        )
    );