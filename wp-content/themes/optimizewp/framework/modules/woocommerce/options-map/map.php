<?php

if ( ! function_exists('optimize_mikado_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function optimize_mikado_woocommerce_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'optimizewp' ),
				'icon' => 'fa fa-header'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = optimize_mikado_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'optimizewp' )
			)
		);

		optimize_mikado_add_admin_field(array(
			'name'        	=> 'mkdf_woo_products_list_full_width',
			'type'        	=> 'yesno',
			'label' => esc_html__( 'Enable Full Width Template', 'optimizewp' ),
			'default_value'	=> 'no',
			'description' => esc_html__( 'Enabling this option will enable full width template for shop page', 'optimizewp' ),
			'parent'      	=> $panel_product_list,
		));

		optimize_mikado_add_admin_field(array(
			'name'        	=> 'mkdf_woo_product_list_columns',
			'type'        	=> 'select',
			'label' => esc_html__( 'Product List Columns', 'optimizewp' ),
			'default_value'	=> 'mkdf-woocommerce-columns-3',
			'description' => esc_html__( 'Choose number of columns for product listing and related products on single product', 'optimizewp' ),
			'options'		=> array(
				'mkdf-woocommerce-columns-3' => esc_html__('3 Columns (2 with sidebar)', 'optimizewp' ),
				'mkdf-woocommerce-columns-4' => esc_html__('4 Columns (3 with sidebar)', 'optimizewp' )
			),
			'parent'      	=> $panel_product_list,
		));

		optimize_mikado_add_admin_field(array(
			'name'        	=> 'mkdf_woo_products_per_page',
			'type'        	=> 'text',
			'label' => esc_html__( 'Number of products per page', 'optimizewp' ),
			'default_value'	=> '',
			'description' => esc_html__( 'Set number of products on shop page', 'optimizewp' ),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'        	=> 'mkdf_products_list_title_tag',
			'type'        	=> 'select',
			'label' => esc_html__( 'Products Title Tag', 'optimizewp' ),
			'default_value'	=> 'h1',
			'description' 	=> '',
			'options'		=> array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = optimize_mikado_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'optimizewp' )
			)
		);

		optimize_mikado_add_admin_field(array(
			'name'        	=> 'mkdf_single_product_title_tag',
			'type'        	=> 'select',
			'label' => esc_html__( 'Single Product Title Tag', 'optimizewp' ),
			'default_value'	=> 'h1',
			'description' 	=> '',
			'options'		=> array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_single_product,
		));
		optimize_mikado_add_admin_field(array(
			'name'        	=> 'hide_product_info',
			'type'        	=> 'yesno',
			'label' => esc_html__( 'Hide Product Info', 'optimizewp' ),
			'default_value'	=> 'no',
			'description' => esc_html__( 'Enabling this option will hide product category, tag, SKU etc.', 'optimizewp' ),
			'parent'      	=> $panel_single_product,
		));


	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_woocommerce_options_map', 16);

}