<?php

if ( ! function_exists('optimize_mikado_page_options_map') ) {

    function optimize_mikado_page_options_map() {

        optimize_mikado_add_admin_page(
            array(
                'slug'  => '_page_page',
                'title' => esc_html__( 'Page', 'optimizewp' ),
                'icon'  => 'fa fa-institution'
            )
        );

        $custom_sidebars = optimize_mikado_get_custom_sidebars();

        $panel_sidebar = optimize_mikado_add_admin_panel(
            array(
                'page'  => '_page_page',
                'name'  => 'panel_sidebar',
                'title' => esc_html__( 'Design Style', 'optimizewp' )
            )
        );

        optimize_mikado_add_admin_field(array(
            'name'        => 'page_sidebar_layout',
            'type'        => 'select',
            'label' => esc_html__( 'Sidebar Layout', 'optimizewp' ),
            'description' => esc_html__( 'Choose a sidebar layout for pages', 'optimizewp' ),
            'default_value' => 'default',
            'parent'      => $panel_sidebar,
            'options'     => array(
                'default'			=> esc_html__('No Sidebar', 'optimizewp' ),
                'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'optimizewp' ),
                'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'optimizewp' ),
                'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'optimizewp' ),
                'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'optimizewp' )
            )
        ));


        if(count($custom_sidebars) > 0) {
            optimize_mikado_add_admin_field(array(
                'name' => 'page_custom_sidebar',
                'type' => 'selectblank',
                'label' => esc_html__( 'Sidebar to Display', 'optimizewp' ),
                'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is Sidebar', 'optimizewp' ),
                'parent' => $panel_sidebar,
                'options' => $custom_sidebars
            ));
        }

        optimize_mikado_add_admin_field(array(
            'name'        => 'page_show_comments',
            'type'        => 'yesno',
            'label' => esc_html__( 'Show Comments', 'optimizewp' ),
            'description' => esc_html__( 'Enabling this option will show comments on your page', 'optimizewp' ),
            'default_value' => 'yes',
            'parent'      => $panel_sidebar
        ));

	    $panel_widgets = optimize_mikado_add_admin_panel(
		    array(
			    'page'  => '_page_page',
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

    add_action( 'optimize_mikado_options_map', 'optimize_mikado_page_options_map', 7);

}