<?php

namespace UltimatePostKit\Modules\SingleComments\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;

if (!defined('ABSPATH')) {
	exit;
}

class Single_Comments extends Group_Control_Query {
	public function get_name() {
		return 'upk-single-comments';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Comments', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-comments';
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
			'section_layout_comments',
			[
				'label' => esc_html__('Layout', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$this->add_control(
			'header_text',
			[
				'label'       => esc_html__('Header Text', 'ultimate-post-kit'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__('Leave a Reply', 'ultimate-post-kit'),
			]
		);
		$this->add_control(
			'form_title_text',
			[
				'label'       => esc_html__('Form Title Text', 'ultimate-post-kit'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__('Comment', 'ultimate-post-kit'),
			]
		);

		$this->add_control(
			'form_btn_text',
			[
				'label'       => esc_html__('Button Text', 'ultimate-post-kit'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default' => esc_html__('Post Comment', 'ultimate-post-kit'),
			]
		);
		// $this->add_control(
		// 	'comments_alignment',
		// 	[
		// 		'label'         => esc_html__('Alignment', 'ultimate-post-kito'),
		// 		'type'          => Controls_Manager::CHOOSE,
		// 		'options'       => [
		// 			'flex-start'      => [
		// 				'title' => esc_html__('Left', 'ultimate-post-kito'),
		// 				'icon'  => 'eicon-h-align-left',
		// 			],
		// 			'center'    => [
		// 				'title' => esc_html__('Center', 'ultimate-post-kito'),
		// 				'icon'  => 'eicon-h-align-center',
		// 			],
		// 			'flex-end'     => [
		// 				'title' => esc_html__('Right', 'ultimate-post-kito'),
		// 				'icon'  => 'eicon-h-align-right',
		// 			],
		// 		],
		// 		'default'       => 'center',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .upk-comments-time' => 'justify-content:{{VALUE}}'
		// 		]
		// 	]
		// );
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_title',
			[
				'label'      => esc_html__('Title', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments .upk-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-comments .upk-title',
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
			'comments_link_color',
			[
				'label'     => esc_html__('Link Color', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'link_typography',
				'label'     => esc_html__('Typography', 'ultimate-woo-kit'),
				'selector'  => '{{WRAPPER}} .upk-comments a',
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
					'{{WRAPPER}} .upk-comments a' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-comments a',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'style_section_label',
			[
				'label' => esc_html__('Label', 'ultimate-woo-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'label_color',
			[
				'label'     => esc_html__('Color', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'label_spacing',
			[
				'label'         => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'          => Controls_Manager::SLIDER,
				'size_units'    => ['px'],
				'selectors' => [
					'{{WRAPPER}} .upk-comments label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'label_typography',
				'label'     => esc_html__('Typography', 'ultimate-woo-kit'),
				'selector'  => '{{WRAPPER}} .upk-comments label',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_section_form_input',
			[
				'label' => esc_html__('Input', 'ultimate-woo-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'input_color',
			[
				'label'     => esc_html__('Color', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments input, {{WRAPPER}} .upk-comments textarea' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'input_background',
			[
				'label'     => esc_html__('Background', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments input, {{WRAPPER}} .upk-comments textarea' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'input_border',
				'label'     => esc_html__('Border', 'ultimate-woo-kit'),
				'selector'  => '{{WRAPPER}} .upk-comments input, {{WRAPPER}} .upk-comments textarea',
			]
		);
		$this->add_responsive_control(
			'input_padding',
			[
				'label'                 => esc_html__('Padding', 'ultimate-woo-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-comments input, {{WRAPPER}} .upk-comments textarea'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'input_margin',
			[
				'label'                 => esc_html__('Margin', 'ultimate-woo-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-comments input, {{WRAPPER}} .upk-comments textarea'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'input_typography',
				'label'     => esc_html__('Typography', 'ultimate-woo-kit'),
				'selector'  => '{{WRAPPER}} .upk-comments input, {{WRAPPER}} .upk-comments textarea',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'style_section_button',
			[
				'label' => esc_html__('Button', 'ultimate-woo-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'button_style_tabs'
		);
		$this->start_controls_tab(
			'button_tab_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-woo-kit'),
			]
		);
		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__('Color', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments .form-submit .submit' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_background',
			[
				'label'     => esc_html__('Background', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments .form-submit .submit' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'button_tab_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-woo-kit'),
			]
		);
		$this->add_control(
			'btn_hover_color',
			[
				'label'     => esc_html__('Color', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments .form-submit .submit:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_hover_bg',
			[
				'label'     => esc_html__('Background', 'ultimate-woo-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-comments .form-submit .submit:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'button_padding',
			[
				'label'                 => esc_html__('Padding', 'ultimate-woo-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-comments .form-submit .submit'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
		$this->add_responsive_control(
			'button_margin',
			[
				'label'                 => esc_html__('Margin', 'ultimate-woo-kit'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', '%', 'em'],
				'selectors'             => [
					'{{WRAPPER}} .upk-comments .form-submit .submit'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => esc_html__('Typography', 'ultimate-woo-kit'),
				'selector'  => '{{WRAPPER}} .upk-comments .form-submit .submit',
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
		<div class="upk-comments upk-flex upk-flex-middle">
			<?php
			$comments_args = array(

				'title_reply_to'       => __('Leave a Reply to %s'),
				'title_reply_before'   => '<h3 id="reply-title" class="upk-title comment-reply-title">',
				'title_reply_after'    => '</h3>',
				'cancel_reply_before'  => ' <small>',
				'cancel_reply_after'   => '</small>',
				'cancel_reply_link'    => __('Cancel reply'),
				'label_submit'         => $settings['form_btn_text'],
				// 'label_submit' => 'Send',
				'title_reply' => $settings['header_text'],
				'comment_notes_after' => '',
				'comment_field' => '<p class="comment-form-comment">
				<label for="comment">' . $settings['form_title_text'] . '</label><br />
				<textarea id="comment" name="comment" aria-required="true"></textarea></p>',
			);

			comment_form($comments_args, 1);

			?>
		</div>
<?php
	}
}
