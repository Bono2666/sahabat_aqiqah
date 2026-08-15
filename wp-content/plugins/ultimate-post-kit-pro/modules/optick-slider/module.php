<?php
namespace UltimatePostKit\Modules\OptickSlider;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'optick-slider';
	}

	public function get_widgets() {

		$widgets = [
			'Optick_Slider',
		];

		return $widgets;
	}
}
