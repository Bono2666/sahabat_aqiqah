<?php

//Slider

$slider_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Background Type', 'optimizewp' ),
        'name' => 'slides_type'
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name'          => 'mkdf_slide_background_type',
            'type'          => 'imagevideo',
            'default_value' => 'image',
            'label' => esc_html__( 'Slide Background Type', 'optimizewp' ),
            'description' => esc_html__( 'Do you want to upload an image or video?', 'optimizewp' ),
            'parent'        => $slider_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#mkdf-meta-box-mkdf_slides_video_settings",
                "dependence_show_on_yes" => "#mkdf-meta-box-mkdf_slides_image_settings"
            )
        )
    );


//Slide Image

$slider_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Background Image', 'optimizewp' ),
        'name' => 'mkdf_slides_image_settings',
        'hidden_property' => 'mkdf_slide_background_type',
        'hidden_values' => array('video')
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_image',
            'type'        => 'image',
            'label' => esc_html__( 'Slide Image', 'optimizewp' ),
            'description' => esc_html__( 'Choose background image', 'optimizewp' ),
            'parent'      => $slider_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_overlay_image',
            'type'        => 'image',
            'label' => esc_html__( 'Overlay Image', 'optimizewp' ),
            'description' => esc_html__( 'Choose overlay image (pattern) for background image', 'optimizewp' ),
            'parent'      => $slider_meta_box
        )
    );


//Slide Video

$video_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Background Video', 'optimizewp' ),
        'name' => 'mkdf_slides_video_settings',
        'hidden_property' => 'mkdf_slide_background_type',
        'hidden_values' => array('image')
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_video_webm',
            'type'        => 'text',
            'label' => esc_html__( 'Video - webm', 'optimizewp' ),
            'description' => esc_html__( 'Path to the webm file that you have previously uploaded in Media Section', 'optimizewp' ),
            'parent'      => $video_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_video_mp4',
            'type'        => 'text',
            'label' => esc_html__( 'Video - mp4', 'optimizewp' ),
            'description' => esc_html__( 'Path to the mp4 file that you have previously uploaded in Media Section', 'optimizewp' ),
            'parent'      => $video_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_video_ogv',
            'type'        => 'text',
            'label' => esc_html__( 'Video - ogv', 'optimizewp' ),
            'description' => esc_html__( 'Path to the ogv file that you have previously uploaded in Media Section', 'optimizewp' ),
            'parent'      => $video_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_video_image',
            'type'        => 'image',
            'label' => esc_html__( 'Video Preview Image', 'optimizewp' ),
            'description' => esc_html__( 'Choose background image that will be visible until video is loaded. This image will be shown on touch devices too.', 'optimizewp' ),
            'parent'      => $video_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_slide_video_overlay',
            'type' => 'yesempty',
            'default_value' => '',
            'label' => esc_html__( 'Video Overlay Image', 'optimizewp' ),
            'description' => esc_html__( 'Do you want to have a overlay image on video?', 'optimizewp' ),
            'parent' => $video_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "",
                "dependence_show_on_yes" => "#mkdf_mkdf_slide_video_overlay_container"
            )
        )
    );

    $slide_video_overlay_container = optimize_mikado_add_admin_container(array(
        'name' => 'mkdf_slide_video_overlay_container',
        'parent' => $video_meta_box,
        'hidden_property' => 'mkdf_slide_video_overlay',
        'hidden_values' => array('','no')
    ));

        optimize_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_slide_video_overlay_image',
                'type'        => 'image',
                'label' => esc_html__( 'Overlay Image', 'optimizewp' ),
                'description' => esc_html__( 'Choose overlay image (pattern) for background video.', 'optimizewp' ),
                'parent'      => $slide_video_overlay_container
            )
        );


//Slide General

