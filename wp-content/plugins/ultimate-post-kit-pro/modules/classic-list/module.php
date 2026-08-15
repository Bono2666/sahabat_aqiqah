<?php
namespace UltimatePostKit\Modules\ClassicList;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'classic-list';
	}

	public function get_widgets() {

		$widgets = [
			'Classic_List',
		];
		
		return $widgets;
	}
}
