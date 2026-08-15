<?php
namespace UltimatePostKit\Modules\FoxicoSlider;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'foxico-slider';
	}

	public function get_widgets() {

		$widgets = [
			'Foxico_Slider',
		];
		
		return $widgets;
	}
}
