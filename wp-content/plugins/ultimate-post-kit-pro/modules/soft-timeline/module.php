<?php
namespace UltimatePostKit\Modules\SoftTimeline;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'soft-timeline';
	}

	public function get_widgets() {

		$widgets = [
			'Soft_Timeline',
		];
		
		return $widgets;
	}
}
