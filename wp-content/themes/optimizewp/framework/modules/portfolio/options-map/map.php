<?php

if ( ! function_exists('optimize_mikado_portfolio_options_map') ) {

	function optimize_mikado_portfolio_options_map() {

		optimize_mikado_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__( 'Portfolio', 'optimizewp' ),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel = optimize_mikado_add_admin_panel(array(
			'title' => esc_html__( 'Portfolio Single', 'optimizewp' ),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'portfolio_single_template',
			'type'        => 'select',
			'label' => esc_html__( 'Portfolio Type', 'optimizewp' ),
			'default_value'	=> 'small-images',
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'optimizewp' ),
			'parent'      => $panel,
			'options'     => array(
				'small-images' => esc_html__('Portfolio small images', 'optimizewp' ),
				'small-slider' => esc_html__('Portfolio small slider', 'optimizewp' ),
				'big-images' => esc_html__('Portfolio big images', 'optimizewp' ),
				'big-slider' => esc_html__('Portfolio big slider', 'optimizewp' ),
				'custom' => esc_html__('Portfolio custom', 'optimizewp' ),
				'full-width-custom' => esc_html__('Portfolio full width custom', 'optimizewp' ),
				'gallery' => esc_html__('Portfolio gallery', 'optimizewp' )
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label' => esc_html__( 'Lightbox for Images', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images.', 'optimizewp' ),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		optimize_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label' => esc_html__( 'Lightbox for Videos', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.', 'optimizewp' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		optimize_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_categories',
			'type'          => 'yesno',
			'label' => esc_html__( 'Hide Categories', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will disable category meta description on Single Projects.', 'optimizewp' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		optimize_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label' => esc_html__( 'Hide Date', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will disable date meta on Single Projects.', 'optimizewp' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		optimize_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label' => esc_html__( 'Show Comments', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will show comments on your page.', 'optimizewp' ),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		optimize_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label' => esc_html__( 'Sticky Side Text', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will make side text sticky on Single Project pages', 'optimizewp' ),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		optimize_mikado_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label' => esc_html__( 'Hide Pagination', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will turn off portfolio pagination functionality.', 'optimizewp' ),
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#mkdf_navigate_same_category_container'
			)
		));

		$container_navigate_category = optimize_mikado_add_admin_container(array(
			'name'            => 'navigate_same_category_container',
			'parent'          => $panel,
			'hidden_property' => 'portfolio_single_hide_pagination',
			'hidden_value'    => 'yes'
		));

		optimize_mikado_add_admin_field(array(
			'name'            => 'portfolio_single_nav_same_category',
			'type'            => 'yesno',
			'label' => esc_html__( 'Enable Pagination Through Same Category', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will make portfolio pagination sort through current category.', 'optimizewp' ),
			'parent'          => $container_navigate_category,
			'default_value'   => 'no'
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'portfolio_single_numb_columns',
			'type'        => 'select',
			'label' => esc_html__( 'Number of Columns', 'optimizewp' ),
			'default_value' => 'three-columns',
			'description' => esc_html__( 'Enter the number of columns for Portfolio Gallery type', 'optimizewp' ),
			'parent'      => $panel,
			'options'     => array(
				'two-columns' => esc_html__('2 columns', 'optimizewp' ),
				'three-columns' => esc_html__('3 columns', 'optimizewp' ),
				'four-columns' => esc_html__('4 columns', 'optimizewp' )
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label' => esc_html__( 'Portfolio Single Slug', 'optimizewp' ),
			'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click Save in order for changes to take effect)', 'optimizewp' ),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));

	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_portfolio_options_map', 11);

}