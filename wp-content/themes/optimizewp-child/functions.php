<?php

/*** Child Theme Function  ***/

if ( ! function_exists('optimize_mikado_child_theme_enqueue_scripts') ) {
	function optimize_mikado_child_theme_enqueue_scripts() {
		$parent_style = 'optimize-mikado-default-style';
		
		wp_enqueue_style('optimize-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
	}
	
	add_action('wp_enqueue_scripts', 'optimize_mikado_child_theme_enqueue_scripts', 11);
}