<?php
	if(!function_exists('optimize_mikado_layerslider_overrides')) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function optimize_mikado_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'optimize_mikado_layerslider_overrides');
	}
?>