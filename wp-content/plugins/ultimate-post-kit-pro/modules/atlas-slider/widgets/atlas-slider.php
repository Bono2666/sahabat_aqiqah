<?php

namespace UltimatePostKit\Modules\AtlasSlider\Widgets;

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

class Atlas_Slider extends Group_Control_Query {
	use Global_Widget_Controls;
	use Global_Widget_Functions;

	private $_query = null;

	public function get_name() {
		return 'upk-atlas-slider';
	}

	public function get_title() {
		return esc_html__('Atlas Slider', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-atlas-slider';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['atlas', 'slider', 'post', 'blog', 'recent', 'news', 'soft', 'video', 'gallery', 'youtube'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['elementor-icons-fa-solid', 'upk-all-styles'];
		} else {
			return ['elementor-icons-fa-solid', 'upk-atlas-slider'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-atlas-slider'];
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'primary_thumbnail',
				'exclude'   => ['custom'],
				'default'   => 'full',
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
			'section_content_additional',
			[
				'label' => esc_html__('Additional', 'ultimate-post-kit'),
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
			]
		);

		$this->add_control(
			'show_author',
			[
				'label'   => esc_html__('Author', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label'   => esc_html__('Meta', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_comments',
			[
				'label'   => esc_html__('Comments', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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


		$this->add_control(
			'show_scrollbar',
			[
				'label'   => esc_html__('Scrollbar', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		//Global Date Controls
		$this->register_date_controls();

		// $this->add_control(
		// 	'global_link',
		// 	[
		// 		'label'        => __('Item Wrapper Link', 'ultimate-post-kit'),
		// 		'type'         => Controls_Manager::SWITCHER,
		// 		'prefix_class' => 'upk-global-link-',
		// 		'description'  => __('Be aware! When Item Wrapper Link activated then title link and read more link will not work', 'ultimate-post-kit'),
		// 		'separator' => 'before'
		// 	]
		// );

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

		$this->start_controls_section(
			'style_play_button',
			[
				'label' => esc_html__('Play Button', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'play_button_size',
			[
				'label'     => __('Size', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 40,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-play-button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-play-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'tabs_play_button'
		);

		$this->start_controls_tab(
			'normal_tab_play_button',
			[
				'label' => __('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'play_button_color',
			[
				'label'     => __('Icon Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-play-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'play_button_bg',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-play-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'play_button_border',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-play-button',
			]
		);

		$this->add_responsive_control(
			'play_button_border_radius',
			[
				'label'		 => __('Border Radius', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-play-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_tab_play_button',
			[
				'label' => __('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'play_button_color_hover',
			[
				'label'     => __('Icon Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider-preview .upk-atlas-video-play-wrap:hover .upk-atlas-play-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'play_button_bg_hover',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider-preview .upk-atlas-video-play-wrap:hover .upk-atlas-play-button',
			]
		);

		$this->add_control(
			'play_button_border_color_hover',
			[
				'label'     => __('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider-preview .upk-atlas-video-play-wrap:hover .upk-atlas-play-button' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'play_button_border_border!' => ''
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		$this->start_controls_tabs('tabs_title_style');

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title',
			]
		);

		$this->add_control(
			'title_advanced_style',
			[
				'label' => esc_html__('Advanced Style', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'title_background',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'      => 'title_text_shadow',
				'label'     => __('Text Shadow', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'title_border',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label'		 => __('Border Radius', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'title_box_shadow',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'title_text_padding',
			[
				'label' 	 => __('Padding', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_border_hover_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title_advanced_style' => 'yes',
					'title_border_border!' => '',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'title_hover_background',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-title:hover',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_category',
			[
				'label'     => esc_html__('Category', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_category' => 'yes'
				],
			]
		);

		$this->start_controls_tabs('tabs_category_style');

		$this->start_controls_tab(
			'tab_category_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'category_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_background',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'category_border',
				'selector'    => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a',
			]
		);

		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_category_hover',
			[
				'label'     => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'category_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_hover_background',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a:hover',
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
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'style_video_comments',
			[
				'label' => esc_html__('Comments', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'comments_typo',
				'selector' => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-comments',
			]
		);

		$this->add_control(
			'comments_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-comments' => 'color: {{VALUE}};',
				],
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
						]
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
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-meta, {{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-author a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-author a:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-preview .upk-atlas-meta',
			]
		);

		$this->end_controls_section();

		// start thumbnail style

		$this->start_controls_section(
			'style_playlist',
			[
				'label' => esc_html__('Thumb Slider', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'playlist_heading',
			[
				'label'     => esc_html__('Image', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'playlist_thumb_width',
			[
				'label'   => esc_html__('Width', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 60,
						'max' => 100,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-thumbs-slide-item .upk-image-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'playlist_thumb_width_border',
				'selector'  => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-thumbs-slide-item .upk-image-wrap',
			]
		);

		$this->add_responsive_control(
			'playlist_thumb_width_border_radius',
			[
				'label'		 => __('Border Radius', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-thumbs-slide-item .upk-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'playlist_overlay_color',
			[
				'label'     => __('Overlay Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-thumbs-slide-item .upk-image-wrap::before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'playlist_play_icon_heading',
			[
				'label'     => esc_html__('P L A Y I C O N', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'playlist_play_icon_size',
			[
				'label'   => esc_html__('Icon Size', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 12,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-atlas-play-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'playlist_play_icon_color',
			[
				'label'     => __('Icon Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-atlas-play-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'playlist_play_icon_active',
			[
				'label'     => __('Icon Active', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist  .swiper-slide-active .upk-atlas-play-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'     => esc_html__('T I T L E', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'playlist_title_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-atlas-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'playlist_title_typo',
				'selector' => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-atlas-title',
			]
		);

		$this->add_control(
			'playlist_title_color_hover',
			[
				'label'     => __('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-atlas-thumbs-slide-item:hover .upk-atlas-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'playlist_title_color_active',
			[
				'label'     => __('Active Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .swiper-slide-active .upk-atlas-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_heading',
			[
				'label'     => esc_html__('C A T E G O R Y', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'playlist_category_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'playlist_category_typo',
				'selector' => '{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-category a',
			]
		);

		$this->add_control(
			'playlist_category_color_hover',
			[
				'label'     => __('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist .upk-atlas-thumbs-slide-item:hover .upk-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'playlist_category_color_active',
			[
				'label'     => __('Active Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist  .swiper-slide-active .upk-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scrollbar_heading',
			[
				'label'     => esc_html__('S C R O L L B A R', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_scrollbar' => 'yes'
				]
			]
		);

		$this->add_control(
			'scrollbar_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'show_scrollbar' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .upk-atlas-slider .upk-atlas-slider-playlist  .swiper-scrollbar' => 'background: {{VALUE}};',
				],
			]
		);



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

		<img class="upk-atlas-img" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_html(get_the_title()); ?>">

	<?php
	}

	public function render_playlist_title() {
		$settings = $this->get_settings_for_display();

		if (!$this->get_settings('show_title')) {
			return;
		}

		printf('<%1$s class="upk-atlas-title"><a href="%2$s" title="%3$s">%3$s</a></%1$s>', Utils::get_valid_html_tag($settings['title_tags']), 'javascript:void(0);', get_the_title());
	}

	public function render_title() {
		$settings = $this->get_settings_for_display();

		if (!$this->get_settings('show_title')) {
			return;
		}

		printf('<%1$s class="upk-atlas-title" data-swiper-parallax-x="100"><a href="%2$s" title="%3$s">%3$s</a></%1$s>', Utils::get_valid_html_tag($settings['title_tags']), get_permalink(), get_the_title());
	}

	public function render_comments($id = 0) {
		if (!$this->get_settings('show_comments')) {
			return;
		}
	?>
		<div class="upk-atlas-comments">
			<span><?php echo get_comments_number($id) ?> <?php echo esc_html__(' Comments', 'ultimate-post-kit') ?></span>
		</div>

	<?php
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
		<div class="upk-atlas-thumbs-slide-item swiper-slide">
			<div class="upk-image-wrap upk-atlas-video-trigger" data-src="<?php echo esc_url($video_link); ?>">
				<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
				<div class="upk-atlas-video-play-wrap">
					<a href="javascript:void(0);">
						<i class="upk-atlas-play-button fas fa-play"></i>
					</a>
				</div>
			</div>
			<div class="upk-atlas-content-wrap">
				<?php $this->render_category(); ?>
				<?php $this->render_playlist_title(); ?>
			</div>
		</div>
	<?php
	}

	public function render_item($post_id, $image_size, $video_link) {
		$settings = $this->get_settings_for_display();
		$video_link = $this->video_link_render($video_link);
	?>
		<div class="upk-atlas-single-slide-item swiper-slide">
			<div class="upk-atlas-image-wrap">
				<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
				<div class="upk-atlas-video-play-wrap">
					<a class="upk-atlas-video-trigger" data-src="<?php echo esc_url($video_link); ?>" href="javascript:void(0);">
						<i class="upk-atlas-play-button fas fa-play"></i>
					</a>
				</div>


				<div class="upk-atlas-video-wrap">
					<iframe src="<?php echo esc_url($video_link); ?>" class="upk-atlas-video-iframe" allow="autoplay;">
					</iframe>
				</div>
			</div>
			<div class="upk-atlas-content-wrap">
				<div class="upk-category-and-comments-wrap" data-swiper-parallax-x="100">
					<?php $this->render_category(); ?>
					<?php $this->render_comments($post_id); ?>
				</div>
				<?php $this->render_title(); ?>
				<div class="upk-atlas-meta" data-swiper-parallax-x="100">
					<?php $this->render_author(); ?>
					<div class="upk-atlas-separator">
						<span><?php echo esc_html($settings['meta_separator']); ?></span>
					</div>
					<?php $this->render_date(); ?>
				</div>
			</div>
		</div>
	<?php
	}


	public function render_header() {
		$settings = $this->get_settings_for_display();


		$id              = 'upk-atlas-slider-' . $this->get_id();
		$settings        = $this->get_settings_for_display();

		$this->add_render_attribute('atlas-slide', 'id', $id);
		$this->add_render_attribute('atlas-slide', 'class', ['upk-atlas-slider']);

		$this->add_render_attribute(
			[
				'atlas-slide' => [
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
							"lazy" => [
								"loadPrevNext"  => "true",
							],
						]))
					]
				]
			]
		);

	?>
		<div <?php $this->print_render_attribute_string('atlas-slide'); ?>>
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
			<div class="swiper-container upk-atlas-slider-preview">
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

			<div thumbsSlider="" class="swiper-container upk-atlas-slider-playlist">
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
				<!-- If we need scrollbar -->
				<?php if ($settings['show_scrollbar'] == 'yes') : ?>
					<div class="swiper-scrollbar"></div>
				<?php endif; ?>
			</div>



<?php
			$this->render_footer();
			wp_reset_postdata();
		} else {
			echo 'please enable the video link metabox first from core settings';
			// printf('Please Enable the video link metabox_first', 'V')
		}
	}
}
