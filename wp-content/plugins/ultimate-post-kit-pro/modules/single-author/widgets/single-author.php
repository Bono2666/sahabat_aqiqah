<?php

namespace UltimatePostKit\Modules\SingleAuthor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;

if (!defined('ABSPATH')) {
	exit;
}

class Single_Author extends Group_Control_Query {
	public function get_name() {
		return 'upk-single-author';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Author', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-single-author';
	}

	public function get_categories() {
		return ['ultimate-post-kit-single'];
	}

	public function get_keywords() {
		return ['post', 'grid', 'blog', 'recent', 'news', 'single author'];
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
			'author_alignment',
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
					'{{WRAPPER}} .upk-author' => 'justify-content:{{VALUE}}'
				]
			]
		);
		$this->add_control(
			'show_name',
			[
				'label'     => esc_html__('Show Name', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'default'	=> 'yes'
			]
		);
		$this->add_control(
			'show_avatar',
			[
				'label'     => esc_html__('Show Avatar', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'avatar_size',
			[
				'label'     => esc_html__('Avatar Size', 'ultimate-post-kit'),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 500,
				'step'      => 1,
				'default'   => 96,
				'description' => esc_html__('Avatar width and height by pexels. for example: 96px', 'ultimate-post-kit'),
				'condition' => [
					'show_avatar' => 'yes'
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_meta',
			[
				'label'      => esc_html__('Name', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-author .upk-author-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-author .upk-author-name:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .upk-author .upk-author-name' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-author .upk-author-name',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_image_border',
				'selector' => '{{WRAPPER}} .upk-author .upk-author-image img',
			]
		);

		$this->add_responsive_control(
			'item_image_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-author .upk-author-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'item_image_box_shadow',
				'label'     => esc_html__('Box Shadow', 'ultimate-post-kit'),
				'selector'  => '{{WRAPPER}} .upk-author .upk-author-image img',
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display(); ?>
		<div class="upk-author upk-flex upk-flex-middle">
			<?php
			$posts = get_post(get_the_ID());
			$author_id =  $posts->post_author;
			if ('yes' == $settings['show_avatar']) :
				printf('<div class="upk-author-image">%s</div>', get_avatar($author_id, $settings['avatar_size']));
			endif;
			if ('yes' == $settings['show_name']) :
				printf('<div class="upk-author-name">%s</div>', get_the_author_meta('display_name', $author_id));
			endif;
			?>
		</div>
<?php
	}
}
