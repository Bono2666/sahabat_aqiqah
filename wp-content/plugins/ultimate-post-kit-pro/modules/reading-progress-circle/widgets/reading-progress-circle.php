<?php
namespace UltimatePostKit\Modules\ReadingProgressCircle\Widgets;

use UltimatePostKit\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class News Ticker
 */
class Reading_Progress_Circle extends Module_Base {

	public function get_name() {
		return 'upk-reading-progress-circle';
	}

	public function get_title() {
		return BDTUPK . esc_html__( 'Reading Progress Circle', 'ultimate-post-kit' );
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-reading-progress-circle';
	}

	public function get_categories() {
		return [ 'ultimate-post-kit' ];
	}

	public function get_keywords() {
		return [ 'bar', 'scroll', 'animate', 'line', 'scrolline', 'pop', 'reading progress', 'circle' ];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['upk-reading-progress-circle'];
		}
	}

	public function get_script_depends() {
		if ( $this->upk_is_edit_mode() ) {
			return [ 'upk-all-scripts' ];
		} else {
			return [ 'upk-reading-progress-circle' ];
		}
	}

	// public function get_custom_help_url() {
	// 	return 'https://youtu.be/xiKwQActvwk';
	// }

	protected function register_controls() {
		$this->start_controls_section(
			'section_reading_progress',
			[
				'label'     => esc_html__( 'Reading Progress', 'ultimate-post-kit' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'circle_position',
			[
				'label'   => esc_html__( 'Position', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-right',
				'options' => [
					'top-left'     => esc_html__( 'Top Left', 'ultimate-post-kit' ),
					'top-right'    => esc_html__( 'Top Right', 'ultimate-post-kit' ),
					'bottom-left'  => esc_html__( 'Bottom Left', 'ultimate-post-kit' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'ultimate-post-kit' ),
				],
				'prefix_class' => 'upk-reading-circle--',
				'render_type' => 'template'
			]
		);

		$this->add_responsive_control(
			'circle_size',
			[
				'label'   => esc_html__( 'Circle Size', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #upk-reading-progress-circle' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'circle_spacing',
			[
				'label'   => esc_html__( 'Circle Spacing', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} #upk-reading-progress-circle' => 'margin: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_width',
			[
				'label'   => esc_html__( 'Thickness', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #upk-reading-progress-circle-value' => 'height: calc(100% - {{SIZE}}px); width: calc(100% - {{SIZE}}px);',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'   => esc_html__( 'Radius', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} #upk-reading-progress-circle, {{WRAPPER}} #upk-reading-progress-circle-value' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'zindex',
			[
				'label'   => esc_html__( 'Z-index', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} #upk-reading-progress-circle' => 'z-index: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_reading_progress',
			[
				'label'     => esc_html__( 'Reading Progress', 'ultimate-post-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__('Text Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #upk-reading-progress-circle-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__('Background Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #upk-reading-progress-circle-value' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'base_color',
            [
                'label'     => __('Base Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'  => '#c2cbd2',
            ]
        );

        $this->add_control(
            'fill_color',
            [
                'label'     => __('Fill Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'  => '#e62a3f',
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'value_typography',
				'label'     => esc_html__('Typography', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} #upk-reading-progress-circle-value',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'circle_box_shadow',
				'selector' => '{{WRAPPER}} #upk-reading-progress-circle',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

	    $this->add_render_attribute(
			[
				'reading-progress-circle-settings' => [
					'id'			=> 'upk-reading-progress-circle',
					'data-settings' => [
						wp_json_encode(array_filter([
							"baseColor" => $settings['base_color'],
						    "fillColor"   => $settings['fill_color'],
						]))
					],
				]
			]
		);

		?>
		<div <?php $this->print_render_attribute_string( 'reading-progress-circle-settings' ); ?>>
        	<span id="upk-reading-progress-circle-value"></span>
		</div>
		<?php
	}
}
