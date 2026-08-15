<?php

if ( ! function_exists('optimize_mikado_general_options_map') ) {
    /**
     * General options page
     */
    function optimize_mikado_general_options_map() {

        optimize_mikado_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__( 'General', 'optimizewp' ),
                'icon'  => 'fa fa-institution'
            )
        );

	    $panel_logo = optimize_mikado_add_admin_panel(
		    array(
			    'page' => '',
			    'name' => 'panel_branding',
			    'title' => esc_html__( 'Branding', 'optimizewp' )
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

        $panel_design_style = optimize_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => esc_html__( 'Appearance', 'optimizewp' )
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label' => esc_html__( 'Font Family', 'optimizewp' ),
                'description' => esc_html__( 'Choose a default Google font for your site', 'optimizewp' ),
                'parent' => $panel_design_style
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__( 'Additional Google Fonts', 'optimizewp' ),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkdf_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = optimize_mikado_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label' => esc_html__( 'Font Family', 'optimizewp' ),
                'description' => esc_html__( 'Choose additional Google font for your site', 'optimizewp' ),
                'parent'        => $additional_google_fonts_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label' => esc_html__( 'Font Family', 'optimizewp' ),
                'description' => esc_html__( 'Choose additional Google font for your site', 'optimizewp' ),
                'parent'        => $additional_google_fonts_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label' => esc_html__( 'Font Family', 'optimizewp' ),
                'description' => esc_html__( 'Choose additional Google font for your site', 'optimizewp' ),
                'parent'        => $additional_google_fonts_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label' => esc_html__( 'Font Family', 'optimizewp' ),
                'description' => esc_html__( 'Choose additional Google font for your site', 'optimizewp' ),
                'parent'        => $additional_google_fonts_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label' => esc_html__( 'Font Family', 'optimizewp' ),
                'description' => esc_html__( 'Choose additional Google font for your site', 'optimizewp' ),
                'parent'        => $additional_google_fonts_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label' => esc_html__( 'First Main Color', 'optimizewp' ),
                'description' => esc_html__( 'Choose the most dominant theme color. Default color is #ff1d4d', 'optimizewp' ),
                'parent'        => $panel_design_style
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label' => esc_html__( 'Page Background Color', 'optimizewp' ),
                'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'optimizewp' ),
                'parent'        => $panel_design_style
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label' => esc_html__( 'Text Selection Color', 'optimizewp' ),
                'description' => esc_html__( 'Choose the color users see when selecting text', 'optimizewp' ),
                'parent'        => $panel_design_style
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__( 'Boxed Layout', 'optimizewp' ),
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkdf_boxed_container"
                )
            )
        );

        $boxed_container = optimize_mikado_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label' => esc_html__( 'Page Background Color', 'optimizewp' ),
                'description' => esc_html__( 'Choose the page background color outside box.', 'optimizewp' ),
                'parent'        => $boxed_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label' => esc_html__( 'Background Image', 'optimizewp' ),
                'description' => esc_html__( 'Choose an image to be displayed in background', 'optimizewp' ),
                'parent'        => $boxed_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'boxed_pattern_background_image',
                'type'          => 'image',
                'label' => esc_html__( 'Background Pattern', 'optimizewp' ),
                'description' => esc_html__( 'Choose an image to be used as background pattern', 'optimizewp' ),
                'parent'        => $boxed_container
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label' => esc_html__( 'Background Image Attachment', 'optimizewp' ),
                'description' => esc_html__( 'Choose background image attachment', 'optimizewp' ),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => esc_html__('Fixed', 'optimizewp' ),
                    'scroll'    => esc_html__('Scroll', 'optimizewp' )
                )
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => '',
                'label' => esc_html__( 'Initial Width of Content', 'optimizewp' ),
                'description' => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to Default Template and rows set to In Grid', 'optimizewp' ),
                'parent'        => $panel_design_style,
                'options'       => array(
                    ""          => "1100px - default",
                    "grid-1300" => "1300px",
                    "grid-1200" => "1200px",
                    "grid-1000" => "1000px",
                    "grid-800"  => "800px"
                )
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'preload_pattern_image',
                'type'          => 'image',
                'label' => esc_html__( 'Preload Pattern Image', 'optimizewp' ),
                'description' => esc_html__( 'Choose preload pattern image to be displayed until images are loaded ', 'optimizewp' ),
                'parent'        => $panel_design_style
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name' => 'element_appear_amount',
                'type' => 'text',
                'label' => esc_html__( 'Element Appearance', 'optimizewp' ),
                'description' => esc_html__( 'For animated elements, set distance (related to browser bottom) to start the animation', 'optimizewp' ),
                'parent' => $panel_design_style,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => 'px'
                )
            )
        );

        $panel_settings = optimize_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__( 'Settings', 'optimizewp' )
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'smooth_scroll',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__( 'Smooth Scroll', 'optimizewp' ),
                'description' => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'optimizewp' ),
                'parent'        => $panel_settings
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'smooth_page_transitions',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__( 'Smooth Page Transitions', 'optimizewp' ),
                'description' => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links.', 'optimizewp' ),
                'parent'        => $panel_settings,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#mkdf_page_transitions_container"
                )
            )
        );

        $page_transitions_container = optimize_mikado_add_admin_container(
            array(
                'parent'            => $panel_settings,
                'name'              => 'page_transitions_container',
                'hidden_property'   => 'smooth_page_transitions',
                'hidden_value'      => 'no'
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'smooth_pt_bgnd_color',
                'type'          => 'color',
                'label' => esc_html__( 'Page Loader Background Color', 'optimizewp' ),
                'parent'        => $page_transitions_container
            )
        );

        $group_pt_spinner_animation = optimize_mikado_add_admin_group(array(
            'name'          => 'group_pt_spinner_animation',
            'title' => esc_html__( 'Loader Style', 'optimizewp' ),
            'description'   => esc_html__('Define styles for loader spinner animation', 'optimizewp' ),
            'parent'        => $page_transitions_container
        ));

        $row_pt_spinner_animation = optimize_mikado_add_admin_row(array(
            'name'      => 'row_pt_spinner_animation',
            'parent'    => $group_pt_spinner_animation
        ));

        optimize_mikado_add_admin_field(array(
            'type'          => 'selectsimple',
            'name'          => 'smooth_pt_spinner_type',
            'default_value' => '',
            'label' => esc_html__( 'Spinner Type', 'optimizewp' ),
            'parent'        => $row_pt_spinner_animation,
            'options'       => array(
                "pulse" => esc_html__("Pulse", 'optimizewp' ),
                "double_pulse" => esc_html__("Double Pulse", 'optimizewp' ),
                "cube" => esc_html__("Cube", 'optimizewp' ),
                "rotating_cubes" => esc_html__("Rotating Cubes", 'optimizewp' ),
                "stripes" => esc_html__("Stripes", 'optimizewp' ),
                "wave" => esc_html__("Wave", 'optimizewp' ),
                "two_rotating_circles" => esc_html__("2 Rotating Circles", 'optimizewp' ),
                "five_rotating_circles" => esc_html__("5 Rotating Circles", 'optimizewp' ),
                "atom" => esc_html__("Atom", 'optimizewp' ),
                "clock" => esc_html__("Clock", 'optimizewp' ),
                "mitosis" => esc_html__("Mitosis", 'optimizewp' ),
                "lines" => esc_html__("Lines", 'optimizewp' ),
                "fussion" => esc_html__("Fussion", 'optimizewp' ),
                "wave_circles" => esc_html__("Wave Circles", 'optimizewp' ),
                "pulse_circles" => esc_html__("Pulse Circles", 'optimizewp' )
            )
        ));

        optimize_mikado_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'smooth_pt_spinner_color',
            'default_value' => '',
            'label' => esc_html__( 'Spinner Color', 'optimizewp' ),
            'parent'        => $row_pt_spinner_animation
        ));

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'elements_animation_on_touch',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__( 'Elements Animation on Mobile/Touch Devices', 'optimizewp' ),
                'description' => esc_html__( 'Enabling this option will allow elements (shortcodes) to animate on mobile / touch devices', 'optimizewp' ),
                'parent'        => $panel_settings
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__( 'Show Back To Top Button', 'optimizewp' ),
                'description' => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'optimizewp' ),
                'parent'        => $panel_settings
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label' => esc_html__( 'Responsiveness', 'optimizewp' ),
                'description' => esc_html__( 'Enabling this option will make all pages responsive', 'optimizewp' ),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = optimize_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__( 'Custom Code', 'optimizewp' )
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label' => esc_html__( 'Custom CSS', 'optimizewp' ),
                'description' => esc_html__( 'Enter your custom CSS here', 'optimizewp' ),
                'parent'        => $panel_custom_code
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label' => esc_html__( 'Custom JS', 'optimizewp' ),
                'description' => esc_html__( 'Enter your custom Javascript here', 'optimizewp' ),
                'parent'        => $panel_custom_code
            )
        );

        $panel_google_api = optimize_mikado_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_google_api',
                'title' => esc_html__( 'Google API', 'optimizewp' )
            )
        );

        optimize_mikado_add_admin_field(
            array(
                'name'        => 'google_maps_api_key',
                'type'        => 'text',
                'label' => esc_html__( 'Google Maps Api Key', 'optimizewp' ),
                'description' => esc_html__( 'Insert your Google Maps API key here.', 'optimizewp' ),
                'parent'      => $panel_google_api
            )
        );
    }

    add_action( 'optimize_mikado_options_map', 'optimize_mikado_general_options_map', 1);

}