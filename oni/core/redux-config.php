<?php
    if ( !class_exists( 'GT3_Core_Elementor' ) || !class_exists( 'Redux' ) ) {
        return;
    }

    $theme = wp_get_theme();
    $opt_name = 'oni';

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__('Theme Options', 'oni' ),
        'page_title'           => esc_html__('Theme Options', 'oni' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => true,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-admin-generic',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => false,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => 'dashicons-admin-generic',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,
    );


    Redux::setArgs( $opt_name, $args );

    /* Header Presets result */

    $preset_opt = gt3_option('gt3_header_builder_presets');
    $presets_array = array();
    if (!empty($preset_opt) && is_array($preset_opt)) {
        if (isset($preset_opt['current_active'])) {
            unset($preset_opt['current_active']);
        }
        if (isset($preset_opt['def_preset'])) {
            unset($preset_opt['def_preset']);
        }
        if (isset($preset_opt['items_count'])) {
            unset($preset_opt['items_count']);
        }
        foreach ($preset_opt as $key => $value) {
            if (!empty($value['title'])) {
                $presets_array[$key] = $value['title'];
            }else{
                $presets_array[$key] = esc_html__( 'No Name', 'oni' );
            }
        }
    }
    
    /* Header Presets result */

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'oni' ),
        'id'               => 'general',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'responsive',
                'type'     => 'switch',
                'title'    => esc_html__( 'Responsive', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Comments', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'back_to_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back to Top', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'    => 'team_slug',
                'type'  => 'text',
                'title' => esc_html__( 'Team Slug', 'oni' ),
            ),
            array(
                'id'    => 'portfolio_slug',
                'type'  => 'text',
                'title' => esc_html__( 'Portfolio Slug', 'oni' ),
            ),
            array(
                'id'       => 'page_404_bg',
                'type'     => 'media',
                'title'    => esc_html__( 'Page 404 Background Image', 'oni' ),
            ),
            array(
                'id'       => 'body_bg_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Page Title Background Image', 'oni' ),
            ),
            array(
                'id'       => 'body_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => esc_html__( 'Body Background Image', 'oni' ),
                'default'  => array(
                    'background-repeat' => 'no-repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                )
            ),
            array(
		        'id'       => 'disable_right_click',
		        'type'     => 'switch',
		        'title'    => esc_html__( 'Disable right click', 'oni' ),
		        'default'  => false,
	        ),
	        array(
		        'id'       => 'disable_right_click_text',
		        'type'     => 'text',
		        'title'    => esc_html__( 'Right click alert text', 'oni' ),
		        'default'  => esc_html__('The right click is disabled. Your content is protected. You can configure this option in the theme.', 'oni' ),
		        'required' => array( 'disable_right_click', '=', '1' ),
	        ),
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'oni' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'oni' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
            array(
                'id'       => 'header_custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'oni' ),
                'subtitle' => esc_html__( 'Code to be added inside HEAD tag', 'oni' ),
                'mode'     => 'html',
                'theme'    => 'chrome',
                'default'  => "<script type='text/javascript'>\njQuery(document).ready(function(){\n\n});\n</script>"
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'             => esc_html__('Preloader', 'oni' ),
        'id'                => 'preloader-option',
        'customizer_width'  => '400px',
        'icon'              => 'el-icon-graph',
        'fields'            => array(
            array(
                'id'            => 'preloader',
                'type'          => 'switch',
                'title'         => esc_html__( 'Preloader', 'oni' ),
                'default'       => false,
            ),
            array(
                'id'            => 'preloader_type',
                'type'          => 'button_set',
                'title'         => esc_html__( 'Preloader type', 'oni' ),
                'options'       => array(
                    'linear'        => esc_html__( 'Linear', 'oni' ),
                    'circle'        => esc_html__( 'Circle', 'oni' ),
                    'theme'         => esc_html__( 'Theme', 'oni' ),
                ),
                'default'       => 'circle',
                'required'      => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'            => 'preloader_background',
                'type'          => 'color',
                'title'         => esc_html__( 'Preloader Background', 'oni' ),
                'subtitle'      => esc_html__( 'Set Preloader Background', 'oni' ),
                'default'       => '#191a1c',
                'transparent'   => false,
                'required'      => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'            => 'preloader_item_color',
                'type'          => 'color',
                'title'         => esc_html__( 'Preloader Stroke Background Color', 'oni' ),
                'subtitle'      => esc_html__( 'Set Preloader Stroke Background Color', 'oni' ),
                'default'       => '#ffffff',
                'transparent'   => false,
                'required'      => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'            => 'preloader_item_color2',
                'type'          => 'color',
                'title'         => esc_html__( 'Preloader Stroke Foreground Color', 'oni' ),
                'subtitle'      => esc_html__( 'Set Preloader Stroke Foreground Color', 'oni' ),
                'default'       => '#435bb2',
                'transparent'   => false,
                'required'      => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'            => 'preloader_item_width',
                'type'          => 'dimensions',
                'title'         => esc_html__( 'Preloader Circle Width', 'oni' ),
                'subtitle'      => esc_html__( 'Set Preloader Circle Width in px (Diameter)', 'oni' ),
                'units'         => false,
                'height'        => false,
                'default'       => array(
                    'width'         => '140',
                ),
                'transparent'   => false,
                'required'      => array(
                    array( 'preloader', '=', '1' ),
                    array( 'preloader_type', '=', array('circle','theme') )
                ),
            ),
            array(
                'id'            => 'preloader_item_stroke',
                'type'          => 'dimensions',
                'title'         => esc_html__( 'Preloader Circle Stroke Width', 'oni' ),
                'subtitle'      => esc_html__( 'Set Preloader Circle Stroke Width in px', 'oni' ),
                'units'         => false,
                'height'        => false,
                'default'       => array(
                    'width'         => '3'
                ),
                'transparent'   => false,
                'required'      => array(
                    array( 'preloader', '=', '1' ),
                    array( 'preloader_type', '=', array('circle','theme') )
                ),
            ),
            array(
                'id'            => 'preloader_item_logo',
                'type'          => 'media',
                'title'         => esc_html__( 'Preloader Logo', 'oni' ),
                'required'      => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'            => 'preloader_item_logo_width',
                'type'          => 'dimensions',
                'title'         => esc_html__( 'Preloader Logo Width', 'oni' ),
                'subtitle'      => esc_html__( 'Set Preloader Logo Width', 'oni' ),
                'units'         => array('px','%'),
                'height'        => false,
                'default'       => array(
                    'width'         => '45',
                    'units'         => 'px',
                ),
                'transparent'   => false,
                'required'      => array(
                    array( 'preloader', '=', '1' ),
	                array( 'preloader_type', '=', array('circle','theme') )
                ),
            ),
            array(
                'id'            => 'preloader_full',
                'type'          => 'switch',
                'title'         => esc_html__( 'Preloader Fullscreen', 'oni' ),
                'default'       => true,
                'required'      => array( 'preloader', '=', '1' ),
            ),
        )
    ) );



// HEADER
if (function_exists('gt3_header_presets')) {
    $presets = gt3_header_presets();
    $header_preset_1 = $presets['header_preset_1'];
    $header_preset_2 = $presets['header_preset_2'];
    $header_preset_3 = $presets['header_preset_3'];
}

function gt3_getMenuList(){
    $menus = wp_get_nav_menus();
    $menu_list = array();

    foreach ($menus as $menu => $menu_obj) {
        $menu_list[$menu_obj->slug] = $menu_obj->name;
    }
    return $menu_list;
}


