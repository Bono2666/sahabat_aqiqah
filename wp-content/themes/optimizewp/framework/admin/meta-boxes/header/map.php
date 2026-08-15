<?php

$header_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' => array('page', 'portfolio-item', 'post'),
		'title' => esc_html__( 'Header', 'optimizewp' ),
		'name'  => 'header_meta'
	)
);
optimize_mikado_create_meta_box_field(
	array(
		'name'          => 'mkdf_header_style_meta',
		'type'          => 'select',
		'default_value' => '',
		'label' => esc_html__( 'Header Skin', 'optimizewp' ),
		'description' => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'optimizewp' ),
		'parent'        => $header_meta_box,
		'options'       => array(
			''             => '',
			'light-header' => esc_html__('Light', 'optimizewp' ),
			'dark-header'  => esc_html__('Dark', 'optimizewp' )
		)
	)
);

optimize_mikado_create_meta_box_field(
	array(
		'parent'        => $header_meta_box,
		'type'          => 'select',
		'name'          => 'mkdf_enable_header_style_on_scroll_meta',
		'default_value' => '',
		'label' => esc_html__( 'Enable Header Style on Scroll', 'optimizewp' ),
		'description' => esc_html__( 'Enabling this option, header will change style depending on row settings for dark/light style', 'optimizewp' ),
		'options'       => array(
			''    => '',
			'no'  => esc_html__('No', 'optimizewp' ),
			'yes' => esc_html__('Yes', 'optimizewp' )
		)
	)
);

switch(optimize_mikado_options()->getOptionValue('header_type')) {
	case 'header-standard':

		optimize_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_menu_area_background_color_header_standard_meta',
				'type'        => 'color',
				'label' => esc_html__( 'Background Color', 'optimizewp' ),
				'description' => esc_html__( 'Choose a background color for header area', 'optimizewp' ),
				'parent'      => $header_meta_box
			)
		);

		optimize_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_menu_area_background_transparency_header_standard_meta',
				'type'        => 'text',
				'label' => esc_html__( 'Transparency', 'optimizewp' ),
				'description' => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'optimizewp' ),
				'parent'      => $header_meta_box,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		optimize_mikado_create_meta_box_field(array(
			'name'          => 'mkdf_menu_area_bottom_border_disable_header_standard_meta',
			'type'          => 'yesno',
			'label' => esc_html__( 'Disable Header Bottom Border', 'optimizewp' ),
			'description' => esc_html__( 'Disable this option will enable bottom border on header', 'optimizewp' ),
			'parent'        => $header_meta_box,
			'default_value' => 'no',
			'args'          => array(
				'dependence'             => true,
				'dependence_hide_on_yes' => '#mkdf_border_bottom_color_container',
				'dependence_show_on_yes' => '',
			)
		));

		$border_bottom_color_container = optimize_mikado_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'border_bottom_color_container',
			'parent'          => $header_meta_box,
			'hidden_property' => 'mkdf_menu_area_bottom_border_enable_header_standard_meta',
			'hidden_value'    => 'yes'
		));

		optimize_mikado_create_meta_box_field(array(
			'name'        => 'mkdf_menu_area_bottom_border_color_meta',
			'type'        => 'color',
			'label' => esc_html__( 'Header Bottom Border Color', 'optimizewp' ),
			'description' => esc_html__( 'Choose color of header bottom border', 'optimizewp' ),
			'parent'      => $border_bottom_color_container
		));

		break;

	case 'header-vertical':

		optimize_mikado_create_meta_box_field(array(
			'name'        => 'mkdf_vertical_header_background_color_meta',
			'type'        => 'color',
			'label' => esc_html__( 'Background Color', 'optimizewp' ),
			'description' => esc_html__( 'Set background color for vertical menu', 'optimizewp' ),
			'parent'      => $header_meta_box
		));

		optimize_mikado_create_meta_box_field(array(
			'name'        => 'mkdf_vertical_header_transparency_meta',
			'type'        => 'text',
			'label' => esc_html__( 'Transparency', 'optimizewp' ),
			'description' => esc_html__( 'Enter transparency for vertical menu (value from 0 to 1)', 'optimizewp' ),
			'parent'      => $header_meta_box,
			'args'        => array(
				'col_width' => 1
			)
		));

		optimize_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label' => esc_html__( 'Background Image', 'optimizewp' ),
				'description' => esc_html__( 'Set background image for vertical menu', 'optimizewp' ),
				'parent'        => $header_meta_box
			)
		);

		optimize_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Disable Background Image', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'optimizewp' ),
				'parent'        => $header_meta_box
			)
		);

		break;
}

