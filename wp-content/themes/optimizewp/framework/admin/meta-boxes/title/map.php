<?php

$title_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' => array('page', 'portfolio-item', 'post'),
		'title' => esc_html__( 'Title', 'optimizewp' ),
		'name'  => 'title_meta'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_show_title_area_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Show Title Area', 'optimizewp' ),
		'description' => esc_html__( 'Disabling this option will turn off page title area', 'optimizewp' ),
		'parent'        => $title_meta_box,
		'options'       => array(
			''    => '',
			'no'  => esc_html__('No', 'optimizewp' ),
			'yes' => esc_html__('Yes', 'optimizewp' )
		),
		'args'          => array(
			"dependence" => true,
			"hide"       => array(
				""    => "",
				"no"  => "#mkdf_mkdf_show_title_area_meta_container",
				"yes" => ""
			),
			"show"       => array(
				""    => "#mkdf_mkdf_show_title_area_meta_container",
				"no"  => "",
				"yes" => "#mkdf_mkdf_show_title_area_meta_container"
			)
		)
	)
);

$show_title_area_meta_container = optimize_mikado_add_admin_container(
	array(
		'parent'          => $title_meta_box,
		'name'            => 'mkdf_show_title_area_meta_container',
		'hidden_property' => 'mkdf_show_title_area_meta',
		'hidden_value'    => 'no'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_title_area_type_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Title Area Type', 'optimizewp' ),
		'description' => esc_html__( 'Choose title type', 'optimizewp' ),
		'parent'        => $show_title_area_meta_container,
		'options'       => array(
			''           => '',
			'standard'   => esc_html__('Standard', 'optimizewp' ),
			'breadcrumb' => esc_html__('Breadcrumb', 'optimizewp' )
		),
		'args'          => array(
			"dependence" => true,
			"hide"       => array(
				"standard"   => "",
				"standard"   => "",
				"breadcrumb" => "#mkdf_mkdf_title_area_type_meta_container"
			),
			"show"       => array(
				""           => "#mkdf_mkdf_title_area_type_meta_container",
				"standard"   => "#mkdf_mkdf_title_area_type_meta_container",
				"breadcrumb" => ""
			)
		)
	)
);

$title_area_type_meta_container = optimize_mikado_add_admin_container(
	array(
		'parent'          => $show_title_area_meta_container,
		'name'            => 'mkdf_title_area_type_meta_container',
		'hidden_property' => 'mkdf_title_area_type_meta',
		'hidden_value'    => '',
		'hidden_values'   => array('breadcrumb'),
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_title_area_enable_breadcrumbs_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Enable Breadcrumbs', 'optimizewp' ),
		'description' => esc_html__( 'This option will display Breadcrumbs in Title Area', 'optimizewp' ),
		'parent'        => $title_area_type_meta_container,
		'options'       => array(
			''    => '',
			'no'  => esc_html__('No', 'optimizewp' ),
			'yes' => esc_html__('Yes', 'optimizewp' )
		),
	)
);

optimize_mikado_create_meta_box_field(array(
	'name'        => 'mkdf_title_text_size_meta',
	'type'        => 'select',
	'label' => esc_html__( 'Choose Title Text Size', 'optimizewp' ),
	'description' => esc_html__( 'Choose predefined size for title text', 'optimizewp' ),
	'parent'      => $title_area_type_meta_container,
	'options'     => array(
		''       => esc_html__('Default', 'optimizewp' ),
		'medium' => esc_html__('Medium', 'optimizewp' ),
		'large'  => esc_html__('Large', 'optimizewp' )
	)
));

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_title_area_animation_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Animations', 'optimizewp' ),
		'description' => esc_html__( 'Choose an animation for Title Area', 'optimizewp' ),
		'parent'        => $show_title_area_meta_container,
		'options'       => array(
			''           => '',
			'no'         => esc_html__('No Animation', 'optimizewp' ),
			'right-left' => esc_html__('Text right to left', 'optimizewp' ),
			'left-right' => esc_html__('Text left to right', 'optimizewp' )
		)
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_title_area_vertial_alignment_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Vertical Alignment', 'optimizewp' ),
		'description' => esc_html__( 'Specify title vertical alignment', 'optimizewp' ),
		'parent'        => $show_title_area_meta_container,
		'options'       => array(
			''              => '',
			'header_bottom' => esc_html__('From Bottom of Header', 'optimizewp' ),
			'window_top'    => esc_html__('From Window Top', 'optimizewp' )
		)
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_title_area_content_alignment_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Horizontal Alignment', 'optimizewp' ),
		'description' => esc_html__( 'Specify title horizontal alignment', 'optimizewp' ),
		'parent'        => $show_title_area_meta_container,
		'options'       => array(
			''       => '',
			'left'   => esc_html__('Left', 'optimizewp' ),
			'center' => esc_html__('Center', 'optimizewp' ),
			'right'  => esc_html__('Right', 'optimizewp' )
		)
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_title_text_color_meta',
		'type'        => 'color',
		'label' => esc_html__( 'Title Color', 'optimizewp' ),
		'description' => esc_html__( 'Choose a color for title text', 'optimizewp' ),
		'parent'      => $show_title_area_meta_container
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_title_breadcrumb_color_meta',
		'type'        => 'color',
		'label' => esc_html__( 'Breadcrumb Color', 'optimizewp' ),
		'description' => esc_html__( 'Choose a color for breadcrumb text', 'optimizewp' ),
		'parent'      => $show_title_area_meta_container
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_title_area_background_color_meta',
		'type'        => 'color',
		'label' => esc_html__( 'Background Color', 'optimizewp' ),
		'description' => esc_html__( 'Choose a background color for Title Area', 'optimizewp' ),
		'parent'      => $show_title_area_meta_container
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_hide_background_image_meta',
		'type'          => 'yesno',
		'default_value' => 'no',
		'label' => esc_html__( 'Hide Background Image', 'optimizewp' ),
		'description' => esc_html__( 'Enable this option to hide background image in Title Area', 'optimizewp' ),
		'parent'        => $show_title_area_meta_container,
		'args'          => array(
			"dependence"             => true,
			"dependence_hide_on_yes" => "#mkdf_mkdf_hide_background_image_meta_container",
			"dependence_show_on_yes" => ""
		)
	)
);

