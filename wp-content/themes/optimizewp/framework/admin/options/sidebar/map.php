<?php

if ( ! function_exists('optimize_mikado_sidebar_options_map') ) {

	function optimize_mikado_sidebar_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar', 'optimizewp' ),
				'icon'  => 'fa fa-bars'
			)
		);

		$panel_widgets = optimize_mikado_add_admin_panel(
			array(
				'page'  => '_sidebar_page',
				'name'  => 'panel_widgets',
				'title' => esc_html__( 'Widgets', 'optimizewp' )
			)
		);

		/**
		 * Navigation style
		 */
		optimize_mikado_add_admin_field(array(
			'type'			=> 'color',
			'name'			=> 'sidebar_background_color',
			'default_value'	=> '',
			'label' => esc_html__( 'Sidebar Background Color', 'optimizewp' ),
			'description' => esc_html__( 'Choose background color for sidebar', 'optimizewp' ),
			'parent'		=> $panel_widgets
		));

		$group_sidebar_padding = optimize_mikado_add_admin_group(array(
			'name'		=> 'group_sidebar_padding',
			'title' => esc_html__( 'Padding', 'optimizewp' ),
			'parent'	=> $panel_widgets
		));

		$row_sidebar_padding = optimize_mikado_add_admin_row(array(
			'name'		=> 'row_sidebar_padding',
			'parent'	=> $group_sidebar_padding
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_top',
			'default_value'	=> '',
			'label' => esc_html__( 'Top Padding', 'optimizewp' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_right',
			'default_value'	=> '',
			'label' => esc_html__( 'Right Padding', 'optimizewp' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_bottom',
			'default_value'	=> '',
			'label' => esc_html__( 'Bottom Padding', 'optimizewp' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'sidebar_padding_left',
			'default_value'	=> '',
			'label' => esc_html__( 'Left Padding', 'optimizewp' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_sidebar_padding
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'select',
			'name'			=> 'sidebar_alignment',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Alignment', 'optimizewp' ),
			'description' => esc_html__( 'Choose text aligment', 'optimizewp' ),
			'options'		=> array(
				'left' => esc_html__('Left', 'optimizewp' ),
				'center' => esc_html__('Center', 'optimizewp' ),
				'right' => esc_html__('Right', 'optimizewp' )
			),
			'parent'		=> $panel_widgets
		));

	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_sidebar_options_map');

}