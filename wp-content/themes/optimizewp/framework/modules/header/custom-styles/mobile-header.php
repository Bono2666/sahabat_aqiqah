<?php

if(!function_exists('optimize_mikado_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function optimize_mikado_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(optimize_mikado_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(optimize_mikado_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = optimize_mikado_options()->getOptionValue('mobile_header_background_color');
        }

        echo optimize_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-header-inner', $mobile_header_styles);
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_mobile_header_general_styles');
}

if(!function_exists('optimize_mikado_mobile_navigation_styles')) {
    /**
     * Generates styles for mobile navigation
     */
    function optimize_mikado_mobile_navigation_styles() {
        $mobile_nav_styles = array();
        if(optimize_mikado_options()->getOptionValue('mobile_menu_background_color')) {
            $mobile_nav_styles['background-color'] = optimize_mikado_options()->getOptionValue('mobile_menu_background_color');
        }

        echo optimize_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-nav', $mobile_nav_styles);

        $mobile_nav_item_styles = array();
        if(optimize_mikado_options()->getOptionValue('mobile_menu_separator_color') !== '') {
            $mobile_nav_item_styles['border-bottom-color'] = optimize_mikado_options()->getOptionValue('mobile_menu_separator_color');
        }

        if(optimize_mikado_options()->getOptionValue('mobile_text_color') !== '') {
            $mobile_nav_item_styles['color'] = optimize_mikado_options()->getOptionValue('mobile_text_color');
        }

        if(optimize_mikado_is_font_option_valid(optimize_mikado_options()->getOptionValue('mobile_font_family'))) {
            $mobile_nav_item_styles['font-family'] = optimize_mikado_get_formatted_font_family(optimize_mikado_options()->getOptionValue('mobile_font_family'));
        }

        if(optimize_mikado_options()->getOptionValue('mobile_font_size') !== '') {
            $mobile_nav_item_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('mobile_font_size')).'px';
        }

        if(optimize_mikado_options()->getOptionValue('mobile_line_height') !== '') {
            $mobile_nav_item_styles['line-height'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('mobile_line_height')).'px';
        }

        if(optimize_mikado_options()->getOptionValue('mobile_text_transform') !== '') {
            $mobile_nav_item_styles['text-transform'] = optimize_mikado_options()->getOptionValue('mobile_text_transform');
        }

        if(optimize_mikado_options()->getOptionValue('mobile_font_style') !== '') {
            $mobile_nav_item_styles['font-style'] = optimize_mikado_options()->getOptionValue('mobile_font_style');
        }

        if(optimize_mikado_options()->getOptionValue('mobile_font_weight') !== '') {
            $mobile_nav_item_styles['font-weight'] = optimize_mikado_options()->getOptionValue('mobile_font_weight');
        }

        $mobile_nav_item_selector = array(
            '.mkdf-mobile-header .mkdf-mobile-nav a',
            '.mkdf-mobile-header .mkdf-mobile-nav h4'
        );

        echo optimize_mikado_dynamic_css($mobile_nav_item_selector, $mobile_nav_item_styles);

        $mobile_nav_item_hover_styles = array();
        if(optimize_mikado_options()->getOptionValue('mobile_text_hover_color') !== '') {
            $mobile_nav_item_hover_styles['color'] = optimize_mikado_options()->getOptionValue('mobile_text_hover_color');
        }

        $mobile_nav_item_selector_hover = array(
            '.mkdf-mobile-header .mkdf-mobile-nav a:hover',
            '.mkdf-mobile-header .mkdf-mobile-nav h4:hover'
        );

        echo optimize_mikado_dynamic_css($mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles);
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_mobile_navigation_styles');
}

if(!function_exists('optimize_mikado_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function optimize_mikado_mobile_logo_styles() {
        if(optimize_mikado_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo optimize_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
                array('height' => optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(optimize_mikado_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo optimize_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
                array('height' => optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }

        if(optimize_mikado_options()->getOptionValue('mobile_header_height') !== '') {
            $max_height = intval(optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('mobile_header_height')) * 0.9).'px';
            echo optimize_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-logo-wrapper a', array('max-height' => $max_height));
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_mobile_logo_styles');
}

if(!function_exists('optimize_mikado_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function optimize_mikado_mobile_icon_styles() {
        $mobile_icon_styles = array();
        if(optimize_mikado_options()->getOptionValue('mobile_icon_color') !== '') {
            $mobile_icon_styles['color'] = optimize_mikado_options()->getOptionValue('mobile_icon_color');
        }

        if(optimize_mikado_options()->getOptionValue('mobile_icon_size') !== '') {
            $mobile_icon_styles['font-size'] = optimize_mikado_filter_px(optimize_mikado_options()->getOptionValue('mobile_icon_size')).'px';
        }

        echo optimize_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-menu-opener a', $mobile_icon_styles);

        if(optimize_mikado_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo optimize_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover',
                array('color' => optimize_mikado_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('optimize_mikado_style_dynamic', 'optimize_mikado_mobile_icon_styles');
}