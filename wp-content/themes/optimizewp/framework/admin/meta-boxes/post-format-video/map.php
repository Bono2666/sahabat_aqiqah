<?php

/*** Video Post Format ***/

$video_post_format_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => esc_html__( 'Video Post Format', 'optimizewp' ),
		'name' 	=> 'post_format_video_meta'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_video_type_meta',
		'type'        => 'select',
		'label' => esc_html__( 'Video Type', 'optimizewp' ),
		'description' => esc_html__( 'Choose video type', 'optimizewp' ),
		'parent'      => $video_post_format_meta_box,
		'default_value' => 'youtube',
		'options'     => array(
			'youtube' => esc_html__('Youtube', 'optimizewp' ),
			'vimeo' => esc_html__('Vimeo', 'optimizewp' ),
			'self' => esc_html__('Self Hosted', 'optimizewp' )
		),
		'args' => array(
		'dependence' => true,
		'hide' => array(
			'youtube' => '#mkdf_mkdf_video_self_hosted_container',
			'vimeo' => '#mkdf_mkdf_video_self_hosted_container',
			'self' => '#mkdf_mkdf_video_embedded_container'
		),
		'show' => array(
			'youtube' => '#mkdf_mkdf_video_embedded_container',
			'vimeo' => '#mkdf_mkdf_video_embedded_container',
			'self' => '#mkdf_mkdf_video_self_hosted_container')
	)
	)
);

$mkdf_video_embedded_container = optimize_mikado_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'mkdf_video_embedded_container',
		'hidden_property' => 'mkdf_video_type_meta',
		'hidden_value' => 'self'
	)
);

$mkdf_video_self_hosted_container = optimize_mikado_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'mkdf_video_self_hosted_container',
		'hidden_property' => 'mkdf_video_type_meta',
		'hidden_values' => array('youtube', 'vimeo')
	)
);



optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_id_meta',
		'type'        => 'text',
		'label' => esc_html__( 'Video ID', 'optimizewp' ),
		'description' => esc_html__( 'Enter Video ID', 'optimizewp' ),
		'parent'      => $mkdf_video_embedded_container,

	)
);


optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_image_meta',
		'type'        => 'image',
		'label' => esc_html__( 'Video Image', 'optimizewp' ),
		'description' => esc_html__( 'Upload video image', 'optimizewp' ),
		'parent'      => $mkdf_video_self_hosted_container,

	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_webm_link_meta',
		'type'        => 'text',
		'label' => esc_html__( 'Video WEBM', 'optimizewp' ),
		'description' => esc_html__( 'Enter video URL for WEBM format', 'optimizewp' ),
		'parent'      => $mkdf_video_self_hosted_container,

	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_mp4_link_meta',
		'type'        => 'text',
		'label' => esc_html__( 'Video MP4', 'optimizewp' ),
		'description' => esc_html__( 'Enter video URL for MP4 format', 'optimizewp' ),
		'parent'      => $mkdf_video_self_hosted_container,

	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_ogv_link_meta',
		'type'        => 'text',
		'label' => esc_html__( 'Video OGV', 'optimizewp' ),
		'description' => esc_html__( 'Enter video URL for OGV format', 'optimizewp' ),
		'parent'      => $mkdf_video_self_hosted_container,

	)
);