$general_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide General', 'optimizewp' ),
        'name' => 'mkdf_slides_general_settings'
    )
);

    optimize_mikado_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'mkdf_text_content_title',
            'title' => esc_html__( 'Slide Text Content', 'optimizewp' )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_slide_hide_title',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__( 'Hide Slide Title', 'optimizewp' ),
            'description' => esc_html__( 'Do you want to hide slide title?', 'optimizewp' ),
            'parent' => $general_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#mkdf_mkdf_slide_hide_title_container, #mkdf-meta-box-mkdf_slides_title",
                "dependence_show_on_yes" => ""
            )
        )
    );

    $slide_hide_title_container = optimize_mikado_add_admin_container(array(
        'name' => 'mkdf_slide_hide_title_container',
        'parent' => $general_meta_box,
        'hidden_property' => 'mkdf_slide_hide_title',
        'hidden_value' => 'yes'
    ));

        $group_title_link = optimize_mikado_add_admin_group(array(
            'title' => esc_html__( 'Title Link', 'optimizewp' ),
            'name' => 'group_title_link',
            'description' => esc_html__( 'Define styles for title', 'optimizewp' ),
            'parent' => $slide_hide_title_container
        ));

            $row1 = optimize_mikado_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_title_link
            ));

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_title_link',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'Link', 'optimizewp' ),
                        'parent'      => $row1
                    )
                );

                optimize_mikado_create_meta_box_field(
                    array(
                        'parent' => $row1,
                        'type' => 'selectsimple',
                        'name' => 'mkdf_slide_title_target',
                        'default_value' => '_self',
                        'label' => esc_html__( 'Target', 'optimizewp' ),
                        'options' => array(
                            "_self" => esc_html__("Self", 'optimizewp' ),
                            "_blank" => esc_html__("Blank", 'optimizewp' )
                        )
                    )
                );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_subtitle',
            'type'        => 'text',
            'label' => esc_html__( 'Subtitle Text', 'optimizewp' ),
            'description' => esc_html__( 'Enter text for subtitle', 'optimizewp' ),
            'parent'      => $general_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_text',
            'type'        => 'text',
            'label' => esc_html__( 'Body Text', 'optimizewp' ),
            'description' => esc_html__( 'Enter slide body text', 'optimizewp' ),
            'parent'      => $general_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_button_label',
            'type'        => 'text',
            'label' => esc_html__( 'Button 1 Text', 'optimizewp' ),
            'description' => esc_html__( 'Enter text to be displayed on button 1', 'optimizewp' ),
            'parent'      => $general_meta_box
        )
    );

    $group_button1 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Button 1 Link', 'optimizewp' ),
        'name' => 'group_button1',
        'parent' => $general_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_button1
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_link',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Link', 'optimizewp' ),
                    'default_value' => '',
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'parent' => $row1,
                    'type' => 'selectsimple',
                    'name' => 'mkdf_slide_button_target',
                    'default_value' => '_self',
                    'label' => esc_html__( 'Target', 'optimizewp' ),
                    'options' => array(
                        "_self" => esc_html__("Self", 'optimizewp' ),
                        "_blank" => esc_html__("Blank", 'optimizewp' )
                    )
                )
            );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_button_label2',
            'type'        => 'text',
            'label' => esc_html__( 'Button 2 Text', 'optimizewp' ),
            'description' => esc_html__( 'Enter text to be displayed on button 2', 'optimizewp' ),
            'parent'      => $general_meta_box
        )
    );

    $group_button2 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Button 2 Link', 'optimizewp' ),
        'name' => 'group_button2',
        'parent' => $general_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_button2
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_link2',
                    'type'        => 'textsimple',
                    'default_value' => '',
                    'label' => esc_html__( 'Link', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'parent' => $row1,
                    'type' => 'selectsimple',
                    'name' => 'mkdf_slide_button_target2',
                    'default_value' => '_self',
                    'label' => esc_html__( 'Target', 'optimizewp' ),
                    'options' => array(
                        "_self" => esc_html__("Self", 'optimizewp' ),
                        "_blank" => esc_html__("Blank", 'optimizewp' )
                    )
                )
            );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_text_content_top_margin',
            'type'        => 'text',
            'label' => esc_html__( 'Text Content Top Margin', 'optimizewp' ),
            'description' => esc_html__( 'Enter top margin for text content', 'optimizewp' ),
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_text_content_bottom_margin',
            'type'        => 'text',
            'label' => esc_html__( 'Text Content Bottom Margin', 'optimizewp' ),
            'description' => esc_html__( 'Enter bottom margin for text content', 'optimizewp' ),
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    optimize_mikado_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'mkdf_graphic_title',
            'title' => esc_html__( 'Slide Graphic', 'optimizewp' )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_thumbnail',
            'type'        => 'image',
            'label' => esc_html__( 'Slide Graphic', 'optimizewp' ),
            'description' => esc_html__( 'Choose slide graphic', 'optimizewp' ),
            'parent'      => $general_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_thumbnail_link',
            'type'        => 'text',
            'label' => esc_html__( 'Graphic Link', 'optimizewp' ),
            'description' => esc_html__( 'Enter URL to link slide graphic', 'optimizewp' ),
            'parent'      => $general_meta_box
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_graphic_top_padding',
            'type'        => 'text',
            'label' => esc_html__( 'Graphic Top Padding', 'optimizewp' ),
            'description' => esc_html__( 'Enter top padding for slide graphic', 'optimizewp' ),
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_graphic_bottom_padding',
            'type'        => 'text',
            'label' => esc_html__( 'Graphic Bottom Padding', 'optimizewp' ),
            'description' => esc_html__( 'Enter bottom padding for slide graphic', 'optimizewp' ),
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    optimize_mikado_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'mkdf_general_styling_title',
            'title' => esc_html__( 'General Styling', 'optimizewp' )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'parent' => $general_meta_box,
            'type' => 'selectblank',
            'name' => 'mkdf_slide_header_style',
            'default_value' => '',
            'label' => esc_html__( 'Header Style', 'optimizewp' ),
            'description' => esc_html__( 'Header style will be applied when this slide is in focus', 'optimizewp' ),
            'options' => array(
                "light" => esc_html__("Light", 'optimizewp' ),
                "dark" => esc_html__("Dark", 'optimizewp' )
            )
        )
    );

//Slide Behaviour

