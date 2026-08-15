<?php

$custom_sidebars = optimize_mikado_get_custom_sidebars();

$sidebar_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => esc_html__( 'Sidebar', 'optimizewp' ),
        'name' => 'sidebar_meta'
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_sidebar_meta',
            'type'        => 'select',
            'label' => esc_html__( 'Layout', 'optimizewp' ),
            'description' => esc_html__( 'Choose the sidebar layout', 'optimizewp' ),
            'parent'      => $sidebar_meta_box,
            'options'     => array(
						''			=> 'Default',
						'no-sidebar'		=> esc_html__('No Sidebar', 'optimizewp' ),
						'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'optimizewp' ),
						'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'optimizewp' ),
						'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'optimizewp' ),
						'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'optimizewp' ),
					)
        )
    );

if(count($custom_sidebars) > 0) {
    optimize_mikado_create_meta_box_field(array(
        'name' => 'mkdf_custom_sidebar_meta',
        'type' => 'selectblank',
        'label' => esc_html__( 'Choose Widget Area in Sidebar', 'optimizewp' ),
        'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar', 'optimizewp' ),
        'parent' => $sidebar_meta_box,
        'options' => $custom_sidebars
    ));
}
