<?php

if ( ! function_exists('optimize_mikado_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function optimize_mikado_load_elements_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => esc_html__( 'Elements', 'optimizewp' ),
				'icon' => 'fa fa-star'
			)
		);

		do_action( 'optimize_mikado_options_elements_map' );

	}

	add_action('optimize_mikado_options_map', 'optimize_mikado_load_elements_map', 9);

}