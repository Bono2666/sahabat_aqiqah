<?php

if ( ! function_exists('optimize_mikado_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function optimize_mikado_reset_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'optimizewp' ),
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = optimize_mikado_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'optimizewp' )
			)
		);

		optimize_mikado_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Reset to Defaults', 'optimizewp' ),
			'description' => esc_html__( 'This option will reset all Mikado Options values to defaults', 'optimizewp' ),
			'parent'		=> $panel_reset
		));

	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_reset_options_map', 100 );

}