$behaviours_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Behaviours', 'optimizewp' ),
        'name' => 'mkdf_slides_behaviour_settings'
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_slide_scroll_to_section',
            'type' => 'text',
            'label' => esc_html__( 'Scroll to Section', 'optimizewp' ),
            'description' => esc_html__('An arrow will appear to take viewers to the next section of the page. Enter the section anchor here, for example, #contact','optimizewp'),
            'parent' => $behaviours_meta_box
        )
    ); 

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_slide_scroll_to_section_position',
            'type' => 'select',
            'label' => esc_html__( 'Scroll to Section Icon Position', 'optimizewp' ),
            'description' => esc_html__( 'Choose position for anchor icon - scroll to section', 'optimizewp' ),
            'parent' => $behaviours_meta_box,
            'options' => array(
                "in_content" => esc_html__("In Text Content", 'optimizewp' ),
                "bottom_of_slider" => esc_html__("Bottom of the slide", 'optimizewp' )
            )
        )
    );    

    optimize_mikado_add_admin_section_title(
        array(
            'parent' => $behaviours_meta_box,
            'name' => 'mkdf_image_animation_title',
            'title' => esc_html__( 'Slide Image Animation', 'optimizewp' )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_enable_image_animation',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__( 'Enable Image Animation', 'optimizewp' ),
            'description' => esc_html__( 'Enabling this option will turn on a motion animation on the slide image', 'optimizewp' ),
            'parent' => $behaviours_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "",
                "dependence_show_on_yes" => "#mkdf_mkdf_enable_image_animation_container"
            )
        )
    );

    $enable_image_animation_container = optimize_mikado_add_admin_container(array(
        'name' => 'mkdf_enable_image_animation_container',
        'parent' => $behaviours_meta_box,
        'hidden_property' => 'mkdf_enable_image_animation',
        'hidden_value' => 'no'
    ));

        optimize_mikado_create_meta_box_field(
            array(
                'parent' => $enable_image_animation_container,
                'type' => 'select',
                'name' => 'mkdf_enable_image_animation_type',
                'default_value' => 'zoom_center',
                'label' => esc_html__( 'Animation Type', 'optimizewp' ),
                'options' => array(
                    "zoom_center" => esc_html__("Zoom In Center", 'optimizewp' ),
                    "zoom_top_left" => esc_html__("Zoom In to Top Left", 'optimizewp' ),
                    "zoom_top_right" => esc_html__("Zoom In to Top Right", 'optimizewp' ),
                    "zoom_bottom_left" => esc_html__("Zoom In to Bottom Left", 'optimizewp' ),
                    "zoom_bottom_right" => esc_html__("Zoom In to Bottom Right", 'optimizewp' )
                )
            )
        );

    optimize_mikado_add_admin_section_title(
        array(
            'parent' => $behaviours_meta_box,
            'name' => 'mkdf_content_animation_title',
            'title' => esc_html__( 'Slide Content Entry Animations', 'optimizewp' )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'parent' => $behaviours_meta_box,
            'type' => 'select',
            'name' => 'mkdf_slide_thumbnail_animation',
            'default_value' => 'flip',
            'label' => esc_html__( 'Graphic Entry Animation', 'optimizewp' ),
            'description' => esc_html__( 'Choose entry animation for graphic', 'optimizewp' ),
            'options' => array(
                "flip" => esc_html__("Flip", 'optimizewp' ),
                "fade" => esc_html__("Fade In", 'optimizewp' ),
                "from_bottom" => esc_html__("From Bottom", 'optimizewp' ),
                "from_top" => esc_html__("From Top", 'optimizewp' ),
                "from_left" => esc_html__("From Left", 'optimizewp' ),
                "from_right" => esc_html__("From Right", 'optimizewp' ),
                "clip_anim_hor" => esc_html__("Clip Animation Horizontal", 'optimizewp' ),
                "clip_anim_ver" => esc_html__("Clip Animation Vertical", 'optimizewp' ),
                "clip_anim_puzzle" => esc_html__("Clip Animation Puzzle", 'optimizewp' ),
                "without_animation" =>  esc_html__("No Animation", 'optimizewp' )
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'parent' => $behaviours_meta_box,
            'type' => 'select',
            'name' => 'mkdf_slide_content_animation',
            'default_value' => 'all_at_once',
            'label' => esc_html__( 'Content Entry Animation', 'optimizewp' ),
            'description' => esc_html__( 'Choose entry animation for whole slide content group (title, subtitle, text, button)', 'optimizewp' ),
            'options' => array(
                "all_at_once" => esc_html__("All At Once", 'optimizewp' ),
                "one_by_one" => esc_html__("One By One", 'optimizewp' ),
                "without_animation" =>  esc_html__("No Animation", 'optimizewp' )
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "all_at_once"=>"",
                    "one_by_one"=>"",
                    "without_animation"=>"#mkdf_mkdf_slide_content_animation_container"),
                "show" => array(
                    "all_at_once"=>"#mkdf_mkdf_slide_content_animation_container",
                    "one_by_one"=>"#mkdf_mkdf_slide_content_animation_container",
                    "without_animation"=>""
                )
            )
        )
    );

    $slide_content_animation_container = optimize_mikado_add_admin_container(array(
        'name' => 'mkdf_slide_content_animation_container',
        'parent' => $behaviours_meta_box,
        'hidden_property' => 'mkdf_slide_content_animation',
        'hidden_value' => 'without_animation'
    ));

        optimize_mikado_create_meta_box_field(
            array(
                'parent' => $slide_content_animation_container,
                'type' => 'select',
                'name' => 'mkdf_slide_content_animation_direction',
                'default_value' => 'from_bottom',
                'label' => esc_html__( 'Animation Direction', 'optimizewp' ),
                'options' => array(
                    "from_bottom" => esc_html__("From Bottom", 'optimizewp' ),
                    "from_top" => esc_html__("From Top", 'optimizewp' ),
                    "from_left" => esc_html__("From Left", 'optimizewp' ),
                    "from_right" => esc_html__("From Right", 'optimizewp' ),
                    "fade" => esc_html__("Fade In", 'optimizewp' )
                )
            )
        );

//Slide Title Styles

$title_style_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Title Style', 'optimizewp' ),
        'name' => 'mkdf_slides_title',
        'hidden_property' => 'mkdf_slide_hide_title',
        'hidden_values' => array('yes')
    )
);

    $title_text_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Title Text Style', 'optimizewp' ),
        'description' => esc_html__( 'Define styles for title text', 'optimizewp' ),
        'name' => 'mkdf_title_text_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_text_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Font Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_font_size',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Font Size (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_line_height',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Line Height (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_letter_spacing',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Letter Spacing (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

        $row2 = optimize_mikado_add_admin_row(array(
            'name' => 'row2',
            'parent' => $title_text_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_font_family',
                    'type'        => 'fontsimple',
                    'label' => esc_html__( 'Font Family', 'optimizewp' ),
                    'parent'      => $row2
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_font_style',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Style', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'     => $optimize_mikado_options_fontstyle
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_font_weight',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Weight', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'     => $optimize_mikado_options_fontweight
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_text_transform',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Text Transform', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'       => $optimize_mikado_options_texttransform
                )
            );

    $title_background_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Background', 'optimizewp' ),
        'description' => esc_html__( 'Define background for title', 'optimizewp' ),
        'name' => 'mkdf_title_background_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_background_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_background_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Background Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_bg_color_transparency',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Background Color Transparency (values 0-1)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $title_margin_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Margin Bottom (px)', 'optimizewp' ),
        'description' => esc_html__( 'Enter value for title bottom margin (default value is 14)', 'optimizewp' ),
        'name' => 'mkdf_title_margin_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_margin_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_margin_bottom',
                    'type'        => 'textsimple',
                    'label'       => '',
                    'parent'      => $row1
                )
            );

    $title_padding_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Padding', 'optimizewp' ),
        'description' => esc_html__( 'Define padding for title', 'optimizewp' ),
        'name' => 'mkdf_title_padding_group',
        'parent' => $title_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $title_padding_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_padding_top',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Top Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_padding_right',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Right Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_padding_bottom',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Bottom Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_title_padding_left',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Left Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $slide_title_border = optimize_mikado_create_meta_box_field(array(
        'label' => esc_html__( 'Border', 'optimizewp' ),
        'description' => esc_html__( 'Do you want to have a title border?', 'optimizewp' ),
        'name' => 'mkdf_slide_title_border',
        'type' => 'yesno',
        'default_value' => 'no',
        'parent' => $title_style_meta_box,
        'args' => array(
            'dependence' => true,
            'dependence_hide_on_yes' => '',
            'dependence_show_on_yes' => '#mkdf_mkdf_title_border_container'
        )
    ));

    $title_border_container = optimize_mikado_add_admin_container(array(
        'name' => 'mkdf_title_border_container',
        'parent' => $title_style_meta_box,
        'hidden_property' => 'mkdf_slide_title_border',
        'hidden_value' => 'no'
    ));

        $title_border_group = optimize_mikado_add_admin_group(array(
            'title' => esc_html__( 'Title Border', 'optimizewp' ),
            'description' => esc_html__( 'Define border for title', 'optimizewp' ),
            'name' => 'mkdf_title_border_group',
            'parent' => $title_border_container
        ));

            $row1 = optimize_mikado_add_admin_row(array(
                'name' => 'row1',
                'parent' => $title_border_group
            ));

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_title_border_thickness',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'Thickness (px)', 'optimizewp' ),
                        'parent'      => $row1
                    )
                );

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_title_border_style',
                        'type'        => 'selectsimple',
                        'label' => esc_html__( 'Style', 'optimizewp' ),
                        'parent'      => $row1,
                        'options'     => array(
                            "solid" => esc_html__("solid", 'optimizewp' ),
                            "dashed" => esc_html__("dashed", 'optimizewp' ),
                            "dotted" => esc_html__("dotted", 'optimizewp' ),
                            "double" => esc_html__("double", 'optimizewp' ),
                            "groove" => esc_html__("groove", 'optimizewp' ),
                            "ridge" => esc_html__("ridge", 'optimizewp' ),
                            "inset" => esc_html__("inset", 'optimizewp' ),
                            "outset" => esc_html__("outset", 'optimizewp' )
                        )
                    )
                );

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slider_title_border_color',
                        'type'        => 'colorsimple',
                        'label' => esc_html__( 'Color', 'optimizewp' ),
                        'parent'      => $row1
                    )
                );