if(optimize_mikado_options()->getOptionValue('header_type') != 'header-vertical') {
	optimize_mikado_create_meta_box_field(
		array(
			'name'            => 'mkdf_scroll_amount_for_sticky_meta',
			'type'            => 'text',
			'label' => esc_html__( 'Scroll amount for sticky header appearance', 'optimizewp' ),
			'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'optimizewp' ),
			'parent'          => $header_meta_box,
			'args'            => array(
				'col_width' => 2,
				'suffix'    => 'px'
			),
			'hidden_property' => 'mkdf_header_behaviour',
			'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
		)
	);

	optimize_mikado_add_admin_section_title(array(
		'name'   => 'top_bar_section_title',
		'parent' => $header_meta_box,
		'title' => esc_html__( 'Top Bar', 'optimizewp' )
	));

	$top_bar_global_option      = optimize_mikado_options()->getOptionValue('top_bar');
	$top_bar_default_dependency = array(
		'' => '#mkdf_top_bar_container_no_style'
	);

	$top_bar_show_array = array(
		'yes' => '#mkdf_top_bar_container_no_style'
	);

	$top_bar_hide_array = array(
		'no' => '#mkdf_top_bar_container_no_style'
	);

	if($top_bar_global_option === 'yes') {
		$top_bar_show_array = array_merge($top_bar_show_array, $top_bar_default_dependency);
	} else {
		$top_bar_hide_array = array_merge($top_bar_hide_array, $top_bar_default_dependency);
	}

	optimize_mikado_create_meta_box_field(array(
		'name'          => 'mkdf_top_bar_meta',
		'type'          => 'select',
		'label' => esc_html__( 'Enable Top Bar on This Page', 'optimizewp' ),
		'description' => esc_html__( 'Enabling this option will enable top bar on this page', 'optimizewp' ),
		'parent'        => $header_meta_box,
		'default_value' => '',
		'options'       => array(
			''    => esc_html__('Default', 'optimizewp' ),
			'yes' => esc_html__('Yes', 'optimizewp' ),
			'no'  => esc_html__('No', 'optimizewp' )
		),
		'args'          => array(
			'dependence' => true,
			'show'       => $top_bar_show_array,
			'hide'       => $top_bar_hide_array
		)
	));

	$top_bar_container = optimize_mikado_add_admin_container_no_style(array(
		'name'            => 'top_bar_container_no_style',
		'parent'          => $header_meta_box,
		'hidden_property' => 'top_bar',
		'hidden_value'    => 'no'
	));

	optimize_mikado_create_meta_box_field(array(
		'name'    => 'mkdf_top_bar_skin_meta',
		'type'    => 'select',
		'label' => esc_html__( 'Top Bar Skin', 'optimizewp' ),
		'options' => array(
			''      => esc_html__('Default', 'optimizewp' ),
			'light' => esc_html__('Light', 'optimizewp' ),
			'dark'  => esc_html__('Dark', 'optimizewp' )
		),
		'parent'  => $top_bar_container
	));

	optimize_mikado_create_meta_box_field(array(
		'name'   => 'mkdf_top_bar_background_color_meta',
		'type'   => 'color',
		'label' => esc_html__( 'Top Bar Background Color', 'optimizewp' ),
		'parent' => $top_bar_container
	));

	optimize_mikado_create_meta_box_field(array(
		'name'          => 'mkdf_top_bar_social_icon_hover_disabled_meta',
		'type'          => 'yesno',
		'label' => esc_html__( 'Disable Hover for Social Icons', 'optimizewp' ),
		'description' => esc_html__( 'Choose whether to disable hover on social icons placed in top bar area', 'optimizewp' ),
		'parent'        => $top_bar_container,
		'default_value' => 'no'
	));
}
