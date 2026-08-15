<?php

namespace UltimatePostKit\Modules\SingleTitle;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

	public function get_name() {
		return 'upk-single-title';
	}

	public function get_widgets() {

		$widgets = [
			'Single_Title',
		];

		return $widgets;
	}
}
