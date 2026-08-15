<?php

namespace UltimatePostKit\Modules\HoluxTabs\Widgets;

use UltimatePostKit\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use UltimatePostKit\Utils;


if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Holux_Tabs extends Module_Base {

	public function get_name() {
		return 'upk-holux-tabs';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Holux Tabs', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-holux-tabs';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'blog', 'recent', 'news', 'holux', 'list', 'tabs'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-holux-tabs'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-holux-tabs'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/P-y7v3RRP1M';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_post_grid_query',
			[
				'label' => esc_html__('Query', 'ultimate-post-kit'),
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
		$this->add_control(
			'order',
			[
				'label'   => esc_html__('Order', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__('ASC', 'ultimate-post-kit'),
					'desc' => esc_html__('DESC', 'ultimate-post-kit'),
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'filter_label',
			[
				'label'       => esc_html__('Label', 'ultimate-post-kit'),
				'type'        => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'custom_post_type',
			[
				'label'       => esc_html__('Post Type', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'post',
				'options'     => ultimate_post_kit_get_post_types(),
			]
		);
		$repeater->add_control(
			'post_format',
			[
				'label'      => esc_html__('Post Format', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'all',
				'options'    => [
					'all' 		=> esc_html__('All', 'ultimate-post-kit'),
					'standard' 	=> esc_html__('Standard', 'ultimate-post-kit'),
					'aside' 	=> esc_html__('Aside', 'ultimate-post-kit'),
					'chat' 		=> esc_html__('Chat', 'ultimate-post-kit'),
					'gallery' 	=> esc_html__('Gallery ', 'ultimate-post-kit'),
					'link' 		=> esc_html__('Link', 'ultimate-post-kit'),
					'image' 	=> esc_html__('Image', 'ultimate-post-kit'),
					'quote' 	=> esc_html__('Quote', 'ultimate-post-kit'),
					'status' 	=> esc_html__('Status', 'ultimate-post-kit'),
					'audio' 	=> esc_html__('Audio', 'ultimate-post-kit'),
					'video' 	=> esc_html__('Video', 'ultimate-post-kit'),
				],
				'condition' => [
					'custom_post_type' => 'post'
				]
			]
		);
		$repeater->add_control(
			'filter_by',
			[
				'label'      => esc_html__('Filter By', 'ultimate-post-kit'),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'latest',
				'options'    => [
					'latest' => esc_html__('Latest', 'ultimate-post-kit'),
					'trending' => esc_html__('Trending', 'ultimate-post-kit'),
					'popular' => esc_html__('Popular', 'ultimate-post-kit')
				]
			]
		);

		$repeater->add_control(
			'trending_days_limit',
			[
				'label'     => esc_html__('Trending Days Limit', 'ultimate-post-kit'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 20,
				'condition' => [
					'filter_by' =>  'trending'
				]
			]
		);

		$this->add_control(
			'filter_item_list',
			[
				'label'         => esc_html__('Filter List', 'ultimate-post-kit'),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'default'       => [
					[
						'filter_label'    => esc_html__('Latest', 'ultimate-post-kit'),
						'filter_by'    => esc_html__('latest', 'ultimate-post-kit'),
					],
					[
						'filter_label'    => esc_html__('Popular', 'ultimate-post-kit'),
						'filter_by' => esc_html__('popular', 'ultimate-post-kit')
					],
					[
						'filter_label'    => esc_html__('Trending', 'ultimate-post-kit'),
						'filter_by'      =>   esc_html__('trending', 'ultimate-post-kit')
					],
				],
				'title_field'   => '{{{ filter_label }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_addition',
			[
				'label' => esc_html__('Additional', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'primary_thumbnail',
				'exclude'   => ['custom'],
				'default'   => 'medium',
			]
		);
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
			'title_tags',
			[
				'label'     => __('Title HTML Tag', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => ultimate_post_kit_title_tags(),
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
			'show_date',
			[
				'label'         => esc_html__('Show Date', 'ultimate-post-kit'),
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
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_tabs',
			[
				'label' => esc_html__('Tabs', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'style_tabs'
		);
		$this->start_controls_tab(
			'tab_active',
			[
				'label' => esc_html__('Active', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'tab_active_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs .upk-holux-tabs-active a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_active_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs .upk-holux-tabs-active a',
			]
		);
		$this->add_responsive_control(
			'tabs_height',
			[
				'label'         => esc_html__('Height', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 20,
						'max'   => 200,
						'step'  => 1,
					],
				],
				'default'       => [
					'unit'      => 'px',
					'size'      => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs a' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
		$this->add_responsive_control(
			'tabs_spacing',
			[
				'label'         => esc_html__('Spacing', 'ultimate-post-kit-pro'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'range'         => [
					'px'        => [
						'min'   => 0,
						'max'   => 30,
						'step'  => 1,
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs li + li'    => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'tabs_border',
				'label'     => esc_html__('Border', 'ultimate-post-kit-pro'),
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs li',
			]
		);
		$this->add_responsive_control(
			'tabs_border_radius',
			[
				'label'                 => esc_html__('Border Radius', 'ultimate-post-kit-pro'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs li'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow: hidden;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'tabs_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'exclude' => ['line_height', 'text_decoration'],
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'tab_normal_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs .upk-holux-tabs-tabs-list:not(.upk-holux-tabs-active) a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'tab_normal_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs .upk-holux-tabs-tabs-list:not(.upk-holux-tabs-active)' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'tabs_border_border!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'tab_normal_background',
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-header-tabs .upk-holux-tabs-tabs-list:not(.upk-holux-tabs-active) a',
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
				'label' => __('Content Padding', 'ultimate-post-kit'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'   => [
					'top' => 30,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_border_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label'     => esc_html__('Image', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'items_image_size',
			[
				'label'         => esc_html__('Size', 'ultimate-post-kit-pro'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['%', 'px', 'vh'],
				'range'         => [
					'px'        => [
						'min'   => 50,
						'max'   => 300,
						'step'  => 1,
					],
					'%'         => [
						'min'   => 1,
						'max'   => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs-item .upk-holux-tabs-image img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_image_border',
				'selector' => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-image a img',
			]
		);

		$this->add_responsive_control(
			'item_image_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-image a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'item_image_box_shadow',
				'label'     => esc_html__('Box Shadow', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-image a img',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__('Title', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__('Bottom Spacing', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-title a',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'label'    => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-title a',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_meta',
			[
				'label'     => esc_html__('Meta', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-content .upk-holux-tabs-meta *' => 'color: {{VALUE}};',
					'{{WRAPPER}}  .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-content .upk-holux-tabs-meta .upk-holux-tabs-author::before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-meta:hover *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_spacing',
			[
				'label'     => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-meta span' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' =>
				'{{WRAPPER}} 	.ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-meta i,
						{{WRAPPER}} 	.ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-meta span',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_category',
			[
				'label'     => esc_html__('Category', 'ultimate-post-kit'),
				'tab'       => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_background',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a' => 'background: {{VALUE}}',
				],
				'separator' => 'after'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'category_border',
				'label'     => esc_html__('Border', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a',
			]
		);
		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_margin',
			[
				'label'      => esc_html__('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'exclude' => ['line_height'],
				'selector' => '{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a ',
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
			'category_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_hover_bg',
			[
				'label'     => esc_html__('Background', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a:hover' => 'background: {{VALUE}}',
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
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate-post-kit-holux-tabs-wrap .upk-holux-tabs .upk-holux-tabs-item .upk-holux-tabs-item-box .upk-holux-tabs-content .upk-holux-tabs-category a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function render_title() {
		$settings = $this->get_settings_for_display();
		if (!$this->get_settings('show_title')) {
			return;
		}

		printf('<%1$s class="upk-holux-tabs-title"><a href="%2$s" title="%3$s" class="upk-title">%3$s</a></%1$s>', Utils::get_valid_html_tag($settings['title_tags']), get_permalink(), get_the_title());

	}


	public function render_author() { ?>
		<div class="upk-holux-tabs-author">
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
				<i class="upk-icon-user"></i>
				<span class="upk-author-name"><?php echo get_the_author() ?></span>
			</a>
		</div>
	<?php
	}

	public function render_date() { ?>
		<div class="upk-holux-tabs-date">
			<i class="upk-icon upk-icon-calendar"></i>
			<span class="upk-date-text">
				<?php echo get_the_date(); ?>
			</span>
		</div>
	<?php
	}

	public function render_category() {
		$settings = $this->get_settings_for_display();
		foreach ($settings['filter_item_list'] as $key => $value) {
			if ($key == 0) :
				$post_type = $value['custom_post_type'];
			endif;
		}

		?>
		<div class="upk-holux-tabs-category">
			<?php echo upk_get_category($post_type); ?>
		</div>
		<?php
	}
	protected function render_header() {
		$settings = $this->get_settings_for_display();
		foreach ($settings['filter_item_list'] as $key => $value) {
			$trending_days_limit = $value['trending_days_limit'];
		}
		$this->add_render_attribute('holux-tabs', 'class', 'ultimate-post-kit-holux-tabs-wrap', true);
		$this->add_render_attribute(
			[
				'holux-tabs' => [
					'data-settings' => [
						wp_json_encode(array_filter(
							[
								'order' 				=> $settings['order'],
								'posts_per_page'   		=>  $settings['item_limit']['size'],
								'trending_days_limit' 	=> $trending_days_limit,
								'show_title' 			=>  isset($settings['show_title']) ? $settings['show_title'] : 'yes',
								'title_tags' 			=>  isset($settings['title_tags']) ? $settings['title_tags'] : 'h3',
								// 'title_word_limit' 		=> $settings['title_word_limit'],
								'show_category' 		=>  isset($settings['show_category']) ? $settings['show_category'] : 'yes',
								'show_meta' 			=>  isset($settings['show_meta']) ? $settings['show_meta'] : 'yes',
								'show_author' 			=>  isset($settings['show_author']) ? $settings['show_author'] : 'yes',
								'show_date' 			=>  isset($settings['show_date']) ? $settings['show_date'] : 'yes',
								'meta_separator' 		=> $settings['meta_separator']
							]
						))
					]
				]
			]
		);

	?>
		<div <?php $this->print_render_attribute_string('holux-tabs'); ?>>
			<ul class="upk-holux-tabs-header-tabs">
				<?php
				if ($settings['filter_item_list']) {
					foreach ($settings['filter_item_list'] as $key => $item) {
						$this->add_render_attribute(
							[
								'holux-tab-option' => [
									'data-settings' => [
										wp_json_encode(array_filter([
											'post_type'   =>  $item['custom_post_type'],
											'post_format' => $item['post_format'],
											'filter_by'   => $item['filter_by'],
										]))
									]
								]
							],
							'',
							'',
							true
						);
						$active_class = ($key == 0) ? 'upk-holux-tabs-active' : '';
				?>
						<li class="upk-holux-tabs-tabs-list <?php echo esc_attr($active_class); ?>">
							<?php printf('<a href="javascript:void(0)" class="post-tab-option" %2$s>%1$s</a>', $item['filter_label'], $this->get_render_attribute_string('holux-tab-option')); ?>
						</li>
				<?php
					}
				}
				?>
			</ul>
			<div class="upk-holux-tabs">
			<?php
		}
		protected function render_footer() { ?>
			</div>
		</div>
		<?php
		}
		protected function render_loop_item() {
			$settings = $this->get_settings_for_display();
			if (!(empty($settings['filter_item_list']))) {
				foreach ($settings['filter_item_list'] as $key => $tag) {
					if ($key == 0) :
						$post_type   =  $tag['custom_post_type'];
						$post_format = $tag['post_format'];
						$filter_by  = $tag['filter_by'];
						$trending_days_limit  = $tag['trending_days_limit'];
					endif;
				}
			}
			$query_args = [
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => $settings['item_limit']['size'],
				'order' => $settings['order'],
				'ignore_sticky_posts' => 1
			];

			if ($post_format == 'post') :
				switch ($post_format) {
					case 'standard':
						$query_args['tax_query'] = [
							[
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => [
									'post-format-aside', 'post-format-audio', 'post-format-chat', 'post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-video',
								],
								'operator' => 'NOT IN'
							]
						];
						break;
					case 'all':
						$query_args['tax_query'] = [];
						break;
					default:
						$query_args['tax_query'] = [
							[
								'taxonomy' => 'post_format',
								'field' => 'slug',
								'terms' => ['post-format-' . $post_format . ''],
							]
						];
						break;
				}
			endif;


			switch ($filter_by) {

				case 'popular':
					$query_args['orderby'] = 'comment_count';
					$query_args['order'] = 'DESC';
					break;
				case 'trending':
					$query_args['orderby'] = 'comment_count';
					$query_args['oroder'] = 'DESC';
					$query_args['date_query'] = [
						'after'  => '' . $trending_days_limit . ' days ago',
						'inclusive' => true,
					];
					break;
				default:
					$query_args['orderby'] = 'date';
					$query_args['order'] = 'DESC';
					break;
			}



			$wp_query = new \WP_Query($query_args);
			if (!$wp_query->found_posts) {
				return;
			}


			while ($wp_query->have_posts()) :
				$wp_query->the_post();
				$image_src = wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['primary_thumbnail_size']);
				$placeholder_image_src = Utils::get_placeholder_image_src();
				if (empty($image_src)) {
					$image_src = $placeholder_image_src;
				} ?>
			<div class="upk-holux-tabs-item">
				<div class="upk-holux-tabs-item-box">
					<div class="upk-holux-tabs-image">
						<a href="<?php echo get_permalink(); ?>">
							<img class="upk-img" src="<?php echo esc_url($image_src) ?>" alt="<?php echo get_the_title(); ?>">
						</a>
					</div>
					<div class="upk-holux-tabs-content">
						<?php
						if ($settings['show_category'] === 'yes') :
							$this->render_category();
						endif; ?>
						<?php
						if ($settings['show_title'] === 'yes') :
							$this->render_title();
						endif;
						?>
						<?php //if ($settings['show_meta'] === 'yes') :
						?>
						<div class="upk-holux-tabs-meta">
							<?php
							if ($settings['show_author'] == 'yes') :
								$this->render_author();
							endif;
							?>
							<span class="upk-separator"><?php echo esc_html($settings['meta_separator']); ?></span>
							<?php
							if ($settings['show_date'] === 'yes') :
								$this->render_date();
							endif;
							?>
						</div>
						<?php //endif;
						?>
					</div>
				</div>
			</div>
<?php endwhile;
			wp_reset_postdata();
		}
		protected function render() {
			$this->render_header();
			$this->render_loop_item();
			$this->render_footer();
		}
	}
