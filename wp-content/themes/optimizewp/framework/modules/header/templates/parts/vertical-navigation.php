<?php do_action('optimize_mikado_before_top_navigation'); ?>

    <nav data-navigation-type='float' class="mkdf-vertical-menu mkdf-vertical-dropdown-float">
        <?php
        wp_nav_menu(array(
            'theme_location'  => 'main-navigation',
            'container'       => '',
            'container_class' => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'fallback_cb'     => 'top_navigation_fallback',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
            'walker'          => new OptimizeMikadoTopNavigationWalker()
        ));
        ?>
    </nav>

<?php do_action('optimize_mikado_after_top_navigation'); ?>