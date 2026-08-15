<?php

namespace UltimatePostKit\Modules\SingleCategory;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'upk-category';
	}

	public function get_widgets() {

		$widgets = [
			'Single_Category',
		];

		return $widgets;
	}
}
