<?php

namespace UltimatePostKit\Modules\SnapTimeline\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Traits\Global_Widget_Functions;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;
use WP_Query;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Snap_Timeline extends Group_Control_Query {
	use Global_Widget_Controls;
	use Global_Widget_Functions;
	private $_query = null;

	public function get_name() {
		return 'upk-snap-timeline';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Snap Timeline', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-snap-timeline';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'grid', 'blog', 'recent', 'news', 'alter'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-snap-timeline'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/KCBjzS_1lE0';
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
		$this->add_control(
			'skin_layout',
			[
				'label'   => __('Position', 'ultimate-post-kit'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'style-3',
				'options' => [
					'style-1'   => [
						'title' => __('Left', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-left',
					],
					'style-3'  => [
						'title' => __('Center', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-center',
					],
					'style-2'  => [
						'title' => __('Right', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'render_type' => 'template',
				'toggle' => false
			]
		);
		$this->add_control(
			'content_alignment',
			[
				'label'   => __('Alignment', 'ultimate-post-kit'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'right',
				'options' => [
					'left'   => [
						'title' => __('Left', 'ultimate-post-kit'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'ultimate-post-kit'),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __('Right', 'ultimate-post-kit'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'render_type' => 'template',
				'toggle' => false,
				'separator' => 'after',
				'condition' => [
					'skin_layout!' => 'style-3'
				]
			]
		);

		$this->add_control(
			'show_start_end',
			[
				'label'   => esc_html__('Show Start/End', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);
		$this->add_control(
			'show_image',
			[
				'label'   => esc_html__('Show Image', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'primary_thumbnail',
				'exclude' => ['custom'],
				'default' => 'medium',
				'condition' => [
					'show_image' => 'yes'
				]
			]
		);

		$this->add_control(
			'hr_image',
			[
				'type'    => Controls_Manager::DIVIDER,
			]
		);

		//Global Title Controls
		$this->register_title_controls();

		$this->add_control(
			'show_excerpt',
			[
				'label'   => esc_html__('Show Text', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'       => esc_html__('Text Limit', 'ultimate-post-kit'),
				'description' => esc_html__('It\'s just work for main content, but not working with excerpt. If you set 0 so you will get full main content.', 'ultimate-post-kit'),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 30,
				'condition'   => [
					'show_excerpt' => 'yes'
				],
			]
		);

		$this->add_control(
			'strip_shortcode',
			[
				'label'     => esc_html__('Strip Shortcode', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_date',
			[
				'label'        => esc_html__('Show Date', 'ultimate-post-kit'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'separator'	   => 'before'
			]
		);
		$this->add_control(
			'human_diff_time',
			[
				'label'   => esc_html__('Human Different Time', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'show_date' => 'yes'
				]
			]
		);

		$this->add_control(
			'human_diff_time_short',
			[
				'label'   => esc_html__('Time Short Format', 'ultimate-post-kit'),
				'description' => esc_html__('This will work for Hours, Minute and Seconds', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'human_diff_time' => 'yes',
					'show_date' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_time',
			[
				'label'   => esc_html__('Show Time', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'human_diff_time' => '',
					'show_date' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'   => esc_html__('Show Category', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_comments',
			[
				'label'   => esc_html__('Show Comments', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_pagination',
			[
				'label'     => esc_html__('Pagination', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'global_link',
			[
				'label'        => __('Item Wrapper Link', 'ultimate-post-kit'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'upk-global-link-',
				'description'  => __('Be aware! When Item Wrapper Link activated then title link and read more link will not work', 'ultimate-post-kit'),
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
		$this->add_control(
			'item_limit',
			[
				'label'   => esc_html__('Item Limit', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'default' => [
					'size' => 6,
				],
			]
		);
		$this->register_query_builder_controls();

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'section_style_timeline',
			[
				'label' => esc_html__('Timeline', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_line_number_style');

		$this->start_controls_tab(
			'tab_line_number_normal',
			[
				'label' => esc_html__('LINE', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'line_border_style',
			[
				'label'      => esc_html__('Line Style', 'ultimate-post-kit'),
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
					'{{WRAPPER}}' => '--upk-snap-timeline-border-style: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'item_line_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => '--upk-snap-timeline-border-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'item_line_width',
			[
				'label'         => esc_html__('Width', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 0.1,
						'max'   => 5,
						'step'  => 0.1,
					]
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 1,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-snap-timeline-border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_number',
			[
				'label' => esc_html__('NUMBER', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'number_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-counter::before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'number_bg_color',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-counter::before' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'number_radius',
			[
				'label'                 => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-counter::before'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'heading_number_hover',
			[
				'label'     => esc_html__('HOVER', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'number_h_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item:hover .upk-timeline-counter::before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'number_h_bg_color',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item:hover .upk-timeline-counter::before' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'number_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item:hover .upk-timeline-counter::before' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'dost_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-counter::before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_start_end',
			[
				'label' => esc_html__('START/END', 'ultimate-post-kit'),
				'condition' => [
					'show_start_end' => 'yes'
				]
			]
		);

		$this->add_control(
			'item_start_end_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid-start-end-wrap .upk-timeline-s-e-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .upk-snap-timeline-grid-start-end-wrap .upk-timeline-s-e-text upk-bottom-end' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_start_end' => 'yes'
				]
			]
		);

		$this->add_control(
			'item_start_end_bg_color',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid-start-end-wrap .upk-timeline-s-e-text' => 'background: {{VALUE}};',
					'{{WRAPPER}} .upk-snap-timeline-grid-start-end-wrap .upk-timeline-s-e-text upk-bottom-end' => 'background: {{VALUE}};'
				],
				'condition' => [
					'show_start_end' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'item_start_end_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid-start-end-wrap .upk-timeline-s-e-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'show_start_end' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'item_start_end_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline-grid-start-end-wrap .upk-timeline-s-e-text',
				'condition' => [
					'show_start_end' => 'yes'
				]
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
			'items_offset',
			[
				'label'         => esc_html__('Offset', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => -250,
						'max'   => 250,
						'step'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item:not(:first-child)' => 'margin: {{SIZE}}{{UNIT}} 0px;',
				],
				'condition' => [
					'skin_layout' => 'style-3'
				]
			]
		);

		$this->add_responsive_control(
			'items_gap',
			[
				'label'         => esc_html__('Gap', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'skin_layout!' => 'style-3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'timeline_item_background',
				'selector'  => '{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-content-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'           => 'timeline_item_border',
				'label'          => __('Border', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-content-inner',
			]
		);

		$this->add_responsive_control(
			'timeline_item_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-content-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'timeline_item_shadow',
				'selector' => '{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-content-inner',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_image' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'label'     => esc_html__('Border', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-image-wrapper',
			]
		);
		$this->add_responsive_control(
			'image_radius',
			[
				'label'                 => esc_html__('Radius', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-image-wrapper'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__('Title', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_style',
			[
				'label'   => esc_html__('Style', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'underline',
				'options' => [
					'underline'        => esc_html__('Underline', 'ultimate-post-kit'),
					'middle-underline' => esc_html__('Middle Underline', 'ultimate-post-kit'),
					'overline'         => esc_html__('Overline', 'ultimate-post-kit'),
					'middle-overline'  => esc_html__('Middle Overline', 'ultimate-post-kit'),
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'label'    => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-title',
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
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label'     => esc_html__('Text', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-timeline-desc ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-timeline-desc',
			]
		);
		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label'                 => esc_html__('Margin', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-desc'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_date',
			[
				'label'      => esc_html__('Date', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_date' => 'yes'
				],
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'date_spacing',
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
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-date',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => esc_html__('Meta', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'meta_tabs'
		);
		$this->start_controls_tab(
			'meta_category_tab',
			[
				'label' => esc_html__('Category', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'category_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-meta .upk-timeline-category a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'category_separator_color',
			[
				'label'     => esc_html__('Separator Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-meta .upk-timeline-category a::before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'category_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-meta .upk-timeline-category a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_spacing_between',
			[
				'label'     => esc_html__('Space Between', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-meta .upk-timeline-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-meta .upk-timeline-comments' => 'margin-left: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-meta .upk-timeline-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-meta .upk-timeline-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline-grid .upk-timeline-item .upk-timeline-meta .upk-timeline-category a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'meta_comments_tab',
			[
				'label' => esc_html__('Comments', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-timeline-comments' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Text Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-timeline-comments:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-snap-timeline .upk-timeline-item .upk-timeline-comments',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->register_pagination_controls();
	}

	/**
	 * Main query render for this widget
	 * @param $posts_per_page number item query limit
	 */
	public function query_posts($posts_per_page) {

		$default = $this->getGroupControlQueryArgs();
		if ($posts_per_page) {
			$args['posts_per_page'] = $posts_per_page;
			$args['paged']  = max(1, get_query_var('paged'), get_query_var('page'));
		}
		$args         = array_merge($default, $args);
		$this->_query = new WP_Query($args);
	}

	public function render_category() {

		if (!$this->get_settings('show_category')) {
			return;
		}
?>
		<div class="upk-timeline-category">
			<?php echo upk_get_category($this->get_settings('posts_source')); ?>
		</div>
	<?php
	}

	public function render_image() {
		$settings = $this->get_settings_for_display();
		$image_size = $settings['primary_thumbnail_size'];
		$placeholder_image_src = Utils::get_placeholder_image_src();
		$image_id = get_post_thumbnail_id(get_the_ID());
		$image_src = wp_get_attachment_image_src($image_id, $image_size);
		if (!$image_src) {
			$image_src = $placeholder_image_src;
		} else {
			$image_src = $image_src[0];
		}
	?>
		<a class="upk-timeline-image-wrapper" href="<?php echo get_permalink(); ?>">
			<img class="upk-img" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
		</a>


	<?php
	}

	public function render_excerpt($excerpt_length) {
		if (!$this->get_settings('show_excerpt')) {
			return;
		}
		$strip_shortcode = $this->get_settings_for_display('strip_shortcode');
	?>
		<div class="upk-timeline-desc">
			<?php
			if (has_excerpt()) {
				echo wp_trim_words(get_the_excerpt(), $excerpt_length, '...');
			} else {
				echo ultimate_post_kit_custom_excerpt($excerpt_length, $strip_shortcode);
			}
			?>
		</div>

	<?php
	}

	public function render_comments($id = 0) {

		if (!$this->get_settings('show_comments')) {
			return;
		}
	?>

		<div class="upk-timeline-comments">
			<?php echo get_comments_number($id) ?>
			<?php echo esc_html__('Comments', 'ultimate-post-kit') ?>
		</div>

	<?php
	}

	public function render_date() {
		$settings = $this->get_settings_for_display();

		if (!$this->get_settings('show_date')) {
			return;
		}
	?>
		<div>
			<?php if ($settings['human_diff_time'] == 'yes') {
				echo ultimate_post_kit_post_time_diff(($settings['human_diff_time_short'] == 'yes') ? 'short' : '');
			} else {
				echo get_the_date();
			} ?>
		</div>
	<?php
	}

	public function render_post_grid_item($post_id, $excerpt_length) {
		$settings = $this->get_settings_for_display();

		if ('yes' == $settings['global_link']) {

			$this->add_render_attribute('timeline-item', 'onclick', "window.open('" . esc_url(get_permalink()) . "', '_self')", true);
		}
		$this->add_render_attribute('timeline-item', 'class', ['upk-timeline-item'], true);
	?>

		<div <?php $this->print_render_attribute_string('timeline-item'); ?>>
			<div class="upk-timeline-content-wrap">
				<div class="upk-timeline-counter upk-timeline-counter-active"></div>
				<div class="upk-timeline-content-inner">
					<?php if ($settings['show_image'] == 'yes') :
						$this->render_image();
					endif; ?>
					<div class="upk-timeline-date">
						<?php $this->render_date(); ?>
						<?php if ($settings['show_time']) : ?>
							<div class="upk-post-time">
								<i class="upk-icon-clock" aria-hidden="true"></i>
								<?php echo get_the_time(); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php $this->render_title(); ?>
					<?php $this->render_excerpt($excerpt_length); ?>
					<div class="upk-timeline-meta">
						<?php $this->render_category(); ?>
						<?php $this->render_comments($post_id); ?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$limit = $settings['item_limit']['size'];
		$this->query_posts($limit);
		$wp_query = $this->get_query();
		if (!$wp_query->found_posts) {
			return;
		}
		$this->add_render_attribute('timeline-grid', 'class', ['upk-snap-timeline-grid', 'upk-content-align-' . $settings['content_alignment']], true);
	?>

		<div class="upk-snap-timeline">
			<div class="upk-snap-timeline-wrapper upk-snap-timeline-<?php esc_html_e($settings['skin_layout'], 'ultimate-post-kit'); ?>">
				<div class="upk-snap-timeline-grid-start-end-wrap">
					<?php if ($settings['show_start_end']) : ?>
						<div class="upk-timeline-s-e-text upk-top-start"><?php echo esc_html__('start', 'ultimate-post-kit'); ?></div>
						<div class="upk-timeline-s-e-text upk-bottom-end"><?php echo esc_html__('end', 'ultimate-post-kit'); ?></div>
					<?php endif; ?>
					<div <?php $this->print_render_attribute_string('timeline-grid'); ?>>
						<?php
						while ($wp_query->have_posts()) :
							$wp_query->the_post();
						?>
							<?php $this->render_post_grid_item(get_the_ID(), $settings['excerpt_length']); ?>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		if ($settings['show_pagination']) { ?>
			<div class="ep-pagination">
				<?php ultimate_post_kit_post_pagination($wp_query, $this->get_id()); ?>
			</div>
<?php
		}
		wp_reset_postdata();
	}
}
