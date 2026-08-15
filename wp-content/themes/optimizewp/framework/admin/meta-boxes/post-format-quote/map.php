<?php

/*** Quote Post Format ***/

$quote_post_format_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => esc_html__( 'Quote Post Format', 'optimizewp' ),
		'name' 	=> 'post_format_quote_meta'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_quote_text_meta',
		'type'        => 'text',
		'label' => esc_html__( 'Quote Text', 'optimizewp' ),
		'description' => esc_html__( 'Enter Quote text', 'optimizewp' ),
		'parent'      => $quote_post_format_meta_box,

	)
);
