<?php

namespace UltimatePostKit\Modules\ForbesTabs;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

    public function __construct() {
        parent::__construct();


        add_action('wp_ajax_upk_forbes_tabs', [$this, 'upk_forbes_tabs_callback']);
        add_action('wp_ajax_nopriv_upk_forbes_tabs', [$this, 'upk_forbes_tabs_callback']);
    }

    public function get_name() {
        return 'forbes-tabs';
    }

    public function get_widgets() {

        $widgets = [
            'Forbes_Tabs',
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

    function upk_forbes_tabs_callback() {

        $category_slug    = sanitize_text_field($_POST['category']);
        $show_title       = sanitize_text_field($_POST['show_title']);
        $show_category    = sanitize_text_field($_POST['show_category']);
        $show_meta        = sanitize_text_field($_POST['show_meta']);
        $show_author      = sanitize_text_field($_POST['show_author']);
        $post_type        = sanitize_text_field($_POST['post_type']);
        $taxonomy         = sanitize_text_field($_POST['taxonomy']);
        $title_text_limit = sanitize_text_field($_POST['title_text_limit']);
        $order            = sanitize_text_field($_POST['order']);
        $orderby          = sanitize_text_field($_POST['orderby']);
        $separator        = sanitize_text_field($_POST['meta_separator']);

        $query_args = [
            'post_status'    => 'publish',
            'post_type'      => $post_type,
            'order'          => $order,
            'orderby'        => $orderby,
            'posts_per_page' => 7,
        ];
        if ($category_slug !== '') {
            $query_args['tax_query'] = [
                [
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $category_slug,
                ]
            ];
        }
        $ajaxposts = new \WP_Query($query_args);
        $response  = '';
        if ($ajaxposts->have_posts()) {
            $item_index = 1;
            while ($ajaxposts->have_posts()) :
                if ($item_index > 7) {
                    break;
                }
                $ajaxposts->the_post();
                $title                 = wp_trim_words(get_the_title(), $title_text_limit, '...');
                $post_link             = get_permalink();
                $image_src             = wp_get_attachment_image_url(get_post_thumbnail_id(), 'full');
                $category              = upk_get_category($post_type);
                $author_url            = get_author_posts_url(get_the_author_meta('ID'));
                $author_name           = get_the_author();
                $date                  = get_the_date();
                $placeholder_image_src = \Elementor\Utils::get_placeholder_image_src();
                if (empty($image_src)) {
                    $image_src = $placeholder_image_src;
                }
                $response .= '<div class="upk-forbes-tabs-grid-item">';
                $response .= '<div class="upk-forbes-tabs-grid-item-box">';
                $response .= '<div class="upk-image-wrapper">';
                $response .= '<a href="' . esc_url($post_link) . '"><img alt="" class="upk-img" src="' . esc_url($image_src) . '"></a>';
                $response .= '</div>';
                $response .= '<div class="upk-forbes-tabs-content-box">';
                if ($show_category === 'yes') :
                    $response .= '<div class="upk-forbes-tabs-category">';
                    $response .= $category;
                    $response .= '</div>';
                endif;
                if ($show_title === 'yes') :
                    $response .= '<a class="upk-forbes-tabs-title" href="' . esc_url($post_link) . '">';
                    $response .= '<h3 class="upk-title">' . $title . '</h3>';
                    $response .= '</a>';
                endif;
                if ($show_meta === 'yes') :
                    $response .= '<div class="upk-blog-post-meta">';
                    if ($show_author === 'yes') :
                        $response .= '<div class="upk-blog-author">';
                        $response .= '<a class="author-name" href="' . $author_url . '">' . $author_name . '</a>';
                        $response .= '</div>';
                    endif;
                    $response .= '<span class="upk-separator">' . $separator . '</span>';
                    $response .= '<div class="upk-blog-date">';
                    $response .= '<span class="date">' . $date . '</span>';
                    $response .= '</div>';
                    $response .= '</div>';
                endif;
                $response .= '</div>';
                $response .= '</div>';
                $response .= '</div>';

                $item_index++;
            endwhile;
        } else {
            $response = 'empty';
        }

        $this->get_tab_output($response);
        
        exit();
    }
}