//Slide Subtitle Styles

$subtitle_style_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Subtitle Style', 'optimizewp' ),
        'name' => 'mkdf_slides_subtitle'
    )
);

    $subtitle_text_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Subtitle Text Style', 'optimizewp' ),
        'description' => esc_html__( 'Define styles for subtitle text', 'optimizewp' ),
        'name' => 'mkdf_subtitle_text_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_text_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Font Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_font_size',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Font Size (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_line_height',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Line Height (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_letter_spacing',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Letter Spacing (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

        $row2 = optimize_mikado_add_admin_row(array(
            'name' => 'row2',
            'parent' => $subtitle_text_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_font_family',
                    'type'        => 'fontsimple',
                    'label' => esc_html__( 'Font Family', 'optimizewp' ),
                    'parent'      => $row2
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_font_style',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Style', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'     => $optimize_mikado_options_fontstyle
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_font_weight',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Weight', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'     => $optimize_mikado_options_fontweight
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_text_transform',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Text Transform', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'       => $optimize_mikado_options_texttransform
                )
            );

    $subtitle_background_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Background', 'optimizewp' ),
        'description' => esc_html__( 'Define background for subtitle', 'optimizewp' ),
        'name' => 'mkdf_subtitle_background_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_background_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_background_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Background Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_bg_color_transparency',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Background Color Transparency (values 0-1)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $subtitle_margin_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Margin Bottom (px)', 'optimizewp' ),
        'description' => esc_html__( 'Enter value for subtitle bottom margin (default value is 14)', 'optimizewp' ),
        'name' => 'mkdf_subtitle_margin_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_margin_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_margin_bottom',
                    'type'        => 'textsimple',
                    'label'       => '',
                    'parent'      => $row1
                )
            );

    $subtitle_padding_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Padding', 'optimizewp' ),
        'description' => esc_html__( 'Define padding for subtitle', 'optimizewp' ),
        'name' => 'mkdf_subtitle_padding_group',
        'parent' => $subtitle_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $subtitle_padding_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_padding_top',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Top Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_padding_right',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Right Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_padding_bottom',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Bottom Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_subtitle_padding_left',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Left Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

//Slide Text Styles

