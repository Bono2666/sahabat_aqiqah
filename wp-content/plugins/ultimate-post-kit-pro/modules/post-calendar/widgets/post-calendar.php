<?php

namespace UltimatePostKit\Modules\PostCalendar\Widgets;

use UltimatePostKit\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Post_Calendar extends Module_Base {

    public function get_name() {
        return 'upk-post-calendar';
    }

    public function get_title() {
        return BDTUPK . esc_html__('Post Calendar', 'ultimate-post-kit');
    }

    public function get_icon() {
        return 'upk-widget-icon upk-icon-post-calendar';
    }

    public function get_categories() {
	    return [ 'ultimate-post-kit-pro' ];
    }

    public function get_keywords() {
        return [ 'post', 'event', 'blog', 'recent', 'news', 'calendar' ];
    }
    
    public function get_style_depends() {
        if ( $this->upk_is_edit_mode() ) {
            return [ 'upk-all-styles' ];
        } else {
            return [ 'upk-post-calendar' ];
        }
    }

    public function get_script_depends() {
		if ( $this->upk_is_edit_mode() ) {
			return [ 'upk-all-scripts' ];
		} else {
			return [ 'upk-post-calendar' ];
		}
	}

    public function get_custom_help_url() {
		return 'https://youtu.be/_MhyGAgj8yw';
	}

    protected function register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'ultimate-post-kit'),
            ]
        );
        $this->add_control(
            'show_posts_list',
            [
                'label'         => esc_html__('Posts List', 'ultimate-post-kit'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Show', 'ultimate-post-kit'),
                'label_off'     => esc_html__('Hide', 'ultimate-post-kit'),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => esc_html__( 'Gap', 'ultimate-post-kit' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .upk-calendar-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_posts_list' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'style_calendar',
            [
                'label' => __('Calendar', 'ultimate-post-kit'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'calendar_background',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'calendar_border',
                'label'          => __( 'Border', 'ultimate-post-kit' ),
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width'  => [
                        'default' => [
                            'top'      => '1',
                            'right'    => '1',
                            'bottom'   => '1',
                            'left'     => '1',
                            'isLinked' => false,
                        ],
                    ],
                    'color'  => [
                        'default' => '#dde3ec',
                    ],
                ],
                'selector'       => '{{WRAPPER}} .upk-post-calendar .upk-calendar table th, {{WRAPPER}} .upk-post-calendar .upk-calendar table td',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'calendar_padding',
            [
                'label'      => __('Padding', 'ultimate-post-kit'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .upk-post-calendar .upk-get-calendar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'calendar_day_height',
            [
                'label'     => __('Day Height', 'ultimate-post-kit'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table th, {{WRAPPER}} .upk-post-calendar .upk-calendar table td' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_calendar_month_year',
            [
                'label' => __('Calendar Month/Year', 'ultimate-post-kit'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'year_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar .upk-month-dropdown, {{WRAPPER}} .upk-post-calendar .upk-calendar caption .upk-year' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'month_dropdown_color',
            [
                'label'     => __('Dropdown Text Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar .upk-month-dropdown option' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'calender_spacing',
            [
                'label'     => __('Spacing', 'ultimate-post-kit'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar caption' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'year_space_between',
            [
                'label'     => __('Space Between', 'ultimate-post-kit'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar .upk-month-dropdown' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'year_typography',
                'label'    => __('Typography', 'ultimate-post-kit'),
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar caption *',
            ]
        );

        $this->add_responsive_control(
            'year_alignment',
            [
                'label'     => __('Alignment', 'ultimate-post-kit'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'ultimate-post-kit'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'ultimate-post-kit'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'ultimate-post-kit'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar caption' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_calendar_days',
            [
                'label' => __('Calendar Days', 'ultimate-post-kit'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'calendar_day_name_heading',
            [
                'label'     => __('DAY NAME', 'ultimate-post-kit'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'week_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table thead tr th' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'week_typography',
                'label'    => __('Typography', 'ultimate-post-kit'),
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table thead tr th',
            ]
        );

        $this->add_control(
            'calendar_days_heading',
            [
                'label'     => __('DAY NUMBER', 'ultimate-post-kit'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'day_typography',
                'label'    => __('Typography', 'ultimate-post-kit'),
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td span',
            ]
        );

        $this->start_controls_tabs(
            '_day_tabs'
        );
        $this->start_controls_tab(
            'day_tab_normal',
            [
                'label' => __('Normal', 'ultimate-post-kit'),
            ]
        );
        $this->add_control(
            'day_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table td' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'day_color_background',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td',
            ]
        );

        $this->add_control(
            'normal_days_hover',
            [
                'label'     => esc_html__('Hover', 'ultimate-post-kit'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'day_hover_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table td:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'day_hover_background',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td:hover',
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'day_tab_post',
            [
                'label' => __('Post', 'ultimate-post-kit'),
            ]
        );

        $this->add_control(
            'normal_day_color_post',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table td.upk-has-post span a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'day_color_background_post',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td.upk-has-post',
            ]
        );
        
        $this->add_control(
            'posts_day_hover',
            [
                'label'     => esc_html__('Hover', 'ultimate-post-kit'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'normal_hover_color_post',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table td.upk-has-post span:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'day_hover_background_post',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td.upk-has-post:hover',
            ]
        );
        
        
        $this->add_control(
            'posts_day_active',
            [
                'label'     => esc_html__('Active', 'ultimate-post-kit'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'normal_active_color_post',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table td.upk-has-post td.upk-has-post.upk-selected a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'day_active_background_post',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td.upk-has-post.upk-selected',
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'today_tab',
            [
                'label' => __('Today', 'ultimate-post-kit'),
            ]
        );

        $this->add_control(
            'today_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table td#today span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'today_color_background',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td#today',
            ]
        );
       
        $this->add_control(
            'today_heading_hover',
            [
                'label'     => esc_html__('Hover', 'ultimate-post-kit'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'today_color_hover',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-calendar table td#today span:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'today_color_hover_background',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-calendar table td#today:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_posts_list',
            [
                'label' => __('Posts List', 'ultimate-post-kit'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_posts_list' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'calendar_post_lists',
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists',
            ]
        );

        $this->add_responsive_control(
            'post_list_item_padding',
            [
                'label'      => __('Padding', 'ultimate-post-kit'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_post_list_style' );

		$this->start_controls_tab(
			'tab_post_heading',
			[
				'label'     => esc_html__( 'Heading', 'ultimate-post-kit' ),
			]
		);

        $this->add_control(
            'heading_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-date-wrapper' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_heading_spacing',
            [
                'label'     => __('Spacing', 'ultimate-post-kit'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-date-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'post_heading_typography',
                'label'    => __('Typography', 'ultimate-post-kit'),
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-date-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'tab_no_post_text',
			[
				'label'     => esc_html__( 'No Post Text', 'ultimate-post-kit' ),
			]
		);

        $this->add_control(
            'post_list_no_post_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-post-calendar-list li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'tab_post_title',
			[
				'label'     => esc_html__( 'Title', 'ultimate-post-kit' ),
			]
		);

        $this->add_control(
            'post_list_item_color',
            [
                'label'     => __('Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-post-calendar-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'post_list_item_line_color',
            [
                'label'     => __('Divider Color', 'ultimate-post-kit'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-post-calendar-list .upk-post-calendar-title' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_list_title_padding',
            [
                'label'      => __('Padding', 'ultimate-post-kit'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-post-calendar-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'post_list_item_margin',
            [
                'label'      => __('Margin', 'ultimate-post-kit'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-post-calendar-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'post_list_item_typography',
                'label'    => __('Typography', 'ultimate-post-kit'),
                'selector' => '{{WRAPPER}} .upk-post-calendar .upk-post-calendar-lists .upk-post-calendar-title a',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tab();

        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        if ($settings['show_posts_list'] === 'yes') {
            $this->add_render_attribute('upk-calender', 'class', ['upk-show-post-column', 'upk-calendar']);
        } else {
            $this->add_render_attribute('upk-calender', 'class', ['upk-hide-post-column', 'upk-calendar']);
        }

        $this->add_render_attribute(
            [
                'post-calendar' => [
                    'class'         => 'upk-post-calendar',
                    'action'        => site_url() . '/wp-admin/admin-ajax.php',
                    'data-settings' => [
                        wp_json_encode([
                            "id"           => 'upk-post-calendar-' . $this->get_id(),
                            "showPostList" => ($settings['show_posts_list'] == 'yes') ? 'yes' : 'no'
                        ]),
                    ],
                ],
            ]
        );

        ?>
        <div <?php $this->print_render_attribute_string('post-calendar'); ?>>
            <div class="upk-calendar-grid">
                <?php if ($settings['show_posts_list'] === 'yes') : ?>
                    <div class="upk-post-calendar-lists upk-frist-column">
                        <div class="upk-post-calendar-wrapper">
                            <h1 class="upk-date-wrapper">
                                <?php echo date("l"); ?>,
                                <span class="upk-full-date"><?php echo date("F jS"); ?></span>
                            </h1>
                            <ul class="upk-post-calendar-list"></ul>
                        </div>
                    </div>
                <?php endif; ?>

                <div <?php $this->print_render_attribute_string('upk-calender'); ?>>
                    <div class="upk-get-calendar"></div>
                </div>
            </div>
            <input type="hidden" id="upk-current-date" value="<?php echo date('Y/m/d'); ?>" class="upk-current-date" />
        </div>
        <?php
    }
}
