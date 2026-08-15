<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => esc_html__( 'Audio Post Format', 'optimizewp' ),
		'name' 	=> 'post_format_audio_meta'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_audio_link_meta',
		'type'        => 'text',
		'label' => esc_html__( 'Link', 'optimizewp' ),
		'description' => esc_html__( 'Enter audion link', 'optimizewp' ),
		'parent'      => $audio_post_format_meta_box,

	)
);
