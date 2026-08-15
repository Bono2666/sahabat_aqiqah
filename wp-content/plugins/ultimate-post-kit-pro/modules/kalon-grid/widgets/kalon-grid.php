<?php

namespace UltimatePostKit\Modules\KalonGrid\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

use UltimatePostKit\Utils;
use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Traits\Global_Widget_Functions;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Kalon_Grid extends Group_Control_Query {

	use Global_Widget_Controls;
	use Global_Widget_Functions;

	private $_query = null;

	public function get_name() {
		return 'upk-kalon-grid';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Kalon Grid', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-kalon-grid';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'grid', 'blog', 'recent', 'news', 'kalon'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-kalon-grid'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/sxePbXHbVdw';
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
			'grid_style',
			[
				'label'   => esc_html__('Layout Style', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'  => esc_html__('Style 01', 'ultimate-post-kit'),
					'2'  => esc_html__('Style 02', 'ultimate-post-kit'),
					'3'  => esc_html__('Style 03', 'ultimate-post-kit'),
					'4'  => esc_html__('Style 04', 'ultimate-post-kit'),
					'5'  => esc_html__('Style 05', 'ultimate-post-kit'),
					'6'  => esc_html__('Style 06', 'ultimate-post-kit'),
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => __('Columns', 'ultimate-post-kit'),
				'type' => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-latout-1' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
				],
				'condition' => [
					'grid_style' => ['1']
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => esc_html__('Row Gap', 'ultimate-post-kit') . BDTUPK_NC,
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-grid-wrapper' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => esc_html__('Column Gap', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-grid-wrapper' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'primary_item_height',
			[
				'label'   => esc_html__('Primary Item Height', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 200,
						'max'  => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-latout-1 .upk-item, {{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+2), {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+1), {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+1), {{WRAPPER}} .upk-kalon-grid .upk-latout-5 .upk-item:nth-child(4n+2), {{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+1), {{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+3)' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'grid_style!' => ['2', '3', '4', '6']
				]
			]
		);

		$this->add_responsive_control(
			'secondary_item_height',
			[
				'label'   => esc_html__('Secondary Item Height', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 200,
						'max'  => 800,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+1), {{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+3), {{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+4), {{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+5), {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+2), {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+3), {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+4), {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+5), {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+2), {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+3), {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+4), {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+5), {{WRAPPER}} .upk-kalon-grid .upk-latout-5 .upk-item:nth-child(4n+3), {{WRAPPER}} .upk-kalon-grid .upk-latout-5 .upk-item:nth-child(4n+4), {{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+2), {{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+4)' => 'height: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+2)' => 'height: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+1)' => 'height: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+1)' => 'height: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .upk-kalon-grid .upk-latout-5 .upk-item:nth-child(4n+1)' => 'height: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+1)' => 'height: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+3)' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'grid_style!' => '1'
				]
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

		$this->add_responsive_control(
			'content_alignment',
			[
				'label'       => __('Alignment', 'ultimate-post-kit'),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => 'center',
				'options'     => [
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
				'selectors'   => [
					'{{WRAPPER}} .upk-kalon-grid .upk-content-wrap' => 'text-align: {{VALUE}};',
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'hide_orphan_tablet',
			[
				'label'   => esc_html__('Hide Orphan Post on Tablet', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'prefix_class' => 'upk-hide-orphan-',
				'frontend_available' => true,
			]
		);


		$this->end_controls_section();

		//New Query Builder Settings
		$this->start_controls_section(
			'section_post_query_builder',
			[
				'label' => __('Query', 'ultimate-post-kit'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'item_limit',
			[
				'label' => esc_html__('Item Limit', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 5
					],
				],
				'default' => [
					'size' => 6,
				],
				'condition' => [
					'grid_style' => ['1']
				]
			]
		);

		$this->add_control(
			'item_limit_2_3_4',
			[
				'label' => esc_html__('Item Limit', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 5
					],
				],
				'default' => [
					'size' => 5,
				],
				'condition' => [
					'grid_style' => ['2', '3', '4']
				]
			]
		);

		$this->add_control(
			'item_limit_5_6',
			[
				'label' => esc_html__('Item Limit', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 4
					],
				],
				'default' => [
					'size' => 4,
				],
				'condition' => [
					'grid_style' => ['5', '6']
				]
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
			'show_author',
			[
				'label'   => esc_html__('Author', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		//Global Date Controls
		$this->register_date_controls();

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
			'show_readmore',
			[
				'label'     => esc_html__('Read More', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label'       => esc_html__('Read More Text', 'ultimate-post-kit'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Read More', 'ultimate-post-kit'),
				'placeholder' => esc_html__('Read More', 'ultimate-post-kit'),
				'condition'   => [
					'show_readmore' => 'yes',
				],
			]
		);

		$this->add_control(
			'readmore_icon',
			[
				'label'       => esc_html__('Icon', 'ultimate-post-kit'),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				],
				'label_block' => false,
				'skin'        => 'inline',
				'condition'   => [
					'show_readmore' => 'yes',
				]
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   => esc_html__('Icon Position', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__('Left', 'ultimate-post-kit'),
					'right' => esc_html__('Right', 'ultimate-post-kit'),
				],
				'condition' => [
					'readmore_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'   => esc_html__('Icon Spacing', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'readmore_icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-flex-align-right' => is_rtl() ? 'margin-right: {{SIZE}}{{UNIT}};' : 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .upk-kalon-grid .upk-flex-align-left'  => is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__('Pagination', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
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

		//Style
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
				'label' 	 => __('Content Padding', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-kalon-grid .upk-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_control(
			'overlay_blur_effect',
			[
				'label' => esc_html__('Glassmorphism', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
				'description' => sprintf(__('This feature will not work in the Firefox browser untill you enable browser compatibility so please %1s look here %2s', 'ultimate-post-kit'), '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter#Browser_compatibility" target="_blank">', '</a>'),
			]
		);

		$this->add_control(
			'overlay_blur_level',
			[
				'label'       => __('Blur Level', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					]
				],
				'default'     => [
					'size' => 5
				],
				'selectors'   => [
					'{{WRAPPER}} .upk-kalon-grid .upk-item-box::before' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);'
				],
				'condition' => [
					'overlay_blur_effect' => 'yes'
				]
			]
		);

		$this->add_control(
			'item_overlay_color',
			[
				'label'     => esc_html__('Overlay Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-item-box::before' => 'background: linear-gradient(0deg, {{VALUE}} 0, rgba(141, 153, 174, 0.1) 100%);',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'item_border',
				'selector'    => '{{WRAPPER}} .upk-kalon-grid .upk-item',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-kalon-grid .upk-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' 	 => __('Padding', 'ultimate-post-kit'),
				'type' 		 => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-kalon-grid .upk-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 	   => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'overlay_blur_level_hover',
			[
				'label'       => __('Blur Level', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					]
				],
				'default'     => [
					'size' => 5
				],
				'selectors'   => [
					'{{WRAPPER}} .upk-kalon-grid .upk-item:hover .upk-item-box::before' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);'
				],
				'condition' => [
					'overlay_blur_effect' => 'yes'
				]
			]
		);

		$this->add_control(
			'item_overlay_hover_color',
			[
				'label'     => esc_html__('Overlay Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-item:hover .upk-item-box::before' => 'background: linear-gradient(0deg, {{VALUE}} 0, rgba(141, 153, 174, 0.1) 100%);',
				],
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
					'{{WRAPPER}} .upk-kalon-grid .upk-item:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 	   => 'item_hover_box_shadow',
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-item:hover',
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

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-title-wrap .upk-title' => 'color: {{VALUE}};',
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
						'max'  => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .upk-kalon-grid .upk-title-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-kalon-grid .upk-title-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'secondary_title_typography',
				'label'     => esc_html__('Secondary Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+1) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+3) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+4) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-2 .upk-item:nth-child(5n+5) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+2) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+3) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+4) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-3 .upk-item:nth-child(5n+5) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+2) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+3) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+4) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-4 .upk-item:nth-child(5n+5) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-5 .upk-item:nth-child(4n+3) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-5 .upk-item:nth-child(4n+4) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+2) .upk-title-wrap, {{WRAPPER}} .upk-kalon-grid .upk-latout-6 .upk-item:nth-child(4n+4) .upk-title-wrap',
				'condition' => [
					'grid_style!' => '1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'label' => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-title-wrap',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_author',
			[
				'label'     => esc_html__('Author', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_author' => 'yes',
				],
			]
		);

		$this->add_control(
			'author_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-meta .upk-kalon-author .upk-author-text, {{WRAPPER}} .upk-kalon-grid .upk-meta .upk-kalon-author .upk-author-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'author_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-meta .upk-kalon-author .upk-author-text, {{WRAPPER}} .upk-kalon-grid .upk-meta .upk-kalon-author .upk-author-name',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_date',
			[
				'label'     => esc_html__('Date', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_date' => 'yes',
				],
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-meta .upk-flex-inline *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'date_spacing',
			[
				'label'   => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-meta .upk-flex-inline' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-meta .upk-flex-inline *',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_category',
			[
				'label'     => esc_html__('Category', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_category' => 'yes',
				],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_background',
				'selector'  => '{{WRAPPER}} .upk-kalon-grid .upk-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'category_border',
				'selector'    => '{{WRAPPER}} .upk-kalon-grid .upk-category a',
			]
		);

		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-kalon-grid .upk-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .upk-kalon-grid .upk-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_bottom_spacing',
			[
				'label'   => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-category' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-category a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_readmore',
			[
				'label'     => __('Read More', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_readmore'       => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_readmore_style');

		$this->start_controls_tab(
			'tab_readmore_normal',
			[
				'label' => __('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'readmore_text_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn svg *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'readmore_background',
				'selector'  => '{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'readmore_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn'
			]
		);

		$this->add_responsive_control(
			'readmore_radius',
			[
				'label'      => __('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'readmore_padding',
			[
				'label'      => __('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'readmore_shadow',
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'readmore_typography',
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_readmore_hover',
			[
				'label' => __('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'readmore_hover_text_color',
			[
				'label'     => __('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn:hover svg *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'readmore_hover_background',
				'selector'  => '{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn:hover',
			]
		);

		$this->add_control(
			'readmore_hover_border_color',
			[
				'label'     => __('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'readmore_border_border!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'readmore_hover_shadow',
				'selector' => '{{WRAPPER}} .upk-kalon-grid .upk-btn-wrap .upk-btn:hover',
			]
		);

		$this->add_control(
			'readmore_hover_animation',
			[
				'label' => __('Hover Animation', 'ultimate-post-kit'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pagination',
			[
				'label'     => esc_html__('Pagination', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);


		$this->start_controls_tabs('tabs_pagination_style');

		$this->start_controls_tab(
			'tab_pagination_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li a, {{WRAPPER}} ul.upk-pagination li span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'pagination_background',
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} ul.upk-pagination li a',
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'pagination_border',
				'label'       => esc_html__('Border', 'ultimate-post-kit'),
				'selector'    => '{{WRAPPER}} ul.upk-pagination li a',
			]
		);

		$this->add_responsive_control(
			'pagination_offset',
			[
				'label'     => esc_html__('Offset', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .upk-pagination' => 'margin-top: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_space',
			[
				'label'     => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .upk-pagination' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .upk-pagination > *' => 'padding-left: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_padding',
			[
				'label'     => esc_html__('Padding', 'ultimate-post-kit'),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li a' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_radius',
			[
				'label'     => esc_html__('Radius', 'ultimate-post-kit'),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_arrow_size',
			[
				'label'     => esc_html__('Arrow Size', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li a svg' => 'height: {{SIZE}}px; width: auto;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} ul.upk-pagination li a, {{WRAPPER}} ul.upk-pagination li span',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pagination_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'pagination_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'pagination_hover_background',
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} ul.upk-pagination li a:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pagination_active',
			[
				'label' => esc_html__('Active', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'pagination_active_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li.upk-active a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_active_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.upk-pagination li.upk-active a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pagination_active_background',
				'selector' => '{{WRAPPER}} ul.upk-pagination li.upk-active a',
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

	public function render_title() {
		$settings = $this->get_settings_for_display();

		if (!$this->get_settings('show_title')) {
			return;
		}

		printf('<%1$s class="upk-title-wrap"><a href="%2$s" title="%3$s" class="upk-title">%3$s</a></%1$s>', Utils::get_valid_html_tag($settings['title_tags']), get_permalink(), get_the_title());
	}

	public function render_author() {

		if (!$this->get_settings('show_author')) {
			return;
		}

?>

		<div class="upk-kalon-author">
			<span class="upk-author-text"><?php echo esc_html_x('by', 'Frontend', 'ultimate-post-kit'); ?></span>
			<a class="upk-author-name" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
				<?php echo get_the_author() ?>
			</a>
		</div>

	<?php
	}

	public function render_readmore() {
		$settings        = $this->get_settings_for_display();

		if (!$this->get_settings('show_readmore')) {
			return;
		}

		$animation = ($this->get_settings('readmore_hover_animation')) ? ' elementor-animation-' . $this->get_settings('readmore_hover_animation') : '';

	?>
		<a href="<?php echo esc_url(get_permalink()); ?>" class="upk-btn <?php echo esc_html($animation); ?>">
			<span class="upk-flex upk-flex-middle">
				<?php echo esc_html($this->get_settings('readmore_text')); ?>

				<?php if ($settings['readmore_icon']['value']) : ?>
					<span class="upk-btn-icon upk-flex-align-<?php echo esc_html($this->get_settings('icon_align')); ?>">

						<?php Icons_Manager::render_icon($settings['readmore_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?>

					</span>
				<?php endif; ?>
			</span>
		</a>
	<?php
	}

	public function render_post_grid_item($post_id, $image_size) {
		$settings = $this->get_settings_for_display();

		if ('yes' == $settings['global_link']) {

			$this->add_render_attribute('grid-item', 'onclick', "window.open('" . esc_url(get_permalink()) . "', '_self')", true);
		}
		$this->add_render_attribute('grid-item', 'class', 'upk-item', true);

	?>
		<div <?php $this->print_render_attribute_string('grid-item'); ?>>
			<div class="upk-item-box">
				<div class="upk-img-wrap">
					<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
				</div>

				<div class="upk-content-wrap">
					<div class="upk-content">
						<?php $this->render_category(); ?>
						<?php $this->render_title(); ?>
						<div class="upk-meta">
							<div class="upk-flex-inline">
								<?php $this->render_date(); ?>
							</div>
							<?php $this->render_author(); ?>
						</div>
					</div>

					<div class="upk-btn-wrap">
						<?php $this->render_readmore(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ($settings['grid_style'] == '1') {
			$this->query_posts($settings['item_limit']['size']);
		} elseif ($settings['grid_style'] == '5' or $settings['grid_style'] == '6') {
			$this->query_posts($settings['item_limit_5_6']['size']);
		} else {
			$this->query_posts($settings['item_limit_2_3_4']['size']);
		}

		$wp_query = $this->get_query();

		if (!$wp_query->found_posts) {
			return;
		}

		$this->add_render_attribute('grid-wrap', 'class', 'upk-grid-wrapper');
		$this->add_render_attribute('grid-wrap', 'class', 'upk-latout-' . $settings['grid_style']);

		if (isset($settings['upk_in_animation_show']) && ($settings['upk_in_animation_show'] == 'yes')) {
			$this->add_render_attribute('grid-wrap', 'class', 'upk-in-animation');
			if (isset($settings['upk_in_animation_delay']['size'])) {
				$this->add_render_attribute('grid-wrap', 'data-in-animation-delay', $settings['upk_in_animation_delay']['size']);
			}
		}

	?>
		<div class="upk-kalon-grid">
			<div <?php $this->print_render_attribute_string('grid-wrap'); ?>>

				<?php while ($wp_query->have_posts()) :
					$wp_query->the_post();

					$thumbnail_size = $settings['primary_thumbnail_size'];

				?>

					<?php $this->render_post_grid_item(get_the_ID(), $thumbnail_size); ?>

				<?php endwhile; ?>
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
