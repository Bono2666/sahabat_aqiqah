<?php

namespace UltimatePostKit\Modules\PixinaCarousel\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

use UltimatePostKit\Utils;
use UltimatePostKit\Traits\Global_Widget_Controls;
use UltimatePostKit\Traits\Global_Widget_Functions;
use UltimatePostKit\Traits\Global_Swiper_Functions;
use UltimatePostKit\Includes\Controls\GroupQuery\Group_Control_Query;
use WP_Query;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Pixina_Carousel extends Group_Control_Query {

	use Global_Widget_Controls;
	use Global_Widget_Functions;
	use Global_Swiper_Functions;

	private $_query = null;

	public function get_name() {
		return 'upk-pixina-carousel';
	}

	public function get_title() {
		return BDTUPK . esc_html__('Pixina Carousel', 'ultimate-post-kit');
	}

	public function get_icon() {
		return 'upk-widget-icon upk-icon-pixina-carousel';
	}

	public function get_categories() {
		return ['ultimate-post-kit-pro'];
	}

	public function get_keywords() {
		return ['post', 'carousel', 'blog', 'recent', 'news', 'pixina'];
	}

	public function get_style_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-styles'];
		} else {
			return ['ultimate-post-kit-font', 'upk-pixina-carousel'];
		}
	}

	public function get_script_depends() {
		if ($this->upk_is_edit_mode()) {
			return ['upk-all-scripts'];
		} else {
			return ['upk-pixina-carousel'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/ebSyK__cMhw';
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
			'columns',
			[
				'label' => __('Columns', 'ultimate-post-kit'),
				'type' => Controls_Manager::SELECT,
				'default' => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options' => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				],
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label' => __('Item Gap', 'ultimate-post-kit'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'primary_thumbnail',
				'exclude' => ['custom'],
				'default' => 'medium',
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
				'label'     => esc_html__('Item Limit', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 20,
					],
				],
				'default'   => [
					'size' => 6,
				],
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
			'show_excerpt',
			[
				'label'   => esc_html__('Show Text', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SWITCHER,
				'separator' => 'before'
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
			'show_meta',
			[
				'label'     => esc_html__('Show Meta', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_comments',
			[
				'label' => esc_html__('Show Comments', 'ultimate-post-kit'),
				'type'  => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		//Global Date Controls
		$this->register_date_controls();

		$this->add_control(
			'item_match_height',
			[
				'label'        => __('Item Match Height', 'ultimate-post-kit'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'prefix_class' => 'upk-item-match-height--',
				'separator'    => 'before'
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

		//Navigaiton Global Controls
		$this->register_navigation_controls('pixina');

		//Style
		$this->start_controls_section(
			'upk_section_style',
			[
				'label' => esc_html__('Items', 'ultimate-post-kit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_content_padding',
			[
				'label'      => esc_html__('Content Padding', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-inner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_items_style');

		$this->start_controls_tab(
			'tab_item_normal',
			[
				'label' => esc_html__('Normal', 'ultimate-post-kit'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'item_background',
				'selector'  => '{{WRAPPER}} .upk-pixina-carousel .upk-pixina-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-pixina-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_hover',
			[
				'label' => esc_html__('Hover', 'ultimate-post-kit'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'item_hover_background',
				'selector'  => '{{WRAPPER}} .upk-pixina-carousel .upk-pixina-item:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_hover_box_shadow',
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-pixina-item:hover',
			]
		);

		$this->add_responsive_control(
			'item_shadow_padding',
			[
				'label'       => __('Match Padding', 'ultimate-post-kit'),
				'description' => __('You have to add padding for matching overlaping normal/hover box shadow when you used Box Shadow option.', 'ultimate-post-kit'),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					]
				],
				'default'     => [
					'size' => 10
				],
				'selectors'   => [
					'{{WRAPPER}} .swiper-container' => 'padding: {{SIZE}}{{UNIT}}; margin: 0 -{{SIZE}}{{UNIT}};'
				],
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
			'title_style',
			[
				'label'   => esc_html__('Style', 'ultimate-post-kit'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'underline',
				'options' => [
					'underline'        => esc_html__('Underline', 'ultimate-post-kit'),
					'middle-underline' => esc_html__('Middle Underline', 'ultimate-post-kit'),
					'overline'         => esc_html__('Overline', 'ultimate-post-kit'),
					'middle-overline'  => esc_html__('Middle Overline', 'ultimate-post-kit'),
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'label'    => __('Text Shadow', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__('Spacing', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-title',
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
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-pixina-text',
			]
		);

		$this->add_responsive_control(
			'text_margin',
			[
				'label'      => __('Margin', 'ultimate-post-kit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_meta',
			[
				'label'      => esc_html__('Meta', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap .upk-pixina-category a, {{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap .upk-pixina-author' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap .upk-pixina-category a:hover, {{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap .upk-pixina-author:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_line_color',
			[
				'label'     => esc_html__('Line Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap .upk-author-icon' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap .upk-category-icon' => 'border-left-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap',
			]
		);

		$this->add_responsive_control(
			'meta_space_between',
			[
				'label'     => esc_html__('Category Space Between', 'ultimate-post-kit'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-meta-wrap .upk-pixina-category a + a' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_date',
			[
				'label'      => esc_html__('Date', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_date' => 'yes'
				],
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-post-time, {{WRAPPER}} .upk-pixina-carousel .upk-pixina-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'date_spacing',
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
					'{{WRAPPER}} .upk-pixina-carousel .upk-post-time, {{WRAPPER}} .upk-pixina-carousel .upk-pixina-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'date_space_between',
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
					'{{WRAPPER}} .upk-pixina-carousel .upk-post-time' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-post-time, {{WRAPPER}} .upk-pixina-carousel .upk-pixina-date',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_comments',
			[
				'label'      => esc_html__('Comments', 'ultimate-post-kit'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_comments' => 'yes'
				],
			]
		);

		$this->add_control(
			'comments_color',
			[
				'label'     => esc_html__('Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-comments' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'comments_background_color',
			[
				'label'     => esc_html__('Background Color', 'ultimate-post-kit'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-comments' => 'background: {{VALUE}};',
					'{{WRAPPER}} .upk-pixina-carousel .upk-pixina-comments::after' => 'border-top-color: {{VALUE}}; opacity: 0.7;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'comments_typography',
				'label'    => esc_html__('Typography', 'ultimate-post-kit'),
				'selector' => '{{WRAPPER}} .upk-pixina-carousel .upk-pixina-comments',
			]
		);

		$this->end_controls_section();

		//Navigation Global Controls
		$this->register_navigation_style('pixina');
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

	public function render_image($image_id, $size) {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		$image_src = wp_get_attachment_image_src($image_id, $size);

		if (!$image_src) {
			$image_src = $placeholder_image_src;
		} else {
			$image_src = $image_src[0];
		}

?>

		<img class="upk-img" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_html(get_the_title()); ?>">

	<?php
	}

	public function render_category() {

		if (!$this->get_settings('show_meta')) {
			return;
		}
	?>
		<div class="upk-pixina-category">
			<?php echo upk_get_category($this->get_settings('posts_source')); ?>
			<a href="<?php echo esc_url(get_permalink()) ?>" class="eicon-arrow-right upk-category-icon" aria-hidden="true"></a>
		</div>
	<?php
	}

	public function render_comments($id = 0) {

		if (!$this->get_settings('show_comments')) {
			return;
		}
	?>

		<div class="upk-pixina-comments">
			<?php echo get_comments_number($id) ?>
			<span><?php echo get_comments_number($id) ?> <?php echo esc_html__(' Comments', 'ultimate-post-kit') ?></span>
		</div>

	<?php
	}

	public function render_date() {
		$settings = $this->get_settings_for_display();


		if (!$this->get_settings('show_date')) {
			return;
		}

	?>
		<div class="upk-flex upk-flex-middle">
			<div class="upk-pixina-date">
				<?php if ($settings['human_diff_time'] == 'yes') {
					echo ultimate_post_kit_post_time_diff(($settings['human_diff_time_short'] == 'yes') ? 'short' : '');
				} else {
					echo get_the_date();
				} ?>
			</div>
			<?php if ($settings['show_time']) : ?>
				<div class="upk-post-time">
					<i class="upk-icon-clock" aria-hidden="true"></i>
					<?php echo get_the_time(); ?>
				</div>
			<?php endif; ?>
		</div>

	<?php
	}

	public function render_author() {

		if (!$this->get_settings('show_meta')) {
			return;
		}
	?>
		<a class="upk-pixina-author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
			<i class="eicon-user-circle-o upk-author-icon" aria-hidden="true"></i>
			<span><?php echo get_the_author() ?></span>
		</a>
	<?php
	}

	public function render_excerpt($excerpt_length) {

		if (!$this->get_settings('show_excerpt')) {
			return;
		}
		$strip_shortcode = $this->get_settings_for_display('strip_shortcode');
	?>
		<div class="upk-pixina-text">
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

	public function render_header() {
		//Global Function
		$this->render_header_attribute('pixina');

	?>
		<div <?php $this->print_render_attribute_string('carousel'); ?>>
			<div class="upk-pixina-carousel-wrapper">
				<div class="swiper-container">
					<div class="swiper-wrapper">
					<?php
				}

				public function render_post_carousel_item($post_id, $image_size, $excerpt_length) {
					$settings = $this->get_settings_for_display();

					if ('yes' == $settings['global_link']) {

						$this->add_render_attribute('carousel-item', 'onclick', "window.open('" . esc_url(get_permalink()) . "', '_self')", true);
					}

					$this->add_render_attribute('carousel-item', 'class', 'upk-pixina-item swiper-slide upk-transition-toggle', true);

					?>
						<div <?php $this->print_render_attribute_string('carousel-item'); ?>>
							<div class="upk-pixina-image-wrap">
								<?php $this->render_image(get_post_thumbnail_id($post_id), $image_size); ?>
							</div>
							<div class="upk-pixina-content-wrap">
								<div class="upk-pixina-inner-content">

									<?php $this->render_comments($post_id); ?>
									<?php $this->render_date(); ?>
									<?php $this->render_title(); ?>
									<?php $this->render_excerpt($excerpt_length); ?>

								</div>
							</div>
							<?php if ($settings['show_meta']) : ?>
								<div class="upk-pixina-meta-wrap">
									<?php $this->render_author(); ?>
									<?php $this->render_category(); ?>
								</div>
							<?php endif; ?>
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

					$this->render_header();

					while ($wp_query->have_posts()) {
						$wp_query->the_post();
						$thumbnail_size = $settings['primary_thumbnail_size'];

						$this->render_post_carousel_item(get_the_ID(), $thumbnail_size, $settings['excerpt_length']);
					}

					$this->render_footer();

					wp_reset_postdata();
				}
			}
