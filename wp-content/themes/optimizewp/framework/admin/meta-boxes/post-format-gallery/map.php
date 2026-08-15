<?php

/*** Gallery Post Format ***/

$gallery_post_format_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => esc_html__( 'Gallery Post Format', 'optimizewp' ),
		'name' 	=> 'post_format_gallery_meta'
	)
);

optimize_mikado_add_multiple_images_field(
	array(
		'name'        => 'mkdf_post_gallery_images_meta',
		'label' => esc_html__( 'Gallery Images', 'optimizewp' ),
		'description' => esc_html__( 'Choose your gallery images', 'optimizewp' ),
		'parent'      => $gallery_post_format_meta_box,
	)
);
