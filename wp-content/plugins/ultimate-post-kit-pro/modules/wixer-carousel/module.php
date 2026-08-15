<?php
namespace UltimatePostKit\Modules\WixerCarousel;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'wixer-carousel';
	}

	public function get_widgets() {

		$widgets = [
			'Wixer_Carousel',
		];
		
		return $widgets;
	}
}
