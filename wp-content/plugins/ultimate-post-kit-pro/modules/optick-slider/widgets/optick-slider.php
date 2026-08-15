<?php

namespace UltimatePostKit\Modules\OptickSlider\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

use Elementor\Utils;
use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Traits\Global_Swiper_Functions;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;
use WP_Query;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Optick_Slider extends Group_Control_Query {

	use Global_Widget_Controls;
	use Global_Swiper_Functions;

	private $_query = null;

	public function get_name() {
		return 'upk-optick-slider';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Optick Slider', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-optick-slider';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'carousel', 'blog', 'recent', 'news', 'slider', 'optick'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-optick-slider'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-optick-slider'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/gqTNcaH7Qy4';
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
			'item_height',
			[
				'label' => esc_html__('Height', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => ['px', 'vh'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1080,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item' => 'height: {{SIZE}}{{UNIT}};',
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

		$this->register_title_controls();
		$this->add_control(
			'title_hide_on',
			[
				'label'       => __('Title Hide On', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'desktop' => __('Desktop', 'ultimate-post-kit'),
					'tablet'  => __('Tablet', 'ultimate-post-kit'),
					'mobile'  => __('Mobile', 'ultimate-post-kit'),
				],
				'frontend_available' => true,
			]
		);
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
			'excerpt_hide_on',
			[
				'label'       => __('Excerpt Hide On', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'desktop' => __('Desktop', 'ultimate-post-kit'),
					'tablet'  => __('Tablet', 'ultimate-post-kit'),
					'mobile'  => __('Mobile', 'ultimate-post-kit'),
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'excerpt_length',
			[
				'label'       => esc_html__('Text Limit', 'ultimate-post-kit'),
				'description' => esc_html__('It\'s just work for main content, but not working with excerpt. If you set 0 so you will get full main content.', 'ultimate-post-kit'),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 15,
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
				'label'   => esc_html__('Show Author', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);
		$this->add_control(
			'author_hide_on',
			[
				'label'       => __('Author Hide On', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'desktop' => __('Desktop', 'ultimate-post-kit'),
					'tablet'  => __('Tablet', 'ultimate-post-kit'),
					'mobile'  => __('Mobile', 'ultimate-post-kit'),
				],
				'frontend_available' => true,
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
			'show_item_count',
			[
				'label'         => esc_html__('Show Count', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SWITCHER,
				'label_on'      => esc_html__('Show', 'ultimate-post-kit'),
				'label_off'     => esc_html__('Hide', 'ultimate-post-kit'),
				'return_value'  => 'yes',
				'default'       => 'yes',
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
					'size' => 3,
				],
			]
		);

		$this->register_query_builder_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_navigation',
			[
				'label' => __('Navigation', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __('Navigation', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'            => esc_html__('Arrows and Dots', 'ultimate-post-kit'),
					'arrows-fraction' => esc_html__('Arrows and Fraction', 'ultimate-post-kit'),
					'arrows'          => esc_html__('Arrows', 'ultimate-post-kit'),
					'dots'            => esc_html__('Dots', 'ultimate-post-kit'),
					'progressbar'     => esc_html__('Progress', 'ultimate-post-kit'),
					'none'            => esc_html__('None', 'ultimate-post-kit'),
				],
				'prefix_class' => 'upk-navigation-type-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'dynamic_bullets',
			[
				'label'     => __('Dynamic Bullets?', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'show_scrollbar',
			[
				'label'     => __('Show Scrollbar?', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'both_position',
			[
				'label'     => __('Arrows and Dots Position', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => ultimate_post_kit_navigation_position(),
				'condition' => [
					'navigation' => 'both',
				],

			]
		);

		$this->add_control(
			'arrows_fraction_position',
			[
				'label'     => __('Arrows and Fraction Position', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => ultimate_post_kit_navigation_position(),
				'condition' => [
					'navigation' => 'arrows-fraction',
				],

			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'     => __('Arrows Position', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => ultimate_post_kit_navigation_position(),
				'condition' => [
					'navigation' => 'arrows',
				],

			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'     => __('Dots Position', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom-center',
				'options'   => ultimate_post_kit_pagination_position(),
				'condition' => [
					'navigation' => 'dots',
				],

			]
		);

		$this->add_control(
			'progress_position',
			[
				'label'   => __('Progress Position', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'bottom' => esc_html__('Bottom', 'ultimate-post-kit'),
					'top'    => esc_html__('Top', 'ultimate-post-kit'),
				],
				'condition' => [
					'navigation' => 'progressbar',
				],

			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__('Arrows Icon', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0' => esc_html__('Default', 'bdthemes-element-pack'),
					'1' => esc_html__('Style 1', 'ultimate-post-kit'),
					'2' => esc_html__('Style 2', 'ultimate-post-kit'),
					'3' => esc_html__('Style 3', 'ultimate-post-kit'),
					'4' => esc_html__('Style 4', 'ultimate-post-kit'),
					'5' => esc_html__('Style 5', 'ultimate-post-kit'),
					'6' => esc_html__('Style 6', 'ultimate-post-kit'),
					'7' => esc_html__('Style 7', 'ultimate-post-kit'),
					'8' => esc_html__('Style 8', 'ultimate-post-kit'),
					'9' => esc_html__('Style 9', 'ultimate-post-kit'),
					'10' => esc_html__('Style 10', 'ultimate-post-kit'),
					'11' => esc_html__('Style 11', 'ultimate-post-kit'),
					'12' => esc_html__('Style 12', 'ultimate-post-kit'),
					'13' => esc_html__('Style 13', 'ultimate-post-kit'),
					'14' => esc_html__('Style 14', 'ultimate-post-kit'),
					'15' => esc_html__('Style 15', 'ultimate-post-kit'),
					'16' => esc_html__('Style 16', 'ultimate-post-kit'),
					'17' => esc_html__('Style 17', 'ultimate-post-kit'),
					'18' => esc_html__('Style 18', 'ultimate-post-kit'),
					'circle-1' => esc_html__('Style 19', 'ultimate-post-kit'),
					'circle-2' => esc_html__('Style 20', 'ultimate-post-kit'),
					'circle-3' => esc_html__('Style 21', 'ultimate-post-kit'),
					'circle-4' => esc_html__('Style 22', 'ultimate-post-kit'),
					'square-1' => esc_html__('Style 23', 'ultimate-post-kit'),
				],
				'condition' => [
					'navigation' => ['arrows-fraction', 'both', 'arrows'],
				],
			]
		);

		$this->add_control(
			'hide_arrow_on_mobile',
			[
				'label'     => __('Hide Arrow on Mobile', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'navigation' => ['arrows-fraction', 'arrows', 'both'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_settings',
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
		$this->add_responsive_control(
			'prev_next_slides_width',
			[
				'label'         => esc_html__('Previous/Next Item Width ', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 110,
						'max'   => 300,
						'step'  => 1,
					]
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 170,
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 170,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 150,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 100,
					'unit' => 'px',
				]
			]
		);
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'upk_section_style',
			[
				'label' => esc_html__('Items', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_width',
			[
				'label'         => esc_html__('Content Width', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px', '%'],
				'range'         => [
					'px'        => [
						'min'   => 400,
						'max'   => 800,
						'step'  => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-wrapper .upk-optick-slider-item .upk-optick-content-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_alignment',
			[
				'label'      => esc_html__('Content Alignment', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => [
					'left'  => esc_html__('Left', 'ultimate-post-kit'),
					'center' => esc_html__('Center', 'ultimate-post-kit'),
					'right' => esc_html__('Right', 'ultimate-post-kit'),
				],
			]
		);
		$this->add_control(
			'content_position',
			[
				'label'      => esc_html__('Content Position', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'middle',
				'options'    => [
					'top'  => esc_html__('Top', 'ultimate-post-kit'),
					'middle' => esc_html__('Middle', 'ultimate-post-kit'),
					'bottom' => esc_html__('Bottom', 'ultimate-post-kit'),
				],
			]
		);
		$this->add_control(
			'overlay_blur_effect',
			[
				'label'       => esc_html__('Glassmorphism', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SWITCHER,
				'description' => sprintf(__('This feature will not work in the Firefox browser untill you enable browser compatibility so please %1s look here %2s', 'ultimate-post-kit'), '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter#Browser_compatibility" target="_blank">', '</a>'),
				'default'     => 'yes',
			]
		);

		// $this->add_control(
		// 	'overlay_blur_level',
		// 	[
		// 		'label'     => __('Blur Level', 'ultimate-post-kit'),
		// 		'type'      => Controls_Manager::SLIDER,
		// 		'range'     => [
		// 			'px' => [
		// 				'min'  => 0,
		// 				'step' => 1,
		// 				'max'  => 50,
		// 			]
		// 		],
		// 		'default'   => [
		// 			'size' => 15
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-image-wrapper:before' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);'
		// 		],
		// 		'condition' => [
		// 			'overlay_blur_effect' => 'yes'
		// 		]
		// 	]
		// );
		// $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name'      => 'item_overlay_bg',
		// 		'label'     => esc_html__('Overlay', 'ultimate-post-kit'),
		// 		'types'     => ['classic', 'gradient'],
		// 		'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-image-wrapper:before',
		// 	]
		// );
		$this->end_controls_section();
		$this->start_controls_section(
			'upk_section_style_count',
			[
				'label' => esc_html__('Count', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_item_count' => 'yes'
				]
			]
		);
		$this->add_control(
			'count_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-counter' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'count_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-counter',
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
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-title .upk-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-title:hover .upk-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'label' => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-optick-slider .upk-optick-slider-wrapper .upk-optick-slider-item .upk-optick-title',
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
					'{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-desc' => 'color: {{VALUE}};',
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
						'max'  => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-desc' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'text_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-slider-item .upk-optick-desc',
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
		$this->start_controls_tabs(
			'meta_tabs'
		);
		$this->start_controls_tab(
			'meta_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Text Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .upk-optick-slider .upk-optick-meta-content,
						{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content .upk-author-name' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'meta_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content',
			]
		);
		$this->add_responsive_control(
			'meta_padding',
			[
				'label'                 => esc_html__('Padding', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_margin',
			[
				'label'                 => esc_html__('Margin', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'meta_radius',
			[
				'label'                 => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content',
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
					'{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content .upk-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'meta_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Text Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content .upk-author-name:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'meta_hover_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-meta-content:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__('Button', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'btn_tabs'
		);
		$this->start_controls_tab(
			'btn_tab_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'btn_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label'                 => esc_html__('Padding', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
		$this->add_responsive_control(
			'btn_margin',
			[
				'label'                 => esc_html__('Margin', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_radius',
			[
				'label'                 => esc_html__('Radius', 'ultimate-post-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'btn_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'btn_tab_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'btn_color_hover',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'btn_background_hover',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .upk-optick-slider .upk-optick-wrapper .upk-optick-btn a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __('Navigation', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'  => 'navigation',
							'operator' => '!=',
							'value' => 'none',
						],
						[
							'name'     => 'show_scrollbar',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'arrows_heading',
			[
				'label'     => __('Arrows', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->start_controls_tabs('tabs_navigation_arrows_style');

		$this->start_controls_tab(
			'tabs_nav_arrows_normal',
			[
				'label' => __('Normal', 'ultimate-post-kit'),
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev i, {{WRAPPER}} .upk-optick-slider .upk-navigation-next i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_background',
			[
				'label'     => __('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev, {{WRAPPER}} .upk-optick-slider .upk-navigation-next' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'nav_arrows_border',
				'selector'    => '{{WRAPPER}} .upk-optick-slider .upk-navigation-prev, {{WRAPPER}} .upk-optick-slider .upk-navigation-next',
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev, {{WRAPPER}} .upk-optick-slider .upk-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label' => esc_html__('Padding', 'ultimate-post-kit'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev, {{WRAPPER}} .upk-optick-slider .upk-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
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
				'default'       => [
					'unit'      => 'px',
					'size'      => 28,
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev i,
					{{WRAPPER}} .upk-optick-slider .upk-navigation-next i' => 'font-size: {{SIZE || 28}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);
		$this->add_control(
			'arrows_space',
			[
				'label' => __('Space Between Arrows', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-next' => 'margin-left: {{SIZE}}px;',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_nav_arrows_hover',
			[
				'label' => __('Hover', 'ultimate-post-kit'),
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev:hover i, {{WRAPPER}} .upk-optick-slider .upk-navigation-next:hover i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_background',
			[
				'label'     => __('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev:hover, {{WRAPPER}} .upk-optick-slider .upk-navigation-next:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'nav_arrows_hover_border_color',
			[
				'label'     => __('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev:hover, {{WRAPPER}} .upk-optick-slider .upk-navigation-next:hover'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_arrows_border_border!' => '',
					'navigation!' => ['dots', 'progressbar', 'none'],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_2',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'dots_heading',
			[
				'label'     => __('Dots', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'hr_11',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __('Active Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);


		$this->add_responsive_control(
			'dots_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_height_size',
			[
				'label' => __('Height(px)', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_responsive_control(
			'dots_width_size',
			[
				'label' => __('Width(px)', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => ['arrows', 'arrows-fraction', 'progressbar', 'none'],
				],
			]
		);

		$this->add_control(
			'hr_22',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'fraction_heading',
			[
				'label'     => __('Fraction', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'hr_12',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'fraction_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-fraction' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'active_fraction_color',
			[
				'label'     => __('Active Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-current' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'fraction_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				//'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .upk-optick-slider .swiper-pagination-fraction',
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'hr_3',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progresbar_heading',
			[
				'label'     => __('Progresbar', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'hr_13',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progresbar_color',
			[
				'label'     => __('Bar Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-progressbar' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progres_color',
			[
				'label'     => __('Progress Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'hr_4',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_heading',
			[
				'label'     => __('Scrollbar', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'hr_14',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_color',
			[
				'label'     => __('Bar Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-scrollbar' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_drag_color',
			[
				'label'     => __('Drag Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-scrollbar .swiper-scrollbar-drag' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_height',
			[
				'label'   => __('Height', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-container-horizontal > .swiper-scrollbar' => 'height: {{SIZE}}px;',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'hr_05',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'navi_offset_heading',
			[
				'label'     => __('Offset', 'ultimate-post-kit'),
				'type'      => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'hr_6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'arrows_ncx_position',
			[
				'label'   => __('Arrows Horizontal Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-arrows-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_ncy_position',
			[
				'label'   => __('Arrows Vertical Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				// 'default' => [
				// 	'size' => 40,
				// ],
				// 'tablet_default' => [
				// 	'size' => 40,
				// ],
				// 'mobile_default' => [
				// 	'size' => 40,
				// ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-arrows-ncy: {{SIZE}}px;'
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_acx_position',
			[
				'label'   => __('Arrows Horizontal Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'  => 'arrows_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'dots_nnx_position',
			[
				'label'   => __('Dots Horizontal Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-dots-nnx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'dots_nny_position',
			[
				'label'   => __('Dots Vertical Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'tablet_default' => [
					'size' => -60,
				],
				'mobile_default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-dots-nny: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncx_position',
			[
				'label'   => __('Arrows & Dots Horizontal Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-both-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncy_position',
			[
				'label'   => __('Arrows & Dots Vertical Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-both-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_cx_position',
			[
				'label'   => __('Arrows Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'both_cy_position',
			[
				'label'   => __('Dots Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-dots-container' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncx_position',
			[
				'label'   => __('Arrows & Fraction Horizontal Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-arrows-fraction-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncy_position',
			[
				'label'   => __('Arrows & Fraction Vertical Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--upk-optick-slider-arrows-fraction-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cx_position',
			[
				'label'   => __('Arrows Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .upk-optick-slider .upk-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cy_position',
			[
				'label'   => __('Fraction Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-fraction' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'progress_y_position',
			[
				'label'   => __('Progress Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-pagination-progressbar' => 'transform: translateY({{SIZE}}px);',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_responsive_control(
			'scrollbar_vertical_offset',
			[
				'label'   => __('Scrollbar Offset', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .upk-optick-slider .swiper-container-horizontal > .swiper-scrollbar' => 'bottom: {{SIZE}}px;',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Main query render for this widget
	 *
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

		<img class="upk-optick-img swiper-lazy" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">

	<?php
	}

	public function render_title() {
		$settings = $this->get_settings_for_display();
		if (!$this->get_settings('show_title')) {
			return;
		}
		$title_hide_on = ultimate_post_kit_hide_on_class($settings['title_hide_on']);
		// $this->add_render_attribute('upk-title', 'class', ['upk-optick-title', $title_hide_on], true);
		// $this->add_render_attribute('upk-title', 'data-swiper-parallax', '-100', true);
		$this->add_render_attribute('upk-title', ['class' => ['upk-optick-title', $title_hide_on], 'data-swiper-parallax' => '-100', 'data-swiper-parallax-duration' => '800'], true);
		//TODO title filtering
	?>
		<<?php echo esc_html($settings['title_tags']) ?> <?php $this->print_render_attribute_string('upk-title'); ?>>
			<?php
			printf('<a href="%1$s" class="upk-title">%2$s</a>', get_permalink(), get_the_title()); ?>
		</<?php echo esc_html($settings['title_tags']) ?>>
	<?php
	}

	public function render_excerpt($excerpt_length) {
		if (!$this->get_settings('show_excerpt')) {
			return;
		}
		$excerpt_hide_on = ultimate_post_kit_hide_on_class($this->get_settings('excerpt_hide_on'));
		$this->add_render_attribute('upk-excerpt', ['class' => ['upk-optick-desc', $excerpt_hide_on], 'data-swiper-parallax' => '-80', 'data-swiper-parallax-duration' => '900'], true);
		$strip_shortcode = $this->get_settings_for_display('strip_shortcode'); ?>

		<div <?php $this->print_render_attribute_string('upk-excerpt'); ?>>
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

	public function render_date() {
		$settings = $this->get_settings_for_display();
		if (!$this->get_settings('show_date')) {
			return;
		} ?>
		<div class="upk-optick-date">
			<?php if ($settings['human_diff_time'] == 'yes') {
				echo ultimate_post_kit_post_time_diff(($settings['human_diff_time_short'] == 'yes') ? 'short' : '');
			} else {
				echo get_the_date();
			} ?>
		</div>
	<?php
	}
	public function render_meta() {
		$settings = $this->get_settings_for_display(); ?>
		<div class="upk-optick-meta" data-swiper-parallax="+80" data-swiper-parallax-duration="1000">
			<div class="upk-optick-meta-content">
				<div class="upk-optick-author-text">
					<span><?php echo esc_html_x('by', 'Frontend', 'ultimate-post-kit'); ?></span>
					<a class="upk-author-name" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
						<?php echo get_the_author() ?>
					</a>
				</div>
				<span class="upk-separator"><?php echo esc_html($settings['meta_separator']); ?></span>
				<?php $this->render_date(); ?>
			</div>
		</div>
	<?php
	}

	public function render_header() {
		$id              = 'upk-optick-slider-' . $this->get_id();
		$settings        = $this->get_settings_for_display();
		$desktop_slides_width = ($settings['prev_next_slides_width']['size'] / 100);
		$mobile_slides_width =  ($settings['prev_next_slides_width_mobile']['size'] / 100);
		$tablet_slides_width =  ($settings['prev_next_slides_width_tablet']['size'] / 100);

		$this->add_render_attribute('optick-slider', 'id', $id);
		$this->add_render_attribute('optick-slider', 'class', ['upk-optick-slider']);
		if ('arrows' == $settings['navigation']) {
			$this->add_render_attribute('optick-slider', 'class', 'upk-arrows-align-' . $settings['arrows_position']);
		} elseif ('dots' == $settings['navigation']) {
			$this->add_render_attribute('optick-slider', 'class', 'upk-dots-align-' . $settings['dots_position']);
		} elseif ('both' == $settings['navigation']) {
			$this->add_render_attribute('optick-slider', 'class', 'upk-arrows-dots-align-' . $settings['both_position']);
		} elseif ('arrows-fraction' == $settings['navigation']) {
			$this->add_render_attribute('optick-slider', 'class', 'upk-arrows-dots-align-' . $settings['arrows_fraction_position']);
		}

		if ('arrows-fraction' == $settings['navigation']) {
			$pagination_type = 'fraction';
		} elseif ('both' == $settings['navigation'] or 'dots' == $settings['navigation']) {
			$pagination_type = 'bullets';
		} elseif ('progressbar' == $settings['navigation']) {
			$pagination_type = 'progressbar';
		} else {
			$pagination_type = '';
		}

		$this->add_render_attribute(
			[
				'optick-slider' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"       => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
							"loop"           => ($settings["loop"] == "yes") ? true : false,
							"speed"          => $settings["speed"]["size"],
							"effect"         => 'slide',
							"lazy"           => true,
							"parallax"       => true,
							"centeredSlides" => true,
							"grabCursor"     => ($settings["grab_cursor"] === "yes") ? true : false,
							"pauseOnHover"   => ("yes" == $settings["pauseonhover"]) ? true : false,
							// "slidesPerView"  => 2,
							"observer"       => ($settings["observer"]) ? true : false,
							"observeParents" => ($settings["observer"]) ? true : false,
							"navigation" => [
								"nextEl" => "#" . $id . " .upk-navigation-next",
								"prevEl" => "#" . $id . " .upk-navigation-prev",
							],
							"pagination" => [
								"el"             => "#" . $id . " .swiper-pagination",
								"type"           => $pagination_type,
								"clickable"      => "true",
								'dynamicBullets' => ("yes" == $settings["dynamic_bullets"]) ? true : false,
							],
							"scrollbar" => [
								"el"            => "#" . $id . " .swiper-scrollbar",
								"hide"          => "true",
							],
							"lazy" => [
								"loadPrevNext"  => "true",
							],
							'breakpoints' => [
								320 => [
									'slidesPerView' => $mobile_slides_width,
								],
								768 => [
									'slidesPerView' => $tablet_slides_width,
								],
								1024 => [
									'slidesPerView' => $desktop_slides_width,
								]
							]
						]))
					]
				]
			]
		);
		$this->add_render_attribute(
			'optick-slider-wrapper',
			'class',
			[
				'upk-optick-slider-wrapper',
				'upk-optick-content-position-' . $settings['content_position'] . '',
				'upk-optick-content-alignment-' . $settings['content_alignment'] . ''
			],
			true
		);


	?>
		<div <?php $this->print_render_attribute_string('optick-slider'); ?>>
			<div <?php $this->print_render_attribute_string('optick-slider-wrapper'); ?>>
				<div class="swiper-container upk-optick-wrapper">
					<div class="swiper-wrapper">
					<?php
				}


				public function render_post_grid_item($post_id, $image_size, $excerpt_length, $slide_index) {
					$settings = $this->get_settings_for_display();
					if ('yes' == $settings['global_link']) {

						$this->add_render_attribute('carousel-item', 'onclick', "window.open('" . esc_url(get_permalink()) . "', '_self')", true);
					}
					$this->add_render_attribute('carousel-item', 'class', 'upk-optick-slider-item swiper-slide upk-transition-toggle', true);
					?>
						<div <?php $this->print_render_attribute_string('carousel-item'); ?>>
							<div class="upk-image-wrapper">
								<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
							</div>
							<div class="upk-optick-content-wrap">
								<?php if ($settings['show_item_count'] === 'yes') : ?>
									<div class="upk-optick-counter" data-swiper-parallax-y="-300" data-swiper-parallax-duration="1000">
										<?php printf("%02d", $slide_index); ?>
									</div>
								<?php endif; ?>
								<?php $this->render_meta(); ?>
								<?php $this->render_title(); ?>
								<?php $this->render_excerpt($excerpt_length); ?>
								<div class="upk-optick-btn" data-swiper-parallax="-50" data-swiper-parallax-duration="800">
									<a href="<?php get_permalink(); ?>"><?php esc_html_e('More Details', 'ultimate-post-kit'); ?></a>
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
					$slide_index = 1;
					$this->render_header();
					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						$thumbnail_size = $settings['primary_thumbnail_size'];

						$this->render_post_grid_item(get_the_ID(), $thumbnail_size, $settings['excerpt_length'], $slide_index);
						$slide_index++;
					}
					$this->render_footer();

					wp_reset_postdata();
				}
			}
