<?php

if (!function_exists('optimize_mikado_search_covers_header_style')) {

	function optimize_mikado_search_covers_header_style()
	{

		if (optimize_mikado_options()->getOptionValue('search_height') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-header-bottom.mkdf-animated .mkdf-form-holder-outer, .mkdf-search-slide-header-bottom .mkdf-form-holder-outer, .mkdf-search-slide-header-bottom', array(
				'height' => optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_height')) . 'px'
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_covers_header_style');

}

if (!function_exists('optimize_mikado_search_opener_icon_size')) {

	function optimize_mikado_search_opener_icon_size()
	{

		if (optimize_mikado_options()->getOptionValue('header_search_icon_size')) {
			echo optimize_mikado_dynamic_css('.mkdf-search-opener', array(
				'font-size' => optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_opener_icon_size');

}

if (!function_exists('optimize_mikado_search_opener_icon_colors')) {

	function optimize_mikado_search_opener_icon_colors()
	{

		if (optimize_mikado_options()->getOptionValue('header_search_icon_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-opener', array(
				'color' => optimize_mikado_options()->getOptionValue('header_search_icon_color')
			));
		}

		if (optimize_mikado_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'color' => optimize_mikado_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if (optimize_mikado_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => optimize_mikado_options()->getOptionValue('header_light_search_icon_color') . ' !important'
			));
		}

		if (optimize_mikado_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-light-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-light-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-light-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => optimize_mikado_options()->getOptionValue('header_light_search_icon_hover_color') . ' !important'
			));
		}

		if (optimize_mikado_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener', array(
				'color' => optimize_mikado_options()->getOptionValue('header_dark_search_icon_color') . ' !important'
			));
		}
		if (optimize_mikado_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-dark-header .mkdf-page-header > div:not(.mkdf-sticky-header) .mkdf-search-opener:hover,
			.mkdf-dark-header.mkdf-header-style-on-scroll .mkdf-page-header .mkdf-search-opener:hover,
			.mkdf-dark-header .mkdf-top-bar .mkdf-search-opener:hover', array(
				'color' => optimize_mikado_options()->getOptionValue('header_dark_search_icon_hover_color') . ' !important'
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_opener_icon_colors');

}

if (!function_exists('optimize_mikado_search_opener_icon_background_colors')) {

	function optimize_mikado_search_opener_icon_background_colors()
	{

		if (optimize_mikado_options()->getOptionValue('search_icon_background_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-opener', array(
				'background-color' => optimize_mikado_options()->getOptionValue('search_icon_background_color')
			));
		}

		if (optimize_mikado_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-opener:hover', array(
				'background-color' => optimize_mikado_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_opener_icon_background_colors');
}

if (!function_exists('optimize_mikado_search_opener_text_styles')) {

	function optimize_mikado_search_opener_text_styles()
	{
		$text_styles = array();

		if (optimize_mikado_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = optimize_mikado_options()->getOptionValue('search_icon_text_color');
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = optimize_mikado_options()->getOptionValue('search_icon_text_texttransform');
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = optimize_mikado_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = optimize_mikado_options()->getOptionValue('search_icon_text_fontweight');
		}

		if (!empty($text_styles)) {
			echo optimize_mikado_dynamic_css('.mkdf-search-icon-text', $text_styles);
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-opener:hover .mkdf-search-icon-text', array(
				'color' => optimize_mikado_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_opener_text_styles');
}

if (!function_exists('optimize_mikado_search_opener_spacing')) {

	function optimize_mikado_search_opener_spacing()
	{
		$spacing_styles = array();

		if (optimize_mikado_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (optimize_mikado_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (optimize_mikado_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (optimize_mikado_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo optimize_mikado_dynamic_css('.mkdf-search-opener', $spacing_styles);
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_opener_spacing');
}

if (!function_exists('optimize_mikado_search_bar_background')) {

	function optimize_mikado_search_bar_background()
	{

		if (optimize_mikado_options()->getOptionValue('search_background_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-header-bottom, .mkdf-search-cover, .mkdf-search-fade .mkdf-fullscreen-search-holder .mkdf-fullscreen-search-table, .mkdf-fullscreen-search-overlay, .mkdf-search-slide-window-top, .mkdf-search-slide-window-top input[type="text"]', array(
				'background-color' => optimize_mikado_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_bar_background');
}

if (!function_exists('optimize_mikado_search_text_styles')) {

	function optimize_mikado_search_text_styles()
	{
		$text_styles = array();

		if (optimize_mikado_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = optimize_mikado_options()->getOptionValue('search_text_color');
		}
		if (optimize_mikado_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if (optimize_mikado_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = optimize_mikado_options()->getOptionValue('search_text_texttransform');
		}
		if (optimize_mikado_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if (optimize_mikado_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = optimize_mikado_options()->getOptionValue('search_text_fontstyle');
		}
		if (optimize_mikado_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = optimize_mikado_options()->getOptionValue('search_text_fontweight');
		}
		if (optimize_mikado_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-header-bottom input[type="text"], .mkdf-search-cover input[type="text"], .mkdf-fullscreen-search-holder .mkdf-search-field, .mkdf-search-slide-window-top input[type="text"]', $text_styles);
		}
		if (optimize_mikado_options()->getOptionValue('search_text_disabled_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-header-bottom.mkdf-disabled input[type="text"]::-webkit-input-placeholder, .mkdf-search-slide-header-bottom.mkdf-disabled input[type="text"]::-moz-input-placeholder', array(
				'color' => optimize_mikado_options()->getOptionValue('search_text_disabled_color')
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_text_styles');
}

if (!function_exists('optimize_mikado_search_label_styles')) {

	function optimize_mikado_search_label_styles()
	{
		$text_styles = array();

		if (optimize_mikado_options()->getOptionValue('search_label_text_color') !== '') {
			$text_styles['color'] = optimize_mikado_options()->getOptionValue('search_label_text_color');
		}
		if (optimize_mikado_options()->getOptionValue('search_label_text_fontsize') !== '') {
			$text_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_label_text_fontsize')) . 'px';
		}
		if (optimize_mikado_options()->getOptionValue('search_label_text_texttransform') !== '') {
			$text_styles['text-transform'] = optimize_mikado_options()->getOptionValue('search_label_text_texttransform');
		}
		if (optimize_mikado_options()->getOptionValue('search_label_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('search_label_text_google_fonts')) . ', sans-serif';
		}
		if (optimize_mikado_options()->getOptionValue('search_label_text_fontstyle') !== '') {
			$text_styles['font-style'] = optimize_mikado_options()->getOptionValue('search_label_text_fontstyle');
		}
		if (optimize_mikado_options()->getOptionValue('search_label_text_fontweight') !== '') {
			$text_styles['font-weight'] = optimize_mikado_options()->getOptionValue('search_label_text_fontweight');
		}
		if (optimize_mikado_options()->getOptionValue('search_label_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_label_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo optimize_mikado_dynamic_css('.mkdf-fullscreen-search-holder .mkdf-search-label', $text_styles);
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_label_styles');
}

if (!function_exists('optimize_mikado_search_icon_styles')) {

	function optimize_mikado_search_icon_styles()
	{

		if (optimize_mikado_options()->getOptionValue('search_icon_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-window-top > i, .mkdf-search-slide-header-bottom .mkdf-search-submit i, .mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'color' => optimize_mikado_options()->getOptionValue('search_icon_color')
			));
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-window-top > i:hover, .mkdf-search-slide-header-bottom .mkdf-search-submit i:hover, .mkdf-fullscreen-search-holder .mkdf-search-submit:hover', array(
				'color' => optimize_mikado_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_disabled_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-header-bottom.mkdf-disabled .mkdf-search-submit i, .mkdf-search-slide-header-bottom.mkdf-disabled .mkdf-search-submit i:hover', array(
				'color' => optimize_mikado_options()->getOptionValue('search_icon_disabled_color')
			));
		}
		if (optimize_mikado_options()->getOptionValue('search_icon_size') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-window-top > i, .mkdf-search-slide-header-bottom .mkdf-search-submit i, .mkdf-fullscreen-search-holder .mkdf-search-submit', array(
				'font-size' => optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_icon_styles');
}

if (!function_exists('optimize_mikado_search_close_icon_styles')) {

	function optimize_mikado_search_close_icon_styles()
	{

		if (optimize_mikado_options()->getOptionValue('search_close_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-window-top .mkdf-search-close i, .mkdf-search-cover .mkdf-search-close i, .mkdf-fullscreen-search-close i', array(
				'color' => optimize_mikado_options()->getOptionValue('search_close_color')
			));
		}
		if (optimize_mikado_options()->getOptionValue('search_close_hover_color') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-window-top .mkdf-search-close i:hover, .mkdf-search-cover .mkdf-search-close i:hover, .mkdf-fullscreen-search-close i:hover', array(
				'color' => optimize_mikado_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (optimize_mikado_options()->getOptionValue('search_close_size') !== '') {
			echo optimize_mikado_dynamic_css('.mkdf-search-slide-window-top .mkdf-search-close i, .mkdf-search-cover .mkdf-search-close i, .mkdf-fullscreen-search-close i', array(
				'font-size' => optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('optimize_mikado_style_dynamic', 'optimize_mikado_search_close_icon_styles');
}

?>
