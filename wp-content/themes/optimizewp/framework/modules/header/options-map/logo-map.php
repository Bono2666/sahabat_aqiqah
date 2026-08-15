<?php

if ( ! function_exists('optimize_mikado_logo_options_map') ) {

	function optimize_mikado_logo_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug' => '_logo_page',
				'title' => esc_html__( 'Logo', 'optimizewp' ),
				'icon' => 'fa fa-coffee'
			)
		);

		$panel_logo = optimize_mikado_add_admin_panel(
			array(
				'page' => '_logo_page',
				'name' => 'panel_logo',
				'title' => esc_html__( 'Logo', 'optimizewp' )
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => esc_html__( 'Hide Logo', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will hide logo image', 'optimizewp' ),
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#mkdf_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = optimize_mikado_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Default', 'optimizewp' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'optimizewp' ),
				'parent' => $hide_logo_container
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'name' => 'logo_image_dark',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Dark', 'optimizewp' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'optimizewp' ),
				'parent' => $hide_logo_container
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'name' => 'logo_image_light',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Light', 'optimizewp' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'optimizewp' ),
				'parent' => $hide_logo_container
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo_white.png",
				'label' => esc_html__( 'Logo Image - Sticky', 'optimizewp' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'optimizewp' ),
				'parent' => $hide_logo_container
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => MIKADO_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__( 'Logo Image - Mobile', 'optimizewp' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'optimizewp' ),
				'parent' => $hide_logo_container
			)
		);

	}

	//add_action( 'optimize_mikado_options_map', 'optimize_mikado_logo_options_map');

}