<?php

if(!function_exists('optimize_mikado_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function optimize_mikado_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__( 'Sidebar', 'optimizewp' ),
            'id' => 'sidebar',
            'description' => esc_html__( 'Default Sidebar', 'optimizewp' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title'  => '<h4><span class="mkdf-sidearea-title">',
            'after_title'   => '</span><span class="mkdf-sidearea-line"></span></h4>'
        ));

    }

    add_action('widgets_init', 'optimize_mikado_register_sidebars');
}

if(!function_exists('optimize_mikado_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates OptimizeMikadoSidebar object
     */
    function optimize_mikado_add_support_custom_sidebar() {
        add_theme_support('OptimizeMikadoSidebar');
        if (get_theme_support('OptimizeMikadoSidebar')) new OptimizeMikadoSidebar();
    }

    add_action('after_setup_theme', 'optimize_mikado_add_support_custom_sidebar');
}
