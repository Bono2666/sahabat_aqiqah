<?php

namespace UltimatePostKit\Modules\GroveTimeline\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Traits\Global_Widget_Functions;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Grove_Timeline extends Group_Control_Query {
	use Global_Widget_Controls;
	use Global_Widget_Functions;
	private $_query = null;

	public function get_name() {
		return 'upk-grove-timeline';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Grove Timeline', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-grove-timeline';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'carousel', 'blog', 'recent', 'news', 'elite'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-grove-timeline'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-grove-timeline'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/FPkHDXCMrjk';
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
				'label'      => __('Skin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'style-1',
				'options'    => [
					'style-1'  => __('Style 1', 'ultimate-post-kit'),
					'style-2'  => __('Style 2', 'ultimate-post-kit'),
					'style-3'  => __('Style 3', 'ultimate-post-kit'),
				],
			]
		);
		$this->add_responsive_control(
			'columns',
			[
				'label'          => __('Columns', 'ultimate-post-kit'),
				'type'           => Controls_Manager::SELECT,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options'        => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				],
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label'   => __('Item Gap', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'tablet_default' => [
					'size' => 20,
				],
				'mobile_default' => [
					'size' => 20,
				],
				'range'   => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);
		$this->add_responsive_control(
			'item_height',
			[
				'label'   => esc_html__('Item Height(px)', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-grove-timeline-item-height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'primary_thumbnail',
				'exclude' => ['custom'],
				'default' => 'medium',
			]
		);

		$this->end_controls_section();

		// Query Settings
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

		$this->start_controls_section(
			'section_content_additional',
			[
				'label' => esc_html__('Additional', 'ultimate-post-kit'),
			]
		);

		//Global Title Controls
		// upk_title_controls($this);
		$this->register_title_controls();

		$this->add_control(
			'show_excerpt',
			[
				'label'   => esc_html__('Show Text', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
			'show_author',
			[
				'label'         => esc_html__('Author', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Show', 'ultimate-post-kit'),
				'label_off'     => esc_html__('Hide', 'ultimate-post-kit'),
				'return_value'  => 'yes',
				'default'       => 'no',
				'separator' 	=> 'before'
			]
		);
		$this->add_control(
			'meta_separator',
			[
				'label'       => esc_html__('Separator', 'ultimate-post-kit'),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => '//',
				'label_block' => false,
			]
		);
		$this->register_date_controls();
		$this->add_control(
			'item_match_height',
			[
				'label'        => __('Item Match Height', 'ultimate-post-kit'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'prefix_class' => 'upk-item-match-height--',
				'separator'    => 'before'
			]
		);

		$this->add_control(
			'global_link',
			[
				'label'        => __('Item Wrapper Link', 'ultimate-post-kit'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'upk-global-link-',
				'description'  => __('Be aware! When Item Wrapper Link activated then title link and read more link will not work', 'ultimate-post-kit'),
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		//Navigaiton Global Controls
		$this->start_controls_section(
			'section_content_navigation',
			[
				'label' => __('Navigation', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__('Arrows Icon', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => '15',
				'options' => [
					'1'        => esc_html__('Style 1', 'ultimate-post-kit'),
					'2'        => esc_html__('Style 2', 'ultimate-post-kit'),
					'3'        => esc_html__('Style 3', 'ultimate-post-kit'),
					'4'        => esc_html__('Style 4', 'ultimate-post-kit'),
					'5'        => esc_html__('Style 5', 'ultimate-post-kit'),
					'6'        => esc_html__('Style 6', 'ultimate-post-kit'),
					'7'        => esc_html__('Style 7', 'ultimate-post-kit'),
					'8'        => esc_html__('Style 8', 'ultimate-post-kit'),
					'9'        => esc_html__('Style 9', 'ultimate-post-kit'),
					'10'       => esc_html__('Style 10', 'ultimate-post-kit'),
					'11'       => esc_html__('Style 11', 'ultimate-post-kit'),
					'12'       => esc_html__('Style 12', 'ultimate-post-kit'),
					'13'       => esc_html__('Style 13', 'ultimate-post-kit'),
					'14'       => esc_html__('Style 14', 'ultimate-post-kit'),
					'15'       => esc_html__('Style 15', 'ultimate-post-kit'),
					'16'       => esc_html__('Style 16', 'ultimate-post-kit'),
					'17'       => esc_html__('Style 17', 'ultimate-post-kit'),
					'18'       => esc_html__('Style 18', 'ultimate-post-kit'),
					'circle-1' => esc_html__('Style 19', 'ultimate-post-kit'),
					'circle-2' => esc_html__('Style 20', 'ultimate-post-kit'),
					'circle-3' => esc_html__('Style 21', 'ultimate-post-kit'),
					'circle-4' => esc_html__('Style 22', 'ultimate-post-kit'),
					'square-1' => esc_html__('Style 23', 'ultimate-post-kit'),
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => __('Carousel Settings', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'   => __('Autoplay', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',

			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__('Autoplay Speed', 'ultimate-post-kit'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pauseonhover',
			[
				'label' => esc_html__('Pause on Hover', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'type'           => Controls_Manager::SELECT,
				'label'          => esc_html__('Slides to Scroll', 'ultimate-post-kit'),
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'options'        => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				],
			]
		);

		$this->add_control(
			'centered_slides',
			[
				'label'   => __('Center Slide', 'ultimate-post-kit'),
				'description'   => __('Use even items from Layout > Columns settings for better preview.', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'grab_cursor',
			[
				'label'   => __('Grab Cursor', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => __('Loop', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',

			]
		);


		$this->add_control(
			'speed',
			[
				'label'   => __('Animation Speed (ms)', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 50,
					],
				],
			]
		);

		$this->add_control(
			'observer',
			[
				'label'       => __('Observer', 'ultimate-post-kit'),
				'description' => __('When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SWITCHER,
			]
		);


		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_style_timeline',
			[
				'label' => esc_html__('Timeline', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'timeline_spacing',
			[
				'label'         => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 200,
						'step'  => 1,
					]
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'line_num_tabs'
		);
		$this->start_controls_tab(
			'line_tab',
			[
				'label' => esc_html__('Line', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'item_line_border_style',
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
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrapper::before' => 'border-bottom-style: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'line_border_width',
			[
				'label'     => esc_html__('Line Border Width', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 15,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrapper::before' => 'border-bottom-width: {{SIZE}}px;'
				],
			]
		);
		$this->add_control(
			'item_line_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrapper::before' => 'border-bottom-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'number_tab',
			[
				'label' => esc_html__('Number', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'number_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-counter' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'number_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-counter::before',
			]
		);
		$this->add_responsive_control(
			'number_radius',
			[
				'label'                 => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-counter::before'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'heading_number_hover',
			[
				'label'     => esc_html__('H O V E R', 'ultimate-post-kit'),
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
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item:hover .upk-grove-timeline-counter' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'number_h_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item:hover .upk-grove-timeline-counter::before',
			]
		);
		$this->add_responsive_control(
			'number_spacing',
			[
				'label'         => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 1,
						'max'   => 100,
						'step'  => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-grove-timeline-counter: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'number_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-counter',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_content_style');

		$this->start_controls_tab(
			'tab_item_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'itam_background',
				'selector' => '{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-content-wrap',
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_margin',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'item_border',
				'label'       => __('Border', 'ultimate-post-kit'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-content-wrap',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'name'     => 'itam_background_color_hover',
				'selector' => '{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item:hover',
			]
		);

		$this->add_control(
			'item_border_color_hover',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-content-wrap:hover' => 'border-color: {{VALUE}};'
				],
				'condition' => [
					'item_border_border!' => ''
				]
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
				'selector' => '{{WRAPPER}} .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-image-wrap',
			]
		);

		$this->add_responsive_control(
			'item_image_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-title:hover a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-title a',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'label'    => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-title a',
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
					'{{WRAPPER}} .upk-grove-timeline-wrapper .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-item .upk-grove-timeline-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-item .upk-grove-timeline-desc',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_meta',
			[
				'label'      => esc_html__('Meta', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
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

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Text Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-timeline-meta *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Text Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-timeline-meta *:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-timeline-meta *',
			]
		);

		$this->add_responsive_control(
			'meta_spacing',
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
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-timeline-meta' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_space_between',
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
					'{{WRAPPER}} .upk-grove-timeline .upk-grove-timeline-wrap .upk-grove-timeline-item .upk-grove-timeline-inner-item .upk-grove-timeline-content-wrap .upk-timeline-meta .upk-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'      => __('Navigation', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrows_heading',
			[
				'label'     => __('Arrows', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs('tabs_navigation_arrows_style');

		$this->start_controls_tab(
			'tabs_nav_arrows_normal',
			[
				'label'     => __('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev i, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next i' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'arrows_background',
			[
				'label'     => __('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'nav_arrows_border',
				'selector'  => '{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label' => __('Size', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev i,
                {{WRAPPER}} .upk-grove-timeline .upk-navigation-next i' => 'font-size: {{SIZE || 15}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_nav_arrows_hover',
			[
				'label'     => __('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev:hover i, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next:hover i' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'arrows_hover_background',
			[
				'label'     => __('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev:hover, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next:hover' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'nav_arrows_hover_border_color',
			[
				'label'     => __('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev:hover, {{WRAPPER}} .upk-grove-timeline .upk-navigation-next:hover'  => 'border-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_responsive_control(
			'arrows_acx_position',
			[
				'label'   => __('Arrows Horizontal Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -6,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .upk-grove-timeline .upk-navigation-next' => 'right: {{SIZE}}px;',
				]
			]
		);

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

	public function get_posts_tags() {
		$taxonomy = $this->get_settings('taxonomy');

		foreach ($this->_query->posts as $post) {
			if (!$taxonomy) {
				$post->tags = [];

				continue;
			}

			$tags = wp_get_post_terms($post->ID, $taxonomy);

			$tags_slugs = [];

			foreach ($tags as $tag) {
				$tags_slugs[$tag->term_id] = $tag;
			}

			$post->tags = $tags_slugs;
		}
	}


	public function query_posts($posts_per_page) {
		$default = $this->getGroupControlQueryArgs();
		if ($posts_per_page) {
			$args['posts_per_page'] = $posts_per_page;
			$args['paged']  = max(1, get_query_var('paged'), get_query_var('page'));
		}
		$args         = array_merge($default, $args);
		$this->_query = new \WP_Query($args);
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
		<img class="upk-grove-timeline-img" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_html(get_the_title()); ?>">
	<?php
	}

	public function render_date() {
		$settings = $this->get_settings_for_display();
		if (!$this->get_settings('show_date')) {
			return;
		}

	?>
		<div class="upk-grove-timeline-date">
			<?php if ($settings['human_diff_time'] == 'yes') {
				echo ultimate_post_kit_post_time_diff(($settings['human_diff_time_short'] == 'yes') ? 'short' : '');
			} else {
				echo get_the_date();
			} ?>
		</div>
	<?php
	}

	public function render_author() { ?>
		<div class="upk-author-name-wrap">
			<span class="upk-by"><?php echo esc_html_x('by', 'Frontend', 'ultimate-post-kit'); ?></span>
			<a class="upk-author-name" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
				<?php echo get_the_author() ?>
			</a>
		</div>
	<?php
	}

	public function render_excerpt($excerpt_length) {
		if (!$this->get_settings('show_excerpt')) {
			return;
		}
		$strip_shortcode = $this->get_settings_for_display('strip_shortcode');
	?>
		<div class="upk-grove-timeline-desc">
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

	public function render_header() {
		$id       		 = 'upk-grove-timeline-' . $this->get_id();
		$settings        = $this->get_settings_for_display();
		$elementor_vp_lg = get_option('elementor_viewport_lg');
		$elementor_vp_md = get_option('elementor_viewport_md');
		$viewport_lg     = !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
		$viewport_md     = !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;
		$this->add_render_attribute('grove-timeline', 'id', $id);
		$this->add_render_attribute('grove-timeline', 'class', ['upk-grove-timeline', 'upk-arrows-align-center', 'upk-navigation-type-arrows']);
		$this->add_render_attribute(
			[
				'grove-timeline' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"              => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
							"loop"                  => ($settings["loop"] == "yes") ? true : false,
							"speed"                 => $settings["speed"]["size"],
							"pauseOnHover"          => ("yes" == $settings["pauseonhover"]) ? true : false,
							"slidesPerView"         => (int) $settings["columns_mobile"],
							"slidesPerGroup"        => (int) $settings["slides_to_scroll_mobile"],
							"spaceBetween"          => (int) $settings["item_gap_mobile"]["size"],
							"centeredSlides"        => ($settings["centered_slides"] === "yes") ? true : false,
							"grabCursor"            => ($settings["grab_cursor"] === "yes") ? true : false,
							// "effect"                => $settings["skin"],
							"observer"              => ($settings["observer"]) ? true : false,
							"observeParents"        => ($settings["observer"]) ? true : false,
							// "direction"             => $settings['direction'],
							"watchSlidesVisibility" => true,
							"watchSlidesProgress"   => true,
							"navigation"     => [
								"nextEl" => "#" . $id . " .upk-navigation-next",
								"prevEl" => "#" . $id . " .upk-navigation-prev",
							],
							"lazy"           => [
								"loadPrevNext" => "true",
							],
							"breakpoints"               => [
								(int) $viewport_md         => [
									"slidesPerView"  => (int) $settings["columns_tablet"],
									"spaceBetween"     => (int) $settings["item_gap_tablet"]["size"],
									"slidesPerGroup" => (int) $settings["slides_to_scroll_tablet"]
								],
								(int) $viewport_lg         => [
									"slidesPerView"  => (int) $settings["columns"],
									"spaceBetween"   => (int) $settings["item_gap"]["size"],
									"slidesPerGroup" => (int) $settings["slides_to_scroll"]
								]
							],
						])),
					],
				],
			]
		);
	?>
		<div <?php $this->print_render_attribute_string('grove-timeline'); ?>>
			<div class="upk-grove-timeline-wrapper">
				<div class="swiper-container upk-grove-timeline-wrap upk-grove-timeline-<?php esc_html_e($settings['skin_layout'], 'ultimate-post-kit'); ?>">
					<div class="swiper-wrapper">
					<?php
				}

				public function render_post_grid_item($post_id, $image_size, $excerpt_length, $slides_index) {
					$settings = $this->get_settings_for_display();

					if ('yes' == $settings['global_link']) {

						$this->add_render_attribute('timeline-item', 'onclick', "window.open('" . esc_url(get_permalink()) . "', '_self')", true);
					}
					$this->add_render_attribute('timeline-item', 'class', 'upk-grove-timeline-item swiper-slide', true);

					?>
						<div <?php $this->print_render_attribute_string('timeline-item'); ?>>
							<div class="upk-grove-timeline-counter">
								<?php esc_html_e($slides_index, 'ultimate-post-kit'); ?>
							</div>
							<div class="upk-grove-timeline-inner-item">
								<div class="upk-grove-timeline-image-wrap">
									<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
								</div>
								<div class="upk-grove-timeline-content-wrap">
									<div class="upk-grove-timeline-inner-content">
										<?php $this->render_title(); ?>
										<?php $this->render_excerpt($excerpt_length); ?>
										<div class="upk-timeline-meta">
											<?php
											if ($settings['show_author'] == 'yes') :
												$this->render_author();
											endif;
											?>
											<span class="upk-separator"><?php echo esc_html($settings['meta_separator']); ?></span>
											<?php $this->render_date(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
				}

				public function render_footer() {
					$settings = $this->get_settings_for_display(); ?>
					</div>
				</div>
				<?php
					$settings             = $this->get_settings_for_display();
				?>
				<div class="upk-position-z-index upk-position-center">
					<div class="upk-arrows-container upk-slidenav-container">
						<a href="" class="upk-navigation-prev upk-slidenav-previous upk-icon upk-slidenav">
							<i class="upk-icon-arrow-left-<?php echo esc_html($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
						<a href="" class="upk-navigation-next upk-slidenav-next upk-icon upk-slidenav">
							<i class="upk-icon-arrow-right-<?php echo esc_html($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
	<?php
				}
				public function render() {
					$settings = $this->get_settings_for_display();

					$this->query_posts($settings['item_limit']['size']);
					$wp_query = $this->get_query();
					$slides_index = 1;
					if (!$wp_query->found_posts) {
						return;
					}

					$this->get_posts_tags();

					$this->render_header();

					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						$thumbnail_size = $settings['primary_thumbnail_size'];

						$this->render_post_grid_item(get_the_ID(), $thumbnail_size, $settings['excerpt_length'], $slides_index);
						$slides_index++;
					}

					wp_reset_postdata();

					$this->render_footer();
				}
			}
