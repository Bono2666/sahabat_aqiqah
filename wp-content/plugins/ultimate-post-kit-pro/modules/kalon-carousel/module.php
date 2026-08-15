<?php
namespace UltimatePostKit\Modules\KalonCarousel;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'kalon-carousel';
	}

	public function get_widgets() {

		$widgets = [
			'Kalon_Carousel',
		];
		
		return $widgets;
	}
}
