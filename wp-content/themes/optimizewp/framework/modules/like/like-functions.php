<?php

if ( ! function_exists('optimize_mikado_like') ) {
	/**
	 * Returns OptimizeMikadoLike instance
	 *
	 * @return OptimizeMikadoLike
	 */
	function optimize_mikado_like() {
		return OptimizeMikadoLike::get_instance();
	}

}

function optimize_mikado_get_like() {

	echo wp_kses(optimize_mikado_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('optimize_mikado_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function optimize_mikado_like_latest_posts() {
		return optimize_mikado_like()->add_like();
	}

}

if ( ! function_exists('optimize_mikado_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function optimize_mikado_like_portfolio_list($portfolio_project_id) {
		return optimize_mikado_like()->add_like_portfolio_list($portfolio_project_id);
	}

}