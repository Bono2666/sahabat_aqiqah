<?php

if(!function_exists('optimize_mikado_search_options_map')) {

	function optimize_mikado_search_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'optimizewp' ),
				'icon'  => 'fa fa-search'
			)
		);

		$search_panel = optimize_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'optimizewp' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'search-dropdown',
				'label' => esc_html__( 'Mikado Search Type', 'optimizewp' ),
				'description' => esc_html__( "Choose a type of Mikado search bar", 'optimizewp' ),
				'options'       => array(
					'search-dropdown' => esc_html__('Search Dropdown', 'optimizewp' )
				)
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_awesome',
				'label' => esc_html__( 'Search Icon Pack', 'optimizewp' ),
				'description' => esc_html__( 'Choose icon pack for search icon', 'optimizewp' ),
				'options'       => optimize_mikado_icon_collections()->getIconCollectionsExclude(array(
					'linea_icons',
					'simple_line_icons',
					'dripicons'
				))
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__( 'Search area in grid', 'optimizewp' ),
				'description' => esc_html__( 'Set search area to be in grid', 'optimizewp' ),
			)
		);

		optimize_mikado_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title' => esc_html__( 'Initial Search Icon in Header', 'optimizewp' )
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label' => esc_html__( 'Icon Size', 'optimizewp' ),
				'description' => esc_html__( 'Set size for icon', 'optimizewp' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		$search_icon_color_group = optimize_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title' => esc_html__( 'Icon Colors', 'optimizewp' ),
				'description' => esc_html__( 'Define color style for icon', 'optimizewp' ),
				'name'        => 'search_icon_color_group'
			)
		);

		$search_icon_color_row = optimize_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label' => esc_html__( 'Color', 'optimizewp' )
			)
		);
		optimize_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label' => esc_html__( 'Hover Color', 'optimizewp' )
			)
		);
		optimize_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_color',
				'label' => esc_html__( 'Light Header Icon Color', 'optimizewp' )
			)
		);
		optimize_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_light_search_icon_hover_color',
				'label' => esc_html__( 'Light Header Icon Hover Color', 'optimizewp' )
			)
		);

		$search_icon_color_row2 = optimize_mikado_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row2',
				'next'   => true
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_color',
				'label' => esc_html__( 'Dark Header Icon Color', 'optimizewp' )
			)
		);
		optimize_mikado_add_admin_field(
			array(
				'parent' => $search_icon_color_row2,
				'type'   => 'colorsimple',
				'name'   => 'header_dark_search_icon_hover_color',
				'label' => esc_html__( 'Dark Header Icon Hover Color', 'optimizewp' )
			)
		);


		$search_icon_background_group = optimize_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title' => esc_html__( 'Icon Background Style', 'optimizewp' ),
				'description' => esc_html__( 'Define background style for icon', 'optimizewp' ),
				'name'        => 'search_icon_background_group'
			)
		);

		$search_icon_background_row = optimize_mikado_add_admin_row(
			array(
				'parent' => $search_icon_background_group,
				'name'   => 'search_icon_background_row'
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_color',
				'default_value' => '',
				'label' => esc_html__( 'Background Color', 'optimizewp' ),
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_background_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_background_hover_color',
				'default_value' => '',
				'label' => esc_html__( 'Background Hover Color', 'optimizewp' ),
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Search Icon Text', 'optimizewp' ),
				'description' => esc_html__( "Enable this option to show Search text next to search icon in header", 'optimizewp' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#mkdf_enable_search_icon_text_container'
				)
			)
		);

		$enable_search_icon_text_container = optimize_mikado_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'hidden_property' => 'enable_search_icon_text',
				'hidden_value'    => 'no'
			)
		);

		$enable_search_icon_text_group = optimize_mikado_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title' => esc_html__( 'Search Icon Text', 'optimizewp' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define Style for Search Icon Text', 'optimizewp' )
			)
		);

		$enable_search_icon_text_row = optimize_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_text_color',
				'label' => esc_html__( 'Text Color', 'optimizewp' ),
				'default_value' => ''
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'colorsimple',
				'name'          => 'search_icon_text_color_hover',
				'label' => esc_html__( 'Text Hover Color', 'optimizewp' ),
				'default_value' => ''
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_fontsize',
				'label' => esc_html__( 'Font Size', 'optimizewp' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_lineheight',
				'label' => esc_html__( 'Line Height', 'optimizewp' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$enable_search_icon_text_row2 = optimize_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_texttransform',
				'label' => esc_html__( 'Text Transform', 'optimizewp' ),
				'default_value' => '',
				'options'       => optimize_mikado_get_text_transform_array()
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label' => esc_html__( 'Font Family', 'optimizewp' ),
				'default_value' => '-1',
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_fontstyle',
				'label' => esc_html__( 'Font Style', 'optimizewp' ),
				'default_value' => '',
				'options'       => optimize_mikado_get_font_style_array(),
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_fontweight',
				'label' => esc_html__( 'Font Weight', 'optimizewp' ),
				'default_value' => '',
				'options'       => optimize_mikado_get_font_weight_array(),
			)
		);

		$enable_search_icon_text_row3 = optimize_mikado_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letterspacing',
				'label' => esc_html__( 'Letter Spacing', 'optimizewp' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$search_icon_spacing_group = optimize_mikado_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title' => esc_html__( 'Icon Spacing', 'optimizewp' ),
				'description' => esc_html__( 'Define padding and margins for Search icon', 'optimizewp' ),
				'name'        => 'search_icon_spacing_group'
			)
		);

		$search_icon_spacing_row = optimize_mikado_add_admin_row(
			array(
				'parent' => $search_icon_spacing_group,
				'name'   => 'search_icon_spacing_row'
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_padding_left',
				'default_value' => '',
				'label' => esc_html__( 'Padding Left', 'optimizewp' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_padding_right',
				'default_value' => '',
				'label' => esc_html__( 'Padding Right', 'optimizewp' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_margin_left',
				'default_value' => '',
				'label' => esc_html__( 'Margin Left', 'optimizewp' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		optimize_mikado_add_admin_field(
			array(
				'parent'        => $search_icon_spacing_row,
				'type'          => 'textsimple',
				'name'          => 'search_margin_right',
				'default_value' => '',
				'label' => esc_html__( 'Margin Right', 'optimizewp' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}

	add_action('optimize_mikado_options_map', 'optimize_mikado_search_options_map', 5);

}