<?php

namespace UltimatePostKit\Modules\FoxicoSlider\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

use UltimatePostKit\Utils;
use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Traits\Global_Widget_Functions;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Foxico_Slider extends Group_Control_Query {

	use Global_Widget_Controls;
	use Global_Widget_Functions;

	private $_query = null;

	public function get_name() {
		return 'upk-foxico-slider';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Foxico Slider', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-foxico-slider bdt-new';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'carousel', 'blog', 'recent', 'news', 'slider', 'foxico'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-foxico-slider'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-foxico-slider'];
		}
	}

	// public function get_custom_help_url() {
	// 	return 'https://youtu.be/2ZYnLz__uA4';
	// }


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
			'item_height',
			[
				'label' => esc_html__('Height', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vh'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1080,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-main-slide .swiper-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumbs_width',
			[
				'label' => esc_html__('Thumbs Width', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'default' => [
					'size' => 40,
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}}' => '--upk-thumbs-width: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);

		$this->add_responsive_control(
			'content_alignment',
			[
				'label'   => __('Alignment', 'ultimate-post-kit'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'   => [
						'title' => __('Left', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __('Right', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-main-slide .upk-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'primary_thumbnail',
				'exclude'   => ['custom'],
				'default'   => 'full',
			]
		);

		$this->add_control(
			'hr_1',
			[
				'type'    => Controls_Manager::DIVIDER,
			]
		);

		//Global Title Controls
		$this->register_title_controls();

		$this->add_control(
			'show_category',
			[
				'label'   => esc_html__('Show Category', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

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
				'label'     => esc_html__('Show Author', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before'
			]
		);

		//Global Date Controls
		$this->register_date_controls();

		$this->add_control(
			'show_readmore',
			[
				'label' => esc_html__('Read more', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label'       => __('Readmore Text', 'ultimate-post-kit'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Explore', 'ultimate-post-kit'),
				'label_block' => false,
				'condition' => [
					'show_readmore' => 'yes'
				]
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
				'label' => esc_html__('Item Limit', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'default' => [
					'size' => 7,
				],
			]
		);

		$this->register_query_builder_controls();

		$this->end_controls_section();

		// Navigation
		$this->start_controls_section(
			'section_navigation',
			[
				'label' => __('Navigation', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label' => esc_html__('Arrows', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'     => esc_html__('Arrows Icon', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => '0',
				'options'   => [
					'0'        => esc_html__('Default', 'bdthemes-element-pack'),
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
				],
				'condition' => [
					'show_arrows' => 'yes'
				],
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__('Pagination', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_fraction',
			[
				'label' => esc_html__('Fractions', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => __('Slider Settings', 'ultimate-post-kit'),
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
			'section_style_main_slider',
			[
				'label'     => esc_html__('Slider', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'main_slider_tabs'
		);
		// main slider item
		$this->start_controls_tab(
			'main_slider_item_tab',
			[
				'label' => esc_html__('Item', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'overlay_type',
			[
				'label'   => esc_html__('Overlay', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'background',
				'options' => [
					'none'       => esc_html__('None', 'ultimate-post-kit'),
					'background' => esc_html__('Background', 'ultimate-post-kit'),
					'blend'      => esc_html__('Blend', 'ultimate-post-kit'),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_color',
				'label' => esc_html__('Background', 'ultimate-post-kit'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-main-slide .upk-image-wrap::before',
				'fields_options' => [
					'background' => [
						'default' => 'gradient',
					],
					'color' => [
						'default' => 'rgba(3, 4, 16, 0)',
					],
					'color_b' => [
						'default' => 'rgba(3, 4, 16, 0.7)',
					],
				],
				'condition' => [
					'overlay_type' => ['background', 'blend'],
				],
			]
		);

		$this->add_control(
			'blend_type',
			[
				'label'     => esc_html__('Blend Type', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'multiply',
				'options'   => ultimate_post_kit_blend_options(),
				'condition' => [
					'overlay_type' => 'blend',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-main-slide .upk-image-wrap::before' => 'mix-blend-mode: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'main_slider_border',
				'selector'    => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-image-wrap',
			]
		);

		$this->add_responsive_control(
			'main_slider_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'main_slider_content_heading',
			[
				'label' => esc_html__('C O N T E N T', 'ultimate-post-kit'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'main_slider_content_padding',
			[
				'label' 	 => __('Padding', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-main-slide .upk-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		// main slider title
		$this->start_controls_tab(
			'main_slider_title_tab',
			[
				'label' => esc_html__('Title', 'ultimate-post-kit'),
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' 	 => __('Margin', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'label' => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-title a',
			]
		);

		$this->end_controls_tab();

		// main slider text

		$this->start_controls_tab(
			'main_slider_text_tab',
			[
				'label' => esc_html__('Text', 'ultimate-post-kit'),
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
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-text' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'text_margin',
			[
				'label' 	 => __('Margin', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_spacing',
			[
				'label'      => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'text_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-text',
			]
		);

		$this->end_controls_tab();

		// main slider button

		$this->start_controls_tab(
			'main_slider_button_tab',
			[
				'label' => esc_html__('Button', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'link_button_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'link_button_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'link_button_border',
				'selector'    => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a',
			]
		);

		$this->add_responsive_control(
			'link_button_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'link_button_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'link_button_margin',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'link_button_shadow',
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'link_button_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a',
			]
		);

		$this->add_control(
			'link_button_heading',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_button_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'link_button_hover_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a::before',
			]
		);

		$this->add_control(
			'link_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'category_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-link-btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_thumbs',
			[
				'label'      => esc_html__('Thumbs', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'thumbs_slider_tabs'
		);

		$this->start_controls_tab(
			'thumbs_slider_item_tab',
			[
				'label' => esc_html__('Item', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'thumbs_overlay_type',
			[
				'label'   => esc_html__('Overlay', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'background',
				'options' => [
					'none'       => esc_html__('None', 'ultimate-post-kit'),
					'background' => esc_html__('Background', 'ultimate-post-kit'),
					'blend'      => esc_html__('Blend', 'ultimate-post-kit'),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'thumbs_overlay_color',
				'label' => esc_html__('Background', 'ultimate-post-kit'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumbs-slide .upk-image-wrap::before',
				'fields_options' => [
					'background' => [
						'default' => 'gradient',
					],
					'color' => [
						'default' => 'rgba(3, 4, 16, 0)',
					],
					'color_b' => [
						'default' => 'rgba(3, 4, 16, 0.7)',
					],
				],
				'condition' => [
					'overlay_type' => ['background', 'blend'],
				],
			]
		);

		$this->add_control(
			'thumbs_blend_type',
			[
				'label'     => esc_html__('Blend Type', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'multiply',
				'options'   => ultimate_post_kit_blend_options(),
				'condition' => [
					'overlay_type' => 'blend',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumbs-slide .upk-image-wrap::before' => 'mix-blend-mode: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'thumbs_slider_border',
				'selector'    => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumbs-slide .upk-content-image-wrap',
			]
		);

		$this->add_responsive_control(
			'thumbs_slider_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumbs-slide .upk-content-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumbs_slider_content_padding',
			[
				'label' 	 => __('Content Padding', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumbs-slide .upk-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_tab();

		// thumbs slider meta
		$this->start_controls_tab(
			'thumbs_slider_meta_tab',
			[
				'label' => esc_html__('Meta', 'ultimate-post-kit'),
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
						],
					]
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-meta,
					 {{WRAPPER}} .upk-foxico-slider-wrap .upk-author-wrap a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-author-wrap a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_bottom_spacing',
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
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-date' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-meta',
			]
		);

		$this->end_controls_tab();

		// category

		$this->start_controls_tab(
			'thumbs_slider_category_tab',
			[
				'label' => esc_html__('Category', 'ultimate-post-kit'),
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'category_border',
				'selector'    => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a',
			]
		);

		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_spacing',
			[
				'label'   => esc_html__('Space Between', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a',
			]
		);

		$this->add_control(
			'thumbs_slider_category_hover_heading',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'category_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_hover_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a:hover',
			]
		);

		$this->add_control(
			'category_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'category_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation_and_pagination',
			[
				'label'      => esc_html__('Navigation / Pagination', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'navigation_pagination_tabs'
		);

		$this->start_controls_tab(
			'navigation_tab',
			[
				'label' => esc_html__('Nav', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'navigation_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'navigation_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'navigation_border',
				'selector'    => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button',
			]
		);

		$this->add_responsive_control(
			'navigation_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_margin',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .bdt-nav-and-pg-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_icon_size',
			[
				'label'   => esc_html__('Icon Size', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_spacing',
			[
				'label'   => esc_html__('Space Between', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-wrap' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'navigation_shadow',
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button',
			]
		);

		$this->add_control(
			'navigation_hover_heading',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'navigation_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'navigation_hover_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button:hover',
			]
		);

		$this->add_control(
			'navigation_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'category_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-navigation-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_tab',
			[
				'label' => esc_html__('line Pg', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'pagination_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'pagination_border',
				'selector'    => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet',
			]
		);

		$this->add_responsive_control(
			'pagination_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_margin',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_spacing',
			[
				'label'   => esc_html__('Space Between', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'pagination_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'pagination_shadow',
				'selector' => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet',
			]
		);

		$this->add_control(
			'pagination_hover_heading',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pagination_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'pagination_hover_background',
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet:hover',
			]
		);

		$this->add_control(
			'pagination_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'category_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_line_heading',
			[
				'label' => esc_html__('Line', 'ultimate-post-kit'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pagination_line_color',
			[
				'label'     => esc_html__('Line Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_line_width',
			[
				'label'   => esc_html__('Space Between', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-pagination-line' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'number_pagination_tab',
			[
				'label' => esc_html__('Number Pag', 'plugin-name'),
			]
		);

		$this->add_control(
			'number_pagination_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-number-pagination' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'number_pagination_active_color',
			[
				'label'     => esc_html__('Active Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-number-pagination .swiper-pagination-current' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'number_pagination_margin',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-number-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'number_pagination_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-number-pagination',
			]
		);


		$this->add_control(
			'static_number_pag_heading',
			[
				'label' => esc_html__('Thumb Number', 'ultimate-post-kit'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'static_pagination_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumb-pagination' => 'color: {{VALUE}};',
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumb-pagination::before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'static_pagination_active_color',
			[
				'label'     => esc_html__('Active Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumb-pagination .upk-current-count' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'static_number_pagination_spacing',
			[
				'label'   => esc_html__('Space Between', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumb-pagination' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'number_static_pagination_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-foxico-slider-wrap .upk-thumb-pagination',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
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

	function render_title() {
		$settings = $this->get_settings_for_display();
		if (!$this->get_settings('show_title')) {
			return;
		}

		printf('<%1$s class="upk-title"><a href="%2$s" title="%3$s">%3$s</a></%1$s>', Utils::get_valid_html_tag($settings['title_tags']), get_permalink(), get_the_title());
	}

	public function render_author() {

		if (!$this->get_settings('show_author')) {
			return;
		}
?>
		<div class="upk-author-wrap">
			<span class="upk-by"><?php echo esc_html_x('by', 'Frontend', 'ultimate-post-kit') ?></span>
			<a class="upk-name" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
				<?php echo get_the_author() ?>
			</a>
		</div>
	<?php
	}

	public function render_comments($id = 0) {

		if (!$this->get_settings('show_comments')) {
			return;
		}
	?>

		<div class="upk-comments">
			<?php echo get_comments_number($id) ?>
			<i class="upk-icon-bubble"></i>
		</div>

	<?php
	}

	public function render_header() {
		$id              = 'upk-main-slide-' . $this->get_id();
		$settings        = $this->get_settings_for_display();

		$this->add_render_attribute('foxico-slider', 'id', $id);
		$this->add_render_attribute('foxico-slider', 'class', ['upk-main-slide']);

		$this->add_render_attribute(
			[
				'foxico-slider' => [
					'data-slider-settings' => [
						wp_json_encode(array_filter([
							"id" => '#' . $id,
							"showPagination" 		=> true, // $settings['show_pagination'] == 'yes' ? true : false,
							"showFraction" 		=>  $settings['show_fraction'] == 'yes' ? true : false,
						]))
					],
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"       => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
							"loop"           => ($settings["loop"] == "yes") ? true : false,
							"speed"          => $settings["speed"]["size"],
							"effect"         => 'fade',
							"fadeEffect"     => ['crossFade' => true],
							"lazy"           => true,
							"parallax"       => true,
							"grabCursor"     => ($settings["grab_cursor"] === "yes") ? true : false,
							"pauseOnHover"   => ("yes" == $settings["pauseonhover"]) ? true : false,
							"slidesPerView"  => 1,
							"observer"       => ($settings["observer"]) ? true : false,
							"observeParents" => ($settings["observer"]) ? true : false,
							"loopedSlides" => 4,
							// "navigation" => [
							// 	"nextEl" => "#" . $id . " .upk-button-next",
							// 	"prevEl" => "#" . $id . " .upk-button-prev",
							// ],
							"pagination" => [
								"el"             => "#" . $id . " .upk-pagination-line",
								"clickable"      => "true",
							],

							"lazy" => [
								"loadPrevNext"  => "true",
							],

						]))
					]
				]
			]
		);

	?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
		<div <?php $this->print_render_attribute_string('foxico-slider'); ?>>
			<div class="swiper-container">
				<div class="swiper-wrapper">
				<?php
			}

			public function render_footer() {
				$settings = $this->get_settings_for_display();

				?>

					<?php if ($settings['show_pagination']) : ?>
						<div class="upk-pagination-line"></div>
					<?php endif; ?>

				</div>
			</div>
		</div>

	<?php
			}

			public function render_post_grid_item($post_id, $image_size, $excerpt_length) {
				$settings = $this->get_settings_for_display();

				$this->add_render_attribute('slider-item', 'class', 'upk-item swiper-slide', true);

	?>
		<div <?php $this->print_render_attribute_string('slider-item'); ?>>
			<div class="upk-image-wrap">
				<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
			</div>

			<div class="upk-content">

				<?php if ($settings['show_title']) : ?>
					<div data-swiper-parallax-y="-100">
						<?php $this->render_title(); ?>
					</div>
				<?php endif; ?>

				<?php if ($settings['show_excerpt']) : ?>
					<div class="upk-inline-block" data-swiper-parallax-y="-100">
						<?php $this->render_excerpt($excerpt_length); ?>
					</div>
				<?php endif; ?>

				<?php if ($settings['show_readmore'] === 'yes' and !empty($settings['readmore_text'])) : ?>
					<div class="upk-link-btn" data-swiper-parallax-y="-100" data-swiper-parallax-duration="600">
						<a href="<?php echo esc_url(get_permalink()); ?>">
							<span><?php echo esc_html($settings['readmore_text']); ?></span>
						</a>
					</div>
				<?php endif; ?>

			</div>
		</div>

	<?php
			}

			public function render_thumbnav($post_id, $image_size) {
				$settings        = $this->get_settings_for_display();

				$this->add_render_attribute('thumb-item', 'class', 'upk-item swiper-slide', true);

	?>
		<div <?php $this->print_render_attribute_string('thumb-item'); ?>>
			<div class="upk-content-image-wrap">
				<div class="upk-image-wrap">
					<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
				</div>
				<div class="upk-content">
					<?php if ($settings['show_category']) : ?>
						<div data-swiper-parallax-y="-50" data-swiper-parallax-duration="1000">
							<?php $this->render_category(); ?>
						</div>
					<?php endif; ?>

					<?php if ($settings['show_author'] or $settings['show_date']) : ?>
						<div class="upk-meta">
							<?php if ($settings['show_author']) : ?>
								<div data-swiper-parallax-y="-100" data-swiper-parallax-duration="1200">
									<?php $this->render_author(); ?>
								</div>
							<?php endif; ?>
							<div data-swiper-parallax-y="-100" data-swiper-parallax-duration="1400">
								<?php $this->render_date(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

	<?php

			}

			public function render() {
				$settings = $this->get_settings_for_display();

				$this->query_posts($settings['item_limit']['size']);
				$wp_query = $this->get_query();

				if (!$wp_query->found_posts) {
					return;
				}

	?>
		<div class="upk-foxico-slider-wrap">
			<?php

				$this->render_header();

				while ($wp_query->have_posts()) {
					$wp_query->the_post();
					$thumbnail_size = $settings['primary_thumbnail_size'];

					$this->render_post_grid_item(get_the_ID(), $thumbnail_size, $settings['excerpt_length']);
				}

				$this->render_footer();

			?>
			<div thumbsSlider="" class="upk-thumbs-slide">
				<div class="swiper-wrapper">
					<?php

					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						$thumbnail_size = $settings['primary_thumbnail_size'];

						$this->render_thumbnav(get_the_ID(), $thumbnail_size);
					}

					?>
				</div>
				<div class="bdt-nav-and-pg-wrap">

					<?php if ($settings['show_arrows']) : ?>
						<div class="upk-navigation-wrap">
							<div class="upk-button-next upk-navigation-button">
								<i class="upk-icon-arrow-right-<?php echo esc_html($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
							</div>
							<div class="upk-button-prev upk-navigation-button">
								<i class="upk-icon-arrow-left-<?php echo esc_html($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
							</div>
						</div>
					<?php endif; ?>

					<?php if ($settings['show_fraction']) : ?>
						<div class="upk-thumb-pagination">
							<span class="upk-current-count" style="transition: transform 0.5s cubic-bezier(0.16, 0.77, 0.58, 1) 0s, opacity 0.3s ease 0s">01</span>
							<span class="upk-total-count"></span>
						</div>
					<?php endif; ?>
				</div>


			</div>
			<?php if ($settings['show_fraction']) : ?>
				<div class="upk-number-pagination"></div>
			<?php endif; ?>
		</div>

<?php
				wp_reset_postdata();
			}
		}