$text_style_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Text Style', 'optimizewp' ),
        'name' => 'mkdf_slides_text'
    )
);

    $text_common_text_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Text Color and Size', 'optimizewp' ),
        'description' => esc_html__( 'Define text color and size', 'optimizewp' ),
        'name' => 'mkdf_text_common_text_group',
        'parent' => $text_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $text_common_text_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Font Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_font_size',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Font Size (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_line_height',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Line Height (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $text_without_separator_padding_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Padding', 'optimizewp' ),
        'description' => esc_html__( 'Define padding for text', 'optimizewp' ),
        'name' => 'mkdf_text_without_separator_padding_group',
        'parent' => $text_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $text_without_separator_padding_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_padding_top',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Top Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_padding_right',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Right Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_padding_bottom',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Bottom Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_padding_left',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Left Padding (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $text_without_separator_text_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Text Style', 'optimizewp' ),
        'description' => esc_html__( 'Define styles for slide text', 'optimizewp' ),
        'name' => 'mkdf_text_without_separator_text_group',
        'parent' => $text_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $text_without_separator_text_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_letter_spacing',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Letter Spacing (px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

        $row2 = optimize_mikado_add_admin_row(array(
            'name' => 'row2',
            'parent' => $text_without_separator_text_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_font_family',
                    'type'        => 'fontsimple',
                    'label' => esc_html__( 'Font Family', 'optimizewp' ),
                    'parent'      => $row2
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_font_style',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Style', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'     => $optimize_mikado_options_fontstyle
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_font_weight',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Weight', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'     => $optimize_mikado_options_fontweight
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_text_transform',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Text Transform', 'optimizewp' ),
                    'parent'      => $row2,
                    'options'       => $optimize_mikado_options_texttransform
                )
            );

    $text_without_separator_background_group = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Background', 'optimizewp' ),
        'description' => esc_html__( 'Define background for text', 'optimizewp' ),
        'name' => 'mkdf_text_without_separator_background_group',
        'parent' => $text_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $text_without_separator_background_group
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_background_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Background Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_text_bg_color_transparency',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Background Color Transparency (values 0-1)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

//Slide Buttons Styles

$buttons_style_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Buttons Style', 'optimizewp' ),
        'name' => 'mkdf_slides_buttons'
    )
);

    optimize_mikado_add_admin_section_title(
        array(
            'parent' => $buttons_style_meta_box,
            'name' => 'mkdf_button_1_styling_title',
            'title' => esc_html__( 'Button 1', 'optimizewp' )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_button_size',
            'type'        => 'selectblank',
            'parent'      => $buttons_style_meta_box,
            'label' => esc_html__( 'Size', 'optimizewp' ),
            'description' => esc_html__( 'Choose button size', 'optimizewp' ),
            'default_value' => '',
            'options'     => array(
                "" => esc_html__("Default", 'optimizewp' ),
                "small" => esc_html__("Small", 'optimizewp' ),
                "medium" => esc_html__("Medium", 'optimizewp' ),
                "large" => esc_html__("Large", 'optimizewp' ),
                "huge" => esc_html__("Extra Large", 'optimizewp' ),
                "huge-full-width" => esc_html__("Extra Large Full Width", 'optimizewp' )
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_button_type',
            'type'        => 'selectblank',
            'parent'      => $buttons_style_meta_box,
            'label' => esc_html__( 'Type', 'optimizewp' ),
            'description' => esc_html__( 'Choose button type', 'optimizewp' ),
            'default_value' => '',
            'options'     => array(
                "" => esc_html__("Default", 'optimizewp' ),
                "outline" => esc_html__("Outline", 'optimizewp' ),
                "solid" => esc_html__("Solid", 'optimizewp' )
            )
        )
    );

    $buttons_style_group_1 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Text Style', 'optimizewp' ),
        'description' => esc_html__( 'Define text style', 'optimizewp' ),
        'name' => 'mkdf_buttons_style_group_1',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons_style_group_1
        ));
            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_font_size',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Text Size(px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_font_weight',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Weight', 'optimizewp' ),
                    'parent'      => $row1,
                    'options'     => $optimize_mikado_options_fontweight
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_text_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Text Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_text_hover_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Text Hover Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $buttons_style_group_2 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Background', 'optimizewp' ),
        'description' => esc_html__( 'Define background', 'optimizewp' ),
        'name' => 'mkdf_buttons_style_group_2',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons_style_group_2
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_background_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Background Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_background_hover_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Background Hover Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $buttons_style_group_4 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Border', 'optimizewp' ),
        'description' => esc_html__( 'Define border style', 'optimizewp' ),
        'name' => 'mkdf_buttons_style_group_4',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons_style_group_4
        ));
        
            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_border_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Border Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_border_hover_color',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Border Hover Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $buttons_style_group_5 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Margin (px)', 'optimizewp' ),
        'description' => esc_html__( 'Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px', 'optimizewp' ),
        'name' => 'mkdf_buttons_style_group_5',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons_style_group_5
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_margin1',
                    'type'        => 'textsimple',
                    'label'       => '',
                    'parent'      => $row1
                )
            );
   
    //init icon pack hide and show array. It will be populated dinamically from collections array
    $button1_icon_pack_hide_array = array();
    $button1_icon_pack_show_array = array();

    //do we have some collection added in collections array?
    if(is_array($optimize_mikado_IconCollections->iconCollections) && count($optimize_mikado_IconCollections->iconCollections)) {
        //get collections params array. It will contain values of 'param' property for each collection
        $button1_icon_collections_params = $optimize_mikado_IconCollections->getIconCollectionsParams();

        //foreach collection generate hide and show array
        foreach ($optimize_mikado_IconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
            $button1_icon_pack_hide_array[$dep_collection_key] = '';
            $button1_icon_pack_hide_array["no_icon"] = "";

            //button1_icon_size is input that is always shown when some icon pack is activated and hidden if 'no_icon' is selected
            $button1_icon_pack_hide_array["no_icon"] .= "#mkdf_slider_button1_icon_size,";

            //we need to include only current collection in show string as it is the only one that needs to show
            $button1_icon_pack_show_array[$dep_collection_key] = '#mkdf_slider_button1_icon_size, #mkdf_button1_icon_'.$dep_collection_object->param.'_container';

            //for all collections param generate hide string
            foreach ($button1_icon_collections_params as $button1_icon_collections_param) {
                //we don't need to include current one, because it needs to be shown, not hidden
                if($button1_icon_collections_param !== $dep_collection_object->param) {
                    $button1_icon_pack_hide_array[$dep_collection_key].= '#mkdf_button1_icon_'.$button1_icon_collections_param.'_container,';
                }

                $button1_icon_pack_hide_array["no_icon"] .= '#mkdf_button1_icon_'.$button1_icon_collections_param.'_container,';
            }

            //remove remaining ',' character
            $button1_icon_pack_hide_array[$dep_collection_key] = rtrim($button1_icon_pack_hide_array[$dep_collection_key], ',');
            $button1_icon_pack_hide_array["no_icon"] = rtrim($button1_icon_pack_hide_array["no_icon"], ',');
        }

    }

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_button1_icon_pack',
            'type'        => 'select',
            'label' => esc_html__( 'Button 1 Icon Pack', 'optimizewp' ),
            'description' => esc_html__( 'Choose icon pack for the first button', 'optimizewp' ),
            'default_value' => 'no_icon',
            'parent'      => $buttons_style_meta_box,
            'options'     => $optimize_mikado_IconCollections->getIconCollectionsEmpty("no_icon"),
            'args'        => array(
                "dependence" => true,
                "hide" => $button1_icon_pack_hide_array,
                "show" => $button1_icon_pack_show_array
            )
        )
    );

    if(is_array($optimize_mikado_IconCollections->iconCollections) && count($optimize_mikado_IconCollections->iconCollections)) {
        //foreach icon collection we need to generate separate container that will have dependency set
        //it will have one field inside with icons dropdown
        foreach ($optimize_mikado_IconCollections->iconCollections as $collection_key => $collection_object) {
            $icons_array = $collection_object->getIconsArray();

            //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
            $icon_collections_keys = $optimize_mikado_IconCollections->getIconCollectionsKeys();

            //unset current one, because it doesn't have to be included in dependency that hides icon container
            unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

            $button1_icon_hide_values = $icon_collections_keys;
            $button1_icon_hide_values[] = "no_icon";
            $button1_icon_container = optimize_mikado_add_admin_container(array(
                'name' => "button1_icon_".$collection_object->param."_container",
                'parent' => $buttons_style_meta_box,
                'hidden_property' => 'mkdf_button1_icon_pack',
                'hidden_value' => '',
                'hidden_values' => $button1_icon_hide_values
            ));

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => "button1_icon_".$collection_object->param,
                        'type'        => 'select',
                        'label' => esc_html__( 'Button 1 Icon', 'optimizewp' ),
                        'parent'      => $button1_icon_container,
                        'options'     => $icons_array
                    )
                );
        }

    }


    optimize_mikado_add_admin_section_title(
        array(
            'parent' => $buttons_style_meta_box,
            'name' => 'mkdf_button_2_styling_title',
            'title' => esc_html__( 'Button 2', 'optimizewp' )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_button_size2',
            'type'        => 'selectblank',
            'parent'      => $buttons_style_meta_box,
            'label' => esc_html__( 'Size', 'optimizewp' ),
            'description' => esc_html__( 'Choose button size', 'optimizewp' ),
            'default_value' => '',
            'options'     => array(
                "" => esc_html__("Default", 'optimizewp' ),
                "small" => esc_html__("Small", 'optimizewp' ),
                "medium" => esc_html__("Medium", 'optimizewp' ),
                "large" => esc_html__("Large", 'optimizewp' ),
                "huge" => esc_html__("Extra Large", 'optimizewp' ),
                "huge-full-width" => esc_html__("Extra Large Full Width", 'optimizewp' )
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_slide_button_type2',
            'type'        => 'selectblank',
            'parent'      => $buttons_style_meta_box,
            'label' => esc_html__( 'Type', 'optimizewp' ),
            'description' => esc_html__( 'Choose button type', 'optimizewp' ),
            'default_value' => '',
            'options'     => array(
                "" => esc_html__("Default", 'optimizewp' ),
                "outline" => esc_html__("Outline", 'optimizewp' ),
                "solid" => esc_html__("Solid", 'optimizewp' )
            )
        )
    );

    $buttons2_style_group_1 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Text Style', 'optimizewp' ),
        'description' => esc_html__( 'Define text style', 'optimizewp' ),
        'name' => 'mkdf_buttons2_style_group_1',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons2_style_group_1
        ));
        
            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_font_size2',
                    'type'        => 'textsimple',
                    'label' => esc_html__( 'Text Size(px)', 'optimizewp' ),
                    'parent'      => $row1
                )
            );
          
            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_font_weight2',
                    'type'        => 'selectblanksimple',
                    'label' => esc_html__( 'Font Weight', 'optimizewp' ),
                    'parent'      => $row1,
                    'options'     => $optimize_mikado_options_fontweight
                )
            );
            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_text_color2',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Text Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_text_hover_color2',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Text Hover Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );
       
    $buttons2_style_group_2 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Background', 'optimizewp' ),
        'description' => esc_html__( 'Define background', 'optimizewp' ),
        'name' => 'mkdf_buttons2_style_group_2',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons2_style_group_2
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_background_color2',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Background Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_background_hover_color2',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Background Hover Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $buttons2_style_group_4 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Border', 'optimizewp' ),
        'description' => esc_html__( 'Define border style', 'optimizewp' ),
        'name' => 'mkdf_buttons2_style_group_4',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons2_style_group_4
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_border_color2',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Border Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_border_hover_color2',
                    'type'        => 'colorsimple',
                    'label' => esc_html__( 'Border Hover Color', 'optimizewp' ),
                    'parent'      => $row1
                )
            );

    $buttons2_style_group_5 = optimize_mikado_add_admin_group(array(
        'title' => esc_html__( 'Margin (px)', 'optimizewp' ),
        'description' => esc_html__( 'Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px', 'optimizewp' ),
        'name' => 'mkdf_buttons2_style_group_5',
        'parent' => $buttons_style_meta_box
    ));

        $row1 = optimize_mikado_add_admin_row(array(
            'name' => 'row1',
            'parent' => $buttons2_style_group_5
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_button_margin2',
                    'type'        => 'textsimple',
                    'label'       => '',
                    'parent'      => $row1
                )
            );

    //init icon pack hide and show array. It will be populated dinamically from collections array
    $button2_icon_pack_hide_array = array();
    $button2_icon_pack_show_array = array();

    //do we have some collection added in collections array?
    if(is_array($optimize_mikado_IconCollections->iconCollections) && count($optimize_mikado_IconCollections->iconCollections)) {
        //get collections params array. It will contain values of 'param' property for each collection
        $button2_icon_collections_params = $optimize_mikado_IconCollections->getIconCollectionsParams();

        //foreach collection generate hide and show array
        foreach ($optimize_mikado_IconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
            $button2_icon_pack_hide_array[$dep_collection_key] = '';
            $button2_icon_pack_hide_array["no_icon"] = "";

            //button2_icon_size is input that is always shown when some icon pack is activated and hidden if 'no_icon' is selected
            $button2_icon_pack_hide_array["no_icon"] .= "#mkdf_slider_button2_icon_size,";

            //we need to include only current collection in show string as it is the only one that needs to show
            $button2_icon_pack_show_array[$dep_collection_key] = '#mkdf_slider_button2_icon_size, #mkdf_button2_icon_'.$dep_collection_object->param.'_container';

            //for all collections param generate hide string
            foreach ($button2_icon_collections_params as $button2_icon_collections_param) {
                //we don't need to include current one, because it needs to be shown, not hidden
                if($button2_icon_collections_param !== $dep_collection_object->param) {
                    $button2_icon_pack_hide_array[$dep_collection_key].= '#mkdf_button2_icon_'.$button2_icon_collections_param.'_container,';
                }

                $button2_icon_pack_hide_array["no_icon"] .= '#mkdf_button2_icon_'.$button2_icon_collections_param.'_container,';
            }

            //remove remaining ',' character
            $button2_icon_pack_hide_array[$dep_collection_key] = rtrim($button2_icon_pack_hide_array[$dep_collection_key], ',');
            $button2_icon_pack_hide_array["no_icon"] = rtrim($button2_icon_pack_hide_array["no_icon"], ',');
        }

    }

    optimize_mikado_create_meta_box_field(
        array(
            'name'        => 'mkdf_button2_icon_pack',
            'type'        => 'select',
            'label' => esc_html__( 'Button 2 Icon Pack', 'optimizewp' ),
            'description' => esc_html__( 'Choose icon pack for the first button', 'optimizewp' ),
            'default_value' => 'no_icon',
            'parent'      => $buttons_style_meta_box,
            'options'     => $optimize_mikado_IconCollections->getIconCollectionsEmpty("no_icon"),
            'args'        => array(
                "dependence" => true,
                "hide" => $button2_icon_pack_hide_array,
                "show" => $button2_icon_pack_show_array
            )
        )
    );

    //echo var_dump($button2_icon_pack_hide_array); die();

    if(is_array($optimize_mikado_IconCollections->iconCollections) && count($optimize_mikado_IconCollections->iconCollections)) {
        //foreach icon collection we need to generate separate container that will have dependency set
        //it will have one field inside with icons dropdown
        foreach ($optimize_mikado_IconCollections->iconCollections as $collection_key => $collection_object) {
            $icons_array = $collection_object->getIconsArray();

            //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
            $icon_collections_keys = $optimize_mikado_IconCollections->getIconCollectionsKeys();

            //unset current one, because it doesn't have to be included in dependency that hides icon container
            unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

            $button2_icon_hide_values = $icon_collections_keys;
            $button2_icon_hide_values[] = "no_icon";
            $button2_icon_container = optimize_mikado_add_admin_container(array(
                'name' => "button2_icon_".$collection_object->param."_container",
                'parent' => $buttons_style_meta_box,
                'hidden_property' => 'mkdf_button2_icon_pack',
                'hidden_value' => '',
                'hidden_values' => $button2_icon_hide_values
            ));

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => "button2_icon_".$collection_object->param,
                        'type'        => 'select',
                        'label' => esc_html__( 'Button 2 Icon', 'optimizewp' ),
                        'parent'      => $button2_icon_container,
                        'options'     => $icons_array
                    )
                );
        }

    }



