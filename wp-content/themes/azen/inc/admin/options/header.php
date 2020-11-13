<?php
$url_image = get_template_directory_uri('template_directory') . '/images/';

Redux::setSection($opt_name, array(
    'title' => esc_html__('Header', 'azen'),
    'id' => 'header',
    'icon' => 'el el-tasks',
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Logo', 'azen'),
    'id' => 'logo-heaser',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'azen_logo',
            'type' => 'media',
            'title' => esc_html__('Header Logo', 'azen'),
            'desc' => esc_html__('Enter URL or Upload an image file as your logo.', 'azen'),
            'default' => array('url' => $url_image . 'logo.png'),
        ),
        array(
            'id' => 'azen_logo_404',
            'type' => 'media',
            'title' => esc_html__('Header Logo Page 404', 'azen'),
            'desc' => esc_html__('Enter URL or Upload an image file as your logo.', 'azen'),
            'default' => array('url' => $url_image . 'Logo-white.png'),
        ),
        array(
            'id' => 'width_logo',
            'type' => 'dimensions',
            'units' => 'px',
            'title' => esc_html__('Width Column Logo', 'azen'),
            'height' => false,
            'default' => array(
                'width' => 80,
            )
        ),
        array(
            'id' => 'width_logo_mobile',
            'type' => 'dimensions',
            'units' => 'px',
            'title' => esc_html__('Width Column Logo Mobile', 'azen'),
            'height' => false,
            'default' => array(
                'width' => 80,
            )
        ),
    )
));
//
// Main Menu
Redux::setSection($opt_name, array(
    'title' => esc_html__('Main Menu', 'azen'),
    'id' => 'all_page_general_settings',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'main_menu_style',
            'type' => 'image_select',
            'title' => esc_html__('Main Menu Style', 'azen'),
            'options' => array(
                'header_v1' => array('alt' => 'header_v1', 'img' => $url_image . 'themeoptions/azenheader_v1.jpg'),
                'header_v2' => array('alt' => 'header_v2', 'img' => $url_image . 'themeoptions/azenheader_v2.jpg'),
                'header_v3' => array('alt' => 'header_v3', 'img' => $url_image . 'themeoptions/azenheader_v3.jpg'),
            ),
            'default' => 'header_v1',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'set-header-homepage',
            'type' => 'button_set',
            'title' => __('Style Header Homepage', 'azen'),
            'subtitle' => __('Only used for homepage 4,5,6', 'azen'),
            'options' => array(
                '1' => 'Header overlay',
                '2' => 'Home Boxed',
                '3' => 'Home with featured slider',
                '' => 'Clear'
            ),
            'default' => ''
        ),
        array(
            'id' => 'bg_header_color',
            'type' => 'color_rgba',
            'title' => esc_html__('Background header', 'azen'),
            'default' => array(
                'color' => '#fff',
                'alpha' => 1
            ),
        ),

        array(
            'id' => 'font_main_menu',
            'type' => 'typography',
            'title' => esc_html__('Main Menu Font', 'azen'),
            'line-height' => false,
            'font-family' => false,
            'text-align' => false,
            'font-style' => false,
            'font-size' => true,
            'font-weight' => true,
            'text-transform' => true,
            'default' => array(
                'color' => '#111',
                'font-size' => '15',
                'font-weight' => '400',
                'text-transform' => 'uppercase',
            ),
        ),
        array(
            'id' => 'bg_menu_hover_color',
            'type' => 'color',
            'title' => esc_html__('Background Hover Color', 'azen'),
            'transparent' => false,
            'default' => '#ffffff'
        ),

        array(
            'id' => 'text_menu_hover_color',
            'type' => 'color',
            'title' => esc_html__('Text Hover Color', 'azen'),
            'transparent' => false,
            'default' => '#111'
        ),

        array(
            'id' => 'sticky_menu',
            'type' => 'switch',
            'title' => esc_html__('Show Sticky Menu', 'azen'),
            'default' => 0,
            'on' => esc_html__('Yes', 'azen'),
            'off' => esc_html__('No', 'azen'),
        ),


    )
));

// Sub Menu
Redux::setSection($opt_name, array(
    'title' => esc_html__('Sub Menu', 'azen'),
    'id' => 'sub_menu',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sub_menu_bg_color',
            'type' => 'color',
            'title' => esc_html__('Background Color', 'azen'),
            'transparent' => false,
            'default' => '#111',
        ),

        array(
            'id' => 'font_sub_menu',
            'type' => 'typography',
            'title' => esc_html__('Sub Menu Font', 'azen'),
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'font-style' => false,
            'font-size' => true,
            'default' => array(
                'color' => '#cecece',
                'font-size' => '14',
                'font-weight' => '500',
            ),
        ),
        array(
            'id' => 'sub_menu_text_hover_color',
            'type' => 'color',
            'title' => esc_html__('Text Hover Color', 'azen'),
            'transparent' => false,
            'default' => '#fff',
        ),
    )
));

// Sub Menu
Redux::setSection($opt_name, array(
    'title' => esc_html__('Mobile Menu', 'azen'),
    'id' => 'mobile_menu_title',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'icon_color',
            'type' => 'color',
            'title' => esc_html__('Color Hamburger icon', 'azen'),
            'transparent' => false,
            'default' => '#111'
        ),

        array(
            'id' => 'mobile_menu_bg_color',
            'type' => 'color',
            'title' => esc_html__('Background Item Color', 'azen'),
            'transparent' => false,
            'default' => '#fff',
        ),
        array(
            'id' => 'mobile_sub_menu_bg_color',
            'type' => 'color',
            'title' => esc_html__('Background Sub Item Color', 'azen'),
            'transparent' => false,
            'default' => '#f2f2f2',
        ),

        array(
            'id' => 'mobile_menu_text_color',
            'type' => 'color',
            'title' => esc_html__('Text Color', 'azen'),
            'transparent' => false,
            'default' => '#111',
        ),

        array(
            'id' => 'mobile_menu_text_hover_color',
            'type' => 'color',
            'title' => esc_html__('Text Hover Color', 'azen'),
            'transparent' => false,
            'default' => '#000',
        ),
        array(
            'id' => 'mobile_border_item_color',
            'type' => 'color',
            'title' => esc_html__('Border Item Color', 'azen'),
            'transparent' => false,
            'default' => '#e9e9e9',
        ),
    )
));

// Top bar

Redux::setSection($opt_name, array(
    'title' => esc_html__('Top bar', 'azen'),
    'id' => 'top_bar_azen',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'top_bar_bg_color',
            'type' => 'color',
            'title' => esc_html__('Background Top Bar Color', 'azen'),
            'transparent' => false,
            'default' => '#111',
        ),

        array(
            'id' => 'top_bar_text_color',
            'type' => 'color',
            'title' => esc_html__('Top Bar Text Color', 'azen'),
            'transparent' => false,
            'default' => '#fff',
        ),
        array(
            'id' => 'top_bar_text_hover_color',
            'type' => 'color',
            'title' => esc_html__('Text Top Bar Hover Color', 'azen'),
            'transparent' => false,
            'default' => '#fff',
        ),
        array(
            'id' => 'font_size_text_top_bar',
            'type' => 'spinner',
            'title' => esc_html__('Font Size Top Bar(px)', 'azen'),
            'default' => '11',
            'min' => '1',
            'step' => '1',
            'max' => '50',
        ),

    )
));