<?php

if ( ! function_exists('optimize_mikado_error_404_options_map') ) {

	function optimize_mikado_error_404_options_map() {

		optimize_mikado_add_admin_page(array(
			'slug' => '__404_error_page',
			'title' => esc_html__( '404 Error Page', 'optimizewp' ),
			'icon' => 'fa fa-exclamation-triangle'
		));

		$panel_404_options = optimize_mikado_add_admin_panel(array(
			'page' => '__404_error_page',
			'name'	=> 'panel_404_options',
			'title' => esc_html__( '404 Page Option', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'parent' => $panel_404_options,
			'type' => 'text',
			'name' => '404_title',
			'default_value' => '',
			'label' => esc_html__( 'Title', 'optimizewp' ),
			'description' => esc_html__( 'Enter title for 404 page', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'parent' => $panel_404_options,
			'type' => 'text',
			'name' => '404_text',
			'default_value' => '',
			'label' => esc_html__( 'Text', 'optimizewp' ),
			'description' => esc_html__( 'Enter text for 404 page', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'parent' => $panel_404_options,
			'type' => 'text',
			'name' => '404_back_to_home',
			'default_value' => '',
			'label' => esc_html__( 'Back to Home Button Label', 'optimizewp' ),
			'description' => esc_html__( 'Enter label for Back to Home button', 'optimizewp' )
		));

	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_error_404_options_map', 14);

}