$def_header_option = array(
    'all_item'      => array(
        'title'   => esc_html__('All Item', 'oni' ),
        'layout'  => 'all',
        'content' => array(
            'search'         => array(
                'title'        => esc_html__('Search', 'oni' ),
                'has_settings' => true,
            ),
            'login'          => array(
                'title'        => esc_html__('Login', 'oni' ),
                'has_settings' => false,
            ),
            'cart'           => array(
                'title'        => esc_html__('Cart', 'oni' ),
                'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title'        => esc_html__('Burger Sidebar', 'oni' ),
                'has_settings' => true,
            ),
            'text1'          => array(
                'title'        => esc_html__('Text/HTML 1', 'oni' ),
                'has_settings' => true,
            ),
            'text2'          => array(
                'title'        => esc_html__('Text/HTML 2', 'oni' ),
                'has_settings' => true,
            ),

            'text3' => array(
                'title'        => esc_html__('Text/HTML 3', 'oni' ),
                'has_settings' => true,
            ),
            'text4' => array(
                'title'        => esc_html__('Text/HTML 4', 'oni' ),
                'has_settings' => true,
            ),

            'text5'      => array(
                'title'        => esc_html__('Text/HTML 5', 'oni' ),
                'has_settings' => true,
            ),
            'text6'      => array(
                'title'        => esc_html__('Text/HTML 6', 'oni' ),
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left'      => array(
        'title'        => esc_html__('Top Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'top_center'    => array(
        'title'        => esc_html__('Top Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'top_right'     => array(
        'title'        => esc_html__('Top Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'middle_left'   => array(
        'title'        => esc_html__('Middle Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'content'      => array(
            'logo' => array(
                'title'        => esc_html__('Logo', 'oni' ),
                'has_settings' => true,
            ),
        ),
    ),
    'middle_center' => array(
        'title'        => esc_html__('Middle Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'middle_right'  => array(
        'title'        => esc_html__('Middle Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(
            'menu' => array(
                'title'        => esc_html__('Menu', 'oni' ),
                'has_settings' => true,
            ),
        ),
    ),
    'bottom_left'   => array(
        'title'        => esc_html__('Bottom Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'content'      => array(),
    ),
    'bottom_center' => array(
        'title'        => esc_html__('Bottom Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'bottom_right'  => array(
        'title'        => esc_html__('Bottom Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),

    /// tablet
    'all_item__tablet' => array(
        'title' => esc_html__('All Item', 'oni' ),
        'layout' => 'all',
        'extra_class' => 'tablet',
        'content' => array(
            'logo' => array(
                'title'        => esc_html__('Logo', 'oni' ),
                'has_settings' => true,
            ),
            'menu' => array(
                'title'        => esc_html__('Menu', 'oni' ),
                'has_settings' => true,
            ),
            'search' => array(
                'title' => esc_html__('Search', 'oni' ),
                'has_settings' => true,
            ),
            'login' => array(
                'title' => esc_html__('Login', 'oni' ),
                'has_settings' => false,
            ),
            'cart' => array(
                'title' => esc_html__('Cart', 'oni' ),
                'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title' => esc_html__('Burger Sidebar', 'oni' ),
                'has_settings' => true,
            ),
            'text1' => array(
                'title' => esc_html__('Text/HTML 1', 'oni' ),
                'has_settings' => true,
            ),
            'text2' => array(
                'title' => esc_html__('Text/HTML 2', 'oni' ),
                'has_settings' => true,
            ),

            'text3' => array(
                'title' => esc_html__('Text/HTML 3', 'oni' ),
                'has_settings' => true,
            ),
            'text4' => array(
                'title' => esc_html__('Text/HTML 4', 'oni' ),
                'has_settings' => true,
            ),

            'text5' => array(
                'title' => esc_html__('Text/HTML 5', 'oni' ),
                'has_settings' => true,
            ),
            'text6' => array(
                'title' => esc_html__('Text/HTML 6', 'oni' ),
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left__tablet'      => array(
        'title'        => esc_html__('Top Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'top_center__tablet'    => array(
        'title'        => esc_html__('Top Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'top_right__tablet'     => array(
        'title'        => esc_html__('Top Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_left__tablet'   => array(
        'title'        => esc_html__('Middle Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_center__tablet' => array(
        'title'        => esc_html__('Middle Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_right__tablet'  => array(
        'title'        => esc_html__('Middle Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_left__tablet'   => array(
        'title'        => esc_html__('Bottom Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_center__tablet' => array(
        'title'        => esc_html__('Bottom Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_right__tablet'  => array(
        'title'        => esc_html__('Bottom Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),


    /// mobile
    'all_item__mobile' => array(
        'title' => esc_html__('All Item', 'oni' ),
        'layout' => 'all',
        'extra_class' => 'mobile',
        'content' => array(
            'logo' => array(
                'title'        => esc_html__('Logo', 'oni' ),
                'has_settings' => true,
            ),
            'menu' => array(
                'title'        => esc_html__('Menu', 'oni' ),
                'has_settings' => true,
            ),
            'search' => array(
                'title' => esc_html__('Search', 'oni' ),
                'has_settings' => true,
            ),
            'login' => array(
                'title' => esc_html__('Login', 'oni' ),
                'has_settings' => false,
            ),
            'cart' => array(
                'title' => esc_html__('Cart', 'oni' ),
                'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title' => esc_html__('Burger Sidebar', 'oni' ),
                'has_settings' => true,
            ),
            'text1' => array(
                'title' => esc_html__('Text/HTML 1', 'oni' ),
                'has_settings' => true,
            ),
            'text2' => array(
                'title' => esc_html__('Text/HTML 2', 'oni' ),
                'has_settings' => true,
            ),

            'text3' => array(
                'title' => esc_html__('Text/HTML 3', 'oni' ),
                'has_settings' => true,
            ),
            'text4' => array(
                'title' => esc_html__('Text/HTML 4', 'oni' ),
                'has_settings' => true,
            ),

            'text5' => array(
                'title' => esc_html__('Text/HTML 5', 'oni' ),
                'has_settings' => true,
            ),
            'text6' => array(
                'title' => esc_html__('Text/HTML 6', 'oni' ),
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left__mobile'      => array(
        'title'        => esc_html__('Top Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'top_center__mobile'    => array(
        'title'        => esc_html__('Top Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'top_right__mobile'     => array(
        'title'        => esc_html__('Top Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_left__mobile'   => array(
        'title'        => esc_html__('Middle Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_center__mobile' => array(
        'title'        => esc_html__('Middle Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_right__mobile'  => array(
        'title'        => esc_html__('Middle Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_left__mobile'   => array(
        'title'        => esc_html__('Bottom Left', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_center__mobile' => array(
        'title'        => esc_html__('Bottom Center', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_right__mobile'  => array(
        'title'        => esc_html__('Bottom Right', 'oni' ),
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
);

$options = array(    
    array(
        'id'   => 'gt3_header_builder_id',
        'type' => 'gt3_header_builder',
        'full_width' => true,
        'presets' => 'default',
        'reload_on_change' => true,
        'options' => array(
            'all_item' => array(
                'title' => esc_html__('All Item', 'oni' ),
                'layout' => 'all',
                'content' => array(
                    'search' => array(
                        'title' => esc_html__('Search', 'oni' ),
                        'has_settings' => true,
                    ),
                    'login' => array(
                        'title' => esc_html__('Login', 'oni' ),
                        'has_settings' => false,
                    ),
                    'cart' => array(
                        'title' => esc_html__('Cart', 'oni' ),
                        'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => esc_html__('Burger Sidebar', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => esc_html__('Text/HTML 1', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => esc_html__('Text/HTML 2', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text3' => array(
                        'title' => esc_html__('Text/HTML 3', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => esc_html__('Text/HTML 4', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text5' => array(
                        'title' => esc_html__('Text/HTML 5', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => esc_html__('Text/HTML 6', 'oni' ),
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),
            'top_left' => array(
                'title' => esc_html__('Top Left', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'top_center' => array(
                'title' => esc_html__('Top Center', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'top_right' => array(
                'title' => esc_html__('Top Right', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'middle_left' => array(
                'title' => esc_html__('Middle Left', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds clear-item',
                'content' => array(
                    'logo' => array(
                        'title' => esc_html__('Logo', 'oni' ),
                        'has_settings' => true,
                    ),
                ),
            ),
            'middle_center' => array(
                'title' => esc_html__('Middle Center', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(),
            ),
            'middle_right' => array(
                'title' => esc_html__('Middle Right', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                    'menu' => array(
                        'title' => esc_html__('Menu', 'oni' ),
                        'has_settings' => true,
                    ),
                ),
            ),
            'bottom_left' => array(
                'title' => esc_html__('Bottom Left', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds clear-item',
                'content' => array(),
            ),
            'bottom_center' => array(
                'title' => esc_html__('Bottom Center', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(

                ),
            ),
            'bottom_right' => array(
                'title' => esc_html__('Bottom Right', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(

                ),
            ),

            /// tablet
            'all_item__tablet' => array(
                'title' => esc_html__('All Item', 'oni' ),
                'layout' => 'all',
                'extra_class' => 'tablet',
                'content' => array(
                    'logo' => array(
                        'title'        => esc_html__('Logo', 'oni' ),
                        'has_settings' => true,
                    ),
                    'menu' => array(
                        'title'        => esc_html__('Menu', 'oni' ),
                        'has_settings' => true,
                    ),
                    'search' => array(
                        'title' => esc_html__('Search', 'oni' ),
                        'has_settings' => true,
                    ),
                    'login' => array(
                        'title' => esc_html__('Login', 'oni' ),
                        'has_settings' => false,
                    ),
                    'cart' => array(
                        'title' => esc_html__('Cart', 'oni' ),
                        'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => esc_html__('Burger Sidebar', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => esc_html__('Text/HTML 1', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => esc_html__('Text/HTML 2', 'oni' ),
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => esc_html__('Text/HTML 3', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => esc_html__('Text/HTML 4', 'oni' ),
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => esc_html__('Text/HTML 5', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => esc_html__('Text/HTML 6', 'oni' ),
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),


            'top_left__tablet'      => array(
                'title'        => esc_html__('Top Left', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'top_center__tablet'    => array(
                'title'        => esc_html__('Top Center', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'top_right__tablet'     => array(
                'title'        => esc_html__('Top Right', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_left__tablet'   => array(
                'title'        => esc_html__('Middle Left', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_center__tablet' => array(
                'title'        => esc_html__('Middle Center', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_right__tablet'  => array(
                'title'        => esc_html__('Middle Right', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_left__tablet'   => array(
                'title'        => esc_html__('Bottom Left', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_center__tablet' => array(
                'title'        => esc_html__('Bottom Center', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_right__tablet'  => array(
                'title'        => esc_html__('Bottom Right', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),

            /// mobile
            'all_item__mobile' => array(
                'title' => esc_html__('All Item', 'oni' ),
                'layout' => 'all',
                'extra_class' => 'mobile',
                'content' => array(
                    'logo' => array(
                        'title'        => esc_html__('Logo', 'oni' ),
                        'has_settings' => true,
                    ),
                    'menu' => array(
                        'title'        => esc_html__('Menu', 'oni' ),
                        'has_settings' => true,
                    ),
                    'search' => array(
                        'title' => esc_html__('Search', 'oni' ),
                        'has_settings' => true,
                    ),
                    'login' => array(
                        'title' => esc_html__('Login', 'oni' ),
                        'has_settings' => false,
                    ),
                    'cart' => array(
                        'title' => esc_html__('Cart', 'oni' ),
                        'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => esc_html__('Burger Sidebar', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => esc_html__('Text/HTML 1', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => esc_html__('Text/HTML 2', 'oni' ),
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => esc_html__('Text/HTML 3', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => esc_html__('Text/HTML 4', 'oni' ),
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => esc_html__('Text/HTML 5', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => esc_html__('Text/HTML 6', 'oni' ),
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),
            'top_left__mobile'      => array(
                'title'        => esc_html__('Top Left', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'top_center__mobile'    => array(
                'title'        => esc_html__('Top Center', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'top_right__mobile'     => array(
                'title'        => esc_html__('Top Right', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_left__mobile'   => array(
                'title'        => esc_html__('Middle Left', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_center__mobile' => array(
                'title'        => esc_html__('Middle Center', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_right__mobile'  => array(
                'title'        => esc_html__('Middle Right', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_left__mobile'   => array(
                'title'        => esc_html__('Bottom Left', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_center__mobile' => array(
                'title'        => esc_html__('Bottom Center', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_right__mobile'  => array(
                'title'        => esc_html__('Bottom Right', 'oni' ),
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
        ),
        'default' => array(
            'all_item' => array(
                'title' => esc_html__('All Item', 'oni' ),
                'layout' => 'all',
                'content' => array(
                    'search' => array(
                        'title' => esc_html__('Search', 'oni' ),
                        'has_settings' => true,
                    ),
                    'login' => array(
                        'title' => esc_html__('Login', 'oni' ),
                        'has_settings' => false,
                    ),
                    'cart' => array(
                        'title' => esc_html__('Cart', 'oni' ),
                        'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => esc_html__('Burger Sidebar', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => esc_html__('Text/HTML 1', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => esc_html__('Text/HTML 2', 'oni' ),
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => esc_html__('Text/HTML 3', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => esc_html__('Text/HTML 4', 'oni' ),
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => esc_html__('Text/HTML 5', 'oni' ),
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => esc_html__('Text/HTML 6', 'oni' ),
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                ),
            ),
            'top_left' => array(
                'title' => esc_html__('Top Left', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'top_center' => array(
                'title' => esc_html__('Top Center', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'top_right' => array(
                'title' => esc_html__('Top Right', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'middle_left' => array(
                'title' => esc_html__('Middle Left', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds clear-item',
                'content' => array(
                    'logo' => array(
                        'title' => esc_html__('Logo', 'oni' ),
                        'has_settings' => true,
                    ),
                ),
            ),
            'middle_center' => array(
                'title' => esc_html__('Middle Center', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(

                ),
            ),
            'middle_right' => array(
                'title' => esc_html__('Middle Right', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                    'menu' => array(
                        'title' => esc_html__('Menu', 'oni' ),
                        'has_settings' => true,
                    ),
                ),
            ),
            'bottom_left' => array(
                'title' => esc_html__('Bottom Left', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds clear-item',
                'content' => array(

                ),
            ),
            'bottom_center' => array(
                'title' => esc_html__('Bottom Center', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(

                ),
            ),
            'bottom_right' => array(
                'title' => esc_html__('Bottom Right', 'oni' ),
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
        ),
        'default'    => $def_header_option,
    ),

    //HEADER TEMPLATES
    // MAIN HEADER SETTINGS
    array(
        'id'           => 'header_templates-start',
        'type'         => 'gt3_section',
        'title'        => esc_html__('Header Templates', 'oni'),
        'indent'       => false,
        'section_role' => 'start'
    ),

    //HEADER TEMPLATES
    array(
        'id'         => 'gt3_header_builder_presets',
        'type'       => 'gt3_presets',
        'presets'    => true,
        'full_width' => true,
        'title'      => esc_html__('Gt3 Preset', 'oni'),
        'subtitle'   => esc_html__('This allows you to set default header layout.', 'oni'),
        'default'    => array(
            '0' => array(
                'title'     => esc_html__('Default', 'oni'),
                'preset' => json_encode(array('gt3_header_builder_id' => $def_header_option))
            ),
        ),
        'templates' => array(
            '1' => array(
                'alt'     => esc_html__('Header 1', 'oni' ),
                'img'     => get_template_directory_uri() . '/core/admin/img/header_1.jpg',
                'presets' => $header_preset_1
            ),
            '2' => array(
                'alt'     => esc_html__('Header 2', 'oni' ),
                'img'     => get_template_directory_uri() . '/core/admin/img/header_2.jpg',
                'presets' => $header_preset_2
            ),
            '3' => array(
                'alt'     => esc_html__('Header 3', 'oni' ),
                'img'     => get_template_directory_uri() . '/core/admin/img/header_3.jpg',
                'presets' => $header_preset_3
            ),
        ),
        'options' => array(),
    ),
    array(
        'id'           => 'header_templates-end',
        'type'         => 'gt3_section',
        'indent'       => false,
        'section_role' => 'end'
    ),

    //NO ITEM SETTINGS
    array(
        'id'       => 'no_item-start',
        'type'     => 'gt3_section',
        'title'    => esc_html__( 'Header Settings', 'oni' ),
        'indent'   => false,
        'section_role' => 'start'
    ),

    array(
        'id'   => 'no_item_message',
        'type' => 'info',
        'style' => 'warning',
        'title' => esc_html__('Warning!', 'oni'),
        'icon'  => 'el-icon-info-sign',
        'desc' => esc_html__('To modify the settings, please add any item to the header section. It can not be empty.', 'oni')
    ),
    array(
        'id'            => 'no_item-end',
        'type'          => 'gt3_section',
        'indent'        => false,
        'section_role'  => 'end'
    ),


    //LOGO SETTINGS
    array(
        'id'       => 'logo-start',
        'type'     => 'gt3_section',
        'title'    => esc_html__( 'Logo Settings', 'oni' ),
        'indent'   => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'header_logo',
        'type'     => 'media',
        'title'    => esc_html__( 'Header Logo', 'oni' ),
    ),
    array(
        'id'       => 'logo_height_custom',
        'type'     => 'switch',
        'title'    => esc_html__( 'Enable Logo Height', 'oni' ),
        'default'  => true,
    ),
    array(
        'id'             => 'logo_height',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => esc_html__( 'Set Logo Height' , 'oni' ),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => 23,
        ),
        'required'      => array( 'logo_height_custom', '=', '1' ),
    ),
    array(
        'id'            => 'logo_max_height',
        'type'          => 'switch',
        'title'         => esc_html__( 'Don\'t limit maximum height', 'oni' ),
        'default'       => false,
        'required'      => array( 'logo_height_custom', '=', '1' ),
    ),
    array(
        'id'             => 'sticky_logo_height',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => __( 'Set Sticky Logo Height' , 'oni' ),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => '',
        ),
        'required'      => array(
            array( 'logo_height_custom', '=', '1' ),
            array( 'logo_max_height', '=', '1' ),
        ),
    ),
    array(
        'id'            => 'logo_sticky',
        'type'          => 'media',
        'title'         => __( 'Sticky Logo', 'oni' ),
    ),

    array(
        'id'            => 'logo_tablet',
        'type'          => 'media',
        'title'         => __( 'Tablet Logo', 'oni' ),
    ),
    array(
        'id'             => 'logo_teblet_width',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => __( 'Set Logo Width on Tablet' , 'oni' ),
        'height'         => false,
        'width'          => true,
    ),

    array(
        'id'            => 'logo_mobile',
        'type'          => 'media',
        'title'         => __( 'Mobile Logo', 'oni' ),
    ),
    array(
        'id'             => 'logo_mobile_width',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => __( 'Set Logo Width on Mobile' , 'oni' ),
        'height'         => false,
        'width'          => true,
    ),


    array(
        'id'            => 'logo-end',
        'type'          => 'gt3_section',
        'indent'        => false,
        'section_role'  => 'end'
    ),

    // MENU
    array(
        'id'            => 'menu-start',
        'type'          => 'gt3_section',
        'title'         => __( 'Menu Settings', 'oni' ),
        'indent'        => false,
        'section_role'  => 'start'
    ),
    array(
        'id'            => 'menu_select',
        'type'          => 'select',
        'title'         => esc_html__( 'Select Menu', 'oni' ),
        'options'       => gt3_getMenuList(),
        'default'       => '',
    ),
    array(
        'id'            => 'menu_ative_top_line',
        'type'          => 'switch',
        'title'         => esc_html__( 'Enable Active Menu Item Marker', 'oni' ),
        'default'       => false,
    ),
    array(
        'id'            => 'sub_menu_background',
        'type'          => 'color_rgba',
        'title'         => __( 'Sub Menu Background', 'oni' ),
        'subtitle'      => __( 'Set the background color for sub menu', 'oni' ),
        'default'       => array(
            'color' => '#1d1e20',
            'alpha' => '1',
            'rgba'  => 'rgba(29,30,32,1)'
        ),
        'mode'          => 'background',
    ),
    array(
        'id'            => 'sub_menu_color',
        'type'          => 'color',
        'title'         => __( 'Menu Text Color', 'oni' ),
        'subtitle'      => __( 'Set the header text color for menu', 'oni' ),
        'default'       => '#9da1a5',
        'transparent'   => false,
    ),
    array(
        'id'            => 'sub_menu_color_hover',
        'type'          => 'color',
        'title'         => __( 'Menu Text Color on Hover and Current', 'oni' ),
        'subtitle'      => __( 'Set the header text color for menu on hover and Current menu', 'oni' ),
        'default'       => '#ffffff',
        'transparent'   => false,
    ),
    array(
        'id'            => 'menu-end',
        'type'          => 'gt3_section',
        'indent'        => true,
        'section_role'  => 'end'

    ),

    // BURGER SIDEBAR
    array(
        'id'       => 'burger_sidebar-start',
        'type'     => 'gt3_section',
        'title'    => __( 'Burger Sidebar Settings', 'oni' ),
        'indent'   => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'burger_sidebar_select',
        'type'     => 'select',
        'title'    => esc_html__( 'Select Sidebar', 'oni' ),
        'data'     => 'sidebars',
    ),
    array(
        'id'     => 'burger_sidebar-end',
        'type'   => 'gt3_section',
        'indent' => false,
        'section_role' => 'end'
    ),

    // Search
    array(
        'id'       => 'search-start',
        'type'     => 'gt3_section',
        'title'    => __( 'Search Settings', 'oni' ),
        'indent'   => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'header_search_title',
        'type'     => 'text',
        'title'    => esc_html__('Search Title', 'oni'),
        'validate' => 'no_html',
        'default'  => 'WHAT ARE YOU LOOKING FOR TODAY?'
    ),
    array(
        'id'     => 'search-end',
        'type'   => 'gt3_section',
        'indent' => false,
        'section_role' => 'end'
    ),


);


$responsive_sections = array('','__tablet','__mobile');

$sections = array(
    'top_left'      => esc_html__('Top Left Settings', 'oni'),
    'top_center'    => esc_html__('Top Center Settings', 'oni'),
    'top_right'     => esc_html__('Top Right Settings', 'oni'),
    'middle_left'   => esc_html__('Middle Left Settings', 'oni'),
    'middle_center' => esc_html__('Middle Center Settings', 'oni'),
    'middle_right'  => esc_html__('Middle Right Settings', 'oni'),
    'bottom_left'   => esc_html__('Bottom Left Settings', 'oni'),
    'bottom_center' => esc_html__('Bottom Center Settings', 'oni'),
    'bottom_right'  => esc_html__('Bottom Right Settings', 'oni'),
);

$responsive_tabs = array(
    'desktop' => esc_html__( 'Desktop', 'oni' ),
    'tablet' => esc_html__( 'Tablet', 'oni' ),
    'mobile' => esc_html__( 'Mobile', 'oni' ),
);

$header_global_settings = array();
foreach ($responsive_tabs as $responsive_tab => $responsive_tab_translate) {
    array_push($header_global_settings,
        array(
            'id'       => $responsive_tab.'_header_settings-start',
            'type'     => 'gt3_section',
            'title'    => $responsive_tab_translate.esc_html__( ' Settings', 'oni' ),
            'indent'   => false,
            'section_role' => 'start'
        )
    );

    if ($responsive_tab == 'desktop') {
        array_push($header_global_settings,
            array(
                'id'       => 'header_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Header', 'oni' ),
                'subtitle' => esc_html__( 'Set header content in full width layout', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'header_on_bg',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Above Content', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'header_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'oni' ),
                'default'  => false,
            )
        );
    }else{
        array_push($header_global_settings,
            array(
                'id'       => $responsive_tab.'_header_on_bg',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Above Content', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => $responsive_tab.'_header_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'oni' ),
                'default'  => false,
                'required' => array( 'header_sticky', '=', '1' ),
            )
        );
    }

    if ($responsive_tab == 'desktop') {
        array_push($header_global_settings,
            array(
                'id'       => 'header_sticky_appearance_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Sticky Appearance Style', 'oni' ),
                'options'  => array(
                    'classic' => esc_html__( 'Classic', 'oni' ),
                    'scroll_top' => esc_html__( 'Appearance only on scroll top', 'oni' ),
                ),
                'required' => array( 'header_sticky', '=', '1' ),
                'default'  => 'classic'
            ),
            array(
                'id'       => 'header_sticky_appearance_from_top',
                'type'     => 'select',
                'title'    => esc_html__( 'Sticky Header Appearance From Top of Page', 'oni' ),
                'options'  => array(
                    'auto' => esc_html__( 'Auto', 'oni' ),
                    'custom' => esc_html__( 'Custom', 'oni' ),
                ),
                'required' => array( 'header_sticky', '=', '1' ),
                'default'  => 'auto'
            ),
            array(
                'id'             => 'header_sticky_appearance_number',
                'type'           => 'dimensions',
                'units'          => false,
                'units_extended' => false,
                'title'          => __( 'Set the distance from the top of the page', 'oni' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 300,
                ),
                'required' => array( 'header_sticky_appearance_from_top', '=', 'custom' ),
            ),
            array(
                'id'       => 'header_sticky_shadow',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header Bottom Shadow', 'oni' ),
                'default'  => true,
                'required' => array( 'header_sticky', '=', '1' ),
            )
        );
    }

    array_push($header_global_settings,
        array(
            'id'     => $responsive_tab.'_header_settings-end',
            'type'   => 'gt3_section',
            'indent' => false,
            'section_role' => 'end'
        )
    );
}


// add align options to each section
$aligns = array();
foreach ($responsive_sections as $responsive_section) {
    foreach ($sections as $section => $section_translate) {
        $default = explode("_", $section);
        array_push($aligns,
            array(
                'id'           => $section.$responsive_section.'-start',
                'type'         => 'gt3_section',
                'title'        => $section_translate,
                'indent'       => false,
                'section_role' => 'start'
            ),
            array(
                'id'      => $section.$responsive_section.'-align',
                'type'    => 'select',
                'title'   => esc_html__('Item Align', 'oni'),
                'options' => array(
                    'left'   => esc_html__('Left', 'oni'),
                    'center' => esc_html__('Center', 'oni'),
                    'right'  => esc_html__('Right', 'oni'),
                ),
                'default' => !empty($default[1]) ? $default[1] : 'left',
            ),
            array(
                'id'           => $section.$responsive_section.'-end',
                'type'         => 'gt3_section',
                'indent'       => false,
                'section_role' => 'end'
            )
        );
    }
}


$side_opt = array();
$sides = array(
    'top'      => esc_html__('Top Header Settings', 'oni'),
    'middle'   => esc_html__('Middle Header Settings', 'oni'),
    'bottom'   => esc_html__('Bottom Header Settings', 'oni'),
);
foreach ($responsive_sections as $responsive_section) {
    foreach ($sides as $side => $section_translate) {

        $background_color = $background_color2 = $border_color  = array();

        $color = '';
        $color_hover = '';
        $height = '';

        if (empty($responsive_section)) {
            $background_color = array(
                'color' => '#ffffff',
                'alpha' => '0',
                'rgba'  => 'rgba(255,255,255,0)'
            );
            $background_color2 = array(
                'color' => '#ffffff',
                'alpha' => '0',
                'rgba'  => 'rgba(255,255,255,0)'
            );
            $color = '#ffffff';
            $color_hover = '#ffffff';
            $height = '80';
            $border_color = array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => 'rgba(255,255,255,1)'
            );

        }

        array_push($side_opt,
            //TOP SIDE
            array(
                'id'           => 'side_'.$side.$responsive_section.'-start',
                'type'         => 'gt3_section',
                'title'        => $section_translate,
                'indent'       => false,
                'section_role' => 'start'
            )
        );

        if (!empty($responsive_section)) {
            array_push($side_opt,
                //TOP SIDE
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_custom',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Customize ', 'oni' ).$section_translate,
                    'default'  => false,
                ),
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_styling-start',
                    'type'     => 'section',
                    'title'    => esc_html__( 'Customize ', 'oni' ).$section_translate,
                    'indent'   => true,
                    'required' => array( 'side_'.$side.$responsive_section.'_custom', '=', '1' ),
                )
            );
        }

        array_push($side_opt,
            array(
                'id'       => 'side_'.$side.$responsive_section.'_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Background', 'oni'),
                'subtitle' => esc_html__('Set background color', 'oni'),
                'default'  => $background_color,
                'mode'     => 'background',
            ),
            array(
                'id'       => 'side_'.$side.$responsive_section.'_background2',
                'type'     => 'color_rgba',
                'title'    => __( 'Inner Background', 'oni' ),
                'subtitle' => __( 'Set background color', 'oni' ),
                'default'  => $background_color2,
                'mode'     => 'background',
                'required' => array( 'header_full_width', '!=', '1' ),
            ),
            array(
                'id'          => 'side_'.$side.$responsive_section.'_color',
                'type'        => 'color',
                'title'       => esc_html__('Text Color', 'oni'),
                'subtitle'    => esc_html__('Set text color', 'oni'),
                'default'     => $color,
                'transparent' => false,
            ),
            array(
                'id'          => 'side_'.$side.$responsive_section.'_color_hover',
                'type'        => 'color',
                'title'       => esc_html__('Link Text Color on Hover', 'oni'),
                'subtitle'    => esc_html__('Set text color', 'oni'),
                'default'     => $color_hover,
                'transparent' => false,
            ),
            array(
                'id'             => 'side_'.$side.$responsive_section.'_height',
                'type'           => 'dimensions',
                'units'          => false,
                'units_extended' => false,
                'title'          => esc_html__('Height', 'oni'),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => $height,
                )
            ),
            array(
                'id'            => 'side_'.$side.$responsive_section.'_spacing',
                'type'          => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'          => 'padding',
                'units'         => 'px',
                'all'           => false,
                'bottom'        => false,
                'top'           => false,
                'left'          => true,
                'right'         => true,
                'title'         => esc_html__( 'Padding (px)', 'oni' ),
                'subtitle'      => esc_html__( 'Set empty padding-left/-right to default 20px', 'oni' ),
                'default'       => array(
                    'padding-left'   => '',
                    'padding-right'  => '',

                )
            ),

            array(
                'id'      => 'side_'.$side.$responsive_section.'_border',
                'type'    => 'switch',
                'title'   => esc_html__('Set Bottom Border', 'oni'),
                'default' => false,
            ),
            array(
                'id'       => 'side_'.$side.$responsive_section.'_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Border Color', 'oni'),
                'subtitle' => esc_html__('Set border color', 'oni'),
                'default'  => $border_color,
                'mode'     => 'background',
                'required' => array('side_'.$side.$responsive_section.'_border', '=', '1'),
            ),
            array(
                'id'       => 'side_'.$side.$responsive_section.'_border_radius',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Border Radius', 'oni' ),
                'default'  => false,
            )
        );

        if (empty($responsive_section)) {
            array_push($side_opt,
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Section in Sticky Header?', 'oni'),
                    'default'  => true,
                    'required' => array('header_sticky', '=', '1'),
                ),
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_background_sticky',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Sticky Header Background', 'oni'),
                    'subtitle' => esc_html__('Set background color', 'oni'),
                    'default'  => array(
                        'color' => '#191a1c',
                        'alpha' => '1',
                        'rgba'  => 'rgba(25,26,28,1)'
                    ),
                    'mode'     => 'background',
                    'required' => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'          => 'side_'.$side.$responsive_section.'_color_sticky',
                    'type'        => 'color',
                    'title'       => esc_html__('Sticky Header Text Color', 'oni'),
                    'subtitle'    => esc_html__('Set text color', 'oni'),
                    'default'     => '#ffffff',
                    'transparent' => false,
                    'required'    => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'          => 'side_'.$side.$responsive_section.'_color_hover_sticky',
                    'type'        => 'color',
                    'title'       => esc_html__('Sticky Header Link Color on Hover', 'oni'),
                    'subtitle'    => esc_html__('Set text color', 'oni'),
                    'default'     => $color_hover,
                    'transparent' => false,
                    'required'    => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'             => 'side_'.$side.$responsive_section.'_height_sticky',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('Sticky Header Height', 'oni'),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 80,
                    ),
                    'required'       => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'            => 'side_'.$side.$responsive_section.'_spacing_sticky',
                    'type'          => 'spacing',
                    // An array of CSS selectors to apply this font style to
                    'mode'          => 'padding',
                    'units'         => 'px',
                    'all'           => false,
                    'bottom'        => false,
                    'top'           => false,
                    'left'          => true,
                    'right'         => true,
                    'title'         => esc_html__( 'Sticky Header Padding (px)', 'oni' ),
                    'subtitle'      => esc_html__( 'Set empty padding-left/-right to default 20px', 'oni' ),
                    'default'       => array(
                        'padding-left'   => '',
                        'padding-right'  => '',
                    ),
                    'required'       => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                )
            );
        }else{
            $header_sticky_prefix = str_replace('__','',$responsive_section);
            array_push($side_opt,
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Section in Sticky Header?', 'oni'),
                    'default'  => true,
                    'required' => array('header_sticky', '=', '1'),
                )
            );
        }

        if (!empty($responsive_section)) {
            array_push($side_opt,
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_styling-end',
                    'type'     => 'section',
                    'indent'   => false,
                    'required' => array( 'side_'.$side.$responsive_section.'_custom', '=', '1' ),
                )
            );
        }

        array_push($side_opt,
            array(
                'id'           => 'side_'.$side.$responsive_section.'-end',
                'type'         => 'gt3_section',
                'indent'       => false,
                'section_role' => 'end'
            )
        );

    }
}


// text editor
$text_editor_count = 6;
$text_opt = array();
for ($i=1; $i <= $text_editor_count ; $i++) {
    array_push($text_opt,
        array(
            'id'           => 'text'.$i.'-start',
            'type'         => 'gt3_section',
            'title'        => esc_html__('Text / HTML', 'oni') . ' ' . $i . ' ' . esc_html__('Settings', 'oni'),
            'indent'       => false,
            'section_role' => 'start'
        ),
        array(
            'id'      => 'text'.$i.'_editor',
            'type'    => 'editor',
            'title'   => esc_html__('Text Editor', 'oni'),
            'default' => '',
            'args'    => array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 8,
                'teeny'         => false,
                'quicktags'     => true,
            ),
        ),
        array(
            'id'           => 'text'.$i.'-end',
            'type'         => 'gt3_section',
            'indent'       => false,
            'section_role' => 'end'
        )
    );
};


// delimiter
$delimiter_count = 6;
$delimiter_opt = array();
for ($i=1; $i <= $delimiter_count ; $i++) {
    array_push($delimiter_opt,
        // Delimiters
        array(
            'id'           => 'delimiter'.$i.'-start',
            'type'         => 'gt3_section',
            'title'        => esc_html__('Delimiter', 'oni') . ' ' . $i . ' ' . esc_html__('Settings', 'oni'),
            'indent'       => false,
            'section_role' => 'start'
        ),
        array(
            'id'      => 'delimiter'.$i.'_height',
            'type'    => 'dimensions',
            'units'   => array('em', 'px', '%'),
            'title'   => esc_html__('Delimiter Height', 'oni'),
            'height'  => true,
            'width'   => false,
            'output'  => array('height' => '.gt3_delimiter'.$i.''),
            'default' => array(
                'height' => 1,
                'units'  => 'em',
            )
        ),
        array(
            'id'       => 'delimiter'.$i.'_border_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Border Color', 'oni'),
            'subtitle' => esc_html__('Set border color', 'oni'),
            'output'  => array('border-color' => '.gt3_delimiter'.$i.''),
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => '1',
                'rgba'  => 'rgba(255,255,255,1)'
            ),
            'mode'     => 'background',
        ),
        array(
            'id'           => 'delimiter'.$i.'-end',
            'type'         => 'gt3_section',
            'indent'       => false,
            'section_role' => 'end'
        )
    );
};

$options = array_merge($options,$aligns,$text_opt,$delimiter_opt,$side_opt,$header_global_settings);

    Redux::setSection( $opt_name, array(
        'id'     => 'gt3_header_builder_section',
        'title'  =>  __( 'Header Builder', 'oni' ),
        'icon'   => 'el el-screen',
        'fields' => array(
            array(
                'id'       => 'main_header_preset',
                'type'     => 'select',
                'title'    => esc_html__( 'Please select "active/default" header preset', 'oni' ),
                'options'  => $presets_array,
                'default'  => '',
            ),
            array(
                'id'   => 'info_normal',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'What does "active/default" mean?', 'oni'),
                'icon'  => 'el-icon-info-sign',
                'desc' => esc_html__( 'It means that this header preset will be used on all the pages/posts by default.', 'oni').'<br>' . esc_html__( '
If there is no preset available in the list, please create a new one in "Header Builder Editor" section.', 'oni')
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Builder Editor', 'oni' ),
        'id'               => 'header_builder_editor',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields' => $options
    ) );
    // END HEADER

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Page Title', 'oni' ),
        'id'               => 'page_title',
        'icon'             => 'el-icon-screen',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'page_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Page Title', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Blog Post Title', 'oni' ),
                'default'  => true,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'team_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Team Post Title', 'oni' ),
                'default'  => false,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'portfolio_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Portfolio Post Title', 'oni' ),
                'default'  => true,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'page_title-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Page Title Settings', 'oni' ),
                'indent'   => true,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'page_title_breadcrumbs_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Breadcrumbs', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_title_vert_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Vertical Align', 'oni' ),
                'options'  => array(
                    'top'       => esc_html__( 'Top', 'oni' ),
                    'middle'    => esc_html__( 'Middle', 'oni' ),
                    'bottom'    => esc_html__( 'Bottom', 'oni' )
                ),
                'default'  => 'middle'
            ),
            array(
                'id'       => 'page_title_horiz_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Title Text Align?', 'oni' ),
                'options'  => array(
                    'left'      =>  esc_html__( 'Left', 'oni' ),
                    'center'    => esc_html__( 'Center', 'oni' ),
                    'right'     => esc_html__( 'Right', 'oni' )
                ),
                'default'  => 'center'
            ),
            array(
                'id'       => 'page_title_font_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Font Color', 'oni' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Background Color', 'oni' ),
                'default'  => '#090a0b',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_overlay_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Overlay Color', 'oni' ),
                'default'  => '',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Page Title Background Image', 'oni' ),
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => esc_html__( 'Page Title Background Image', 'oni' ),
                'default'  => array(
                    'background-repeat' => 'no-repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#090a0b',
                )
            ),
            array(
                'id'             => 'page_title_height',
                'type'           => 'dimensions',
                'units'          => false,
                'units_extended' => false,
                'title'          => esc_html__( 'Page Title Height', 'oni' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 215,
                )
            ),
            array(
                'id'       => 'page_title_top_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Title Top Border', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'page_title_top_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Page Title Top Border Color', 'oni' ),
                'default'  => array(
                    'color' => '#191a1c',
                    'alpha' => '1',
                    'rgba'  => 'rgba(25,26,28,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'page_title_top_border', '=', '1' ),
                ),
            ),
            array(
                'id'            => 'page_title_bottom_border',
                'type'          => 'switch',
                'title'         => esc_html__( 'Page Title Bottom Border', 'oni' ),
                'default'       => false,
            ),
            array(
                'id'            => 'page_title_bottom_border_color',
                'type'          => 'color_rgba',
                'title'         => esc_html__( 'Page Title Bottom Border Color', 'oni' ),
                'default'       => array(
                    'color'         => '#191a1c',
                    'alpha'         => '1',
                    'rgba'          => 'rgba(25,26,28,1)'
                ),
                'mode'          => 'background',
                'required'      => array(
                    array( 'page_title_bottom_border', '=', '1' ),
                ),
            ),
            array(
                'id'            => 'page_title_bottom_margin',
                'type'          => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'          => 'margin',
                'all'           => false,
                'bottom'        => true,
                'top'           => false,
                'left'          => false,
                'right'         => false,
                'title'         => esc_html__( 'Page Title Bottom Margin', 'oni' ),
                'default'       => array(
                    'margin-bottom' => '110',
                )
            ),
            array(
                'id'            => 'page_title-end',
                'type'          => 'section',
                'indent'        => false,
                'required'      => array( 'page_title_conditional', '=', '1' ),
            ),

        )
    ) );

    // -> START Footer Options
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__('Footer', 'oni' ),
        'id'                => 'footer-option',
        'customizer_width'  => '400px',
        'icon'              => 'el-icon-screen',
        'fields'            => array(
            array(
                'id'            => 'footer_full_width',
                'type'          => 'select',
                'title'         => esc_html__( 'Full Width Footer', 'oni' ),
                'options'       => array(
                    'default'        => esc_html__( 'Default', 'oni' ),
                    'strech_footer'  => esc_html__( 'Strech Footer', 'oni' ),
                    'strech_content' => esc_html__( 'Strech Footer and Content', 'oni' ),
                ),
                'default'       => 'default',
            ),
            array(
                'id'            => 'footer_bg_color',
                'type'          => 'color',
                'title'         => esc_html__( 'Footer Background Color', 'oni' ),
                'default'       => '#191a1c',
                'transparent'   => false
            ),
            array(
                'id'            => 'footer_text_color',
                'type'          => 'color',
                'title'         => esc_html__( 'Footer Text color', 'oni' ),
                'default'       => '#9da1a5',
                'transparent'   => false
            ),
            array(
                'id'            => 'footer_heading_color',
                'type'          => 'color',
                'title'         => esc_html__( 'Footer Heading color', 'oni' ),
                'default'       => '#ffffff',
                'transparent'   => false
            ),
            array(
                'id'            => 'footer_bg_image',
                'type'          => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview'       => false,
                'title'         => esc_html__( 'Footer Background Image', 'oni' ),
                'default'       => array(
                    'background-repeat'     => 'repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center center',
                    'background-color'      => '#191a1c',
                )
            ),
            array(
                'id'       => 'footer_top_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Footer Top Border', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'footer_top_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Footer Border Color', 'oni' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,0.1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'footer_top_border', '=', '1' ),
                ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer Content', 'oni' ),
        'id'               => 'footer_content',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'            => 'footer_switch',
                'type'          => 'switch',
                'title'         => esc_html__( 'Show Footer', 'oni' ),
                'default'       => true,
            ),
            array(
                'id'            => 'footer-start',
                'type'          => 'section',
                'title'         => esc_html__( 'Footer Settings', 'oni' ),
                'indent'        => true,
                'required'      => array( 'footer_switch', '=', '1' ),
            ),
            array(
                'id'            => 'footer_column',
                'type'          => 'select',
                'title'         => esc_html__( 'Footer Column', 'oni' ),
                'options'       => array(
                    '1'     => '1',
                    '2'     => '2',
                    '3'     => '3',
                    '4'     => '4',
                    '5'     => '5'
                ),
                'default'       => '3'
            ),
            array(
                'id'            => 'footer_column2',
                'type'          => 'select',
                'title'         => esc_html__( 'Footer Column Layout', 'oni' ),
                'options'       => array(
                    '6-6'           => '50% / 50%',
                    '3-9'           => '25% / 75%',
                    '9-3'           => '25% / 75%',
                    '4-8'           => '33% / 66%',
                    '8-3'           => '66% / 33%',
                ),
                'default'       => '6-6',
                'required'      => array( 'footer_column', '=', '2' ),
            ),
            array(
                'id'            => 'footer_column3',
                'type'          => 'select',
                'title'         => esc_html__( 'Footer Column Layout', 'oni' ),
                'options'       => array(
                    '4-4-4'         => '33% / 33% / 33%',
                    '3-3-6'         => '25% / 25% / 50%',
                    '3-6-3'         => '25% / 50% / 25%',
                    '6-3-3'         => '50% / 25% / 25%',
                    '5-5-2'         => '42% / 42% / 16%',
                    '4-5-3'         => '33% / 42% / 25%',
                ),
                'default'       => '5-5-2',
                'required'      => array( 'footer_column', '=', '3' ),
            ),
            array(
                'id'            => 'footer_column5',
                'type'          => 'select',
                'title'         => esc_html__( 'Footer Column Layout', 'oni' ),
                'options'       => array(
                    '2-3-2-2-3'     => '16% / 25% / 16% / 16% / 25%',
                    '3-2-2-2-3'     => '25% / 16% / 16% / 16% / 25%',
                    '3-2-3-2-2'     => '25% / 16% / 26% / 16% / 16%',
                    '3-2-3-3-2'     => '25% / 16% / 16% / 25% / 16%',
                ),
                'default'       => '2-3-2-2-3',
                'required'      => array( 'footer_column', '=', '5' ),
            ),
            array(
                'id'            => 'footer_align',
                'type'          => 'select',
                'title'         => esc_html__( 'Footer Title Text Align', 'oni' ),
                'options'       => array(
                    'left'          => esc_html__( 'Left', 'oni' ),
                    'center'        => esc_html__( 'Center', 'oni' ),
                    'right'         => esc_html__( 'Right', 'oni' ),
                ),
                'default'       => 'left'
            ),
            array(
                'id'            => 'footer_spacing',
                'type'          => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'          => 'padding',
                'all'           => false,
                'title'         => esc_html__( 'Footer Padding (px)', 'oni' ),
                'default'       => array(
                    'padding-top'    => '57',
                    'padding-right'  => '0',
                    'padding-bottom' => '57',
                    'padding-left'   => '0'
                )
            ),
            array(
                'id'            => 'footer-end',
                'type'          => 'section',
                'indent'        => false,
                'required'      => array( 'footer_switch', '=', '1' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Copyright', 'oni' ),
        'id'               => 'copyright',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'copyright_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Copyright', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'      => 'copyright_editor',
                'type'    => 'editor',
                'title'   => esc_html__( 'Copyright Editor', 'oni' ),
                'default' => '',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 15,
                    'teeny'         => false,
                    'quicktags'     => true,
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Copyright Title Text Align', 'oni' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'oni' ),
                    'center' => esc_html__( 'Center', 'oni' ),
                    'right' => esc_html__( 'Right', 'oni' ),
                ),
                'default'  => 'center',
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_spacing',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__( 'Copyright Padding (px)', 'oni' ),
                'default'  => array(
                    'padding-top'    => '17',
                    'padding-right'  => '0',
                    'padding-bottom' => '17',
                    'padding-left'   => '0'
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Background Color', 'oni' ),
                'default'  => '#191a1c',
                'transparent' => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Text Color', 'oni' ),
                'default'  => '#9da1a5',
                'transparent' => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Copyright Top Border', 'oni' ),
                'default'  => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Copyright Border Color', 'oni' ),
                'default'  => array(
                    'color' => '#191a1c',
                    'alpha' => '1',
                    'rgba'  => 'rgba(25,26,28,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'copyright_top_border', '=', '1' ),
                    array( 'copyright_switch', '=', '1' )
                ),
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Prefooter Area', 'oni' ),
        'id'               => 'pre_footer',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'pre_footer_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Prefooter Area', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'      => 'pre_footer_editor',
                'type'    => 'editor',
                'title'   => esc_html__( 'Prefooter Editor', 'oni' ),
                'default' => '',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny'         => false,
                    'quicktags'     => true,
                ),
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Prefooter Title Text Align', 'oni' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'oni' ),
                    'center' => esc_html__( 'Center', 'oni' ),
                    'right' => esc_html__( 'Right', 'oni' ),
                ),
                'default'  => 'left',
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_spacing',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__( 'Prefooter Area Padding (px)', 'oni' ),
                'default'  => array(
                    'padding-top'    => '20',
                    'padding-right'  => '0',
                    'padding-bottom' => '20',
                    'padding-left'   => '0'
                ),
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'            => 'pre_footer_bg_color',
                'type'          => 'color',
                'title'         => esc_html__( 'Footer Background Color', 'oni' ),
                'default'       => '#191a1c',
                'transparent'   => false,
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'            => 'pre_footer_text_color',
                'type'          => 'color',
                'title'         => esc_html__( 'Footer Text color', 'oni' ),
                'default'       => '#9da1a5',
                'transparent'   => false,
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Prefooter Border', 'oni' ),
                'default'  => false,
                'required' => array( 'pre_footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'pre_footer_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Prefooter Border Color', 'oni' ),
                'default'  => array(
                    'color' => '#191a1c',
                    'alpha' => '1',
                    'rgba'  => 'rgba(25,26,28,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'pre_footer_bottom_border', '=', '1' ),
                    array( 'pre_footer_switch', '=', '1' )
                ),
            ),
        )
    ));

    // -> START Blog Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Blog', 'oni' ),
        'id'               => 'blog-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-th-list',
        'fields'           => array(
            array(
                'id'       => 'related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_posts_filter',
                'type'     => 'button_set',
                'title'    => esc_html__('Show Related Posts by', 'oni'),
                'options' => array(
                    'tag' => esc_html__('Tag', 'oni'),
                    'category' => esc_html__('Category', 'oni'),
                 ),
                'default' => 'tag',
                'required' => array( 'related_posts', '=', '1' ),
            ),
            array(
                'id'       => 'author_box',
                'type'     => 'switch',
                'title'    => esc_html__( 'Author Box on Single Post', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'post_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Comments', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'post_pingbacks',
                'type'     => 'switch',
                'title'    => esc_html__( 'Trackbacks and Pingbacks', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_post_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Likes on Posts', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_post_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share on Posts', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_post_listing_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cut Off Text in Blog Listing', 'oni' ),
                'default'  => false,
            ),
        )
    ) );

    // -> START Gallery Options
	if (class_exists('\ElementorModal\Widgets\GT3_Elementor_Gallery')) {
		Redux::setSection($opt_name, array(
			'title'            => esc_html__('Gallery', 'oni'),
			'id'               => 'gallery-option',
			'customizer_width' => '400px',
			'icon'             => 'el el-picture',
			'fields'           => array(
				array(
					'id'      => 'gallery_type',
					'type'    => 'select',
					'title'   => esc_html__('Select default gallery type', 'oni'),
					'options' => array(
						'grid'          => esc_html__('Grid Gallery', 'oni'),
						'packery'       => esc_html__('Packery Gallery', 'oni'),
						'fs_slider'     => esc_html__('FullScreen Slider', 'oni'),
						'shift_slider'  => esc_html__('Shift Slider', 'oni'),
						'masonry'       => esc_html__('Masonry Gallery', 'oni'),
						'kenburn'       => esc_html__('Kenburns', 'oni'),
						'ribbon'        => esc_html__('Ribbon Slider', 'oni'),
						'flow'          => esc_html__('Flow Slider', 'oni'),
					),
					'default' => 'grid'
				),
				// Grid
				array(
					'id'       => 'grid_grid_type',
					'type'     => 'select',
					'title'    => esc_html__('Grid Type', 'oni'),
					'options'  => array(
						'vertical'  => esc_html__('Vertical Align', 'oni'),
						'square'    => esc_html__('Square', 'oni'),
						'rectangle' => esc_html__('Rectangle', 'oni'),
					),
					'default'  => 'vertical',
					'required' => array( 'gallery_type', '=', 'grid' ),
				),
				array(
					'id'       => 'grid_cols',
					'type'     => 'select',
					'title'    => esc_html__('Cols', 'oni'),
					'options'  => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
					),
					'default'  => '4',
					'required' => array( 'gallery_type', '=', 'grid' ),
				),
				array(
					'id'       => 'grid_grid_gap',
					'type'     => 'select',
					'title'    => esc_html__('Grid Gap', 'oni'),
					'options'  => array(
						'0'    => '0',
						'1px'  => '1px',
						'2px'  => '2px',
						'3px'  => '3px',
						'4px'  => '4px',
						'5px'  => '5px',
						'10px' => '10px',
						'15px' => '15px',
						'20px' => '20px',
						'25px' => '25px',
						'30px' => '30px',
						'35px' => '35px',

						'2%'    => '2%',
						'4.95%' => '5%',
						'8%'    => '8%',
						'10%'   => '10%',
						'12%'   => '12%',
						'15%'   => '15%',
					),
					'default'  => '30px',
					'required' => array( 'gallery_type', '=', 'grid' ),
				),
				array(
					'id'       => 'grid_hover',
					'type'     => 'select',
					'title'    => esc_html__('Hover Effect', 'oni'),
					'options'  => array(
						'type1' => esc_html__('Type 1', 'oni'),
						'type2' => esc_html__('Type 2', 'oni'),
						'type3' => esc_html__('Type 3', 'oni'),
						'type4' => esc_html__('Type 4', 'oni'),
						'type5' => esc_html__('Type 5', 'oni'),
					),
					'default'  => 'type2',
					'required' => array( 'gallery_type', '=', 'grid' ),
				),

				array(
					'id'       => 'grid_lightbox',
					'type'     => 'switch',
					'title'    => esc_html__('Lightbox', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'grid' ),
				),
				array(
					'id'       => 'grid_show_title',
					'type'     => 'switch',
					'title'    => esc_html__('Show Title', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'grid' ),
				),
				array(
					'id'            => 'grid_post_per_load',
					'type'          => 'slider',
					'title'         => esc_html__('Post Per Load', 'oni'),
					'default'       => 12,
					'min'           => 1,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'text',
					'required'      => array( 'gallery_type', '=', 'grid' ),
				),
				array(
					'id'       => 'grid_show_view_all',
					'type'     => 'switch',
					'title'    => esc_html__('Show "See More" Button', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'grid' ),
				),
				array(
					'id'            => 'grid_load_items',
					'type'          => 'slider',
					'title'         => esc_html__('See Items', 'oni'),
					'default'       => 4,
					'min'           => 1,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'text',
					'required'      => array(
						array( 'gallery_type', '=', 'grid' ),
						array( 'grid_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'grid_button_type',
					'type'     => 'select',
					'title'    => esc_html__('Button Type', 'oni'),
					'options'  => array(
						'none'    => esc_html__('None', 'oni'),
						'default' => esc_html__('Default', 'oni'),
					),
					'default'  => 'default',
					'required' => array(
						array( 'gallery_type', '=', 'grid' ),
						array( 'grid_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'grid_button_border',
					'type'     => 'switch',
					'title'    => esc_html__('Button Border', 'oni'),
					'default'  => true,
					'required' => array(
						array( 'gallery_type', '=', 'grid' ),
						array( 'grid_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'grid_button_title',
					'type'     => 'text',
					'title'    => esc_html__('Button Title', 'oni'),
					'default'  => esc_html__('Load More', 'oni'),
					'required' => array(
						array( 'gallery_type', '=', 'grid' ),
						array( 'grid_show_view_all', '=', '1' ),
					),
				),


				// Packery
				array(
					'id'      => 'packery_type',
					'type'    => 'image_select',
					'title'   => esc_html__('Type', 'oni'),
					'options' => array(
						'1' => array(
							'alt' => esc_html__('Type 1', 'oni'),
							'img' => esc_url(\ElementorModal\Widgets\GT3_Elementor_Gallery::$IMAGE_URL.'type1.png')
						),
						'2' => array(
							'alt' => esc_html__('Type 2', 'oni'),
							'img' => esc_url(\ElementorModal\Widgets\GT3_Elementor_Gallery::$IMAGE_URL.'type2.png')
						),
						'3' => array(
							'alt' => esc_html__('Type 3', 'oni'),
							'img' => esc_url(\ElementorModal\Widgets\GT3_Elementor_Gallery::$IMAGE_URL.'type3.png')
						),
						'4' => array(
							'alt' => esc_html__('Type 4', 'oni'),
							'img' => esc_url(\ElementorModal\Widgets\GT3_Elementor_Gallery::$IMAGE_URL.'type4.png')
						),
					),
					'default' => '2',
					'required' => array( 'gallery_type', '=', 'packery' ),
				),
				array(
					'id'       => 'packery_grid_gap',
					'type'     => 'select',
					'title'    => esc_html__('Packery Gap', 'oni'),
					'options'  => array(
						'0'    => '0',
						'1px'  => '1px',
						'2px'  => '2px',
						'3px'  => '3px',
						'4px'  => '4px',
						'5px'  => '5px',
						'10px' => '10px',
						'15px' => '15px',
						'20px' => '20px',
						'25px' => '25px',
						'30px' => '30px',
						'35px' => '35px',

						'2%'    => '2%',
						'4.95%' => '5%',
						'8%'    => '8%',
						'10%'   => '10%',
						'12%'   => '12%',
						'15%'   => '15%',
					),
					'default'  => '30px',
					'required' => array( 'gallery_type', '=', 'packery' ),
				),
				array(
					'id'       => 'packery_hover',
					'type'     => 'select',
					'title'    => esc_html__('Hover Effect', 'oni'),
					'options'  => array(
						'type1' => esc_html__('Type 1', 'oni'),
						'type2' => esc_html__('Type 2', 'oni'),
						'type3' => esc_html__('Type 3', 'oni'),
						'type4' => esc_html__('Type 4', 'oni'),
						'type5' => esc_html__('Type 5', 'oni'),
					),
					'default'  => 'type2',
					'required' => array( 'gallery_type', '=', 'packery' ),
				),
				array(
					'id'       => 'packery_lightbox',
					'type'     => 'switch',
					'title'    => esc_html__('Lightbox', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'packery' ),
				),
				array(
					'id'       => 'packery_show_title',
					'type'     => 'switch',
					'title'    => esc_html__('Show Title', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'packery' ),
				),
				array(
					'id'            => 'packery_post_per_load',
					'type'          => 'slider',
					'title'         => esc_html__('Post Per Load', 'oni'),
					'default'       => 12,
					'min'           => 1,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'text',
					'required'      => array( 'gallery_type', '=', 'packery' ),
				),
				array(
					'id'       => 'packery_show_view_all',
					'type'     => 'switch',
					'title'    => esc_html__('Show "See More" Button', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'packery' ),
				),
				array(
					'id'            => 'packery_load_items',
					'type'          => 'slider',
					'title'         => esc_html__('See Items', 'oni'),
					'default'       => 4,
					'min'           => 1,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'text',
					'required'      => array(
						array( 'gallery_type', '=', 'packery' ),
						array( 'packery_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'packery_button_type',
					'type'     => 'select',
					'title'    => esc_html__('Button Type', 'oni'),
					'options'  => array(
						'none'    => esc_html__('None', 'oni'),
						'default' => esc_html__('Default', 'oni'),
					),
					'default'  => 'default',
					'required' => array(
						array( 'gallery_type', '=', 'packery' ),
						array( 'packery_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'packery_button_border',
					'type'     => 'switch',
					'title'    => esc_html__('Button Border', 'oni'),
					'default'  => true,
					'required' => array(
						array( 'gallery_type', '=', 'packery' ),
						array( 'packery_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'packery_button_border',
					'type'     => 'switch',
					'title'    => esc_html__('Button Border', 'oni'),
					'default'  => true,
					'required' => array(
						array( 'gallery_type', '=', 'packery' ),
						array( 'packery_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'packery_button_title',
					'type'     => 'text',
					'title'    => esc_html__('Button Title', 'oni'),
					'default'  => esc_html__('Load More', 'oni'),
					'required' => array(
						array( 'gallery_type', '=', 'packery' ),
						array( 'packery_show_view_all', '=', '1' ),
					),
				),
				// FS Slider
				array(
					'id'       => 'fs_controls',
					'type'     => 'switch',
					'title'    => esc_html__('Controls', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'       => 'fs_autoplay',
					'type'     => 'switch',
					'title'    => esc_html__('Autoplay', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'       => 'fs_thumbs',
					'type'     => 'switch',
					'title'    => esc_html__('Thumbnails', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'       => 'fs_interval',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Slide Duration', 'oni'),
					'default'  => '6000',
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'       => 'fs_transition_time',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Transition Interval', 'oni'),
					'default'  => '1000',
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'        => 'fs_panel_color',
					'type'      => 'color',
					'title'     => esc_html__('Panel Color', 'oni' ),
					'transparent' => false,
					'default'   => '#fff',
					'validate'  => 'color',
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'       => 'fs_anim_style',
					'type'     => 'select',
					'title'    => esc_html__('Anim style', 'oni'),
					'options'  => array(
						'fade'      => esc_html__('Fade', 'oni'),
						'slip'      => esc_html__('Slip', 'oni'),
						'slip_up'   => esc_html__('Slip Up', 'oni'),
						'slip_down' => esc_html__('Slip Down', 'oni'),
					),
					'default'  => 'fade',
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'       => 'fs_fit_style',
					'type'     => 'select',
					'title'    => esc_html__('Fit Style', 'oni'),
					'options'  => array(
						'no_fit'     => __('Cover Slide', 'oni'),
						'fit_always' => __('Fit Always', 'oni'),
						'fit_width'  => __('Fit Horizontal', 'oni'),
						'fit_height' => __('Fit Vertical', 'oni'),
					),
					'default'  => 'no_fit',
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),
				array(
					'id'       => 'fs_module_height',
					'type'     => 'text',
					'title'    => esc_html__('Module Height', 'oni'),
					'description' => esc_html__('Set module height in px (pixels). Enter \'100%\' for full height mode', 'oni'),
					'default'  => '100%',
					'required' => array( 'gallery_type', '=', 'fs_slider' ),
				),

				// Shift
				array(
					'id'       => 'shift_controls',
					'type'     => 'switch',
					'title'    => esc_html__('Show Control Buttons', 'oni'),
					'description' => esc_html__('Turn ON or OFF control buttons', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'shift_slider' ),
				),
				array(
					'id'       => 'shift_infinity_scroll',
					'type'     => 'switch',
					'title'    => esc_html__('Infinite Scroll', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'shift_slider' ),
					'description' => esc_html__('Turn ON or OFF infinite  scrolling. Autoplay works only when infinite scroll is ON', 'oni'),
				),
				array(
					'id'       => 'shift_autoplay',
					'type'     => 'switch',
					'title'    => esc_html__('Autoplay', 'oni'),
					'description' => esc_html__('Turn ON or OFF slider autoplay', 'oni'),
					'default'  => true,
					'required' => array(
						array( 'gallery_type', '=', 'shift_slider' ),
						array( 'shift_infinity_scroll', '=', '1'),
					),
				),
				array(
					'id'       => 'shift_interval',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Slide Duration', 'oni'),
					'description' => esc_html__('Set the timing of single slides in milliseconds', 'oni'),
					'default'  => '6000',
					'required' => array(
						array( 'gallery_type', '=', 'shift_slider' ),
						array( 'shift_infinity_scroll', '=', '1'),
						array( 'shift_autoplay', '=', '1'),
					),
				),
				array(
					'id'       => 'shift_transition_time',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Transition Interval', 'oni'),
					'description' => esc_html__('Set transition animation time', 'oni'),
					'default'  => '600',
					'required' => array( 'gallery_type', '=', 'shift_slider' ),
				),
				array(
					'id'       => 'shift_descr_type',
					'type'     => 'select',
					'title'    => esc_html__('Show Title', 'oni'),
					'options'  => array(
						'always'   => esc_html__('Always Show', 'oni'),
						'hide'     => esc_html__('Always Hide', 'oni'),
						'on_hover' => esc_html__('Show on Hover', 'oni'),
						'expanded' => esc_html__('Show when slide is expanded', 'oni'),
					),
					'default'  => 'on_hover',
					'required' => array( 'gallery_type', '=', 'shift_slider' ),
				),
				array(
					'id'       => 'shift_expandeble',
					'type'     => 'switch',
					'title'    => esc_html__('Expandable slides', 'oni'),
					'description' => esc_html__('Turn ON or OFF expandable slides', 'oni'),
					'required' => array( 'gallery_type', '=', 'shift_slider' ),
				),
				array(
					'id'       => 'shift_hover_effect',
					'type'     => 'switch',
					'title'    => esc_html__('Hover Effect', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'shift_slider' ),
					'description' => esc_html__('Turn ON or OFF hover effect', 'oni'),
				),
				array(
					'id'       => 'shift_module_height',
					'type'     => 'text',
					'title'    => esc_html__('Module Height', 'oni'),
					'description' => esc_html__('Set module height in px (pixels). Enter \'100%\' for full height mode', 'oni'),
					'default'  => '100%',
					'required' => array( 'gallery_type', '=', 'shift_slider' ),
				),
				// Masonry
				array(
					'id'       => 'masonry_cols',
					'type'     => 'select',
					'title'    => esc_html__('Cols', 'oni'),
					'options'  => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
					),
					'default'  => '4',
					'required' => array( 'gallery_type', '=', 'masonry' ),
				),
				array(
					'id'       => 'masonry_grid_gap',
					'type'     => 'select',
					'title'    => esc_html__('Grid Gap', 'oni'),
					'options'  => array(
						'0'    => '0',
						'1px'  => '1px',
						'2px'  => '2px',
						'3px'  => '3px',
						'4px'  => '4px',
						'5px'  => '5px',
						'10px' => '10px',
						'15px' => '15px',
						'20px' => '20px',
						'25px' => '25px',
						'30px' => '30px',
						'35px' => '35px',

						'2%'    => '2%',
						'4.95%' => '5%',
						'8%'    => '8%',
						'10%'   => '10%',
						'12%'   => '12%',
						'15%'   => '15%',
					),
					'default'  => '30px',
					'required' => array( 'gallery_type', '=', 'masonry' ),
				),
				array(
					'id'       => 'masonry_hover',
					'type'     => 'select',
					'title'    => esc_html__('Hover Effect', 'oni'),
					'options'  => array(
						'type1' => esc_html__('Type 1', 'oni'),
						'type2' => esc_html__('Type 2', 'oni'),
						'type3' => esc_html__('Type 3', 'oni'),
						'type4' => esc_html__('Type 4', 'oni'),
						'type5' => esc_html__('Type 5', 'oni'),
					),
					'default'  => 'type2',
					'required' => array( 'gallery_type', '=', 'masonry' ),
				),

				array(
					'id'       => 'masonry_lightbox',
					'type'     => 'switch',
					'title'    => esc_html__('Lightbox', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'masonry' ),
				),
				array(
					'id'       => 'masonry_show_title',
					'type'     => 'switch',
					'title'    => esc_html__('Show Title', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'masonry' ),
				),
				array(
					'id'            => 'masonry_post_per_load',
					'type'          => 'slider',
					'title'         => esc_html__('Post Per Load', 'oni'),
					'default'       => 12,
					'min'           => 1,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'text',
					'required'      => array( 'gallery_type', '=', 'masonry' ),
				),
				array(
					'id'       => 'masonry_show_view_all',
					'type'     => 'switch',
					'title'    => esc_html__('Show "See More" Button', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'masonry' ),
				),
				array(
					'id'            => 'masonry_load_items',
					'type'          => 'slider',
					'title'         => esc_html__('See Items', 'oni'),
					'default'       => 4,
					'min'           => 1,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'text',
					'required'      => array(
						array( 'gallery_type', '=', 'masonry' ),
						array( 'masonry_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'masonry_button_type',
					'type'     => 'select',
					'title'    => esc_html__('Button Type', 'oni'),
					'options'  => array(
						'none'    => esc_html__('None', 'oni'),
						'default' => esc_html__('Default', 'oni'),
					),
					'default'  => 'default',
					'required' => array(
						array( 'gallery_type', '=', 'masonry' ),
						array( 'masonry_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'masonry_button_border',
					'type'     => 'switch',
					'title'    => esc_html__('Button Border', 'oni'),
					'default'  => true,
					'required' => array(
						array( 'gallery_type', '=', 'masonry' ),
						array( 'masonry_show_view_all', '=', '1' ),
					),
				),
				array(
					'id'       => 'masonry_button_title',
					'type'     => 'text',
					'title'    => esc_html__('Button Title', 'oni'),
					'default'  => esc_html__('Load More', 'oni'),
					'required' => array(
						array( 'gallery_type', '=', 'masonry' ),
						array( 'masonry_show_view_all', '=', '1' ),
					),
				),
				// Kenburns
				array(
					'id'       => 'kenburn_interval',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Slide Duration', 'oni'),
					'description' => esc_html__('Set the timing of single slides in milliseconds', 'oni'),
					'default'  => '6000',
					'required' => array(
						array( 'gallery_type', '=', 'kenburn' ),
					),
				),
				array(
					'id'       => 'kenburn_transition_time',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Transition Interval', 'oni'),
					'description' => esc_html__('Set transition animation time', 'oni'),
					'default'  => '600',
					'required' => array( 'gallery_type', '=', 'kenburn' ),
				),
				array(
					'id'       => 'kenburn_overlay_state',
					'type'     => 'switch',
					'title'    => esc_html__('Overlay', 'oni'),
					'description' => esc_html__('Turn ON or OFF slides color overlay.', 'oni'),
					'required' => array( 'gallery_type', '=', 'kenburn' ),
				),
				array(
					'id'        => 'kenburn_overlay_bg',
					'type'      => 'color',
					'title'     => esc_html__('Panel Color', 'oni' ),
					'transparent' => false,
					'default'   => '#fff',
					'validate'  => 'color',
					'required' => array(
						array( 'gallery_type', '=', 'kenburn' ),
						array( 'kenburn_overlay_state', '=', '1'),
					),
				),
				array(
					'id'       => 'kenburn_module_height',
					'type'     => 'text',
					'title'    => esc_html__('Module Height', 'oni'),
					'description' => esc_html__('Set module height in px (pixels). Enter \'100%\' for full height mode', 'oni'),
					'default'  => '100%',
					'required' => array( 'gallery_type', '=', 'kenburn' ),
				),
				// Ribbon
				array(
					'id'       => 'ribbon_show_title',
					'type'     => 'switch',
					'title'    => esc_html__('Show Title', 'oni'),
					'description' => esc_html__('Turn ON or OFF titles and captions', 'oni'),
					'default'  => true,
					'required' => array( 'gallery_type', '=', 'ribbon' ),
				),
				array(
					'id'       => 'ribbon_descr',
					'type'     => 'switch',
					'title'    => esc_html__('Show Caption', 'oni'),
					'description' => esc_html__('Turn ON or OFF captions', 'oni'),
					'default'  => false,
					'required' => array( 'gallery_type', '=', 'ribbon' ),
				),

				array(
					'id'            => 'ribbon_items_padding',
					'type'          => 'slider',
					'title'         => esc_html__('Paddings around the images', 'oni'),
					'description' => esc_html__('Please use this option to add paddings around the images. Recommended size in pixels 0-50. (Ex.: 15px)', 'oni'),
					'default'       => 0,
					'min'           => 0,
					'step'          => 1,
					'max'           => 100,
					'display_value' => 'text',
					'required'      => array( 'gallery_type', '=', 'ribbon' ),
				),
				array(
					'id'       => 'ribbon_controls',
					'type'     => 'switch',
					'title'    => esc_html__('Controls', 'oni'),
					'default'  => false,
					'required' => array( 'gallery_type', '=', 'ribbon' ),
				),
				array(
					'id'       => 'ribbon_autoplay',
					'type'     => 'switch',
					'title'    => esc_html__('Autoplay', 'oni'),
					'default'  => false,
					'required' => array( 'gallery_type', '=', 'ribbon' ),
				),
				array(
					'id'       => 'ribbon_interval',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Slide Duration', 'oni'),
					'description' => esc_html__('Set the timing of single slides in milliseconds', 'oni'),
					'default'  => '6000',
					'required' => array(
						array( 'gallery_type', '=', 'ribbon' ),
						array( 'ribbon_autoplay', '=', '1'),
					),
				),
				array(
					'id'       => 'ribbon_transition_time',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Transition Interval', 'oni'),
					'description' => esc_html__('Set transition animation time', 'oni'),
					'default'  => '600',
					'required' => array(
						array( 'gallery_type', '=', 'ribbon' ),
						array( 'ribbon_autoplay', '=', '1'),
					),
				),
				array(
					'id'       => 'ribbon_module_height',
					'type'     => 'text',
					'title'    => esc_html__('Module Height', 'oni'),
					'description' => esc_html__('Set module height in px (pixels). Enter \'100%\' for full height mode', 'oni'),
					'default'  => '100%',
					'required' => array( 'gallery_type', '=', 'ribbon' ),
				),
				// Flow
				array(
					'id'            => 'flow_img_width',
					'type'          => 'slider',
					'title'         => esc_html__('Image Width in px (pixels)', 'oni'),
					'default'       => 1168,
					'min'           => 640,
					'step'          => 2,
					'max'           => 2560,
					'display_value' => 'text',
					'required'      => array( 'gallery_type', '=', 'flow' ),
				),
				array(
					'id'            => 'flow_img_height',
					'type'          => 'slider',
					'title'         => esc_html__('Image Height in px (pixels)', 'oni'),
					'default'       => 820,
					'min'           => 480,
					'step'          => 2,
					'max'           => 1600,
					'display_value' => 'text',
					'required'      => array( 'gallery_type', '=', 'flow' ),
				),
				array(
					'id'       => 'flow_title_state',
					'type'     => 'switch',
					'title'    => esc_html__('Show Title', 'oni'),
					'description' => esc_html__('Turn ON or OFF titles on slide', 'oni'),
					'default'  => false,
					'required' => array( 'gallery_type', '=', 'flow' ),
				),
				array(
					'id'       => 'flow_autoplay',
					'type'     => 'switch',
					'title'    => esc_html__('Autoplay', 'oni'),
					'default'  => false,
					'required' => array( 'gallery_type', '=', 'flow' ),
				),
				array(
					'id'       => 'flow_interval',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Slide Duration', 'oni'),
					'description' => esc_html__('Set the timing of single slides in milliseconds', 'oni'),
					'default'  => '6000',
					'required' => array(
						array( 'gallery_type', '=', 'flow' ),
						array( 'flow_autoplay', '=', '1'),
					),
				),
				array(
					'id'       => 'flow_transition_time',
					'type'     => 'text',
					'validate' => 'numeric',
					'title'    => esc_html__('Transition Interval', 'oni'),
					'description' => esc_html__('Set transition animation time', 'oni'),
					'default'  => '600',
					'required' => array(
						array( 'gallery_type', '=', 'flow' ),
						array( 'flow_autoplay', '=', '1'),
					),
				),
				array(
					'id'       => 'flow_module_height',
					'type'     => 'text',
					'title'    => esc_html__('Module Height', 'oni'),
					'description' => esc_html__('Set module height in px (pixels). Enter \'100%\' for full height mode', 'oni'),
					'default'  => '100%',
					'required' => array( 'gallery_type', '=', 'flow' ),
				),
			)
		));
	}

    // -> START Layout Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebars', 'oni' ),
        'id'               => 'layout_options',
        'customizer_width' => '400px',
        'icon' => 'el el-website',
        'fields'           => array(
            array(
                'id'       => 'page_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Sidebar Layout', 'oni' ),
                'options'  => array(
                    'none' => array(
                        'alt' => esc_html__('None', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => esc_html__('Left', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'right'
            ),
            array(
                'id'       => 'page_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Sidebar', 'oni' ),
                'data'     => 'sidebars',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'blog_single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Single Sidebar Layout', 'oni' ),
                'options'  => array(
                    'none' => array(
                        'alt' => esc_html__('None', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => esc_html__('Left', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'blog_single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Single Sidebar', 'oni' ),
                'data'     => 'sidebars',
                'required' => array( 'blog_single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'portfolio_single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Single Sidebar Layout', 'oni' ),
                'options'  => array(
                    'none' => array(
                        'alt' => esc_html__('None', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => esc_html__('Left', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'portfolio_single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Portfolio Single Sidebar', 'oni' ),
                'data'     => 'sidebars',
                'required' => array( 'portfolio_single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'team_single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Team Single Sidebar Layout', 'oni' ),
                'options'  => array(
                    'none' => array(
                        'alt' => esc_html__('None', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => esc_html__('Left', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right', 'oni' ),
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'team_single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Team Single Sidebar', 'oni' ),
                'data'     => 'sidebars',
                'required' => array( 'team_single_sidebar_layout', '!=', 'none' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebar Generator', 'oni' ),
        'id'               => 'sidebars_generator_section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'        =>'sidebars',
                'type'      => 'multi_text',
                'validate'  => 'no_html',
                'add_text'  => esc_html__('Add Sidebar', 'oni' ),
                'title'     => esc_html__('Sidebar Generator', 'oni' ),
                'default'   => array("Main Sidebar","Menu Sidebar","Shop Sidebar"),
            ),
        )
    ) );


    // -> START Styling Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Color Options', 'oni' ),
        'id'               => 'color_options',
        'customizer_width' => '400px',
        'icon'             => 'el-icon-brush'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Colors', 'oni' ),
        'id'               => 'color_options_color',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'        => 'theme-custom-color',
                'type'      => 'color',
                'title'     => esc_html__('Theme Color', 'oni' ),
                'transparent' => false,
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'theme-custom-color2',
                'type'      => 'color',
                'title'     => esc_html__('Theme Color2', 'oni' ),
                'transparent' => false,
                'default'   => '#435bb2',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'body-background-color',
                'type'      => 'color',
                'title'     => esc_html__('Body Background Color', 'oni' ),
                'transparent' => false,
                'default'   => '#191a1c',
                'validate'  => 'color',
            ),
        )
    ));



    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Typography', 'oni' ),
        'id'               => 'typography_options',
        'customizer_width' => '400px',
        'icon' => 'el-icon-font',
        'fields'           => array(
            array(
                'id'            => 'menu-font',
                'type'          => 'typography',
                'title'         => esc_html__( 'Menu Font', 'oni' ),
                'google'        => true,
                'font-style'    => true,
                'color'         => false,
                'line-height'   => true,
                'font-size'     => true,
                'font-backup'   => false,
                'text-align'    => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'       => array(
                    'font-family'   => 'Noto Sans',
                    'google'        => true,
                    'font-size'     => '12px',
                    'line-height'   => '22px',
                    'font-weight'   => '400',
                    'text-transform' => 'uppercase',
                ),
            ),

            array(
                'id' => 'main-font',
                'type' => 'typography',
                'title' => esc_html__('Main Font', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'all_styles' => true,
                'default' => array(
                    'font-size' => '14px',
                    'line-height' => '24px',
                    'color' => '#9da1a5',
                    'google' => true,
                    'font-family' => 'Noto Sans',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id' => 'secondary-font',
                'type' => 'typography',
                'title' => esc_html__('Secondary Font', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'default' => array(
                    'font-size' => '18px',
                    'line-height' => '32px',
                    'color' => '#ffffff',
                    'google' => true,
                    'font-family' => 'Noto Serif',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'title' => esc_html__('Headers Font', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => false,
                'line-height' => false,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'color' => '#ffffff',
                    'google' => true,
                    'font-family' => 'Noto Sans',
                    'font-weight' => '700',
                ),
            ),
            array(
                'id' => 'h1-font',
                'type' => 'typography',
                'title' => esc_html__('H1', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '30px',
                    'line-height' => '40px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h2-font',
                'type' => 'typography',
                'title' => esc_html__('H2', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '27px',
                    'line-height' => '38px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h3-font',
                'type' => 'typography',
                'title' => esc_html__('H3', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '24px',
                    'line-height' => '36px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h4-font',
                'type' => 'typography',
                'title' => esc_html__('H4', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '20px',
                    'line-height' => '33px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h5-font',
                'type' => 'typography',
                'title' => esc_html__('H5', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'google' => true,
                ),
            ),
            array(
                'id'            => 'h6-font',
                'type'          => 'typography',
                'title'         => esc_html__('H6', 'oni' ),
                'google'        => true,
                'font-backup'   => false,
                'font-size'     => true,
                'line-height'   => true,
                'color'         => false,
                'word-spacing'  => false,
                'letter-spacing' => false,
                'text-align'    => false,
                'text-transform' => false,
                'default'       => array(
                    'font-size'     => '14px',
                    'line-height'   => '24px',
                    'google'        => true,
                ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Google Map', 'oni' ),
        'id'               => 'google_map',
        'customizer_width' => '400px',
        'icon'             => 'el el-map-marker',
        'fields'           => array(
            array(
                'id'       => 'map_prefooter_default',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Map Output in the Prefooter Area?', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'google_map_api_key',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Map API Key', 'oni' ),
                'desc' => esc_html__( 'Create own API key', 'oni' )
                          .' <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#--api" target="_blank">'
                          .esc_html__('here', 'oni')
                          .'</a>',
                'default'  => '',
            ),
            array(
                'id'       => 'google_map_latitude',
                'type'     => 'text',
                'title'    => esc_html__( 'Map Latitude Coordinate', 'oni' ),
                'default'  => '-37.8172507',
            ),
            array(
                'id'       => 'google_map_longitude',
                'type'     => 'text',
                'title'    => esc_html__( 'Map Longitude Coordinate', 'oni' ),
                'default'  => '144.9535833',
            ),
            array(
                'id'       => 'zoom_map',
                'type'     => 'select',
                'title'    => esc_html__( 'Default Zoom Map', 'oni' ),
                'desc'  => esc_html__( 'Select the number of zoom map.', 'oni' ),
                'options'  => array(
                    '10' => esc_html__( '10', 'oni' ),
                    '11' => esc_html__( '11', 'oni' ),
                    '12' => esc_html__( '12', 'oni' ),
                    '13' => esc_html__( '13', 'oni' ),
                    '14' => esc_html__( '14', 'oni' ),
                    '15' => esc_html__( '15', 'oni' ),
                    '16' => esc_html__( '16', 'oni' ),
                    '17' => esc_html__( '17', 'oni' ),
                    '18' => esc_html__( '18', 'oni' ),
                ),
                'default'  => '14'
            ),
            array(
                'id'       => 'map_marker_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Map Marker Info', 'oni' ),
                'default'  => true,
            ),
            array(
                'id'       => 'custom_map_marker',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Map Marker URl', 'oni' ),
                'default'  => '',
                'subtitle' => esc_html__( 'Visible only on mobile or if "Map Marker Info" option is off.', 'oni'),
            ),
            array(
                'id'       => 'map_marker_info_street_number',
                'type'     => 'text',
                'title'    => esc_html__( 'Street Number', 'oni' ),
                'default'  => '',
                'required'  => array( 'map_marker_info', '=', '1' ),
            ),
            array(
                'id'       => 'map_marker_info_street',
                'type'     => 'text',
                'title'    => esc_html__( 'Street', 'oni' ),
                'default'  => '',
                'required'  => array( 'map_marker_info', '=', '1' ),
            ),
            array(
                'id'=>'map_marker_info_descr',
                'type' => 'textarea',
                'title' => esc_html__('Short Description', 'oni'),
                'default' => '',
                'required'  => array( 'map_marker_info', '=', '1' ),
                'allowed_html' => array(
                    'a' => array(
                        'href' => array(),
                        'title' => array()
                    ),
                    'br' => array(),
                    'em' => array(),
                    'strong' => array()
                ),
                'description' => esc_html__('The optimal number of characters is 35', 'oni'),
            ),
            array(
                'id'            => 'map_marker_info_background',
                'type'          => 'color',
                'title'         => esc_html__( 'Map Marker Info Background', 'oni' ),
                'subtitle'      => esc_html__( 'Set Map Marker Info Background', 'oni' ),
                'default'       => '#0a0b0b',
                'transparent'   => false,
                'required'  => array( 'map_marker_info', '=', '1' ),
            ),
            array(
                'id' => 'map-marker-font',
                'type' => 'typography',
                'title' => esc_html__('Map Marker Font', 'oni' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => false,
                'line-height' => false,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'default' => array(),
            ),
            array(
                'id'            => 'map_marker_info_color',
                'type'          => 'color',
                'title'         => esc_html__( 'Map Marker Description Text Color', 'oni' ),
                'subtitle'      => esc_html__( 'Set Map Marker Description Text Color', 'oni' ),
                'default'       => '#ffffff',
                'transparent'   => false,
                'required'  => array( 'map_marker_info', '=', '1' ),
            ),
            array(
                'id'       => 'custom_map_style',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Map Style', 'oni' ),
                'default'  => false,
            ),
            array(
                'id'       => 'custom_map_code',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'JavaScript Style Array', 'oni' ),
                'desc' => esc_html__( 'To change the style of the map, you must insert the JavaScript Style Array code from ', 'oni' ) .' <a href="https://snazzymaps.com/" target="_blank">'.esc_html__('Snazzy Maps', 'oni')
                    .'</a>',
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => "",
                'required'  => array( 'custom_map_style', '=', '1' ),
            ),
        ),
    ));


    if (class_exists('WooCommerce')) {
        // -> START Layout Options
        Redux::setSection( $opt_name, array(
            'title'            => esc_html__('Shop', 'oni' ),
            'id'               => 'woocommerce_layout_options',
            'customizer_width' => '400px',
            'icon' => 'el el-shopping-cart',
            'fields'           => array(

            )
        ) );
        Redux::setSection( $opt_name, array(
            'title'            => esc_html__('Products Page', 'oni' ),
            'id'               => 'products_page_settings',
            'subsection'       => true,
            'customizer_width' => '450px',
            'fields'           => array(
                array(
                    'id'       => 'products_layout',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Products Layout', 'oni' ),
                    'options'  => array(
                        'container' => esc_html__( 'Container', 'oni' ),
                        'full_width' => esc_html__( 'Full Width', 'oni' ),
                    ),
                    'default'  => 'container'
                ),
                array(
                    'id'       => 'products_sidebar_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Products Page Sidebar Layout', 'oni' ),
                    'options'  => array(
                        'none' => array(
                            'alt' => esc_html__('None', 'oni' ),
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                        ),
                        'left' => array(
                            'alt' => esc_html__('Left', 'oni' ),
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                        ),
                        'right' => array(
                            'alt' => esc_html__('Right', 'oni' ),
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                        )
                    ),
                    'default'  => 'none'
                ),
                array(
                    'id'       => 'products_sidebar_def',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Products Page Sidebar', 'oni' ),
                    'data'     => 'sidebars',
                    'required' => array( 'products_sidebar_layout', '!=', 'none' ),
                ),
	            array(
		            'id'        => 'products_per_page_frontend',
		            'type'      => 'switch',
		            'title'     => esc_html__( 'Show dropdown on the frontend to change Number of products displayed per page', 'oni' ),
	            ),
	            array(
		            'id'        => 'products_sorting_frontend',
		            'type'      => 'switch',
		            'title'     => esc_html__( 'Show dropdown on the frontend to change Sorting of products displayed per page', 'oni' ),
	            ),
	            array(
		            'id'      => 'products_infinite_scroll',
		            'type'    => 'select',
		            'title'   => esc_html__( 'Infinite Scroll', 'oni' ),
		            'desc'    => esc_html__( 'Select Infinite Scroll options', 'oni' ),
		            'options' => array(
			            'none'     => esc_html__( 'None', 'oni' ),
			            'view_all' => esc_html__( 'Activate after clicking on "View All"', 'oni' ),
			            'always'   => esc_html__( 'Always', 'oni' ),
		            ),
		            'default' => 'none',
	            ),
	            array(
		            'id'        => 'woocommerce_pagination',
		            'type'      => 'select',
		            'title'     => esc_html__( 'Pagination', 'oni' ),
		            'desc'      => esc_html__( 'Select the position of pagination.', 'oni' ),
		            'options'   => array(
			            'top'       => esc_html__( 'Top', 'oni' ),
			            'bottom'    => esc_html__( 'Bottom', 'oni' ),
			            'top_bottom'=> esc_html__( 'Top and Bottom', 'oni' ),
			            'off'       => esc_html__( 'Off', 'oni' ),
		            ),
		            'default'   => 'top_bottom',
		            'required' => array( 'products_infinite_scroll', '!=', 'always' ),
	            ),
	            array(
		            'id'        => 'woocommerce_grid_list',
		            'type'      => 'select',
		            'title'     => esc_html__( 'Grid/List Option', 'oni' ),
		            'desc'      => esc_html__( 'Display products in grid or list view by default', 'oni' ),
		            'options'   => array(
			            'grid'      => esc_html__( 'Grid', 'oni' ),
			            'list'      => esc_html__( 'List', 'oni' ),
			            'off'       => esc_html__( 'Off', 'oni' ),
		            ),
		            'default'   => 'off',
	            ),
                array(
                    'id'        => 'section-label_color-start',
                    'type'      => 'section',
                    'title'     => esc_html__('"Sale", "Hot" and "New" labels color', 'oni'),
                    'indent'    => true,
                ),
                array(
                    'id'        => 'label_color_sale',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__( 'Color for "Sale" label', 'oni' ),
                    'subtitle'  => esc_html__( 'Select the Background Color for "Sale" label.', 'oni' ),
                    'default'   => array(
                        'color'     => '#dc1c52',
                        'alpha'     => '1',
                        'rgba'      => 'rgba(230,55,100,1)'
                    ),
                ),
                array(
                    'id'        => 'label_color_hot',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__( 'Color for "Hot" label', 'oni' ),
                    'subtitle'  => esc_html__( 'Select the Background Color for "Hot" label.', 'oni' ),
                    'default'   => array(
                        'color'     => '#71d080',
                        'alpha'     => '1',
                        'rgba'      => 'rgba(113,208,128,1)'
                    ),
                ),
                array(
                    'id'        => 'label_color_new',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__( 'Color for "New" label', 'oni' ),
                    'subtitle'  => esc_html__( 'Select the Background Color for "New" label.', 'oni' ),
                    'default'   => array(
                        'color'     => '#435bb2',
                        'alpha'     => '1',
                        'rgba'      => 'rgba(106,209,228,1)'
                    ),
                ),
                array(
                    'id'        => 'section-label_color-end',
                    'type'      => 'section',
                    'indent'    => false,
                ),
            )
        ) );
        Redux::setSection( $opt_name, array(
            'title'             => esc_html__('Single Product Page', 'oni' ),
            'id'                => 'product_page_settings',
            'subsection'        => true,
            'customizer_width'  => '450px',
            'fields'            => array(
                array(
                    'id'        => 'product_layout',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Thumbnails Layout', 'oni' ),
                    'options'   => array(
                        'horizontal'    => esc_html__( 'Thumbnails Bottom', 'oni' ),
                        'vertical'      => esc_html__( 'Thumbnails Left', 'oni' ),
                        'thumb_grid'    => esc_html__( 'Thumbnails Grid', 'oni' ),
                        'thumb_vertical'=> esc_html__( 'Thumbnails Vertical Grid', 'oni' ),
                    ),
                    'default'   => 'horizontal'
                ),
                array(
                    'id'        => 'activate_carousel_thumb',
                    'type'      => 'switch',
                    'title'     => esc_html__( 'Activate Carousel for Vertical Thumbnail', 'oni' ),
                    'default'   => false,
                ),
                array(
                    'id'        => 'product_container',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Product Page Layout', 'oni' ),
                    'options'   => array(
                        'container'     => esc_html__( 'Container', 'oni' ),
                        'full_width'    => esc_html__( 'Full Width', 'oni' ),
                    ),
                    'default'   => 'container'
                ),
                array(
                    'id'        => 'sticky_thumb',
                    'type'      => 'switch',
                    'title'     => esc_html__( 'Sticky Thumbnails', 'oni' ),
                    'default'   => false,
                    'required'  => array( 'product_layout', '!=', 'thumb_vertical' ),
                ),
                array(
                    'id'        => 'product_sidebar_layout',
                    'type'      => 'image_select',
                    'title'     => esc_html__( 'Single Product Page Sidebar Layout', 'oni' ),
                    'options'   => array(
                        'none'  => array(
                            'alt'       => esc_html__('None', 'oni' ),
                            'img'       => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                        ),
                        'left'  => array(
                            'alt'       => esc_html__('Left', 'oni' ),
                            'img'       => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                        ),
                        'right' => array(
                            'alt'       => esc_html__('Right', 'oni' ),
                            'img'       => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                        )
                    ),
                    'default'   => 'none'
                ),
                array(
                    'id'        => 'product_sidebar_def',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Single Product Page Sidebar', 'oni' ),
                    'data'      => 'sidebars',
                    'required'  => array( 'product_sidebar_layout', '!=', 'none' ),
                ),
                array(
                    'id'        => 'shop_size_guide',
                    'type'      => 'switch',
                    'title'     => esc_html__( 'Show Size Guide', 'oni' ),
                    'default'   => false,
                ),
                array(
                    'id'        => 'size_guide',
                    'type'      => 'media',
                    'title'     => esc_html__( 'Size guide Popup Image', 'oni' ),
                    'required'  => array( 'shop_size_guide', '=', true ),
                ),
                array(
                    'id'        => 'next_prev_product',
                    'type'      => 'switch',
                    'title'     => esc_html__( 'Show Next and Previous products', 'oni' ),
                    'default'   => true,
                ),
            )
        ) );
	    Redux::setSection( $opt_name, array(
		    'title'             => esc_html__('Page Title', 'oni' ),
		    'id'                => 'product_page_title_settings',
		    'subsection'        => true,
		    'customizer_width'  => '450px',
		    'fields'            => array(
			    array(
				    'id'       => 'shop_cat_title_conditional',
				    'type'     => 'switch',
				    'title'    => esc_html__( 'Show Title for Shop Category, Tags and Taxonomies', 'oni' ),
				    'default'  => true,
				    'required' => array( 'page_title_conditional', '=', '1' ),
			    ),
			    array(
				    'id'       => 'product_title_conditional',
				    'type'     => 'switch',
				    'title'    => esc_html__( 'Show Single Product Page Title', 'oni' ),
				    'default'  => false,
				    'required' => array( 'page_title_conditional', '=', '1' ),
			    ),
			    array(
				    'id'       => 'customize_shop_title',
				    'type'     => 'switch',
				    'title'    => esc_html__( 'Customize Shop Title', 'oni' ),
				    'default'  => false,
			    ),
			    array(
				    'id'       => 'shop_title-start',
				    'type'     => 'section',
				    'title'    => esc_html__( 'Title Settings', 'oni' ),
				    'indent'   => true,
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_vert_align',
				    'type'     => 'select',
				    'title'    => esc_html__( 'Vertical Align', 'oni' ),
				    'options'  => array(
					    'top'       => esc_html__( 'Top', 'oni' ),
					    'middle'    => esc_html__( 'Middle', 'oni' ),
					    'bottom'    => esc_html__( 'Bottom', 'oni' )
				    ),
				    'default'  => 'middle',
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_horiz_align',
				    'type'     => 'select',
				    'title'    => esc_html__( 'Shop Title Text Align?', 'oni' ),
				    'options'  => array(
					    'left'      =>  esc_html__( 'Left', 'oni' ),
					    'center'    => esc_html__( 'Center', 'oni' ),
					    'right'     => esc_html__( 'Right', 'oni' )
				    ),
				    'default'  => 'left',
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_font_color',
				    'type'     => 'color',
				    'title'    => esc_html__( 'Shop Title Font Color', 'oni' ),
				    'default'  => '#ffffff',
				    'transparent' => false,
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_bg_color',
				    'type'     => 'color',
				    'title'    => esc_html__( 'Shop Title Background Color', 'oni' ),
				    'default'  => '#0a0b0b',
				    'transparent' => false,
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_overlay_color',
				    'type'     => 'color',
				    'title'    => esc_html__( 'Shop Title Overlay Color', 'oni' ),
				    'default'  => '',
				    'transparent' => false,
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_bg_image',
				    'type'     => 'media',
				    'title'    => esc_html__( 'Shop Title Background Image', 'oni' ),
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_bg_image',
				    'type'     => 'background',
				    'background-color' => false,
				    'preview_media' => true,
				    'preview' => false,
				    'title'    => esc_html__( 'Shop Title Background Image', 'oni' ),
				    'default'  => array(
					    'background-repeat' => 'no-repeat',
					    'background-size' => 'cover',
					    'background-attachment' => 'scroll',
					    'background-position' => 'center center',
					    'background-color' => '#0a0b0b',
				    ),
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'             => 'shop_title_height',
				    'type'           => 'dimensions',
				    'units'          => false,
				    'units_extended' => false,
				    'title'          => esc_html__( 'Shop Title Height', 'oni' ),
				    'height'         => true,
				    'width'          => false,
				    'default'        => array(
					    'height' => 300,
				    ),
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_top_border',
				    'type'     => 'switch',
				    'title'    => esc_html__( 'Shop Title Top Border', 'oni' ),
				    'default'  => false,
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'       => 'shop_title_top_border_color',
				    'type'     => 'color_rgba',
				    'title'    => esc_html__( 'Shop Title Top Border Color', 'oni' ),
				    'default'  => array(
					    'color' => '#0a0b0b',
					    'alpha' => '1',
					    'rgba'  => 'rgba(10,11,11,1)'
				    ),
				    'mode'     => 'background',
				    'required' => array(
					    array( 'shop_title_top_border', '=', '1' ),
					    array( 'customize_shop_title', '=', '1' )
				    ),
			    ),
			    array(
				    'id'            => 'shop_title_bottom_border',
				    'type'          => 'switch',
				    'title'         => esc_html__( 'Shop Title Bottom Border', 'oni' ),
				    'default'       => false,
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
			    array(
				    'id'            => 'shop_title_bottom_border_color',
				    'type'          => 'color_rgba',
				    'title'         => esc_html__( 'Shop Title Bottom Border Color', 'oni' ),
				    'default'       => array(
					    'color'         => '#0a0b0b',
					    'alpha'         => '1',
					    'rgba'          => 'rgba(10,11,11,1)'
				    ),
				    'mode'          => 'background',
				    'required'      => array(
					    array( 'shop_title_bottom_border', '=', '1' ),
					    array( 'customize_shop_title', '=', '1' )
				    ),
			    ),
			    array(
				    'id'            => 'shop_title_bottom_margin',
				    'type'          => 'spacing',
				    'mode'          => 'margin',
				    'all'           => false,
				    'bottom'        => true,
				    'top'           => false,
				    'left'          => false,
				    'right'         => false,
				    'title'         => esc_html__( 'Shop Title Bottom Margin', 'oni' ),
				    'default'       => array(
					    'margin-bottom' => '60',
				    ),
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),

			    array(
				    'id'       => 'shop_title-end',
				    'type'     => 'section',
				    'indent'   => false,
				    'required' => array( 'customize_shop_title', '=', '1' )
			    ),
		    ),
	    ));

        $presets_array = array('default' => esc_html__( 'Default from Theme Options', 'oni' )) + $presets_array;

        Redux::setSection( $opt_name, array(
            'title'             => esc_html__('Shop Header', 'oni' ),
            'id'                => 'product_page_header_settings',
            'subsection'        => true,
            'customizer_width'  => '450px',
            'fields'            => array(
                array(
                    'id'       => 'shop_header',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Please select "active/default" header preset for Shop pages', 'oni' ),
                    'options'  => $presets_array,
                    'default'  => 'middle',
                ),
            ),
        ));
    }

