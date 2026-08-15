<?php

namespace UltimatePostKit\Modules\ForbesTabs\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;
use WP_Query;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Forbes_Tabs extends Group_Control_Query {
	use Global_Widget_Controls;

	private $_query = null;

	public function get_name() {
		return 'upk-forbes-tabs';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Forbes Tabs', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-forbes-tabs';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'blog', 'recent', 'news', 'forbes', 'list', 'tabs'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-forbes-tabs'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-forbes-tabs'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/lc0WNMtjP_k';
	}

	public function get_query() {
		return $this->_query;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Layout', 'ultimate-post-kit'),
			]
		);
		$this->add_responsive_control(
			'content_item_gap',
			[
				'label'      => esc_html__('Items Gap', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vh'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_height',
			[
				'label'      => esc_html__('Content Height', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vh'],
				'range'      => [
					'px' => [
						'min'  => 450,
						'max'  => 1200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'primary_thumbnail',
				'exclude' => ['custom'],
				'default' => 'full',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_post_query_builder',
			[
				'label' => __('Query', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		// $this->add_control(
		// 	'item_limit',
		// 	[
		// 		'label'   => esc_html__('Item Limit', 'ultimate-post-kit'),
		// 		'type'    => Controls_Manager::SLIDER,
		// 		'range'   => [
		// 			'px' => [
		// 				'min' => 1,
		// 				'max' => 20,
		// 			],
		// 		],
		// 		'default' => [
		// 			'size' => 7,
		// 		],
		// 	]
		// );
		$this->register_query_builder_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_additional',
			[
				'label' => esc_html__('Additional', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'show_header',
			[
				'label'   => esc_html__('Show Header', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		// $this->add_control(
		// 	'show_arrow',
		// 	[
		// 		'label'   => esc_html__('Show Arrow', 'ultimate-post-kit'),
		// 		'type'    => Controls_Manager::SWITCHER,
		// 		'default' => 'no',
		// 	]
		// );
		$this->add_control(
			'show_title',
			[
				'label'         => esc_html__('Show Title', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Show', 'ultimate-post-kit'),
				'label_off'     => esc_html__('Hide', 'ultimate-post-kit'),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);
		$this->add_control(
			'title_word_limit',
			[
				'label'     => esc_html__('Title Limit', 'ultimate-post-kit'),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'default'   => 10,
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);
		$this->add_control(
			'show_category',
			[
				'label'         => esc_html__('Show Category', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Show', 'ultimate-post-kit'),
				'label_off'     => esc_html__('Hide', 'ultimate-post-kit'),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label'         => esc_html__('Show Meta', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Show', 'ultimate-post-kit'),
				'label_off'     => esc_html__('Hide', 'ultimate-post-kit'),
				'return_value'  => 'yes',
				'default'       => 'yes',
			]
		);
		$this->add_control(
			'show_author',
			[
				'label'         => esc_html__('Show Author', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Show', 'ultimate-post-kit'),
				'label_off'     => esc_html__('Hide', 'ultimate-post-kit'),
				'return_value'  => 'yes',
				'default'       => 'yes',
				'condition' => [
					'show_meta' => 'yes'
				]
			]
		);
		$this->add_control(
			'meta_separator',
			[
				'label'       => __('Separator', 'ultimate-post-kit'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '//',
				'label_block' => false,
			]
		);

		$this->register_date_controls();
		$this->add_control(
			'header_title_text',
			[
				'label'     => esc_html__('Header Label', 'ultimate-post-kit'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Trending Articles', 'ultimate-post-kit'),
				'condition' => [
					'show_header' => 'yes'
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_header',
			[
				'label' => esc_html__('Header', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'header_background',
				'label'    => esc_html__('Background', 'ultimate-post-kit'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .upk-forbes-tabs-header-wrap',
			]
		);
		// $this->add_group_control(
		// 	Group_Control_Border::get_type(),
		// 	[
		// 		'name'           => 'header_border',
		// 		'label'          => __('Border', 'ultimate-post-kit'),
		// 		'fields_options' => [
		// 			'border' => [
		// 				'default' => 'solid',
		// 			],
		// 			'width'  => [
		// 				'default' => [
		// 					'top'      => '0',
		// 					'right'    => '0',
		// 					'bottom'   => '2',
		// 					'left'     => '0',
		// 					'isLinked' => false,
		// 				],
		// 			],
		// 			'color'  => [
		// 				'default' => '#EF233C',
		// 			],
		// 		],
		// 		'selector'       => '{{WRAPPER}} .upk-forbes-tabs-header-wrap',
		// 	]
		// );
		$this->add_control(
			'heading_header_border',
			[
				'label'     => esc_html__('B O R D E R', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'header_border_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-header-wrap' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'header_border_style',
			[
				'label'      => esc_html__('Style', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'solid',
				'options'    => [
					'solid'  => esc_html__('Solid', 'ultimate-post-kit'),
					'dashed' => esc_html__('Dashed', 'ultimate-post-kit'),
					'dotted' => esc_html__('Dotted', 'ultimate-post-kit'),
					'double' => esc_html__('Double', 'ultimate-post-kit'),
					'groove'   => esc_html__('Groove', 'ultimate-post-kit'),
				],
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-header-wrap' => 'border-bottom-style: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'header_border_width',
			[
				'label'         => esc_html__('Width', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 1,
						'max'   => 20,
						'step'  => 1,
					]
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 2,
				],
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-header-wrap' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'header_spacing',
			[
				'label'         => esc_html__('Bottom Spacing', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 100,
						'step'  => 1,
					]
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-header-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_heading_title',
			[
				'label' => esc_html__('Heading Title', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'header_title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'heading_title_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title',
			]
		);
		// $this->add_control(
		// 	'header_title_hover_color',
		// 	[
		// 		'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title:hover' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );
		$this->add_responsive_control(
			'header_title_padding',
			[
				'label'      => esc_html__('Padding', 'ultimae-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'heading_title_border',
				'label'     => esc_html__('Border', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title',
			]
		);
		$this->add_responsive_control(
			'heading_title_border_radius',
			[
				'label'                 => esc_html__('Radius', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'header_title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'header_title_text_shadow',
				'label'    => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-forbes-tabs-header-wrap .upk-forbes-tabs-header-title .upk-title',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_filter',
			[
				'label' => esc_html__('Filter', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'filter_tabs'
		);

		$this->start_controls_tab(
			'filter_tab_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'header_filter_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_background',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'header_filter_padding',
			[
				'label'      => esc_html__('Padding', 'ultimae-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
		$this->add_responsive_control(
			'header_filter_margin',
			[
				'label'      => esc_html__('Margin', 'ultimae-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'filter_border',
				'label'     => esc_html__('Border', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option',
			]
		);
		$this->add_responsive_control(
			'filter_border_radius',
			[
				'label'                 => esc_html__('Radius', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}}  .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'header_filter_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'filter_tab_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'filter_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_hover_background',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list .upk-option:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'filter_tab_active',
			[
				'label' => esc_html__('Active', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'filter_active_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list.upk-forbes-tabs-active .upk-option' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_active_background',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list.upk-forbes-tabs-active .upk-option' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_active_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-header-wrap .upk-filter-and-pagination-wrap .upk-forbes-tabs-filter-wrapper .upk-forbes-tabs-filter-item .upk-filter-list.upk-forbes-tabs-active .upk-option' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'upk_section_style',
			[
				'label' => esc_html__('Items', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __('Content Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'      => 30,
					'right'    => 0,
					'bottom'   => 0,
					'left'     => 0,
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_item_style');

		$this->start_controls_tab(
			'tab_item_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_border',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item',
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => __('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_hover_background',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:hover',
			]
		);

		$this->add_control(
			'item_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'item_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_hover_box_shadow',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_image_border',
				'selector' => '{{WRAPPER}} .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item .upk-forbes-tabs-grid-item-box .upk-image-wrapper',
			]
		);

		$this->add_responsive_control(
			'item_image_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item .upk-forbes-tabs-grid-item-box .upk-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__('Title', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'tabs_title_primary'
		);
		$this->start_controls_tab(
			'title_tab_primary',
			[
				'label' => esc_html__('Primary', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'primary_title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'primary_title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'primary_title_spacing',
			[
				'label'     => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'primary_title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'primary_title_text_shadow',
				'label'    => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'title_tab_secondary',
			[
				'label' => esc_html__('Secondary', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'label'    => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-title .upk-title',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_meta',
			[
				'label'     => esc_html__('Meta', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'  => 'show_author',
							'value' => 'yes'
						],
						[
							'name'  => 'show_date',
							'value' => 'yes'
						]
					]
				],
			]
		);
		$this->add_responsive_control(
			'meta_separator_spacing',
			[
				'label'         => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-blog-post-meta .upk-separator' => 'margin: 0px {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'style_meta_tabs'
		);
		$this->start_controls_tab(
			'meta_tab_primary',
			[
				'label' => esc_html__('Primary', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Text Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-blog-post-meta *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Text Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-blog-post-meta *:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-blog-post-meta *'
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'meta_tab_secondary',
			[
				'label' => esc_html__('Secondary', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'meta_s_color',
			[
				'label'     => esc_html__('Text Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-blog-post-meta *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_s_hover_color',
			[
				'label'     => esc_html__('Text Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-blog-post-meta *:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_s_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-blog-post-meta *'
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_category',
			[
				'label' => esc_html__('Category', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_category_style');
		$this->start_controls_tab(
			'tab_category_primary',
			[
				'label' => esc_html__('Primary', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'category_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'category_background',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'category_border',
				'label'     => esc_html__('Border Secondary', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);

		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_margin',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_category_secondary',
			[
				'label' => esc_html__('Secondary', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'category_color_secondary',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'category_background_secondary',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'category_border_secondary',
				'label'     => esc_html__('Border Secondary', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);

		$this->add_responsive_control(
			'category_border_radius_secondary',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_padding_secondary',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_margin_secondary',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-item .upk-forbes-tabs-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow_secondary',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography_secondary',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_category_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'heading_category_primary',
			[
				'label'     => esc_html__('Primary', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'category_primary_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'category_primary_hover_background',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a:hover',
			]
		);

		$this->add_control(
			'category_primary_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'category_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper .upk-forbes-tabs-grid-item:nth-child(7n + 1) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_category_secondary',
			[
				'label'     => esc_html__('Secondary', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'category_secondary_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'category_secondary_hover_background',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a:hover',
			]
		);

		$this->add_control(
			'category_secondary_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'category_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-forbes-tabs-wrap .upk-forbes-tabs-grid-wrapper :not(.upk-forbes-tabs-grid-item:nth-child(7n + 1)) .upk-forbes-tabs-grid-item-box .upk-forbes-tabs-content-box .upk-forbes-tabs-category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	public function get_taxonomies() {
		$taxonomies = get_taxonomies(['show_in_nav_menus' => true], 'objects');
		$options = ['' => ''];

		foreach ($taxonomies as $taxonomy) {
			$options[$taxonomy->name] = $taxonomy->label;
		}

		return $options;
	}

	//	public function get_posts_tags() {
	//		$taxonomy = $this->get_settings('taxonomy');
	//		foreach ($this->_query->posts as $post) {
	//			if (!$taxonomy) {
	//				$post->tags = [];
	//
	//				continue;
	//			}
	//			$tags = wp_get_post_terms($post->ID, $taxonomy);
	//			$tags_slugs = [];
	//			foreach ($tags as $tag) {
	//				$tags_slugs[$tag->term_id] = $tag;
	//			}
	//			$post->tags = $tags_slugs;
	//		}
	//	}

	public function query_posts() {
		$default                = $this->getGroupControlQueryArgs();
		$args['posts_per_page'] = 7;
		$args['paged']  = max(1, get_query_var('paged'), get_query_var('page'));
		$query_args             = array_merge($default, $args);
		$this->_query           = new WP_Query($query_args);
	}

	public function render_image($image_id, $size) {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		$image_src = wp_get_attachment_image_src($image_id, $size);

		if (!$image_src) {
			$image_src = $placeholder_image_src;
		} else {
			$image_src = $image_src[0];
		}

?>
		<a href="<?php echo get_permalink(); ?>">
			<img class="upk-img" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
		</a>


	<?php
	}

	public function render_title() {
		$settings = $this->get_settings_for_display();
	?>
		<a class="upk-forbes-tabs-title" href="<?php echo get_permalink(); ?>">
			<h3 class="upk-title"><?php echo wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') ?></h3>
		</a>
	<?php
	}

	public function render_author() { ?>
		<div class="upk-author-content">
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
				<i class="upk-icon-user"></i>
				<span class="upk-author-name"><?php echo get_the_author() ?></span>
			</a>
		</div>
	<?php
	}


	public function render_date() {
		$settings = $this->get_settings_for_display();
		if (!$this->get_settings('show_date')) {
			return;
		} ?>
		<div class="upk-blog-date">
			<span class="date">
				<?php if ($settings['human_diff_time'] == 'yes') {
					echo ultimate_post_kit_post_time_diff(($settings['human_diff_time_short'] == 'yes') ? 'short' : '');
				} else {
					echo get_the_date();
				} ?>
			</span>
		</div>
	<?php
	}



	public function render_category() { ?>
		<div class="upk-forbes-tabs-category">
			<?php echo upk_get_category($this->get_settings('posts_source')); ?>
		</div>
	<?php
	}

	protected function forbes_tabs_get_category() {
		$settings = $this->get_settings_for_display();
		$terms_query = $this->get_custom_terms();
		$post_type = $this->get_settings('posts_source');
		switch ($post_type) {
			case 'campaign':
				$taxonomy = 'campaign_category';
				break;
			case 'lightbox_library':
				$taxonomy = 'ngg_tag';
				break;
			case 'give_forms':
				$taxonomy = 'give_forms_category';
				break;
			case 'tribe_events':
				$taxonomy = 'tribe_events_cat';
				break;
			case 'product':
				$taxonomy = 'product_cat';
				break;
			default:
				$taxonomy = 'category';
				break;
		}
		// if (!empty($terms_query)) {
		// 	$taxonomy = $terms_query[0]['taxonomy'];
		// 	$taxonomy_id = $terms_query[0]['terms'];
		// } else {
		// 	$taxonomy = 'category';
		// 	$taxonomy_id = '';
		// }
		$include_Categories = $settings['posts_include_term_ids'];
		$exclude_Categories = $settings['posts_exclude_term_ids'];
		$post_options = [];
		$post_categories = get_terms([
			'taxonomy' => $taxonomy,
			// 'term_taxonomy_id' => $taxonomy_id,
			'hide_empty' => true,
			'include' => $include_Categories,
			'exclude' => $exclude_Categories,
		]);

		if (is_wp_error($post_categories)) {
			return $post_options;
		}
		if (false !== $post_categories and is_array($post_categories)) {
			foreach ($post_categories as $category) {
				$post_options[$category->slug] = $category->name;
			}
		}
		return $post_options;
	}

	public function get_custom_terms() {
		$settings = $this->get_settings_for_display();
		/**
		 * Set Taxonomy
		 */
		$include_by    = $this->getGroupControlQueryParamBy('include');
		$exclude_by    = $this->getGroupControlQueryParamBy('exclude');
		$include_terms = [];
		$exclude_terms = [];
		$terms_query   = [];

		if (in_array('terms', $include_by)) {
			$include_terms = wp_parse_id_list($settings['posts_include_term_ids']);
		}

		if (in_array('terms', $exclude_by)) {
			$exclude_terms = wp_parse_id_list($settings['posts_exclude_term_ids']);
			$include_terms = array_diff($include_terms, $exclude_terms);
		}

		if (!empty($include_terms)) {
			$tax_terms_map = $this->mapGroupControlQuery($include_terms);

			foreach ($tax_terms_map as $tax => $terms) {
				$terms_query[] = [
					'taxonomy' => $tax,
					'field'    => 'term_id',
					'terms'    => $terms,
					'operator' => 'IN',
				];
			}
		}
		if (!empty($terms_query)) {
			return $terms_query;
		}
	}

	protected function render_header() {
		$settings = $this->get_settings_for_display();
		// $terms_query = $this->get_custom_terms();
		// if (!empty($terms_query)) {
		// 	$taxonomy = $terms_query[0]['taxonomy'];
		// } else {
		// 	$taxonomy = 'category';
		// }
		$post_type = $this->get_settings('posts_source');
		switch ($post_type) {
			case 'campaign':
				$taxonomy = 'campaign_category';
				break;
			case 'lightbox_library':
				$taxonomy = 'ngg_tag';
				break;
			case 'give_forms':
				$taxonomy = 'give_forms_category';
				break;
			case 'tribe_events':
				$taxonomy = 'tribe_events_cat';
				break;
			case 'product':
				$taxonomy = 'product_cat';
				break;
			default:
				$taxonomy = 'category';
				break;
		}
		$categories = $this->forbes_tabs_get_category();
		$this->add_render_attribute(
			[
				'upk-forbes-tabs' => [
					'class' => [
						'upk-forbes-tabs'
					],
					'data-show-hide' => [
						wp_json_encode(array_filter([
							'show_title' => isset($settings['show_title']) ? $settings['show_title'] : 'no',
							'show_category' => isset($settings['show_category']) ? $settings['show_category'] : 'no',
							'show_meta' => isset($settings['show_meta']) ? $settings['show_meta'] : 'no',
							'show_author' => isset($settings['show_author']) ? $settings['show_author'] : 'no',
						]))
					]
				]
			]
		);
		$this->add_render_attribute('forbes-tabs', 'class', 'upk-forbes-tabs-grid-wrapper', true);
		$this->add_render_attribute(
			[
				'forbes-tabs' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							'taxonomy'    => $taxonomy,
							'post-type'   => $settings['posts_source'],
							'order'       => $settings['posts_order'],
							'orderby'     => $settings['posts_orderby'],
							'meta_separator' => $settings['meta_separator'],
							'title_text_limit' 	=> $settings['title_word_limit'],
						]))
					]
				]
			]
		);

	?>

		<div <?php $this->print_render_attribute_string('upk-forbes-tabs'); ?>>
			<div class="ultimate-post-kit-forbes-tabs-wrap">
				<?php if ($settings['show_header']) : ?>
					<div class="upk-forbes-tabs-header-wrap">
						<div class="upk-forbes-tabs-header-title">
							<h3 class="upk-title"><?php _e($settings['header_title_text'], 'ultimate-post-kit'); ?></h3>
						</div>
						<div class="upk-filter-and-pagination-wrap">
							<div class="upk-forbes-tabs-filter-wrapper">
								<ul class="upk-forbes-tabs-filter-item">
									<li class="upk-filter-list upk-forbes-tabs-active">
										<a class="upk-option upk-active" href="javascript:void(0)" data-slug=""><?php _e('All', 'ultimate-post-kit'); ?></a>
									</li>
									<?php
									foreach ($categories as  $key => $category) : ?>
										<li class="upk-filter-list">
											<?php printf('<a class="upk-option" href="javascript:void(0)" data-slug="%2$s">%1$s</a>', $category, $key); ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="upk-forbes-tabs-filter-responsive">
								<select class="upk-filter-item">
									<option value="">
										<a class="upk-option upk-active" href="javascript:void(0)" data-slug=""><?php _e('All', 'ultimate-post-kit'); ?></a>
									</option>
									<?php foreach ($categories as $category) : ?>
										<option value="<?php echo esc_attr($category); ?>">
											<?php printf('<a class="upk-option" href="javascript:void(0)" data-slug="%2$s">%1$s</a>', $category, $key); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<!-- TODO  -->
							<!--<div class="upk-forbes-tabs-pagination">
									<a class="upk-pagination-btn upk-prev" href="#">
										<i class="upk-icon  eicon-arrow-left"></i>
									</a>
									<a class="upk-pagination-btn upk-next" href="#">
										<i class="upk-icon  eicon-arrow-right"></i>
									</a>
								</div> -->
						</div>
					</div>
				<?php endif; ?>
				<div <?php $this->print_render_attribute_string('forbes-tabs'); ?>>

				<?php
			}

			protected function render_footer() { ?>
				</div>
			</div>
		</div>
	<?php
			}
			public function render_post_grid_item($post_id) {
				$settings = $this->get_settings_for_display(); ?>
		<div class="upk-forbes-tabs-grid-item">
			<div class="upk-forbes-tabs-grid-item-box">
				<div class="upk-image-wrapper">
					<?php $this->render_image(get_post_thumbnail_id($post_id), $settings['primary_thumbnail_size']); ?>
				</div>
				<div class="upk-forbes-tabs-content-box">
					<?php if ($settings['show_category'] == 'yes') :
						$this->render_category();
					endif;

					if ($settings['show_title'] == 'yes') :
						$this->render_title();
					endif;

					if ($settings['show_meta'] == 'yes') : ?>
						<div class="upk-blog-post-meta">
							<?php if ($settings['show_author'] == 'yes') : ?>
								<div class="upk-blog-author">
									<a class="author-name" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
										<?php echo get_the_author() ?>
									</a>
								</div>
							<?php endif; ?>
							<span class="upk-separator"><?php echo esc_html($settings['meta_separator']); ?></span>
							<?php $this->render_date(); ?>
							<?php if ($settings['show_time']) : ?>
								<div class="upk-post-time">
									<i class="upk-icon-clock" aria-hidden="true"></i>
									<?php echo get_the_time(); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
			<?php
			}

			public function render() {
				$settings = $this->get_settings_for_display();
				$this->query_posts();
				$wp_query = $this->get_query();
				$item_index = 1;

				if (!$wp_query->found_posts) {
					return;
				}
				$this->render_header();

				while ($wp_query->have_posts()) {
					if ($item_index > 7) {
						break;
					}
					$wp_query->the_post();
					$image_src             = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');
					$placeholder_image_src = Utils::get_placeholder_image_src();
					if (empty($image_src)) {
						$image_src = $placeholder_image_src;
					}
					$this->render_post_grid_item(get_the_ID(), $image_src);
					$item_index++;
				}
				$this->render_footer();
				wp_reset_postdata();
			}


			private function getGroupControlQueryParamBy($by = 'exclude') {
				$mapBy = [
					'exclude' => 'posts_exclude_by',
					'include' => 'posts_include_by',
				];

				$setting = $this->get_settings_for_display($mapBy[$by]);

				return (!empty($setting) ? $setting : []);
			}
			private function mapGroupControlQuery($term_ids = []) {
				$terms = get_terms(
					[
						'term_taxonomy_id' => $term_ids,
						'hide_empty'       => false,
					]
				);

				$tax_terms_map = [];

				foreach ($terms as $term) {
					$taxonomy                     = $term->taxonomy;
					$tax_terms_map[$taxonomy][] = $term->term_id;
				}
				return $tax_terms_map;
			}
		}
