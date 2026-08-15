<?php
namespace UltimatePostKit\Modules\ReadingProgressCircle;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'reading-progress-circle';
	}

	public function get_widgets() {

		$widgets = [
			'Reading_Progress_Circle',
		];
		
		return $widgets;
	}
}
