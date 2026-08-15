<?php

if ( ! function_exists('optimize_mikado_blog_options_map') ) {

	function optimize_mikado_blog_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__( 'Blog', 'optimizewp' ),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */

		$custom_sidebars = optimize_mikado_get_custom_sidebars();

		$panel_blog_lists = optimize_mikado_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'optimizewp' )
			)
		);

		optimize_mikado_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label' => esc_html__( 'Blog Layout for Archive Pages', 'optimizewp' ),
			'description' => esc_html__( 'Choose a default blog layout', 'optimizewp' ),
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'standard'				=> esc_html__('Blog: Standard', 'optimizewp' ),
				'split-column'			=> esc_html__('Blog: Split Column', 'optimizewp' ),
				'masonry' 				=> esc_html__('Blog: Masonry', 'optimizewp' ),
				'masonry-full-width' 	=> esc_html__('Blog: Masonry Full Width', 'optimizewp' ),
				'standard-whole-post' 	=> esc_html__('Blog: Standard Whole Post', 'optimizewp' )
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label' => esc_html__( 'Archive and Category Sidebar', 'optimizewp' ),
			'description' => esc_html__( 'Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists', 'optimizewp' ),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'default'			=> esc_html__('No Sidebar', 'optimizewp' ),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'optimizewp' ),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'optimizewp' ),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'optimizewp' ),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'optimizewp' ),
			)
		));


		if(count($custom_sidebars) > 0) {
			optimize_mikado_add_admin_field(array(
				'name' => 'blog_custom_sidebar',
				'type' => 'selectblank',
				'label' => esc_html__( 'Sidebar to Display', 'optimizewp' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is Sidebar Page', 'optimizewp' ),
				'parent' => $panel_blog_lists,
				'options' => optimize_mikado_get_custom_sidebars()
			));
		}

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'pagination',
				'default_value' => 'yes',
				'label' => esc_html__( 'Pagination', 'optimizewp' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enabling this option will display pagination links on bottom of Blog Post List', 'optimizewp' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_pagination_container'
				)
			)
		);

		$pagination_container = optimize_mikado_add_admin_container(
			array(
				'name' => 'mkdf_pagination_container',
				'hidden_property' => 'pagination',
				'hidden_value' => 'no',
				'parent' => $panel_blog_lists,
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent' => $pagination_container,
				'type' => 'text',
				'name' => 'blog_page_range',
				'default_value' => '',
				'label' => esc_html__( 'Pagination Range limit', 'optimizewp' ),
				'description' => esc_html__( 'Enter a number that will limit pagination to a certain range of links', 'optimizewp' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		optimize_mikado_add_admin_field(array(
			'name'        => 'masonry_pagination',
			'type'        => 'select',
			'label' => esc_html__( 'Pagination on Masonry', 'optimizewp' ),
			'description' => esc_html__( 'Choose a pagination style for Masonry Blog List', 'optimizewp' ),
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'			=> esc_html__('Standard', 'optimizewp' ),
				'load-more'			=> esc_html__('Load More', 'optimizewp' ),
				'infinite-scroll' 	=> esc_html__('Infinite Scroll', 'optimizewp' )
			),
			
		));
		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'enable_load_more_pag',
				'default_value' => 'no',
				'label' => esc_html__( 'Load More Pagination on Other Lists', 'optimizewp' ),
				'parent' => $pagination_container,
				'description' => esc_html__( 'Enable Load More Pagination on other lists', 'optimizewp' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'masonry_filter',
				'default_value' => 'no',
				'label' => esc_html__( 'Masonry Filter', 'optimizewp' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enabling this option will display category filter on Masonry and Masonry Full Width Templates', 'optimizewp' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);		
		optimize_mikado_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '',
				'label' => esc_html__( 'Number of Words in Excerpt', 'optimizewp' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'optimizewp' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		optimize_mikado_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'standard_number_of_chars',
				'default_value' => '45',
				'label' => esc_html__( 'Standard Type Number of Words in Excerpt', 'optimizewp' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'optimizewp' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		optimize_mikado_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'masonry_number_of_chars',
				'default_value' => '45',
				'label' => esc_html__( 'Masonry Type Number of Words in Excerpt', 'optimizewp' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'optimizewp' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);
		optimize_mikado_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'split_column_number_of_chars',
				'default_value' => '45',
				'label' => esc_html__( 'Split Column Type Number of Words in Excerpt', 'optimizewp' ),
				'parent' => $panel_blog_lists,
				'description' => esc_html__( 'Enter a number of words in excerpt (article summary)', 'optimizewp' ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = optimize_mikado_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'optimizewp' )
			)
		);


		optimize_mikado_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label' => esc_html__( 'Sidebar Layout', 'optimizewp' ),
			'description' => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'optimizewp' ),
			'parent'      => $panel_blog_single,
			'options'     => array(
				'default'			=> esc_html__('No Sidebar', 'optimizewp' ),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'optimizewp' ),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'optimizewp' ),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'optimizewp' ),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'optimizewp' ),
			),
			'default_value'	=> 'default'
		));


		if(count($custom_sidebars) > 0) {
			optimize_mikado_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar',
				'type' => 'selectblank',
				'label' => esc_html__( 'Sidebar to Display', 'optimizewp' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is Sidebar', 'optimizewp' ),
				'parent' => $panel_blog_single,
				'options' => optimize_mikado_get_custom_sidebars()
			));
		}
		optimize_mikado_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label' => esc_html__( 'Show Comments', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will show comments on your page.', 'optimizewp' ),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		optimize_mikado_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label' => esc_html__( 'Show Related Posts', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will show related posts on your single post.', 'optimizewp' ),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'optimizewp' ),
				'parent' => $panel_blog_single,
				'description' => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'optimizewp' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = optimize_mikado_add_admin_container(
			array(
				'name' => 'mkdf_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Navigation Only in Current Category', 'optimizewp' ),
				'description' => esc_html__( 'Limit your navigation only through current category', 'optimizewp' ),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'no',
				'label' => esc_html__( 'Show Author Info Box', 'optimizewp' ),
				'parent' => $panel_blog_single,
				'description' => esc_html__( 'Enabling this option will display author name and descriptions on Blog Single pages', 'optimizewp' ),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_mkdf_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = optimize_mikado_add_admin_container(
			array(
				'name' => 'mkdf_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label' => esc_html__( 'Show Author Email', 'optimizewp' ),
				'description' => esc_html__( 'Enabling this option will show author email', 'optimizewp' ),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_blog_options_map', 10);

}
