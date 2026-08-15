<?php

if ( ! function_exists('optimize_mikado_mobile_header_options_map') ) {

	function optimize_mikado_mobile_header_options_map() {

		optimize_mikado_add_admin_page(array(
			'slug'  => '_mobile_header',
			'title' => esc_html__( 'Mobile Header', 'optimizewp' ),
			'icon'  => 'fa fa-header'
		));

		$panel_mobile_header = optimize_mikado_add_admin_panel(array(
			'title' => esc_html__( 'Mobile header', 'optimizewp' ),
			'name'  => 'panel_mobile_header',
			'page'  => '_mobile_header'
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_header_height',
			'type'        => 'text',
			'label' => esc_html__( 'Mobile Header Height', 'optimizewp' ),
			'description' => esc_html__( 'Enter height for mobile header in pixels', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_header_background_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Header Background Color', 'optimizewp' ),
			'description' => esc_html__( 'Choose color for mobile header', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_background_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Menu Background Color', 'optimizewp' ),
			'description' => esc_html__( 'Choose color for mobile menu', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_menu_separator_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Menu Item Separator Color', 'optimizewp' ),
			'description' => esc_html__( 'Choose color for mobile menu horizontal separators', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label' => esc_html__( 'Logo Height For Mobile Header', 'optimizewp' ),
			'description' => esc_html__( 'Define logo height for screen size smaller than 1000px', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label' => esc_html__( 'Logo Height For Mobile Devices', 'optimizewp' ),
			'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		optimize_mikado_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title' => esc_html__( 'Typography', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'color',
			'label' => esc_html__( 'Navigation Text Color', 'optimizewp' ),
			'description' => esc_html__( 'Define color for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'color',
			'label' => esc_html__( 'Navigation Hover/Active Color', 'optimizewp' ),
			'description' => esc_html__( 'Define hover/active color for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_font_family',
			'type'        => 'font',
			'label' => esc_html__( 'Navigation Font Family', 'optimizewp' ),
			'description' => esc_html__( 'Define font family for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'text',
			'label' => esc_html__( 'Navigation Font Size', 'optimizewp' ),
			'description' => esc_html__( 'Define font size for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'text',
			'label' => esc_html__( 'Navigation Line Height', 'optimizewp' ),
			'description' => esc_html__( 'Define line height for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'select',
			'label' => esc_html__( 'Navigation Text Transform', 'optimizewp' ),
			'description' => esc_html__( 'Define text transform for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'options'     => optimize_mikado_get_text_transform_array(true)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'select',
			'label' => esc_html__( 'Navigation Font Style', 'optimizewp' ),
			'description' => esc_html__( 'Define font style for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'options'     => optimize_mikado_get_font_style_array(true)
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'select',
			'label' => esc_html__( 'Navigation Font Weight', 'optimizewp' ),
			'description' => esc_html__( 'Define font weight for mobile navigation text', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'options'     => optimize_mikado_get_font_weight_array(true)
		));

		optimize_mikado_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => esc_html__( 'Mobile Menu Opener', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_pack',
			'type'        => 'select',
			'label' => esc_html__( 'Mobile Navigation Icon Pack', 'optimizewp' ),
			'default_value' => 'font_awesome',
			'description' => esc_html__( 'Choose icon pack for mobile navigation icon', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'options'     => optimize_mikado_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'simple_line_icons'))
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Navigation Icon Color', 'optimizewp' ),
			'description' => esc_html__( 'Choose color for icon header', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label' => esc_html__( 'Mobile Navigation Icon Hover Color', 'optimizewp' ),
			'description' => esc_html__( 'Choose hover color for mobile navigation icon ', 'optimizewp' ),
			'parent'      => $panel_mobile_header
		));

		optimize_mikado_add_admin_field(array(
			'name'        => 'mobile_icon_size',
			'type'        => 'text',
			'label' => esc_html__( 'Mobile Navigation Icon size', 'optimizewp' ),
			'description' => esc_html__( 'Choose size for mobile navigation icon ', 'optimizewp' ),
			'parent'      => $panel_mobile_header,
			'args' => array(
				'col_width' => 3,
				'suffix' => 'px'
			)
		));

	}

	//add_action( 'optimize_mikado_options_map', 'optimize_mikado_mobile_header_options_map');

}