$hide_background_image_meta_container = optimize_mikado_add_admin_container(
	array(
		'parent'          => $show_title_area_meta_container,
		'name'            => 'mkdf_hide_background_image_meta_container',
		'hidden_property' => 'mkdf_hide_background_image_meta',
		'hidden_value'    => 'yes'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_title_area_background_image_meta',
		'type'        => 'image',
		'label' => esc_html__( 'Background Image', 'optimizewp' ),
		'description' => esc_html__( 'Choose an Image for Title Area', 'optimizewp' ),
		'parent'      => $hide_background_image_meta_container
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_title_area_background_image_responsive_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Background Responsive Image', 'optimizewp' ),
		'description' => esc_html__( 'Enabling this option will make Title background image responsive', 'optimizewp' ),
		'parent'        => $hide_background_image_meta_container,
		'options'       => array(
			''    => '',
			'no'  => esc_html__('No', 'optimizewp' ),
			'yes' => esc_html__('Yes', 'optimizewp' )
		),
		'args'          => array(
			"dependence" => true,
			"hide"       => array(
				""    => "",
				"no"  => "",
				"yes" => "#mkdf_mkdf_title_area_background_image_responsive_meta_container, #mkdf_mkdf_title_area_height_meta"
			),
			"show"       => array(
				""    => "#mkdf_mkdf_title_area_background_image_responsive_meta_container, #mkdf_mkdf_title_area_height_meta",
				"no"  => "#mkdf_mkdf_title_area_background_image_responsive_meta_container, #mkdf_mkdf_title_area_height_meta",
				"yes" => ""
			)
		)
	)
);

$title_area_background_image_responsive_meta_container = optimize_mikado_add_admin_container(
	array(
		'parent'          => $hide_background_image_meta_container,
		'name'            => 'mkdf_title_area_background_image_responsive_meta_container',
		'hidden_property' => 'mkdf_title_area_background_image_responsive_meta',
		'hidden_value'    => 'yes'
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_title_area_background_image_parallax_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Background Image in Parallax', 'optimizewp' ),
		'description' => esc_html__( 'Enabling this option will make Title background image parallax', 'optimizewp' ),
		'parent'        => $title_area_background_image_responsive_meta_container,
		'options'       => array(
			''         => '',
			'no'       => esc_html__('No', 'optimizewp' ),
			'yes'      => esc_html__('Yes', 'optimizewp' ),
			'yes_zoom' => esc_html__('Yes, with zoom out', 'optimizewp' )
		)
	)
);

optimize_mikado_create_meta_box_field(array(
	'name'        => 'mkdf_title_area_height_meta',
	'type'        => 'text',
	'label' => esc_html__( 'Height', 'optimizewp' ),
	'description' => esc_html__( 'Set a height for Title Area', 'optimizewp' ),
	'parent'      => $show_title_area_meta_container,
	'args'        => array(
		'col_width' => 2,
		'suffix'    => 'px'
	)
));

optimize_mikado_create_meta_box_field(array(
	'name'          => 'mkdf_disable_title_bottom_border_meta',
	'type'          => 'yesno',
	'label' => esc_html__( 'Disable Title Bottom Border', 'optimizewp' ),
	'description' => esc_html__( 'This option will disable title area bottom border', 'optimizewp' ),
	'parent'        => $show_title_area_meta_container,
	'default_value' => 'no'
));

optimize_mikado_create_meta_box_field(array(
	'name'          => 'mkdf_title_area_subtitle_meta',
	'type'          => 'text',
	'default_value' => '',
	'label' => esc_html__( 'Subtitle Text', 'optimizewp' ),
	'description' => esc_html__( 'Enter your subtitle text', 'optimizewp' ),
	'parent'        => $show_title_area_meta_container,
	'args'          => array(
		'col_width' => 6
	)
));

optimize_mikado_create_meta_box_field(
	array(
		'name'        => 'mkdf_subtitle_color_meta',
		'type'        => 'color',
		'label' => esc_html__( 'Subtitle Color', 'optimizewp' ),
		'description' => esc_html__( 'Choose a color for subtitle text', 'optimizewp' ),
		'parent'      => $show_title_area_meta_container
	)
);