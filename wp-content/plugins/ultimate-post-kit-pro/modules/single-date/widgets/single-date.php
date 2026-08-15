<?php

namespace UltimatePostKit\Modules\SingleDate\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;

if (!defined('ABSPATH')) {
	exit;
}

class Single_Date extends Group_Control_Query {
	public function get_name() {
		return 'upk-single-date';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Date', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-date';
	}

	public function get_categories() {
		return ['ultimate-post-kit-single'];
	}

	public function get_keywords() {
		return ['post', 'grid', 'blog', 'recent', 'news', 'content'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/criKI7Mm-5g';
	}

	public function register_controls() {
		$this->start_controls_section(
			'section_layout_date',
			[
				'label' => esc_html__('Date', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);
		$this->add_control(
			'date_alignment',
			[
				'label'         => esc_html__('Alignment', 'ultimate-post-kito'),
				'type'          => Controls_Manager::CHOOSE,
				'options'       => [
					'flex-start'      => [
						'title' => esc_html__('Left', 'ultimate-post-kito'),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => esc_html__('Center', 'ultimate-post-kito'),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'     => [
						'title' => esc_html__('Right', 'ultimate-post-kito'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'       => 'center',
				'selectors' => [
					'{{WRAPPER}} .upk-date-time' => 'justify-content:{{VALUE}}'
				]
			]
		);
		$this->add_control(
			'show_date',
			[
				'label'     => esc_html__('Show Time', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'default'	=> 'yes'
			]
		);
		$this->add_control(
			'human_diff_time',
			[
				'label'     => esc_html__('Human Different Time', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'human_diff_time_short',
			[
				'label'       => esc_html__(
					'Time Short Format',
					'ultimate-post-kit'
				),
				'description' => esc_html__(
					'This will work for Hours, Minute and Seconds',
					'ultimate-post-kit'
				),
				'type'        => Controls_Manager::SWITCHER,
				'condition'   => [
					'human_diff_time' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_time',
			[
				'label'     => esc_html__('Show Time', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'human_diff_time' => ''
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_meta',
			[
				'label'      => esc_html__('Meta', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-date-time .upk-date, {{WRAPPER}} .upk-date-time .upk-time' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-date-time .upk-date:hover, {{WRAPPER}} .upk-date-time .upk-time:hover' => 'color: {{VALUE}};',
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
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-date-time .upk-date' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-date-time .upk-date, {{WRAPPER}} .upk-date-time .upk-time',
			]
		);

		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
		<div class="upk-date-time upk-flex upk-flex-middle">
			<?php if ($settings['show_date']) : ?>
				<div class="upk-date">
					<?php if ($settings['human_diff_time'] == 'yes') {
						echo ultimate_post_kit_post_time_diff(($settings['human_diff_time_short'] == 'yes') ? 'short' : '');
					} else {
						echo get_the_date();
					} ?>
				</div>
			<?php endif; ?>
			<?php if ($settings['show_time']) : ?>
				<div class="upk-time">
					<i class="upk-icon-clock" aria-hidden="true"></i>
					<?php echo get_the_time(); ?>
				</div>
			<?php endif; ?>
		</div>
<?php
	}
}