//Slide Content Positioning

$content_positioning_meta_box = optimize_mikado_create_meta_box(
    array(
        'scope' => array('slides'),
        'title' => esc_html__( 'Slide Content Positioning', 'optimizewp' ),
        'name' => 'mkdf_content_positioning_settings'
    )
);

    optimize_mikado_create_meta_box_field(
        array(
            'parent' => $content_positioning_meta_box,
            'type' => 'selectblank',
            'name' => 'mkdf_slide_content_alignment',
            'default_value' => '',
            'label' => esc_html__( 'Text Alignment', 'optimizewp' ),
            'description' => esc_html__( 'Choose an alignment for the slide text', 'optimizewp' ),
            'options' => array(
                "left" => esc_html__("Left", 'optimizewp' ),
                "center" => esc_html__("Center", 'optimizewp' ),
                "right" => esc_html__("Right", 'optimizewp' )
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'parent' => $content_positioning_meta_box,
            'type' => 'selectblank',
            'name' => 'mkdf_slide_separate_text_graphic',
            'default_value' => 'no',
            'label' => esc_html__( 'Separate Graphic and Text Positioning', 'optimizewp' ),
            'description' => esc_html__( 'Do you want to separately position graphic and text?', 'optimizewp' ),
            'options' => array(
                "no" => esc_html__("No", 'optimizewp' ),
                "yes" => esc_html__("Yes", 'optimizewp' )
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "#mkdf_mkdf_slide_graphic_positioning_container",
                    "no" => "#mkdf_mkdf_slide_graphic_positioning_container, #mkdf_mkdf_content_vertical_positioning_group_container"
                ),
                "show" => array(
                    "yes" => "#mkdf_mkdf_slide_graphic_positioning_container, #mkdf_mkdf_content_vertical_positioning_group_container"
                )
            )
        )
    );

    optimize_mikado_create_meta_box_field(
        array(
            'name' => 'mkdf_slide_content_vertical_middle',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => esc_html__( 'Vertically Align Content to Middle', 'optimizewp' ),
            'parent' => $content_positioning_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#mkdf_mkdf_slide_content_vertical_middle_no_container",
                "dependence_show_on_yes" => "#mkdf_mkdf_slide_content_vertical_middle_yes_container"
            )
        )
    );

    $slide_content_vertical_middle_yes_container = optimize_mikado_add_admin_container(array(
        'name' => 'mkdf_slide_content_vertical_middle_yes_container',
        'parent' => $content_positioning_meta_box,
        'hidden_property' => 'mkdf_slide_content_vertical_middle',
        'hidden_value' => 'no'
    ));

        optimize_mikado_create_meta_box_field(
            array(
                'parent' => $slide_content_vertical_middle_yes_container,
                'type' => 'selectblank',
                'name' => 'mkdf_slide_content_vertical_middle_type',
                'default_value' => '',
                'label' => esc_html__( 'Align Content Vertically Relative to the Height Measured From', 'optimizewp' ),
                'options' => array(
                    "bottom_of_header" => esc_html__("Bottom of Header", 'optimizewp' ),
                    "window_top" => esc_html__("Window Top", 'optimizewp' )
                )
            )
        );

        optimize_mikado_create_meta_box_field(
            array(
                'name' => 'mkdf_slide_vertical_content_full_width',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__( 'Content Holder Full Width', 'optimizewp' ),
                'description' => esc_html__( 'Do you want to set slide content holder to full width?', 'optimizewp' ),
                'parent' => $slide_content_vertical_middle_yes_container
            )
        );

        optimize_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_slide_vertical_content_width',
                'type'        => 'text',
                'label' => esc_html__( 'Content Width', 'optimizewp' ),
                'description' => esc_html__( 'Enter Width for Content Area', 'optimizewp' ),
                'parent'      => $slide_content_vertical_middle_yes_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => '%'
                )
            )
        );

        $group_space_around_content = optimize_mikado_add_admin_group(array(
            'title' => esc_html__( 'Space Around Content in Slide', 'optimizewp' ),
            'name' => 'group_space_around_content',
            'parent' => $slide_content_vertical_middle_yes_container
        ));

            $row1 = optimize_mikado_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_space_around_content
            ));

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_vertical_content_left',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'From Left', 'optimizewp' ),
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_vertical_content_right',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'From Right', 'optimizewp' ),
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

    $slide_content_vertical_middle_no_container = optimize_mikado_add_admin_container(array(
        'name' => 'mkdf_slide_content_vertical_middle_no_container',
        'parent' => $content_positioning_meta_box,
        'hidden_property' => 'mkdf_slide_content_vertical_middle',
        'hidden_value' => 'yes'
    ));

        optimize_mikado_create_meta_box_field(
            array(
                'name' => 'mkdf_slide_content_full_width',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__( 'Content Holder Full Width', 'optimizewp' ),
                'description' => esc_html__( 'Do you want to set slide content holder to full width?', 'optimizewp' ),
                'parent' => $slide_content_vertical_middle_no_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#mkdf_mkdf_slide_content_width_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $slide_content_width_container = optimize_mikado_add_admin_container(array(
            'name' => 'mkdf_slide_content_width_container',
            'parent' => $slide_content_vertical_middle_no_container,
            'hidden_property' => 'mkdf_slide_content_full_width',
            'hidden_value' => 'yes'
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'name'        => 'mkdf_slide_content_width',
                    'type'        => 'text',
                    'label' => esc_html__( 'Content Holder Width', 'optimizewp' ),
                    'description' => esc_html__( 'Enter Width for Content Holder Area', 'optimizewp' ),
                    'parent'      => $slide_content_width_container,
                    'args' => array(
                        'col_width' => 2,
                        'suffix' => '%'
                    )
                )
            );

        $group_space_around_content = optimize_mikado_add_admin_group(array(
            'title' => esc_html__( 'Space Around Content in Slide', 'optimizewp' ),
            'name' => 'group_space_around_content',
            'parent' => $slide_content_vertical_middle_no_container
        ));

            $row1 = optimize_mikado_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_space_around_content
            ));

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_content_top',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'From Top', 'optimizewp' ),
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_content_left',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'From Left', 'optimizewp' ),
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_content_bottom',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'From Bottom', 'optimizewp' ),
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_content_right',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'From Right', 'optimizewp' ),
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

            $row2 = optimize_mikado_add_admin_row(array(
                'name' => 'row2',
                'parent' => $group_space_around_content
            ));

                $content_vertical_positioning_group_container = optimize_mikado_add_admin_container_no_style(array(
                    'name' => 'mkdf_content_vertical_positioning_group_container',
                    'parent' => $row2,
                    'hidden_property' => 'mkdf_slide_separate_text_graphic',
                    'hidden_value' => 'no'
                ));

                    optimize_mikado_create_meta_box_field(
                        array(
                            'name'        => 'mkdf_slide_text_width',
                            'type'        => 'textsimple',
                            'label' => esc_html__( 'Text Holder Width', 'optimizewp' ),
                            'parent'      => $content_vertical_positioning_group_container,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

        $slide_graphic_positioning_container = optimize_mikado_add_admin_container(array(
            'name' => 'mkdf_slide_graphic_positioning_container',
            'parent' => $slide_content_vertical_middle_no_container,
            'hidden_property' => 'mkdf_slide_separate_text_graphic',
            'hidden_value' => 'no'
        ));

            optimize_mikado_create_meta_box_field(
                array(
                    'parent' => $slide_graphic_positioning_container,
                    'type' => 'selectblank',
                    'name' => 'mkdf_slide_graphic_alignment',
                    'default_value' => 'left',
                    'label' => esc_html__( 'Choose an alignment for the slide graphic', 'optimizewp' ),
                    'options' => array(
                        "left" => esc_html__("Left", 'optimizewp' ),
                        "center" => esc_html__("Center", 'optimizewp' ),
                        "right" => esc_html__("Right", 'optimizewp' )
                    )
                )
            );

            $group_graphic_positioning = optimize_mikado_add_admin_group(array(
                'title' => esc_html__( 'Graphic Positioning', 'optimizewp' ),
                'description' => esc_html__( 'Positioning for slide graphic', 'optimizewp' ),
                'name' => 'group_graphic_positioning',
                'parent' => $slide_graphic_positioning_container
            ));

                $row1 = optimize_mikado_add_admin_row(array(
                    'name' => 'row1',
                    'parent' => $group_graphic_positioning
                ));

                    optimize_mikado_create_meta_box_field(
                        array(
                            'name'        => 'mkdf_slide_graphic_top',
                            'type'        => 'textsimple',
                            'label' => esc_html__( 'From Top', 'optimizewp' ),
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    optimize_mikado_create_meta_box_field(
                        array(
                            'name'        => 'mkdf_slide_graphic_left',
                            'type'        => 'textsimple',
                            'label' => esc_html__( 'From Left', 'optimizewp' ),
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    optimize_mikado_create_meta_box_field(
                        array(
                            'name'        => 'mkdf_slide_graphic_bottom',
                            'type'        => 'textsimple',
                            'label' => esc_html__( 'From Bottom', 'optimizewp' ),
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    optimize_mikado_create_meta_box_field(
                        array(
                            'name'        => 'mkdf_slide_graphic_right',
                            'type'        => 'textsimple',
                            'label' => esc_html__( 'From Right', 'optimizewp' ),
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

            $row2 = optimize_mikado_add_admin_row(array(
                'name' => 'row2',
                'parent' => $group_graphic_positioning
            ));

                optimize_mikado_create_meta_box_field(
                    array(
                        'name'        => 'mkdf_slide_graphic_width',
                        'type'        => 'textsimple',
                        'label' => esc_html__( 'Graphic Holder Width', 'optimizewp' ),
                        'parent'      => $row2,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );