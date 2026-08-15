<?php

//top header bar
add_action('optimize_mikado_before_page_header', 'optimize_mikado_get_header_top');

//mobile header
add_action('optimize_mikado_after_page_header', 'optimize_mikado_get_mobile_header');