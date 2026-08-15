<?php

namespace UltimatePostKit\Modules\HoluxTabs;

use Elementor\Utils;
use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;
use WP_Query;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function __construct() {
		parent::__construct();
		add_action('wp_ajax_upk_holux_tabs', [$this, 'upk_holux_tabs_callback']);
		add_action('wp_ajax_nopriv_upk_holux_tabs', [$this, 'upk_holux_tabs_callback']);
	}

	public function get_name() {
		return 'holux-tabs';
	}

	public function get_widgets() {
		$widgets = [
			'Holux_Tabs',
		];

		return $widgets;
	}

	public function get_tab_output($output) {
        $tags = [
            'div'  => ['class' => []],
            'a'    => ['href'  => [], 'target'      => [], 'class' => [], 'data-bdt-tooltip' => []],
            'span' => ['class' => [], 'style' => []],
            'i'    => ['class' => [], 'aria-hidden' => []],
            'img'  => ['src'   => []],
            'h3'   => [
            	'class' => []
            ],
        ];

        if (isset($output)) {
            echo wp_kses($output, $tags);
        }
    }

	function upk_holux_tabs_callback() {

		$show_title          = sanitize_text_field($_POST['show_title']);
		$show_category       = sanitize_text_field($_POST['show_category']);
		$show_meta           = sanitize_text_field($_POST['show_meta']);
		$meta_separator      = sanitize_text_field($_POST['meta_separator']);
		$show_author         = sanitize_text_field($_POST['show_author']);
		$show_date           = sanitize_text_field($_POST['show_date']);
		$posts_per_page      = sanitize_text_field($_POST['posts_per_page']);
		$order 				 = sanitize_text_field($_POST['order']);
		$trending_days 		 = sanitize_text_field($_POST['trending_days_limit']);

		$post_type 			 = sanitize_text_field($_POST['post_type']);
		$post_format         = sanitize_text_field($_POST['post_format']);
		$filter_by 			 = sanitize_text_field($_POST['filter_by']);

		$query_args          = [
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => $posts_per_page,
			'order'          => $order
		];
		if (isset($post_format)) {
			switch ($post_format) {
				case 'standard':
					$query_args['tax_query'] = [
						[
							'taxonomy' => 'post_format',
							'field'    => 'slug',
							'terms'    => [
								'post-format-aside',
								'post-format-audio',
								'post-format-chat',
								'post-format-gallery',
								'post-format-link',
								'post-format-image',
								'post-format-quote',
								'post-format-status',
								'post-format-video',
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
							'field'    => 'slug',
							'terms'    => ['post-format-' . $post_format . ''],
						]
					];
					break;
			}
		}

		switch ($filter_by) {
			case 'trending':
				$query_args['orderby']    = 'comment_count';
				$query_args['order']      = 'DESC';
				$query_args['date_query'] = [
					'after'     => '' . $trending_days . ' days ago',
					'inclusive' => true,
				];
				break;
			case 'popular':
				$query_args['orderby'] = 'comment_count';
				$query_args['order']   = 'DESC';
				break;
			default:
				$query_args['orderby'] = 'date';
				$query_args['order']   = 'DESC';
				break;
		}


		$ajaxposts = new WP_Query($query_args);
		$response  = '';
		if ($ajaxposts->have_posts()) {
			while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
				$title = get_the_title();
				$post_link             = get_permalink();
				$image_src             = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');
				$category              = upk_get_category($post_type);
				$author_url            = get_author_posts_url(get_the_author_meta('ID'));
				$author_name           = get_the_author();
				$date                  = get_the_date();
				$placeholder_image_src = Utils::get_placeholder_image_src();
				if (empty($image_src)) {
					$image_src = $placeholder_image_src;
				}

				if (($show_author !== null) && ($show_author === 'yes')) {
					$response_author = '<div class="upk-holux-tabs-author"><a href="' . $author_url . '"><i class="upk-icon-user"></i><span class="upk-author-name">' . $author_name . '</span></a></div>';
				}
				if (($show_date !== null) && ($show_date === 'yes')) {
					$response_date = '<div class="upk-holux-tabs-date"><i class="upk-icon upk-icon-calendar"></i> <span class="upk-date-text">' . $date . '</span></div>';
				}

				$response .= '<div class="upk-holux-tabs-item"><div class="upk-holux-tabs-item-box">';
				$response .= '<div class="upk-holux-tabs-image"><a href="' . $post_link . '"><img  src="' . $image_src . '"></a></div>';
				$response .= '<div class="upk-holux-tabs-content">';
				if (($show_category !== null) && ($show_category === 'yes')) {
					$response .= '<div class="upk-holux-tabs-category">' . $category . '</div>';
				}
				if (($show_title !== null) && ($show_title === 'yes')) {
					$response .= '<h3 class="upk-holux-tabs-title"><a href="' . $post_link . '">' . $title . '</a></h3>';
				}
				if (($show_meta !== null) && ($show_meta === 'yes')) {
					$response .= '<div class="upk-holux-tabs-meta">' . $response_author . '<span class="upk-separator">' . $meta_separator . '</span>' . $response_date . '</div>';
				}
				$response .= '</div></div></div>';

			endwhile;
		} else {
			$response = '<span style="font-size:18px; text-transform:uppercase">posts not found</span>';
		}

		$this->get_tab_output($response);

		exit;
	}
}
