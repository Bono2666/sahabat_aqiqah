<?php

namespace UltimatePostKit\Modules\BerlinSlider\Widgets;

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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Berlin_Slider extends Group_Control_Query {
	use Global_Widget_Controls;
	use Global_Widget_Functions;

	private $_query = null;

	public function get_name() {
		return 'upk-berlin-slider';
	}

	public function get_title() {
		return esc_html__( 'Berlin Slider', 'ultimate-post-kit' );
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-berlin-slider upk-new';
	}

	public function get_categories() {
		return array( 'ultimate-post-kit-pro' );
	}

	public function get_keywords() {
		return array( 'berlin', 'slider', 'post', 'blog', 'recent', 'news', 'soft', 'video', 'gallery', 'youtube' );
	}

	public function get_style_depends() {
		if ( $this->upk_is_edit_mode() ) {
			return array( 'elementor-icons-fa-solid', 'upk-all-styles' );
		} else {
			return array( 'elementor-icons-fa-solid', 'upk-berlin-slider' );
		}
	}

	public function get_script_depends() {
		if ( $this->upk_is_edit_mode() ) {
			return array( 'upk-all-scripts' );
		} else {
			return array( 'upk-berlin-slider' );
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
			array(
				'label' => esc_html__( 'Layout', 'ultimate-post-kit' ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'   => esc_html__( 'Image Size', 'ultimate-post-kit' ),
				'name'    => 'primary_thumbnail',
				'exclude' => array( 'custom' ),
				'default' => 'full',
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'label'   => esc_html__( 'Thumbnail Size', 'ultimate-post-kit' ),
				'name'    => 'secondary_thumbnail',
				'exclude' => array( 'custom' ),
				'default' => 'thumbnail',
			)
		);

		//Global Title Controls
		$this->register_title_controls();

		$this->add_control(
			'show_category',
			array(
				'label'     => esc_html__( 'Category', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_author',
			array(
				'label'   => esc_html__( 'Author', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_meta',
			array(
				'label'   => esc_html__( 'Meta', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'meta_separator',
			array(
				'label'       => __( 'Separator', 'ultimate-post-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '//',
				'label_block' => false,
			)
		);

		//Global Date Controls
		$this->register_date_controls();

		$this->end_controls_section();
		//New Query Builder Settings
		$this->start_controls_section(
			'section_post_query_builder',
			array(
				'label' => __( 'Query', 'ultimate-post-kit' ) . BDTUPK_NC,
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'item_limit',
			array(
				'label'   => esc_html__( 'Item Limit', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 5,
					),
				),
				'default' => array(
					'size' => 5,
				),
			)
		);

		$this->register_query_builder_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_settings',
			array(
				'label' => __( 'Slider Settings', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label' => __( 'Autoplay', 'ultimate-post-kit' ),
				'type'  => Controls_Manager::SWITCHER,

			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'     => esc_html__( 'Autoplay Speed', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'grab_cursor',
			array(
				'label' => __( 'Grab Cursor', 'ultimate-post-kit' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'   => __( 'Loop', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',

			)
		);

		$this->add_control(
			'speed',
			array(
				'label'   => __( 'Animation Speed (ms)', 'ultimate-post-kit' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'size' => 500,
				),
				'range'   => array(
					'px' => array(
						'min'  => 100,
						'max'  => 5000,
						'step' => 50,
					),
				),
			)
		);

		$this->add_control(
			'observer',
			array(
				'label'       => __( 'Observer', 'ultimate-post-kit' ),
				'description' => __( 'When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'ultimate-post-kit' ),
				'type'        => Controls_Manager::SWITCHER,
			)
		);

		$this->end_controls_section();

		// style

		$this->start_controls_section(
			'style_slider_main_image',
			array(
				'label' => esc_html__( 'Image', 'ultimate-post-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'image_background_overlay',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-img-wrap::before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-img-wrap',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-img-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_play_button',
			array(
				'label' => esc_html__( 'Play Button', 'ultimate-post-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'play_button_size',
			array(
				'label'     => __( 'Size', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 40,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-play-btn a' => '--upk-play-btn-h-w: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'play_button_icon_size',
			array(
				'label'     => __( 'Icon Size', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-play-btn' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'tabs_play_button'
		);

		$this->start_controls_tab(
			'normal_tab_play_button',
			array(
				'label' => __( 'Normal', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'play_button_color',
			array(
				'label'     => __( 'Icon Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-play-btn a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'play_button_bg',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-play-btn a',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'play_button_border',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-play-btn a',
			)
		);

		$this->add_responsive_control(
			'play_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-play-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_tab_play_button',
			array(
				'label' => __( 'Hover', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'play_button_color_hover',
			array(
				'label'     => __( 'Icon Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-main-slider .upk-play-btn:hover a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'play_button_bg_hover',
				'selector' => '{{WRAPPER}} .upk-main-slider .upk-play-btn:hover a',
			)
		);

		$this->add_control(
			'play_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-main-slider .upk-play-btn:hover a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'play_button_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			array(
				'label'     => esc_html__( 'Title', 'ultimate-post-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_title' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			array(
				'label' => esc_html__( 'Normal', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'ultimate-post-kit' ),
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-title',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-title a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_category',
			array(
				'label'     => esc_html__( 'Category', 'ultimate-post-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_category' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_category_style' );

		$this->start_controls_tab(
			'tab_category_normal',
			array(
				'label' => esc_html__( 'Normal', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => esc_html__( 'Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'category_background',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'category_border',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a',
			)
		);

		$this->add_responsive_control(
			'category_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'category_padding',
			array(
				'label'      => esc_html__( 'Padding', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'category_spacing',
			array(
				'label'     => esc_html__( 'Spacing Between', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 2,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a+a' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Typography', 'ultimate-post-kit' ),
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_category_hover',
			array(
				'label' => esc_html__( 'Hover', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'category_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'category_hover_background',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a:hover',
			)
		);

		$this->add_control(
			'category_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'category_border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-category a:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_meta',
			array(
				'label'      => esc_html__( 'Meta', 'ultimate-post-kit' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'  => 'show_author',
							'value' => 'yes',
						),
					),
				),
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'     => esc_html__( 'Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-meta, {{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-author a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'meta_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-author a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-date:hover'     => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'meta_space_between',
			array(
				'label'     => esc_html__( 'Space Between', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_typography',
				'label'    => esc_html__( 'Typography', 'ultimate-post-kit' ),
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-main-slider .upk-meta',
			)
		);

		$this->end_controls_section();

		// start thumbnail style

		$this->start_controls_section(
			'style_playlist',
			array(
				'label' => esc_html__( 'Thumbnail', 'ultimate-post-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'item_heading',
			array(
				'label' => esc_html__( 'I T E M', 'ultimate-post-kit' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'style_item_tabs'
		);

		$this->start_controls_tab(
			'style_item_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'ultimate-post-kit' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_background',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-img-wrap::before',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_item_active_tab',
			array(
				'label' => esc_html__( 'Active', 'ultimate-post-kit' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'item_background_active',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-item.swiper-slide-active .upk-img-wrap::before',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'playlist_heading',
			array(
				'label'     => esc_html__( 'Image', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'playlist_thumb_width_border',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-img-wrap',
			)
		);

		$this->add_responsive_control(
			'playlist_thumb_width_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-img-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
				),
			)
		);

		$this->add_control(
			'playlist_play_icon_heading',
			array(
				'label'     => esc_html__( 'P L A Y I C O N', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'playlist_play_button_size',
			array(
				'label'      => esc_html__( 'Play Button Size', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 12,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-play-btn a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'playlist_play_icon_size',
			array(
				'label'      => esc_html__( 'Play Icon Size', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 8,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-play-btn a' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'tabs_play_button_thumbs'
		);

		$this->start_controls_tab(
			'normal_tab_play_button_thumbs',
			array(
				'label' => __( 'Normal', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'play_button_thumbs_color',
			array(
				'label'     => __( 'Icon Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-play-btn a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'play_button_thumbs_bg',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-play-btn a',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'play_button_thumbs_border',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-play-btn a',
			)
		);

		$this->add_responsive_control(
			'play_button_thumbs_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-play-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover_tab_play_button_thumbs',
			array(
				'label' => __( 'Hover', 'ultimate-post-kit' ),
			)
		);

		$this->add_control(
			'play_button_thumbs_color_hover',
			array(
				'label'     => __( 'Icon Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-thumbs-slider .upk-play-btn:hover a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'play_button_thumbs_bg_hover',
				'selector' => '{{WRAPPER}} .upk-thumbs-slider .upk-play-btn:hover a',
			)
		);

		$this->add_control(
			'play_button_thumbs_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-thumbs-slider .upk-play-btn:hover a' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'play_button_thumbs_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'title_heading',
			array(
				'label'     => esc_html__( 'T I T L E', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'playlist_title_color',
			array(
				'label'     => __( 'Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'playlist_title_typo',
				'selector' => '{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-title',
			)
		);

		$this->add_control(
			'playlist_title_color_hover',
			array(
				'label'     => __( 'Hover Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-thumbs-slider .upk-content:hover .upk-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'playlist_title_color_active',
			array(
				'label'     => __( 'Active Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .swiper-slide-active .upk-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'topbar_heading',
			array(
				'label'     => esc_html__( 'T O P B A R', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'topbar_active_color',
			array(
				'label'     => __( 'Active Color', 'ultimate-post-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-item.swiper-slide-active .upk-img-wrap::after' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'topbar_size',
			array(
				'label'      => esc_html__( 'Size', 'ultimate-post-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .upk-berlin-slider .upk-thumbs-slider .upk-img-wrap::after' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Main query render for this widget
	 * @param $posts_per_page number item query limit
	 */
	public function query_posts( $posts_per_page ) {

		$default = $this->getGroupControlQueryArgs();
		if ( $posts_per_page ) {
			$args['posts_per_page'] = $posts_per_page;
			$args['paged']          = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
		}

		$args         = array_merge( $default, $args );
		$this->_query = new WP_Query( $args );
	}

	public function render_image( $image_id, $size ) {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		$image_src = wp_get_attachment_image_src( $image_id, $size );

		if ( ! $image_src ) {
			$image_src = $placeholder_image_src;
		} else {
			$image_src = $image_src[0];
		}

		?>

		<img class="upk-img" src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_html( get_the_title() ); ?>">

		<?php
	}

	public function render_playlist_title() {
		$settings = $this->get_settings_for_display();

		if ( ! $this->get_settings( 'show_title' ) ) {
			return;
		}

		printf( '<%1$s class="upk-title"><a href="%2$s" title="%3$s">%3$s</a></%1$s>', Utils::get_valid_html_tag( $settings['title_tags'] ), 'javascript:void(0);', get_the_title() );
	}

	public function render_title() {
		$settings = $this->get_settings_for_display();

		if ( ! $this->get_settings( 'show_title' ) ) {
			return;
		}

		printf( '<%1$s class="upk-title" data-swiper-parallax="-300" data-swiper-parallax-duration="600"><a href="%2$s" title="%3$s">%3$s</a></%1$s>', Utils::get_valid_html_tag( $settings['title_tags'] ), get_permalink(), get_the_title() );
	}


	public function render_date() {
		$settings = $this->get_settings_for_display();

		if ( ! $this->get_settings( 'show_date' ) ) {
			return;
		}

		?>
		<div class="upk-flex upk-flex-middle">
			<div class="upk-date">
				<i class="eicon-calendar upk-author-icon" aria-hidden="true"></i>
				<span>
					<?php
					if ( 'yes' == $settings['human_diff_time'] ) {
						echo ultimate_post_kit_post_time_diff( ( $settings['human_diff_time_short'] == 'yes' ) ? 'short' : '' );
					} else {
						echo get_the_date();
					}
					?>
				</span>
			</div>
			<?php if ( $settings['show_time'] ) : ?>
				<div class="upk-post-time">
					<i class="upk-icon-clock" aria-hidden="true"></i>
					<?php echo get_the_time(); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}

	public function render_author() {

		if ( ! $this->get_settings( 'show_author' ) ) {
			return;
		}
		?>
		<div class="upk-author">
			<i class="eicon-user-circle-o upk-author-icon" aria-hidden="true"></i>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a>
		</div>

		<?php
	}

	/**
	 * @param $excerpt_length
	 * @return void
	 */
	public function render_excerpt( $excerpt_length ) {

		if ( ! $this->get_settings( 'show_excerpt' ) ) {
			return;
		}
		$strip_shortcode = $this->get_settings_for_display( 'strip_shortcode' );
		?>
		<div class="upk-text">
			<?php
			if ( has_excerpt() ) {
				the_excerpt();
			} else {
				echo ultimate_post_kit_custom_excerpt( $excerpt_length, $strip_shortcode );
			}
			?>
		</div>

		<?php
	}

	public function video_link_render( $video ) {
		$youtube_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video, $match ) ) ? $match[1] : false;

		$vimeo_id = ( preg_match( '%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $video, $match ) ) ? $match[3] : false;

		if ( $youtube_id ) {
			// $video_source    = 'https://www.youtube.com/watch?v=' . $youtube_id;
			$video_source = 'https://www.youtube.com/embed/' . $youtube_id;
		} elseif ( $vimeo_id ) {
			$video_source = 'https://vimeo.com/' . $vimeo_id;
		} else {
			$video_source = false;
		}
		return $video_source;
	}

	public function render_playlist_item( $post_id, $image_size, $video_link ) {
		$video_link = $this->video_link_render( $video_link );
		?>
		<div class="upk-item swiper-slide">
			<div class="upk-img-wrap">
				<?php $this->render_image( get_post_thumbnail_id( $post_id ), $image_size ); ?>
			</div>


			<div class="upk-content">

				<?php if ( $video_link ) : ?>
					<div class="upk-play-btn">
						<a href="javascript:void(0);">
							<i class="fas fa-play"></i>
						</a>
					</div>
				<?php endif; ?>

				<?php $this->render_playlist_title(); ?>
			</div>
		</div>
		<?php
	}

	public function render_item( $post_id, $image_size, $video_link ) {
		$settings   = $this->get_settings_for_display();
		$video_link = $this->video_link_render( $video_link );
		?>
		<div class="upk-item swiper-slide">
			<div class="upk-img-wrap">
				<?php $this->render_image( get_post_thumbnail_id( $post_id ), $image_size ); ?>
			</div>

			<div class="upk-content">

				<!-- edit by asik start 16-2022 -->
				<?php if ( $video_link ) : ?>
					<div class="upk-play-button-wrapper upk-video-trigger" data-src="<?php echo esc_url( $video_link ); ?>">
						<input type="checkbox">
						<div class="upk-video-wrap upk-play-btn-video">
							<iframe class="upk-video-iframe" allow="autoplay;" src="<?php echo esc_url( $video_link ); ?>"></iframe>
						</div>
						<div class="upk-play-btn">
							<a href="javascript:void(0);" class="upk-play-icon-wrap">
								<i class="fas fa-play"></i>
							</a>
						</div>
					</div>
				<?php endif; ?>
				<!-- edit by asik end 16-2022 -->


				<div data-swiper-parallax="-200">
					<?php $this->render_category(); ?>
				</div>
				<?php $this->render_title(); ?>
				<div class="upk-meta" data-swiper-parallax="-400" data-swiper-parallax-duration="800">
					<?php $this->render_author(); ?>
					<div class="upk-separator">
						<span>
							<?php echo esc_html( $settings['meta_separator'] ); ?>
						</span>
					</div>
					<?php $this->render_date(); ?>
				</div>
			</div>
		</div>
		<?php
	}


	public function render_header() {
		$settings = $this->get_settings_for_display();

		$id       = 'upk-berlin-slider-' . $this->get_id();
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'berlin-slide', 'id', $id );
		$this->add_render_attribute(
			'berlin-slide',
			'class',
			array(
				'upk-berlin-slider',
			)
		);

		$this->add_render_attribute(
			array(
				'berlin-slide' => array(
					'data-widget'   => array(
						wp_json_encode(
							array_filter(
								array(
									'id' => '#' . $id,
								)
							)
						),
					),
					'data-settings' => array(
						wp_json_encode(
							array_filter(
								array(
									'autoplay'       => ( 'yes' == $settings['autoplay'] ) ? array( 'delay' => $settings['autoplay_speed'] ) : false,
									'loop'           => ( $settings['loop'] == 'yes' ) ? true : false,
									'speed'          => $settings['speed']['size'],
									'effect'         => 'fade',
									'fadeEffect'     => array( 'crossFade' => true ),
									// "lazy"           => true,
									'parallax'       => true,
									'grabCursor'     => ( $settings['grab_cursor'] === 'yes' ) ? true : false,
									'pauseOnHover'   => true,
									'slidesPerView'  => 1,
									'observer'       => ( $settings['observer'] ) ? true : false,
									'observeParents' => ( $settings['observer'] ) ? true : false,
									'loopedSlides'   => 4,
									'lazy'           => array(
										'loadPrevNext' => 'true',
									),
								)
							)
						),
					),
				),
			)
		);

		?>
		<div <?php $this->print_render_attribute_string( 'berlin-slide' ); ?>>
		<?php
	}

	public function render_footer() {
		?>
		</div>
		<?php
	}

	public function render() {

		$available_video_link = ultimate_post_kit_option( 'video_link', 'ultimate_post_kit_other_settings', 'off' );

		if ( $available_video_link == 'on' ) {
			$settings = $this->get_settings_for_display();

			$this->query_posts( $settings['item_limit']['size'] );
			$wp_query = $this->get_query();

			if ( ! $wp_query->found_posts ) {
				return;
			}

			$this->render_header();
			?>
			<div class="upk-main-slider swiper-container">
				<div class="swiper-wrapper">
					<?php
					while ( $wp_query->have_posts() ) {
						$wp_query->the_post();
						$video_link = get_post_meta( get_the_ID(), '_upk_video_link_meta_key', true );
						//if ( $video_link ) {
						$thumbnail_size = $settings['primary_thumbnail_size'];
						$this->render_item( get_the_ID(), $thumbnail_size, $video_link );
						//}
					}
					?>
				</div>
			</div>

			<div class="upk-thumbs-slider swiper-container">
				<div class="swiper-wrapper">
					<?php
					while ( $wp_query->have_posts() ) {
						$wp_query->the_post();
						$video_link = get_post_meta( get_the_ID(), '_upk_video_link_meta_key', true );
						//if ( $video_link ) {
						$thumbnail_size = $settings['secondary_thumbnail_size'];
						$this->render_playlist_item( get_the_ID(), $thumbnail_size, $video_link );
						//}
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
