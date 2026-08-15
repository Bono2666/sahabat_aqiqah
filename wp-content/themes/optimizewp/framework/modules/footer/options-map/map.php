<?php

if ( ! function_exists('optimize_mikado_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function optimize_mikado_footer_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => esc_html__( 'Footer', 'optimizewp' ),
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = optimize_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'optimizewp' ),
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'uncovering_footer',
				'default_value' => 'no',
				'label' => esc_html__( 'Uncovering Footer', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'optimizewp' ),
				'parent' => $footer_panel,
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__( 'Footer in Grid', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will place Footer content in grid', 'optimizewp' ),
				'parent' => $footer_panel,
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => esc_html__( 'Show Footer Top', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will show Footer Top area', 'optimizewp' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = optimize_mikado_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'default_value' => '4',
				'label' => esc_html__( 'Footer Top Columns', 'optimizewp' ),
				'description' => esc_html__( 'Choose number of columns for Footer Top area', 'optimizewp' ),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'5' => '3(25%+25%+50%)',
					'6' => '3(50%+25%+25%)',
					'4' => '4'
				),
				'parent' => $show_footer_top_container,
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => '',
				'label' => esc_html__( 'Footer Top Columns Alignment', 'optimizewp' ),
				'description' => esc_html__( 'Text Alignment in Footer Columns', 'optimizewp' ),
				'options' => array(
					'left' => esc_html__('Left', 'optimizewp' ),
					'center' => esc_html__('Center', 'optimizewp' ),
					'right' => esc_html__('Right', 'optimizewp' )
				),
				'parent' => $show_footer_top_container,
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => esc_html__( 'Show Footer Bottom', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will show Footer Bottom area', 'optimizewp' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = optimize_mikado_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);


		optimize_mikado_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '3',
				'label' => esc_html__( 'Footer Bottom Columns', 'optimizewp' ),
				'description' => esc_html__( 'Choose number of columns for Footer Bottom area', 'optimizewp' ),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_footer_options_map', 8);

}