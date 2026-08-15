<?php

namespace UltimatePostKit\Modules\SlineSlider\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use UltimatePostKit\Utils;

use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Traits\Global_Widget_Functions;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;
use UltimatePostKit\Modules\QueryControl\Controls\Group_Control_Posts;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Sline_Slider extends Group_Control_Query {
	use Global_Widget_Controls;
	use Global_Widget_Functions;

	private $_query = null;

	public function get_name() {
		return 'upk-sline-slider';
	}

	public function get_title() {
		return esc_html__('Sline Slider', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-sline-slider upk-new';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['sline', 'slider', 'post', 'blog', 'recent', 'news', 'soft', 'video', 'gallery', 'youtube'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['elementor-icons-fa-solid', 'upk-all-styles'];
		} else {
			return ['elementor-icons-fa-solid', 'upk-sline-slider'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-sline-slider'];
		}
	}

	// public function get_custom_help_url()
	// {
	// 	return 'https://youtu.be/3ABRMLE_6-I';
	// }

	public function get_query() {
		return $this->_query;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__('Layout', 'ultimate-post-kit'),
			]
		);

		//Global Title Controls
		$this->register_title_controls();

		$this->add_control(
			'show_category',
			[
				'label'   => esc_html__('Category', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_author',
			[
				'label'   => esc_html__('Author', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
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

		//Global Date Controls
		$this->register_date_controls();

		$this->add_control(
			'show_thumbs_category',
			[
				'label'   => esc_html__('Thumbs Category', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_thumbs_title',
			[
				'label'   => esc_html__('Thumbs Title', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'thumbs_title_tags',
			[
				'label'     => __('Thumbs Title HTML Tag', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => ultimate_post_kit_title_tags(),
				'condition' => [
					'show_thumbs_title' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'primary_thumbnail',
				'exclude'   => ['custom'],
				'default'   => 'full',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();
		//New Query Builder Settings
		$this->start_controls_section(
			'section_post_query_builder',
			[
				'label' => __('Query', 'ultimate-post-kit') . BDTUPK_NC,
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'item_limit',
			[
				'label'     => esc_html__('Item Limit', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 20,
						'step' => 5
					],
				],
				'default'   => [
					'size' => 5,
				],
			]
		);

		$this->register_query_builder_controls();

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

		// $this->add_control(
		// 	'pauseonhover',
		// 	[
		// 		'label' => esc_html__('Pause on Hover', 'ultimate-post-kit'),
		// 		'type'  => Controls_Manager::SWITCHER,
		// 	]
		// );

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
			'style_sliders_controls',
			[
				'label' => esc_html__('Sliders', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_type',
			[
				'label'   => esc_html__('Overlay', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'background',
				'options' => [
					'none'       => esc_html__('None', 'bdthemes-prime-slider'),
					'background' => esc_html__('Background', 'bdthemes-prime-slider'),
					'blend'      => esc_html__('Blend', 'bdthemes-prime-slider'),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_color',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .upk-sline-slider .upk-img-wrap::before',
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
				'label'     => esc_html__('Blend Type', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'multiply',
				'options'   => ultimate_post_kit_blend_options(),
				'condition' => [
					'overlay_type' => 'blend',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-img-wrap::before' => 'mix-blend-mode: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => __('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs('tabs_slider_style');

		$this->start_controls_tab(
			'tab_sliders_play_button',
			[
				'label' => __('Play Button', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'play_button_color',
			[
				'label'     => __('Icon Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-play-btn a' => 'color: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'play_button_bg',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-play-btn a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'play_button_border',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-play-btn a',
			]
		);

		$this->add_responsive_control(
			'play_button_border_radius',
			[
				'label'		 => __('Border Radius', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-play-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'play_button_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-play-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'play_button_icon_size',
			[
				'label'     => __('Icon Size', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-play-btn a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sliders_title',
			[
				'label' => __('Title', 'ultimate-post-kit'),
				'condition' => [
					'show_title' => 'yes'
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-title a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title' => 'yes'
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-title',
				'condition' => [
					'show_title' => 'yes'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sliders_category',
			[
				'label' => __('Category', 'ultimate-post-kit'),
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_control(
			'sliders_category_normal',
			[
				'label'     => __('N O R M A L', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
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
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_background',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'category_border',
				'selector'    => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_category' => 'yes'
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
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'category_spacing',
			[
				'label' => esc_html__('Spacing Between', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_control(
			'category_hover',
			[
				'label'     => __('H O V E R', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_control(
			'category_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a:hover' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_hover_background',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a:hover',
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->add_control(
			'category_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'category_border_border!' => '',
					'show_category' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sliders_meta',
			[
				'label' => __('Meta', 'ultimate-post-kit'),
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
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-meta, {{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-author a' => 'color: {{VALUE}};',
				],
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
			'meta_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-author a:hover, {{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-author:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_author' => 'yes'
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
					'{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-sline-slider .upk-main-slider .upk-meta',
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

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// start thumbnail style
		$this->start_controls_section(
			'style_playlist',
			[
				'label' => esc_html__('Thumbs', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_thumbs_style');

		$this->start_controls_tab(
			'tab_thumbs_item',
			[
				'label' => __('Item', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'thumbs_line_color',
			[
				'label'     => __('Line Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-img-wrap:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumbs_line_height',
			[
				'label'   => esc_html__('Line Height', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-img-wrap:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'playlist_thumb_width_border',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-img-wrap',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'playlist_thumb_width_border_radius',
			[
				'label'		 => __('Border Radius', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-img-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
				],
			]
		);

		$this->add_responsive_control(
			'playlist_thumb_padding',
			[
				'label'		 => __('Padding', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-content, {{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'playlist_thumb_margin',
			[
				'label'		 => __('Margin', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-content, {{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_thumbs_play_button',
			[
				'label' => __('Play Button', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'play_button_normal',
			[
				'label'     => esc_html__('N O R M A L', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'play_button_thumbs_color',
			[
				'label'     => __('Icon Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'play_button_thumbs_bg',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'play_button_thumbs_border',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn a',
			]
		);

		$this->add_responsive_control(
			'play_button_thumbs_border_radius',
			[
				'label'		 => __('Border Radius', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'playlist_play_icon_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'playlist_play_icon_size',
			[
				'label'   => esc_html__('Play Icon Size', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 8,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-play-btn a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'play_button_hover',
			[
				'label'     => esc_html__('H O V E R', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'play_button_thumbs_color_hover',
			[
				'label'     => __('Icon Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-thumbs-slider .upk-play-btn:hover a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'play_button_thumbs_bg_hover',
				'selector'  => '{{WRAPPER}} .upk-thumbs-slider .upk-play-btn:hover a',
			]
		);

		$this->add_control(
			'play_button_thumbs_border_color_hover',
			[
				'label'     => __('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-thumbs-slider .upk-play-btn:hover a' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'play_button_thumbs_border_border!' => ''
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_thumbs_title',
			[
				'label' => __('Title', 'ultimate-post-kit'),
				'condition' => [
					'show_thumbs_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'playlist_title_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-title a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_thumbs_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'playlist_title_color_hover',
			[
				'label'     => __('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-thumbs-slider .upk-content:hover .upk-title a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_thumbs_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'playlist_title_color_active',
			[
				'label'     => __('Active Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .swiper-slide-active .upk-title a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_thumbs_title' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'playlist_title_typo',
				'selector' => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-title',
				'condition' => [
					'show_thumbs_title' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_thumbs_category',
			[
				'label' => __('Category', 'ultimate-post-kit'),
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_control(
			'category_normal',
			[
				'label'     => esc_html__('N O R M A L', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_control(
			'playlist_category_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'playlist_category_background',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'playlist_category_border',
				'selector'    => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'playlist_category_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'playlist_category_padding',
			[
				'label'      => esc_html__('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'playlist_category_spacing',
			[
				'label' => esc_html__('Spacing Between', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'playlist_category_shadow',
				'selector' => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'playlist_category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_control(
			'thumbs_category_hover',
			[
				'label'     => esc_html__('H O V E R', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_control(
			'playlist_category_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a:hover' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'playlist_category_hover_background',
				'selector'  => '{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a:hover',
				'condition' => [
					'show_thumbs_category' => 'yes'
				]
			]
		);

		$this->add_control(
			'playlist_category_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'show_thumbs_category' => 'yes',
					'playlist_category_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-sline-slider .upk-thumbs-slider .upk-category a:hover' => 'border-color: {{VALUE}};',
				],
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

	public function render_image($image_id, $size) {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		$image_src = wp_get_attachment_image_src($image_id, $size);

		if (!$image_src) {
			$image_src = $placeholder_image_src;
		} else {
			$image_src = $image_src[0];
		}

?>

		<img class="upk-img" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_html(get_the_title()); ?>">

	<?php
	}

	public function render_playlist_title() {
		$settings = $this->get_settings_for_display();

		if (!$this->get_settings('show_thumbs_title')) {
			return;
		}

		printf('<%1$s class="upk-title"><a href="%2$s" title="%3$s">%3$s</a></%1$s>', Utils::get_valid_html_tag($settings['title_tags']), 'javascript:void(0);', get_the_title());
	}

	public function render_thumbs_category() {
		if (!$this->get_settings('show_thumbs_category')) {
			return;
		}
	?>
		<div class="upk-category">
			<?php echo upk_get_category($this->get_settings('posts_source')); ?>
		</div>
	<?php
	}

	public function render_title() {
		$settings = $this->get_settings_for_display();

		if (!$this->get_settings('show_title')) {
			return;
		}

		printf('<%1$s class="upk-title"><a href="%2$s" title="%3$s">%3$s</a></%1$s>', Utils::get_valid_html_tag($settings['title_tags']), get_permalink(), get_the_title());
	}


	public function render_date() {
		$settings = $this->get_settings_for_display();


		if (!$this->get_settings('show_date')) {
			return;
		}

	?>
		<div class="upk-flex upk-flex-middle">
			<div class="upk-date">
				<i class="eicon-calendar upk-author-icon" aria-hidden="true"></i>
				<span>
					<?php if ($settings['human_diff_time'] == 'yes') {
						echo ultimate_post_kit_post_time_diff(($settings['human_diff_time_short'] == 'yes') ? 'short' : '');
					} else {
						echo get_the_date();
					} ?>
				</span>
			</div>
			<?php if ($settings['show_time']) : ?>
				<div class="upk-post-time">
					<i class="upk-icon-clock" aria-hidden="true"></i>
					<?php echo get_the_time(); ?>
				</div>
			<?php endif; ?>
		</div>

	<?php
	}

	public function render_author() {

		if (!$this->get_settings('show_author')) {
			return;
		}
	?>
		<div class="upk-author">
			<i class="eicon-user-circle-o upk-author-icon" aria-hidden="true"></i>
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php echo get_the_author() ?></a>
		</div>

	<?php
	}

	public function render_excerpt($excerpt_length) {

		if (!$this->get_settings('show_excerpt')) {
			return;
		}
		$strip_shortcode = $this->get_settings_for_display('strip_shortcode');
	?>
		<div class="upk-text">
			<?php
			if (has_excerpt()) {
				the_excerpt();
			} else {
				echo ultimate_post_kit_custom_excerpt($excerpt_length, $strip_shortcode);
			}
			?>
		</div>

	<?php
	}

	public function video_link_render($video) {
		$youtube_id = (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video, $match)) ? $match[1] : false;

		$vimeo_id = (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video, $match)) ? $match[3] : false;

		if ($youtube_id) {
			// $video_source    = 'https://www.youtube.com/watch?v=' . $youtube_id;
			$video_source    = 'https://www.youtube.com/embed/' . $youtube_id;
		} elseif ($vimeo_id) {
			$video_source    = 'https://vimeo.com/' . $vimeo_id;
		} else {
			$video_source = false;
		}
		return $video_source;
	}

	public function render_playlist_item($post_id, $image_size, $video_link) {
		$video_link = $this->video_link_render($video_link);
	?>
		<div class="upk-item swiper-slide">
			<div class="upk-img-wrap">
				<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
			</div>
			<div class="upk-play-btn">
				<a href="javascript:void(0);">
					<i class="fas fa-play"></i>
				</a>
			</div>
			<div class="upk-content">
				<?php $this->render_thumbs_category(); ?>
				<?php $this->render_playlist_title(); ?>
			</div>
		</div>
	<?php
	}

	public function render_item($post_id, $image_size, $video_link) {
		$settings = $this->get_settings_for_display();
		$video_link = $this->video_link_render($video_link);
	?>
		<div class="upk-item swiper-slide">
			<div class="upk-img-wrap">
				<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
				<div class="upk-play-button-wrapper upk-video-trigger" data-src="<?php echo esc_url($video_link); ?>">
					<input type="checkbox">
					<div class="upk-video-wrap upk-play-btn-video">
						<iframe class="upk-video-iframe" allow="autoplay;" src="<?php echo esc_url($video_link); ?>"></iframe>
					</div>
					<div class="upk-play-btn">
						<a href="javascript:void(0);" class="upk-play-icon-wrap">
							<i class="fas fa-play"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="upk-content">
				<?php $this->render_category(); ?>
				<?php $this->render_title();  ?>
				<div class="upk-meta">
					<?php $this->render_author(); ?>
					<?php if (!empty($settings['meta_separator'])) : ?>
						<div class="upk-separator"><?php echo esc_html($settings['meta_separator']); ?></div>
					<?php endif; ?>
					<?php $this->render_date();  ?>
				</div>
			</div>
		</div>
	<?php
	}


	public function render_header() {
		$settings = $this->get_settings_for_display();

		$id              = 'upk-sline-slider-' . $this->get_id();
		$settings        = $this->get_settings_for_display();

		$this->add_render_attribute('sline-slide', 'id', $id);
		$this->add_render_attribute('sline-slide', 'class', [
			'upk-sline-slider',
		]);

		$this->add_render_attribute(
			[
				'sline-slide' => [
					'data-widget' => [
						wp_json_encode(array_filter([
							"id" => '#' . $id
						]))
					],
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"       => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
							"loop"           => ($settings["loop"] == "yes") ? true : false,
							"speed"          => $settings["speed"]["size"],
							"effect"         => 'slide',
							"fadeEffect"     => ['crossFade' => true],
							// "lazy"           => true,
							"parallax"       => true,
							"grabCursor"     => ($settings["grab_cursor"] === "yes") ? true : false,
							"pauseOnHover"   =>  true,
							"slidesPerView"  => 1,
							"observer"       => ($settings["observer"]) ? true : false,
							"observeParents" => ($settings["observer"]) ? true : false,
							"loopedSlides" => 4,
							"lazy" => [
								"loadPrevNext"  => "true",
							],
						]))
					]
				]
			]
		);

	?>
		<div <?php $this->print_render_attribute_string('sline-slide'); ?>>
		<?php
	}
	public function render_footer() {
		?>
		</div>
		<?php
	}
	public function render() {
		$available_video_link = ultimate_post_kit_option('video_link', 'ultimate_post_kit_other_settings', 'off');
		if ($available_video_link == 'on') {
			$settings = $this->get_settings_for_display();

			$this->query_posts($settings['item_limit']['size']);
			$wp_query = $this->get_query();

			if (!$wp_query->found_posts) {
				return;
			}

			$this->render_header();
		?>
			<div class="upk-main-slider swiper-container">
				<div class="swiper-wrapper">
					<?php
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						$video_link = get_post_meta(get_the_ID(), '_upk_video_link_meta_key', true);
						if ($video_link) {
							$thumbnail_size = $settings['primary_thumbnail_size'];
							$this->render_item(get_the_ID(), $thumbnail_size, $video_link);
						}
					}
					?>
				</div>
			</div>

			<div thumbsSlider="" class="upk-thumbs-slider swiper-container">
				<div class="swiper-wrapper">
					<?php
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						$video_link = get_post_meta(get_the_ID(), '_upk_video_link_meta_key', true);
						if ($video_link) {
							$thumbnail_size = $settings['primary_thumbnail_size'];
							$this->render_playlist_item(get_the_ID(), $thumbnail_size, $video_link);
						}
					}

					?>
				</div>
			</div>

<?php
			$this->render_footer();
			wp_reset_postdata();
		} else {
			echo 'Please enable the video link metabox first from core settings';
		}
	}
}
