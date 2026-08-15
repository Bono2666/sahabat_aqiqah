<?php

if(!function_exists('optimize_mikado_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function optimize_mikado_header_class($classes) {
        $header_type = optimize_mikado_get_meta_field_intersect('header_type', optimize_mikado_get_page_id());

        $classes[] = 'mkdf-'.$header_type;

        return $classes;
    }

    add_filter('body_class', 'optimize_mikado_header_class');
}

if(!function_exists('optimize_mikado_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function optimize_mikado_header_behaviour_class($classes) {

        $classes[] = 'mkdf-'.optimize_mikado_options()->getOptionValue('header_behaviour');

        return $classes;
    }

    add_filter('body_class', 'optimize_mikado_header_behaviour_class');
}

if(!function_exists('optimize_mikado_mobile_header_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function optimize_mikado_mobile_header_class($classes) {
        $classes[] = 'mkdf-default-mobile-header';

        $classes[] = 'mkdf-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'optimize_mikado_mobile_header_class');
}

if(!function_exists('optimize_mikado_header_class_first_level_bg_color')) {
    /**
     * Function that adds first level menu background color class to header tag
     * @param array array of classes from main filter
     * @return array array of classes with added first level menu background color class
     */
    function optimize_mikado_header_class_first_level_bg_color($classes) {

        //check if first level hover background color is set
        if(optimize_mikado_options()->getOptionValue('menu_hover_background_color') !== ''){
            $classes[]= 'mkdf-menu-item-first-level-bg-color';
        }

        return $classes;
    }

    add_filter('body_class', 'optimize_mikado_header_class_first_level_bg_color');
}

if(!function_exists('optimize_mikado_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function optimize_mikado_menu_dropdown_appearance($classes) {

        if(optimize_mikado_options()->getOptionValue('menu_dropdown_appearance') !== 'default'){
            $classes[] = 'mkdf-'.optimize_mikado_options()->getOptionValue('menu_dropdown_appearance');
        }

        return $classes;
    }

    add_filter('body_class', 'optimize_mikado_menu_dropdown_appearance');
}

if (!function_exists('optimize_mikado_header_skin_class')) {

	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function optimize_mikado_header_skin_class( $classes ) {

        $id = optimize_mikado_get_page_id();

		if(($meta_temp = get_post_meta($id, 'mkdf_header_style_meta', true)) !== ''){
			$classes[] = 'mkdf-' . $meta_temp;
		} else if ( optimize_mikado_options()->getOptionValue('header_style') !== '' ) {
            $classes[] = 'mkdf-' . optimize_mikado_options()->getOptionValue('header_style');
        }

        return $classes;

    }

    add_filter('body_class', 'optimize_mikado_header_skin_class');

}

if (!function_exists('optimize_mikado_header_scroll_style_class')) {

	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function optimize_mikado_header_scroll_style_class( $classes ) {

		if (optimize_mikado_get_meta_field_intersect('enable_header_style_on_scroll') == 'yes' ) {
			$classes[] = 'mkdf-header-style-on-scroll';
		}

		return $classes;

	}

	add_filter('body_class', 'optimize_mikado_header_scroll_style_class');

}

if(!function_exists('optimize_mikado_header_global_js_var')) {
	/**
	 * @param $global_variables
	 *
	 * @return mixed
	 */
	function optimize_mikado_header_global_js_var($global_variables) {

        $global_variables['mkdfTopBarHeight'] = optimize_mikado_get_top_bar_height();
        $global_variables['mkdfStickyHeaderHeight'] = optimize_mikado_get_sticky_header_height();
        $global_variables['mkdfStickyHeaderTransparencyHeight'] = optimize_mikado_get_sticky_header_height_of_complete_transparency();

        return $global_variables;
    }

    add_filter('optimize_mikado_js_global_variables', 'optimize_mikado_header_global_js_var');
}

if(!function_exists('optimize_mikado_header_per_page_js_var')) {
	/**
	 * @param $perPageVars
	 *
	 * @return mixed
	 */
	function optimize_mikado_header_per_page_js_var($perPageVars) {

        $perPageVars['mkdfStickyScrollAmount'] = optimize_mikado_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('optimize_mikado_per_page_js_vars', 'optimize_mikado_header_per_page_js_var');
}

if(!function_exists('optimize_mikado_full_width_wide_menu_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function optimize_mikado_full_width_wide_menu_class($classes) {
		if(optimize_mikado_options()->getOptionValue('enable_wide_menu_background') === 'yes') {
			$classes[] = 'mkdf-full-width-wide-menu';
		}

		return $classes;
	}

	add_filter('body_class', 'optimize_mikado_full_width_wide_menu_class');
}

if(!function_exists('optimize_mikado_header_bottom_border_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function optimize_mikado_header_bottom_border_class($classes) {
		$id = optimize_mikado_get_page_id();

		$disable_border = get_post_meta($id, 'mkdf_menu_area_bottom_border_disable_header_standard_meta', true) == 'yes';
		if($disable_border) {
			$classes[] = 'mkdf-header-standard-border-disable';
		}

		return $classes;
	}

	add_filter('body_class', 'optimize_mikado_header_bottom_border_class');
}

if(!function_exists('optimize_mikado_get_top_bar_styles')) {
	/**
	 * Sets per page styles for header top bar
	 *
	 * @param $styles
	 *
	 * @return array
	 */
	function optimize_mikado_get_top_bar_styles($styles) {
		$id            = optimize_mikado_get_page_id();
		$class_prefix  = optimize_mikado_get_unique_page_class();
		$top_bar_style = array();

		$top_bar_bg_color     = get_post_meta($id, 'mkdf_top_bar_background_color_meta', true);

		$top_bar_selector = array(
			$class_prefix.' .mkdf-top-bar'
		);

		if($top_bar_bg_color !== '') {
			$top_bar_transparency = get_post_meta($id, 'mkdf_top_bar_background_transparency_meta', true);
			if($top_bar_transparency === '') {
				$top_bar_transparency = 1;
			}

			$top_bar_style['background-color'] = optimize_mikado_rgba_color($top_bar_bg_color, $top_bar_transparency);
		}

		$styles[] = optimize_mikado_dynamic_css($top_bar_selector, $top_bar_style);

		return $styles;
	}

	add_filter('optimize_mikado_add_page_custom_style', 'optimize_mikado_get_top_bar_styles');
}

if(!function_exists('optimize_mikado_top_bar_skin_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function optimize_mikado_top_bar_skin_class($classes) {
	    $id = optimize_mikado_get_page_id();
        $top_bar_skin = get_post_meta($id, 'mkdf_top_bar_skin_meta', true);

	    if($top_bar_skin !== '') {
			$classes[] = 'mkdf-top-bar-'.$top_bar_skin;
	    }

	    return $classes;
    }

	add_filter('body_class', 'optimize_mikado_top_bar_skin_class');
}