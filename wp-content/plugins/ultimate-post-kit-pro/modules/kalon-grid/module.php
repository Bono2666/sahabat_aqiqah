<?php
namespace UltimatePostKit\Modules\KalonGrid;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'kalon-grid';
	}

	public function get_widgets() {

		$widgets = [
			'Kalon_Grid',
		];
		
		return $widgets;
	}
}
