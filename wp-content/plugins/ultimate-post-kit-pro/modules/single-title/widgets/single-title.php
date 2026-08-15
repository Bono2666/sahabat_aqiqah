<?php

namespace UltimatePostKit\Modules\SingleTitle\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Single_Title extends Group_Control_Query {
	// use Global_Widget_Controls;
	public function get_name() {
		return 'upk-single-title';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Title', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-title';
	}

	public function get_categories() {
		return ['ultimate-post-kit-single'];
	}

	public function get_keywords() {
		return ['post', 'grid', 'blog', 'recent', 'news', 'title'];
	}

	// public function get_style_depends() {
	// 	if ($this->upk_is_edit_mode()) {
	// 		return ['upk-all-styles'];
	// 	} else {
	// 		return ['ultimate-post-kit-font', 'upk-alex-grid'];
	// 	}
	// }

	public function get_custom_help_url() {
		return 'https://youtu.be/criKI7Mm-5g';
	}

	public function register_controls() {
		$this->start_controls_section(
			'section_layout_title',
			[
				'label' => esc_html__('Title', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'title_alignment',
			[
				'label'         => esc_html__('Alignment', 'ultimate-post-kit'),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'left'      => [
						'title' => esc_html__('Left', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => esc_html__('Center', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-center',
					],
					'right'     => [
						'title' => esc_html__('Right', 'ultimate-post-kit'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'       => 'center',
				'selectors' => [
					'{{WRAPPER}} .upk-title' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_tags',
			[
				'label'     => __('Title HTML Tag', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h3',
				'options'   => ultimate_post_kit_title_tags(),
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
					'{{WRAPPER}} .upk-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-title',
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
				'selector'  => '{{WRAPPER}} .upk-title',
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
				'selector'  => '{{WRAPPER}} .upk-title',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'title_border',
				'selector'  => '{{WRAPPER}} .upk-title',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label'      => __('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'title_box_shadow',
				'selector'  => '{{WRAPPER}} .upk-title',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'title_text_padding',
			[
				'label'      => __('Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
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
					'{{WRAPPER}} .upk-title:hover a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_border_hover_color',
			[
				'label'     => esc_html__('Border Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-title:hover' => 'color: {{VALUE}};',
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
				'selector'  => '{{WRAPPER}} .upk-title:hover ',
				'condition' => [
					'title_advanced_style' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}
	protected function render() {
		printf('<%1$s class="upk-title"><a href="%2$s" alt="%3$s">%3$s</a></%1$s>', $this->get_settings('title_tags'), get_permalink(), get_the_title());
		// printf('<a class="upk-title" href="%2$s"><%1$s>%3$s</%1$s></a>', $this->get_settings('title_tags'), get_permalink(), get_the_title());
	}
}
