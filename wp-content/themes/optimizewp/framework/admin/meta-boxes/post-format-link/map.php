<?php

/*** Link Post Format ***/

$link_post_format_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' => array('post'),
		'title' => esc_html__( 'Link Post Format', 'optimizewp' ),
		'name' => 'post_format_link_meta'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_link_link_meta',
		'type'        => 'text',
		'label' => esc_html__( 'Link', 'optimizewp' ),
		'description' => esc_html__( 'Enter link', 'optimizewp' ),
		'parent'      => $link_post_format_meta_box,

	)
);

