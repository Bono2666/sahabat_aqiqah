<?php
if(!function_exists('optimize_mikado_design_styles')) {
    /**
     * Generates general custom styles
     */
    function optimize_mikado_design_styles() {

        $preload_background_styles = array();

        if(optimize_mikado_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.optimize_mikado_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(MIKADO_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo optimize_mikado_dynamic_css('.mkdf-preload-background', $preload_background_styles);

		if (optimize_mikado_options()->getOptionValue('google_fonts')){
			$font_family = optimize_mikado_options()->getOptionValue('google_fonts');
			if(optimize_mikado_is_font_option_valid($font_family)) {
				echo optimize_mikado_dynamic_css('body', array('font-family' => optimize_mikado_get_font_option_val($font_family)));
			}
		}

        if(optimize_mikado_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'a',
                'p a',
                '.mkdf-pagination li.active span',
                '.mejs-controls .mejs-button button:hover',
                '.mkdf-like.liked',
                'aside.mkdf-sidebar .widget.widget_nav_menu ul.menu li a:hover',
                'aside.mkdf-sidebar .widget.widget_nav_menu .current-menu-item > a',
                '.mkdf-main-menu ul li:hover a',
                '.mkdf-main-menu ul li.mkdf-active-item a',
                '.mkdf-main-menu ul .mkdf-menu-featured-icon',
                'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-main-menu > ul > li:hover > a',
                '.mkdf-main-menu > ul > li.mkdf-active-item > a',
                '.mkdf-drop-down .second .inner > ul > li:hover > a',
                '.mkdf-drop-down .second .inner ul li.sub ul li:hover > a',
                '.mkdf-drop-down .menu_icon_wrapper',
                '.mkdf-drop-down .wide .second .inner > ul > li > a:hover',
                '.mkdf-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
                '.mkdf-drop-down .wide .second ul li .flexslider ul li a:hover',
                '.mkdf-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
                '.mkdf-header-vertical .mkdf-vertical-dropdown-float .second .inner ul li a:hover',
                '.mkdf-header-vertical .mkdf-vertical-menu ul li a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav a:hover',
                '.mkdf-mobile-header .mkdf-mobile-nav h4:hover',
                '.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li > a:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li.mkdf-active-item > a:hover',
                'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li > a:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-side-menu-button-opener:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-search-opener:hover',
                '.mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li:hover > a',
                'body:not(.mkdf-menu-item-first-level-bg-color) .mkdf-page-header .mkdf-sticky-header .mkdf-main-menu > ul > li:hover > a',
                '.mkdf-page-header .mkdf-search-opener:hover',
                'footer .mkdf-footer-top-holder .widget ul li a:hover',
                '.mkdf-side-menu-button-opener:hover',
                '.mkdf-side-menu-button-opener:hover',
                '.mkdf-search-cover .mkdf-search-close a:hover',
                '.mkdf-search-slide-header-bottom .mkdf-search-submit:hover',
                '.mkdf-portfolio-single-holder .mkdf-portfolio-single-nav .mkdf-single-nav-content-holder .mkdf-single-nav-label-holder:hover',
                '.mkdf-counter-holder .mkdf-counter',
                '.countdown-amount',
                '.mkdf-message .mkdf-message-inner a.mkdf-close i:hover',
                '.mkdf-ordered-list ol > li:before',
                '.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner i',
                '.mkdf-icon-list-item .mkdf-icon-list-icon-holder-inner .font_elegant',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-active',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-hover',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-active .mkdf-accordion-mark',
                '.mkdf-accordion-holder .mkdf-title-holder.ui-state-hover .mkdf-accordion-mark',
                '.mkdf-blog-list-holder .mkdf-item-info-section > div > a:hover',
                '.mkdf-blog-list-holder.mkdf-grid-type-2 .mkdf-post-item-author-holder a:hover',
                '.mkdf-blog-list-holder.mkdf-masonry .mkdf-post-item-author-holder a:hover',
                '.mkdf-blog-list-holder.mkdf-image-in-box h6.mkdf-item-title a:hover',
                '.mkdf-btn.mkdf-btn-outline',
                '.post-password-form input.mkdf-btn-outline[type="submit"]',
                'input.mkdf-btn-outline.wpcf7-form-control.wpcf7-submit',
                '.woocommerce .mkdf-btn-outline.button',
                'blockquote .mkdf-icon-quotations-holder',
                '.mkdf-video-button-play .mkdf-video-button-wrapper:hover',
                '.mkdf-dropcaps',
                '.mkdf-portfolio-filter-holder .mkdf-portfolio-filter-holder-inner ul li.active',
                '.mkdf-portfolio-filter-holder .mkdf-portfolio-filter-holder-inner ul li.current',
                '.mkdf-portfolio-filter-holder .mkdf-portfolio-filter-holder-inner ul li:hover',
                '.mkdf-social-share-holder.mkdf-list li a:hover',
                '.mkdf-icon-progress-bar .mkdf-ipb-active',
                '.woocommerce-pagination .page-numbers li span.current',
                '.woocommerce-pagination .page-numbers li a:hover',
                '.woocommerce-pagination .page-numbers li span:hover',
                '.woocommerce-pagination .page-numbers li span.current:hover',
                '.mkdf-woocommerce-page .select2-results .select2-highlighted',
                '.mkdf-woocommerce-page ul.products .product .added_to_cart',
                '.woocommerce ul.products .product .added_to_cart',
                '.mkdf-woocommerce-page ul.products .add_to_cart_button',
                '.mkdf-woocommerce-page ul.products .mkdf-product-out-of-stock',
                '.woocommerce ul.products .add_to_cart_button',
                '.woocommerce ul.products .mkdf-product-out-of-stock',
                '.mkdf-woocommerce-page .price ins',
                '.woocommerce .price ins',
                '.single-product .mkdf-single-product-summary .price ins',
                '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget.widget_layered_nav a:hover',
                '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product-categories a:hover',
                '.mkdf-woocommerce-with-sidebar aside.mkdf-sidebar .widget .product_list_widget li .mkdf-woo-product-widget-content ins span.amount',
                '.mkdf-shopping-cart-dropdown ul li a:hover',
                '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-left a:hover',
                '.mkdf-shopping-cart-dropdown .mkdf-item-info-holder .mkdf-item-right .remove:hover',
                '.mkdf-shopping-cart-dropdown span.mkdf-total span',
                '.mkdf-shopping-cart-dropdown span.mkdf-quantity',
                '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-name a:hover',
                '.woocommerce-cart .woocommerce .cart-collaterals .mkdf-shipping-calculator .woocommerce-shipping-calculator > p a:hover',
                '.mkdf-blog-holder.mkdf-blog-single article.format-link .mkdf-post-content .mkdf-social-share-holder.mkdf-list ul li a:hover',
                '.mkdf-blog-holder article.sticky .mkdf-post-title a',
                '.mkdf-blog-holder article .mkdf-post-info a:hover',
                '.mkdf-filter-blog-holder li.mkdf-active',
                '.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',
                '.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover'
            );

            $color_important_selector = array(
                '.mkdf-btn.mkdf-btn-hover-outline:not(.mkdf-btn-custom-hover-color):hover',
                '.post-password-form input[type="submit"]:not(.mkdf-btn-custom-hover-color):hover',
                'input.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-color):hover',
                '.woocommerce .button:not(.mkdf-btn-custom-hover-color):hover',
                '.mkdf-btn.mkdf-btn-hover-outline:not(.mkdf-btn-custom-border-hover):hover',
                '.post-password-form input[type="submit"]:not(.mkdf-btn-custom-border-hover):hover',
                'input.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-border-hover):hover',
                '.woocommerce .button:not(.mkdf-btn-custom-border-hover):hover',
                '.mkdf-btn.mkdf-btn-hover-white:not(.mkdf-btn-custom-hover-color):hover',
                '.post-password-form input.mkdf-btn-hover-white[type="submit"]:not(.mkdf-btn-custom-hover-color):hover',
                'input.mkdf-btn-hover-white.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-color):hover',
                '.woocommerce .mkdf-btn-hover-white.button:not(.mkdf-btn-custom-hover-color):hover',
                '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-btns-holder .mkdf-btn.mkdf-btn-small.view-cart:hover',
            );

            $background_color_selector = array(
                'mkdf-st-loader .pulse',
                '.mkdf-st-loader .double_pulse .double-bounce1',
                '.mkdf-st-loader .double_pulse .double-bounce2',
                '.mkdf-st-loader .cube',
                '.mkdf-st-loader .rotating_cubes .cube1',
                '.mkdf-st-loader .rotating_cubes .cube2',
                '.mkdf-st-loader .stripes > div',
                '.mkdf-st-loader .wave > div',
                '.mkdf-st-loader .two_rotating_circles .dot1',
                '.mkdf-st-loader .two_rotating_circles .dot2',
                '.mkdf-st-loader .five_rotating_circles .container1 > div',
                '.mkdf-st-loader .five_rotating_circles .container2 > div',
                '.mkdf-st-loader .five_rotating_circles .container3 > div',
                '.mkdf-st-loader .lines .line1',
                '.mkdf-st-loader .lines .line2',
                '.mkdf-st-loader .lines .line3',
                '.mkdf-st-loader .lines .line4',
                '.mkdf-carousel-pagination .owl-page.active span',
                '.mejs-controls .mejs-time-rail .mejs-time-current',
                '.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                'aside.mkdf-sidebar .widget .searchform input[type=submit]',
                'aside.mkdf-sidebar .widget.widget_product_tag_cloud .tagcloud a',
                'aside.mkdf-sidebar .widget.widget_tag_cloud .tagcloud a',
                '.mkdf-drop-down .narrow .second li:not(.mkdf-menu-item-with-icon) > a:before',
                '.mkdf-header-vertical .mkdf-vertical-menu > ul > li > a:before',
                '.mkdf-header-vertical .mkdf-vertical-menu > ul > li > a:after',
                '.mkdf-team.main-info-below-image .mkdf-icon-element',
                '.mkdf-progress-bar .mkdf-progress-content-outer .mkdf-progress-content',
                '.mkdf-price-table .mkdf-price-table-inner .mkdf-pt-label-holder .mkdf-pt-label-inner',
                '.mkdf-price-table.mkdf-pt-active .mkdf-price-table-inner',
                '.mkdf-pie-chart-doughnut-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
                '.mkdf-pie-chart-pie-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
                '.mkdf-pie-chart-doughnut-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
                '.mkdf-pie-chart-pie-holder .mkdf-pie-legend ul li .mkdf-pie-color-holder',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-active',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-hover',
                '.mkdf-btn.mkdf-btn-solid',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.woocommerce .button',
                '.mkdf-btn.mkdf-btn-hover-solid .mkdf-btn-helper',
                '.post-password-form input.mkdf-btn-hover-solid[type="submit"] .mkdf-btn-helper',
                'input.mkdf-btn-hover-solid.wpcf7-form-control.wpcf7-submit .mkdf-btn-helper',
                '.woocommerce .mkdf-btn-hover-solid.button .mkdf-btn-helper',
                '.mkdf-dropcaps.mkdf-square',
                '.mkdf-dropcaps.mkdf-circle',
                '.mkdf-ptf-item-overlay',
                '.mkdf-comparision-pricing-tables-holder .mkdf-cpt-table .mkdf-cpt-table-btn a',
                '.mkdf-vertical-progress-bar-holder .mkdf-vpb-active-bar',
                '.widget_mkdf_call_to_action_button .mkdf-call-to-action-button',
                '.mkdf-woocommerce-page .mkdf-onsale',
                '.mkdf-woocommerce-page .mkdf-out-of-stock',
                '.woocommerce .mkdf-onsale',
                '.woocommerce .mkdf-out-of-stock',
                '.mkdf-shopping-cart-outer .mkdf-shopping-cart-header .mkdf-header-cart .mkdf-cart-count',
                '.mkdf-blog-holder article.format-quote .mkdf-post-content .mkdf-post-text',
                '.mkdf-blog-holder article.format-link .mkdf-post-content .mkdf-post-text',
                '.mkdf-single-tags-holder .mkdf-tags a',
                '.mkdf-blog-holder.mkdf-blog-type-masonry .format-quote .mkdf-post-content',
                '.mkdf-blog-holder.mkdf-blog-type-masonry .format-link .mkdf-post-content',
            );

            $background_color_important_selector = array(
                '.mkdf-btn.mkdf-btn-hover-solid:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
                '.post-password-form input.mkdf-btn-hover-solid[type="submit"]:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
                'input.mkdf-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
                '.woocommerce .mkdf-btn-hover-solid.button:not(.mkdf-btn-custom-hover-bg):not(.mkdf-btn-with-animation):hover',
            );

            $border_color_selector = array(
                '.mkdf-st-loader .pulse_circles .ball',
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus',
                '#respond textarea:focus',
                '#respond input[type="text"]:focus',
                '.post-password-form input[type="password"]:focus',
                'aside.mkdf-sidebar .widget.widget_product_tag_cloud .tagcloud a',
                'aside.mkdf-sidebar .widget.widget_tag_cloud .tagcloud a',
                '.mkdf-team.main-info-below-image .mkdf-icon-element',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-active',
                '.mkdf-accordion-holder.mkdf-boxed .mkdf-title-holder.ui-state-hover',
                '.mkdf-btn.mkdf-btn-solid',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.woocommerce .button',
                '.mkdf-btn.mkdf-btn-outline',
                '.post-password-form input.mkdf-btn-outline[type="submit"]',
                'input.mkdf-btn-outline.wpcf7-form-control.wpcf7-submit',
                '.woocommerce .mkdf-btn-outline.button',
                '.woocommerce .login input[type=text]:focus',
                '.woocommerce .login input[type=password]:focus',
                '.woocommerce .login input[type=email]:focus',
                '.woocommerce .register input[type=text]:focus',
                '.woocommerce .register input[type=password]:focus',
                '.woocommerce .register input[type=email]:focus',
                '.mkdf-woocommerce-page .woocommerce .button',
                '.woocommerce .woocommerce .button',
                '.mkdf-woocommerce-page .woocommerce .button:hover',
                '.woocommerce .woocommerce .button:hover',
                '.mkdf-woocommerce-page .price_slider_amount button.button',
                '.woocommerce .price_slider_amount button.button',
                '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .actions .coupon input[type=text]:focus',
                '.woocommerce-cart .woocommerce .cart-collaterals .mkdf-shipping-calculator .form-row input[type=text]:focus',
                '.woocommerce-checkout .checkout_coupon input[type=text]:focus',
                '.woocommerce-checkout .login input[type=text]:focus',
                '.woocommerce-checkout .login input[type=password]:focus',
                '.woocommerce-checkout form.checkout input[type=text]:focus',
                '.woocommerce-checkout form.checkout input[type=email]:focus',
                '.woocommerce-checkout form.checkout input[type=password]:focus',
                '.woocommerce-checkout form.checkout input[type=tel]:focus',
                '.woocommerce-checkout form.checkout textarea:focus',
                '.woocommerce-account .woocommerce input[type=text]:focus',
                '.woocommerce-account .woocommerce input[type=email]:focus',
                '.woocommerce-account .woocommerce input[type=tel]:focus',
                '.woocommerce-account .woocommerce textarea:focus',
                '.mkdf-single-tags-holder .mkdf-tags a',
            );

            $border_color_important_celector = array(
                '.mkdf-btn.mkdf-btn-hover-solid:not(.mkdf-btn-custom-border-hover):hover',
                '.post-password-form input.mkdf-btn-hover-solid[type="submit"]:not(.mkdf-btn-custom-border-hover):hover',
                'input.mkdf-btn-hover-solid.wpcf7-form-control.wpcf7-submit:not(.mkdf-btn-custom-border-hover):hover',
                '.woocommerce .mkdf-btn-hover-solid.button:not(.mkdf-btn-custom-border-hover):hover',
                '.mkdf-shopping-cart-dropdown .mkdf-cart-bottom .mkdf-btns-holder .mkdf-btn.mkdf-btn-small.view-cart:hover',
                '.mkdf-btn.mkdf-btn-hover-outline:not(.mkdf-btn-custom-border-hover):hover',
                '.woocommerce .button:not(.mkdf-btn-custom-border-hover):hover'
            );

            $background_selector = array(
                '.mkdf-st-loader .atom .ball-1:befor',
                '.mkdf-st-loader .atom .ball-2:befor',
                '.mkdf-st-loader .atom .ball-3:befor',
                '.mkdf-st-loader .atom .ball-4:befor',
                '.mkdf-st-loader .clock .ball:before',
                '.mkdf-st-loader .mitosis .ball',
                '.mkdf-st-loader .fussion .ball-1',
                '.mkdf-st-loader .fussion .ball-2',
                '.mkdf-st-loader .fussion .ball-3',
                '.mkdf-st-loader .fussion .ball-4',
                '.mkdf-st-loader .wave_circles .ball',
                '.mkdf-st-loader .pulse_circles .ball',
            );

            $border_top_selector = array(
                '.mkdf-progress-bar .mkdf-progress-number-wrapper.mkdf-floating .mkdf-down-arrow'
            );

            $border_bottom_selector = array(
                '.woocommerce-cart .woocommerce .cart-collaterals .mkdf-shipping-calculator .woocommerce-shipping-calculator > p:after'
            );

            echo optimize_mikado_dynamic_css($color_selector, array('color' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css($color_important_selector, array('color' => optimize_mikado_options()->getOptionValue('first_color').'!important'));
            echo optimize_mikado_dynamic_css('::selection', array('background' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css('::-moz-selection', array('background' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css($background_color_selector, array('background-color' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css($background_color_important_selector, array('background-color' => optimize_mikado_options()->getOptionValue('first_color').'!important'));
            echo optimize_mikado_dynamic_css($border_color_selector, array('border-color' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css($background_selector, array('background' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css($border_top_selector, array('border-top' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css($border_bottom_selector, array('border-bottom' => optimize_mikado_options()->getOptionValue('first_color')));
            echo optimize_mikado_dynamic_css($border_color_important_celector, array('border-color' => optimize_mikado_options()->getOptionValue('first_color').'!important'));
        }

		if (optimize_mikado_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.mkdf-wrapper-inner',
				'.mkdf-content'
			);
			echo optimize_mikado_dynamic_css($background_color_selector, array('background-color' => optimize_mikado_options()->getOptionValue('page_background_color')));
		}

		if (optimize_mikado_options()->getOptionValue('selection_color')) {
			echo optimize_mikado_dynamic_css('::selection', array('background' => optimize_mikado_options()->getOptionValue('selection_color')));
			echo optimize_mikado_dynamic_css('::-moz-selection', array('background' => optimize_mikado_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (optimize_mikado_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = optimize_mikado_options()->getOptionValue('page_background_color_in_box');
		}

		if (optimize_mikado_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(optimize_mikado_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (optimize_mikado_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(optimize_mikado_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (optimize_mikado_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (optimize_mikado_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo optimize_mikado_dynamic_css('.mkdf-boxed .mkdf-wrapper', $boxed_background_style);
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_design_styles');
}

if (!function_exists('optimize_mikado_h1_styles')) {

    function optimize_mikado_h1_styles() {

        $h1_styles = array();

        if(optimize_mikado_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = optimize_mikado_options()->getOptionValue('h1_color');
        }
        if(optimize_mikado_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('h1_google_fonts'));
        }
        if(optimize_mikado_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = optimize_mikado_options()->getOptionValue('h1_texttransform');
        }
        if(optimize_mikado_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = optimize_mikado_options()->getOptionValue('h1_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = optimize_mikado_options()->getOptionValue('h1_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo optimize_mikado_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_h1_styles');
}

if (!function_exists('optimize_mikado_h2_styles')) {

    function optimize_mikado_h2_styles() {

        $h2_styles = array();

        if(optimize_mikado_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = optimize_mikado_options()->getOptionValue('h2_color');
        }
        if(optimize_mikado_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('h2_google_fonts'));
        }
        if(optimize_mikado_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = optimize_mikado_options()->getOptionValue('h2_texttransform');
        }
        if(optimize_mikado_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = optimize_mikado_options()->getOptionValue('h2_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = optimize_mikado_options()->getOptionValue('h2_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo optimize_mikado_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_h2_styles');
}

if (!function_exists('optimize_mikado_h3_styles')) {

    function optimize_mikado_h3_styles() {

        $h3_styles = array();

        if(optimize_mikado_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = optimize_mikado_options()->getOptionValue('h3_color');
        }
        if(optimize_mikado_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('h3_google_fonts'));
        }
        if(optimize_mikado_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = optimize_mikado_options()->getOptionValue('h3_texttransform');
        }
        if(optimize_mikado_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = optimize_mikado_options()->getOptionValue('h3_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = optimize_mikado_options()->getOptionValue('h3_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo optimize_mikado_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_h3_styles');
}

if (!function_exists('optimize_mikado_h4_styles')) {

    function optimize_mikado_h4_styles() {

        $h4_styles = array();

        if(optimize_mikado_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = optimize_mikado_options()->getOptionValue('h4_color');
        }
        if(optimize_mikado_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('h4_google_fonts'));
        }
        if(optimize_mikado_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = optimize_mikado_options()->getOptionValue('h4_texttransform');
        }
        if(optimize_mikado_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = optimize_mikado_options()->getOptionValue('h4_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = optimize_mikado_options()->getOptionValue('h4_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo optimize_mikado_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_h4_styles');
}

if (!function_exists('optimize_mikado_h5_styles')) {

    function optimize_mikado_h5_styles() {

        $h5_styles = array();

        if(optimize_mikado_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = optimize_mikado_options()->getOptionValue('h5_color');
        }
        if(optimize_mikado_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('h5_google_fonts'));
        }
        if(optimize_mikado_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = optimize_mikado_options()->getOptionValue('h5_texttransform');
        }
        if(optimize_mikado_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = optimize_mikado_options()->getOptionValue('h5_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = optimize_mikado_options()->getOptionValue('h5_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo optimize_mikado_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_h5_styles');
}

if (!function_exists('optimize_mikado_h6_styles')) {

    function optimize_mikado_h6_styles() {

        $h6_styles = array();

        if(optimize_mikado_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = optimize_mikado_options()->getOptionValue('h6_color');
        }
        if(optimize_mikado_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('h6_google_fonts'));
        }
        if(optimize_mikado_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = optimize_mikado_options()->getOptionValue('h6_texttransform');
        }
        if(optimize_mikado_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = optimize_mikado_options()->getOptionValue('h6_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = optimize_mikado_options()->getOptionValue('h6_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo optimize_mikado_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_h6_styles');
}

if (!function_exists('optimize_mikado_text_styles')) {

    function optimize_mikado_text_styles() {

        $text_styles = array();

        if(optimize_mikado_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = optimize_mikado_options()->getOptionValue('text_color');
        }
        if(optimize_mikado_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('text_google_fonts'));
        }
        if(optimize_mikado_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('text_fontsize')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('text_lineheight')).'px';
        }
        if(optimize_mikado_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = optimize_mikado_options()->getOptionValue('text_texttransform');
        }
        if(optimize_mikado_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = optimize_mikado_options()->getOptionValue('text_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = optimize_mikado_options()->getOptionValue('text_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo optimize_mikado_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_text_styles');
}

if (!function_exists('optimize_mikado_link_styles')) {

    function optimize_mikado_link_styles() {

        $link_styles = array();

        if(optimize_mikado_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = optimize_mikado_options()->getOptionValue('link_color');
        }
        if(optimize_mikado_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = optimize_mikado_options()->getOptionValue('link_fontstyle');
        }
        if(optimize_mikado_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = optimize_mikado_options()->getOptionValue('link_fontweight');
        }
        if(optimize_mikado_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = optimize_mikado_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo optimize_mikado_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_link_styles');
}

if (!function_exists('optimize_mikado_link_hover_styles')) {

    function optimize_mikado_link_hover_styles() {

        $link_hover_styles = array();

        if(optimize_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = optimize_mikado_options()->getOptionValue('link_hovercolor');
        }
        if(optimize_mikado_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = optimize_mikado_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo optimize_mikado_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(optimize_mikado_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = optimize_mikado_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo optimize_mikado_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_link_hover_styles');
}

if (!function_exists('optimize_mikado_smooth_page_transition_styles')) {

    function optimize_mikado_smooth_page_transition_styles() {
        
        $loader_style = array();

        if(optimize_mikado_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = optimize_mikado_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.mkdf-smooth-transition-loader');

        if (!empty($loader_style)) {
            echo optimize_mikado_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(optimize_mikado_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = optimize_mikado_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.mkdf-st-loader .pulse',
            '.mkdf-st-loader .double_pulse .double-bounce1',
            '.mkdf-st-loader .double_pulse .double-bounce2',
            '.mkdf-st-loader .cube',
            '.mkdf-st-loader .rotating_cubes .cube1',
            '.mkdf-st-loader .rotating_cubes .cube2',
            '.mkdf-st-loader .stripes > div',
            '.mkdf-st-loader .wave > div',
            '.mkdf-st-loader .two_rotating_circles .dot1',
            '.mkdf-st-loader .two_rotating_circles .dot2',
            '.mkdf-st-loader .five_rotating_circles .container1 > div',
            '.mkdf-st-loader .five_rotating_circles .container2 > div',
            '.mkdf-st-loader .five_rotating_circles .container3 > div',
            '.mkdf-st-loader .atom .ball-1:before',
            '.mkdf-st-loader .atom .ball-2:before',
            '.mkdf-st-loader .atom .ball-3:before',
            '.mkdf-st-loader .atom .ball-4:before',
            '.mkdf-st-loader .clock .ball:before',
            '.mkdf-st-loader .mitosis .ball',
            '.mkdf-st-loader .lines .line1',
            '.mkdf-st-loader .lines .line2',
            '.mkdf-st-loader .lines .line3',
            '.mkdf-st-loader .lines .line4',
            '.mkdf-st-loader .fussion .ball',
            '.mkdf-st-loader .fussion .ball-1',
            '.mkdf-st-loader .fussion .ball-2',
            '.mkdf-st-loader .fussion .ball-3',
            '.mkdf-st-loader .fussion .ball-4',
            '.mkdf-st-loader .wave_circles .ball',
            '.mkdf-st-loader .pulse_circles .ball'
        );

        if (!empty($spinner_style)) {
            echo optimize_mikado_dynamic_css($spinner_selectors, $spinner_style);
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_smooth_page_transition_styles');
}