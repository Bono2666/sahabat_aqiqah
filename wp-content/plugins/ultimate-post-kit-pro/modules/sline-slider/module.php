<?php

namespace UltimatePostKit\Modules\SlineSlider;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'sline-slider';
	}

	public function get_widgets() {

		$widgets = [
			'Sline_Slider',
		];

		return $widgets;
	}
}
