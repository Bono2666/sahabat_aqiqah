<?php
/**
 * Custom styles for Counter shortcode
 * Hooks to optimize_mikado_style_dynamic hook
 */

//if (!function_exists('optimize_mikado_counter_style')) {
//
//	function optimize_mikado_counter_style()
//	{
//
//		if (optimize_mikado_options()->getOptionValue('option_value') !== '') {
//			echo optimize_mikado_dynamic_css('.css-class', array(
//				//Css rules, etc
//				'height' => optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('option_value')) . 'px'
//			));
//		}
//
//	}
//
//	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_counter_style');
//
//}

if (!function_exists('optimize_mikado_woo_single_style')) {

	function optimize_mikado_woo_single_style() {

		$styles = array();

		if (optimize_mikado_options()->getOptionValue('hide_product_info') === 'yes') {
			$styles['display'] = 'none';
		}

		$selector = array(
			'.single.single-product .product_meta'
		);

		echo optimize_mikado_dynamic_css($selector, $styles);

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_woo_single_style');

}

?>