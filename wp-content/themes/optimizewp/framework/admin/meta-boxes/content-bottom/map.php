<?php

$content_bottom_meta_box = optimize_mikado_create_meta_box(
	array(
		'scope' => array('page', 'portfolio-item', 'post'),
		'title' => esc_html__( 'Content Bottom', 'optimizewp' ),
		'name' => 'content_bottom_meta'
	)
);

	optimize_mikado_create_meta_box_field(
		array(
			'name' => 'mkdf_enable_content_bottom_area_meta',
			'type' => 'selectblank',
			'default_value' => '',
			'label' => esc_html__( 'Enable Content Bottom Area', 'optimizewp' ),
			'description' => esc_html__( 'This option will enable Content Bottom area on pages', 'optimizewp' ),
			'parent' => $content_bottom_meta_box,
			'options' => array(
				'no' => esc_html__('No', 'optimizewp' ),
				'yes' => esc_html__('Yes', 'optimizewp' )
			),
			'args' => array(
				'dependence' => true,
				'hide' => array(
					'' => '#mkdf_mkdf_show_content_bottom_meta_container',
					'no' => '#mkdf_mkdf_show_content_bottom_meta_container'
				),
				'show' => array(
					'yes' => '#mkdf_mkdf_show_content_bottom_meta_container'
				)
			)
		)
	);

	$show_content_bottom_meta_container = optimize_mikado_add_admin_container(
		array(
			'parent' => $content_bottom_meta_box,
			'name' => 'mkdf_show_content_bottom_meta_container',
			'hidden_property' => 'mkdf_enable_content_bottom_area_meta',
			'hidden_value' => '',
			'hidden_values' => array('','no')
		)
	);

		optimize_mikado_create_meta_box_field(
			array(
				'name' => 'mkdf_content_bottom_sidebar_custom_display_meta',
				'type' => 'selectblank',
				'default_value' => '',
				'label' => esc_html__( 'Sidebar to Display', 'optimizewp' ),
				'description' => esc_html__( 'Choose a Content Bottom sidebar to display', 'optimizewp' ),
				'options' => optimize_mikado_get_custom_sidebars(),
				'parent' => $show_content_bottom_meta_container
			)
		);

		optimize_mikado_create_meta_box_field(
			array(
				'type' => 'selectblank',
				'name' => 'mkdf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label' => esc_html__( 'Display in Grid', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will place Content Bottom in grid', 'optimizewp' ),
				'options' => array(
					'no' => esc_html__('No', 'optimizewp' ),
					'yes' => esc_html__('Yes', 'optimizewp' )
				),
				'parent' => $show_content_bottom_meta_container
			)
		);

		optimize_mikado_create_meta_box_field(
			array(
				'type' => 'color',
				'name' => 'mkdf_content_bottom_background_color_meta',
				'default_value' => '',
				'label' => esc_html__( 'Background Color', 'optimizewp' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'optimizewp' ),
				'parent' => $show_content_bottom_meta_container
			)
		);