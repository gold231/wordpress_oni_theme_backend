<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register() {
        $wp_upload_dir = wp_upload_dir();
        $version       = wp_get_theme()->get('Version');

        wp_register_script('gt3-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), $version, true);
        $translation_array = array(
            'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
            'templateUrl' => esc_url(get_stylesheet_directory_uri())
        );
        wp_localize_script('gt3-theme', 'gt3_gt3theme', $translation_array);

        #CSS
        wp_enqueue_style('gt3-theme-default-style', get_bloginfo('stylesheet_url'), array(), $version);
        wp_enqueue_style('gt3-theme-icon', get_template_directory_uri() . '/fonts/theme-font/theme_icon.css');
        if (!wp_style_is('font-awesome-4-shim','enqueued')) {
            wp_enqueue_style("font-awesome", get_template_directory_uri() . '/css/font-awesome.min.css');
        }
        if (class_exists('YITH_WCWL_Init')) {
            wp_dequeue_style('yith-wcwl-font-awesome');
        }
        wp_enqueue_style('select2', get_template_directory_uri() . '/css/select2.min.css', array(), $version);
        wp_enqueue_style('gt3-theme', get_template_directory_uri() . '/css/theme.css', array(), $version);
        wp_enqueue_style('gt3-elementor', get_template_directory_uri() . '/css/base-elementor.css', array(), $version);
        wp_enqueue_style('gt3-responsive', get_template_directory_uri() . '/css/responsive.css', array(), $version);


        #JS
        wp_register_script('jquery-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.8.0', true);
        wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
        wp_enqueue_script('gt3-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), $version, true);
        wp_enqueue_script('event-swipe', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);
        wp_enqueue_script('select2', get_template_directory_uri() . '/js/select2.full.min.js', array(), '4.0.5', false);

        wp_register_script('google-maps-api', add_query_arg('key', gt3_option('google_map_api_key'), '//maps.google.com/maps/api/js'), array(), '', true);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register', 25);

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register() {
    #CSS (MAIN)
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/fa-brands.min.css');
    wp_enqueue_style('gt3-admin', get_template_directory_uri() . '/core/admin/css/admin.css');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('gt3-admin-colorbox', get_template_directory_uri() . '/core/admin/css/colorbox.css');
    wp_enqueue_style('selectBox', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');


    #JS (MAIN)
    wp_enqueue_script('gt3-admin', get_template_directory_uri() . '/core/admin/js/admin.js', array('jquery'), false, true);
    wp_enqueue_media();
    wp_enqueue_script('admin-colorbox', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js', array(), false, true);
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('selectBox', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');


    if (class_exists('RWMB_Loader')) {
        wp_enqueue_script('gt3-metaboxes', get_template_directory_uri() . '/core/admin/js/metaboxes.js');
    }
}

function gt3_custom_styles() {
    $RWMB_Loader = class_exists('RWMB_Loader');
    $custom_css  = '';

    // THEME COLOR
    $theme_color  = esc_attr(gt3_option('theme-custom-color'));
    $theme_color2  = esc_attr(gt3_option('theme-custom-color2'));
    // END THEME COLOR

    // BODY BACKGROUND
    $bg_body = esc_attr(gt3_option('body-background-color'));

    $body_bg_image_array  = gt3_option( "body_bg_image" );
    $body_bg_color = esc_attr(gt3_option('body-background-color'));
    $body_src = !empty($body_bg_image_array['background-image']) ? $body_bg_image_array['background-image'] : '';
    $body_repeat = !empty($body_bg_image_array['background-repeat']) ? $body_bg_image_array['background-repeat'] : '';
    $body_size = !empty($body_bg_image_array['background-size']) ? $body_bg_image_array['background-size'] : '';
    $body_attachment = !empty($body_bg_image_array['background-attachment']) ? $body_bg_image_array['background-attachment'] : '';
    $body_position = !empty($body_bg_image_array['background-position']) ? $body_bg_image_array['background-position'] : '';

    $id = gt3_get_queried_object_id();
    if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
        $mb_body_conditional = rwmb_meta('mb_body_conditional', array(), $id);
        if ($mb_body_conditional == 'custom') {
            $body_bg_color = rwmb_meta('mb_body_bg_color', array(), $id);
            $body_src = rwmb_meta('mb_body_bg_image', array(), $id);
            $body_src = !empty($body_src) ? $body_src : '';
            if (!empty($body_src)) {
                $body_src = array_values($body_src);
                $body_src = $body_src[0]['url'];
            }
            $body_repeat = rwmb_meta('mb_body_bg_repeat', array(), $id);
            $body_size = rwmb_meta('mb_body_bg_size', array(), $id);
            $body_attachment = rwmb_meta('mb_body_bg_attachment', array(), $id);
            $body_position = rwmb_meta('mb_body_bg_position', array(), $id);
        }
    }
    // END BODY BACKGROUND

    // BODY TYPOGRAPHY
    $main_font = gt3_option('main-font');
    if (!empty($main_font)) {
        $content_font_family = esc_attr($main_font['font-family']);
        $content_line_height = esc_attr($main_font['line-height']);
        $content_font_size   = esc_attr($main_font['font-size']);
        $content_font_weight = esc_attr($main_font['font-weight']);
        $content_color       = esc_attr($main_font['color']);
    } else {
        $content_font_family = '';
        $content_line_height = '';
        $content_font_size   = '';
        $content_font_weight = '';
        $content_color       = '';
    }
    $map_marker_font = gt3_option('map-marker-font');
    if (!empty($map_marker_font)) {
        $map_marker_font_family = esc_attr($map_marker_font['font-family']);
        $map_marker_font_weight = esc_attr($map_marker_font['font-weight']);
    } else {
        $map_marker_font_family = '';
        $map_marker_font_weight = '';
    }
    // END BODY TYPOGRAPHY

    // SECONDARY TYPOGRAPHY
    $secondary_font = gt3_option('secondary-font');
    if (!empty($secondary_font)) {
        $content_secondary_font_family = esc_attr($secondary_font['font-family']);
        $content_secondary_line_height = esc_attr($secondary_font['line-height']);
        $content_secondary_font_size   = esc_attr($secondary_font['font-size']);
        $content_secondary_font_weight = esc_attr($secondary_font['font-weight']);
        $content_secondary_color       = esc_attr($secondary_font['color']);
    } else {
        $content_secondary_font_family = '';
        $content_secondary_line_height = '';
        $content_secondary_font_size   = '';
        $content_secondary_font_weight = '';
        $content_secondary_color       = '';
    }
    // END BODY TYPOGRAPHY

    // HEADER TYPOGRAPHY
    $header_font = gt3_option('header-font');
    if (!empty($header_font)) {
        $header_font_family = esc_attr($header_font['font-family']);
        $header_font_weight = esc_attr($header_font['font-weight']);
        $header_font_color  = esc_attr($header_font['color']);
    } else {
        $header_font_family = '';
        $header_font_weight = '';
        $header_font_color  = '';
    }

    $h1_font = gt3_option('h1-font');
    if (!empty($h1_font)) {
        $H1_font_family      = !empty($h1_font['font-family']) ? esc_attr($h1_font['font-family']) : '';
        $H1_font_weight      = !empty($h1_font['font-weight']) ? esc_attr($h1_font['font-weight']) : '';
        $H1_font_line_height = !empty($h1_font['line-height']) ? esc_attr($h1_font['line-height']) : '';
        $H1_font_size        = !empty($h1_font['font-size']) ? esc_attr($h1_font['font-size']) : '';
    } else {
        $H1_font_family      = '';
        $H1_font_weight      = '';
        $H1_font_line_height = '';
        $H1_font_size        = '';
    }

    $h2_font = gt3_option('h2-font');
    if (!empty($h2_font)) {
        $H2_font_family      = !empty($h2_font['font-family']) ? esc_attr($h2_font['font-family']) : '';
        $H2_font_weight      = !empty($h2_font['font-weight']) ? esc_attr($h2_font['font-weight']) : '';
        $H2_font_line_height = !empty($h2_font['line-height']) ? esc_attr($h2_font['line-height']) : '';
        $H2_font_size        = !empty($h2_font['font-size']) ? esc_attr($h2_font['font-size']) : '';
    } else {
        $H2_font_family      = '';
        $H2_font_weight      = '';
        $H2_font_line_height = '';
        $H2_font_size        = '';
    }

    $h3_font = gt3_option('h3-font');
    if (!empty($h3_font)) {
        $H3_font_family      = !empty($h3_font['font-family']) ? esc_attr($h3_font['font-family']) : '';
        $H3_font_weight      = !empty($h3_font['font-weight']) ? esc_attr($h3_font['font-weight']) : '';
        $H3_font_line_height = !empty($h3_font['line-height']) ? esc_attr($h3_font['line-height']) : '';
        $H3_font_size        = !empty($h3_font['font-size']) ? esc_attr($h3_font['font-size']) : '';
    } else {
        $H3_font_family      = '';
        $H3_font_weight      = '';
        $H3_font_line_height = '';
        $H3_font_size        = '';
    }

    $h4_font = gt3_option('h4-font');
    if (!empty($h4_font)) {
        $H4_font_family      = !empty($h4_font['font-family']) ? esc_attr($h4_font['font-family']) : '';
        $H4_font_weight      = !empty($h4_font['font-weight']) ? esc_attr($h4_font['font-weight']) : '';
        $H4_font_line_height = !empty($h4_font['line-height']) ? esc_attr($h4_font['line-height']) : '';
        $H4_font_size        = !empty($h4_font['font-size']) ? esc_attr($h4_font['font-size']) : '';
    } else {
        $H4_font_family      = '';
        $H4_font_weight      = '';
        $H4_font_line_height = '';
        $H4_font_size        = '';
    }

    $h5_font = gt3_option('h5-font');
    if (!empty($h5_font)) {
        $H5_font_family      = !empty($h5_font['font-family']) ? esc_attr($h5_font['font-family']) : '';
        $H5_font_weight      = !empty($h5_font['font-weight']) ? esc_attr($h5_font['font-weight']) : '';
        $H5_font_line_height = !empty($h5_font['line-height']) ? esc_attr($h5_font['line-height']) : '';
        $H5_font_size        = !empty($h5_font['font-size']) ? esc_attr($h5_font['font-size']) : '';
    } else {
        $H5_font_family      = '';
        $H5_font_weight      = '';
        $H5_font_line_height = '';
        $H5_font_size        = '';
    }

    $h6_font = gt3_option('h6-font');
    if (!empty($h6_font)) {
        $H6_font_family         = !empty($h6_font['font-family']) ? esc_attr($h6_font['font-family']) : '';
        $H6_font_weight         = !empty($h6_font['font-weight']) ? esc_attr($h6_font['font-weight']) : '';
        $H6_font_line_height    = !empty($h6_font['line-height']) ? esc_attr($h6_font['line-height']) : '';
        $H6_font_size           = !empty($h6_font['font-size']) ? esc_attr($h6_font['font-size']) : '';
        $H6_font_color          = !empty($h6_font['color']) ? esc_attr($h6_font['color']) : '';
        $H6_font_letter_spacing = !empty($h6_font['letter-spacing']) ? esc_attr($h6_font['letter-spacing']) : '';
        $H6_font_text_transform = !empty($h6_font['text-transform']) ? esc_attr($h6_font['text-transform']) : '';
    } else {
        $H6_font_family         = '';
        $H6_font_weight         = '';
        $H6_font_line_height    = '';
        $H6_font_size           = '';
        $H6_font_color          = '';
        $H6_font_letter_spacing = '';
        $H6_font_text_transform = '';
    }

    $menu_font = gt3_option('menu-font');
    if (!empty($menu_font)) {
        $menu_font_family      = !empty($menu_font['font-family']) ? esc_attr($menu_font['font-family']) : '';
        $menu_font_weight      = !empty($menu_font['font-weight']) ? esc_attr($menu_font['font-weight']) : '';
        $menu_font_line_height = !empty($menu_font['line-height']) ? esc_attr($menu_font['line-height']) : '';
        $menu_font_size        = !empty($menu_font['font-size']) ? esc_attr($menu_font['font-size']) : '';
        $menu_font_letter_spacing = !empty($menu_font['letter-spacing']) ? esc_attr($menu_font['letter-spacing']) : '';
        $menu_font_text_transform = !empty($menu_font['text-transform']) ? esc_attr($menu_font['text-transform']) : '';
    } else {
        $menu_font_family      = '';
        $menu_font_weight      = '';
        $menu_font_line_height = '';
        $menu_font_size        = '';
        $menu_font_letter_spacing = '';
        $menu_font_text_transform = '';
    }

    $sub_menu_bg          = gt3_option('sub_menu_background');
    $sub_menu_color       = gt3_option('sub_menu_color');
    $sub_menu_color_hover = gt3_option('sub_menu_color_hover');

    $logo_height          = gt3_option( 'logo_height' );
    $logo_teblet_width    = gt3_option('logo_teblet_width');
    $logo_mobile_width    = gt3_option('logo_mobile_width');



    /* GT3 Header Builder */
    $sections = array('top','middle','bottom','top__tablet','middle__tablet','bottom__tablet','top__mobile','middle__mobile','bottom__mobile');
    $desktop_sides = array('top', 'middle', 'bottom');

    foreach ($sections as $section) {
        ${'side_' . $section . '_custom'} = gt3_option('side_'.$section.'_custom');
        ${'side_' . $section . '_background'} = gt3_option('side_'.$section.'_background');
        if (!empty(${'side_' . $section . '_background'}['rgba'])) {
            ${'side_' . $section . '_background'} = ${'side_' . $section . '_background'}['rgba'];
        }else{
            ${'side_' . $section . '_background'} = '';
        }


        ${'side_' . $section . '_background2'} = gt3_option('side_'.$section.'_background2');
        if (!empty(${'side_' . $section . '_background2'}['rgba'])) {
            ${'side_' . $section . '_background2'} = ${'side_' . $section . '_background2'}['rgba'];
        }else{
            ${'side_' . $section . '_background2'} = '';
        }

        ${'side_' . $section . '_spacing'}  = gt3_option('side_'.$section.'_spacing');

        ${'side_' . $section . '_color'}  = gt3_option('side_'.$section.'_color');
        ${'side_' . $section . '_color_hover'}  = gt3_option('side_'.$section.'_color_hover');
        ${'side_' . $section . '_height'} = gt3_option('side_'.$section.'_height');
        ${'side_' . $section . '_height'} = ${'side_' . $section . '_height'}['height'];
        ${'side_' . $section . '_border'} = (bool)gt3_option('side_' . $section . '_border');
        ${'side_' . $section . '_border_color'} = gt3_option('side_' . $section . '_border_color');

        ${'side_' . $section . '_border_radius'} = gt3_option('side_' . $section . '_border_radius');
    }

    $logo_limit_on_mobile = gt3_option('logo_limit_on_mobile');

    $header_sticky              = gt3_option('header_sticky');
    foreach ($desktop_sides as $sticky_side) {
        ${'side_'.$sticky_side.'_sticky'}            = gt3_option('side_'.$sticky_side.'_sticky');
        ${'side_'.$sticky_side.'_background_sticky'} = gt3_option('side_'.$sticky_side.'_background_sticky');
        ${'side_'.$sticky_side.'_color_sticky'}      = gt3_option('side_'.$sticky_side.'_color_sticky');
        ${'side_'.$sticky_side.'_color_hover_sticky'}= gt3_option('side_'.$sticky_side.'_color_hover_sticky');
        ${'side_'.$sticky_side.'_height_sticky'}     = gt3_option('side_'.$sticky_side.'_height_sticky');
        ${'side_'.$sticky_side.'_spacing_sticky'}     = gt3_option('side_'.$sticky_side.'_spacing_sticky');
    }

    $gt3_header_builder_active_preset = gt3_option("main_header_preset");
    if (class_exists( 'WooCommerce' ) && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
        $gt3_header_builder_active_preset = gt3_option("shop_header");
    }
    if ( isset($gt3_header_builder_active_preset) ) {
        $presets = gt3_option('gt3_header_builder_presets');
        if ($gt3_header_builder_active_preset != 'default' && isset($gt3_header_builder_active_preset) && !empty($presets[$gt3_header_builder_active_preset]) && !empty($presets[$gt3_header_builder_active_preset]['preset'])) {
            $preset = $presets[$gt3_header_builder_active_preset]['preset'];
            $preset = json_decode($preset,true);
            $gt3_header_builder_array = gt3_option_presets($preset,'gt3_header_builder_id');
        }
    }

    /* mobile options */
    if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
        $id = gt3_get_queried_object_id();
        $mb_header_presets = rwmb_meta('mb_header_presets', array(), $id);
        if (isset($mb_header_presets) && $mb_header_presets != 'default') {
            $gt3_header_builder_active_preset = rwmb_meta('mb_header_presets');
        }        
    }

    if (!empty($presets)) {
        if ($gt3_header_builder_active_preset != 'default' && isset($gt3_header_builder_active_preset) && !empty($presets[$gt3_header_builder_active_preset]) && !empty($presets[$gt3_header_builder_active_preset]['preset']) ) {

            $preset = $presets[$gt3_header_builder_active_preset]['preset'];
            $preset = json_decode($preset,true);

            $sub_menu_bg = gt3_option_presets($preset,'sub_menu_background');
            $sub_menu_color = gt3_option_presets($preset,'sub_menu_color');

            $logo_height       = gt3_option_presets($preset,'logo_height');
            $logo_teblet_width = gt3_option_presets($preset,"logo_teblet_width");
            $logo_mobile_width = gt3_option_presets($preset,"logo_mobile_width");

            foreach ($sections as $section) {
                ${'side_' . $section . '_custom'} = gt3_option_presets($preset,'side_'.$section.'_custom');
                ${'side_' . $section . '_background'} = gt3_option_presets($preset,'side_'.$section.'_background');
                ${'side_' . $section . '_background'} = ${'side_' . $section . '_background'}['rgba'];

                ${'side_' . $section . '_background2'} = gt3_option_presets($preset,'side_'.$section.'_background2');
                ${'side_' . $section . '_background2'} = ${'side_' . $section . '_background2'}['rgba'];

                ${'side_' . $section . '_spacing'}  = gt3_option_presets($preset,'side_'.$section.'_spacing');

                ${'side_' . $section . '_color'}  = gt3_option_presets($preset,'side_'.$section.'_color');
                ${'side_' . $section . '_color_hover'}  = gt3_option_presets($preset,'side_'.$section.'_color_hover');
                ${'side_' . $section . '_height'} = gt3_option_presets($preset,'side_'.$section.'_height');
                ${'side_' . $section . '_height'} = ${'side_' . $section . '_height'}['height'];
                ${'side_' . $section . '_border'} = (bool)gt3_option_presets($preset,'side_' . $section . '_border');
                ${'side_' . $section . '_border_color'} = gt3_option_presets($preset,'side_' . $section . '_border_color');

                ${'side_' . $section . '_border_radius'} = gt3_option_presets($preset,'side_' . $section . '_border_radius');
            }

            $header_sticky = gt3_option_presets($preset,"header_sticky");

            foreach ($desktop_sides as $sticky_side) {
                ${'side_'.$sticky_side.'_sticky'} = gt3_option_presets($preset,'side_'.$sticky_side.'_sticky');
                ${'side_'.$sticky_side.'_background_sticky'} = gt3_option_presets($preset,'side_'.$sticky_side.'_background_sticky');
                ${'side_'.$sticky_side.'_color_sticky'} = gt3_option_presets($preset,'side_'.$sticky_side.'_color_sticky');
                ${'side_'.$sticky_side.'_color_hover_sticky'} = gt3_option_presets($preset,'side_'.$sticky_side.'_color_hover_sticky');
                ${'side_'.$sticky_side.'_height_sticky'} = gt3_option_presets($preset,'side_'.$sticky_side.'_height_sticky');
                ${'side_'.$sticky_side.'_spacing_sticky'} = gt3_option_presets($preset,'side_'.$sticky_side.'_spacing_sticky');
            }
        }
    }

    /* End GT3 Header Builder */


    // END HEADER TYPOGRAPHY


    $custom_css .= '
    /* Custom CSS */
    *{
    }
    
    body,
    .main_footer .widget-title,
    .widget-title,
    body .widget .yit-wcan-select-open,
    body .widget-hotspot,
    body div[id*="ajaxsearchlitesettings"].searchsettings form fieldset legend,
    .prev_next_links_fullwidht .link_item,
    span.elementor-drop-cap span.elementor-drop-cap-letter,
    input[type="date"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    input[type="search"],
    input[type="tel"],
    input[type="text"],
    input[type="url"],
    select,
    textarea,
    .select2-search--dropdown .select2-search__field {
        font-family:' . $content_font_family . ';
    }
    input[type="date"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    input[type="search"],
    input[type="tel"],
    input[type="text"],
    input[type="url"],
    select,
    textarea,
    .select2-search--dropdown .select2-search__field {
        font-weight:' . $content_font_weight . ';
    }
    body {
        ' . (!empty($body_bg_color) ? 'background-color:' . $body_bg_color . ';' : '') . '
        font-size:' . $content_font_size . ';
        line-height:' . $content_line_height . ';
        font-weight:' . $content_font_weight . ';
        color: ' . $content_color . ';
        ' . (!empty($body_src) ? 'background-image: url(' . $body_src . ');' : '') . '
        ' . (!empty($body_repeat) && !empty($body_src) ? 'background-repeat:' . $body_repeat . ';' : '') . '
        ' . (!empty($body_size) && !empty($body_src) ? 'background-size:' . $body_size . ';' : '') . '
        ' . (!empty($body_attachment) && !empty($body_src) ? 'background-attachment:' . $body_attachment . ';' : '') . '
        ' . (!empty($body_position) && !empty($body_src) ? 'background-position:' . $body_position . ';' : '') . '
    }
    .elementor-widget-gt3-core-portfolio .hover_type2 .wrapper .text_wrap:before,
    .elementor-widget-gt3-core-portfolio .hover_type3 .wrapper .text_wrap:before,
    .elementor-widget-gt3-core-team .module_team.type2 .item-team-member .item_wrapper,
    .elementor-widget-gt3-core-team .module_team.type2 .item-team-member:nth-child(even) .item_wrapper,
    .gt3pg_pro_FSSlider .gt3pg_pro_gallery_wrap,
    .gt3_image_rotate .gt3_image_rotate_title {
        ' . (!empty($bg_body) ? 'background:' . $bg_body . ';' : '') . '
    }
    .single .post_share_block:hover > .post_share_wrap ul li {
        ' . (!empty($bg_body) ? 'background:' . $bg_body . ' !important;' : '') . '
    }
    p {
        line-height: ' . ((int)$content_line_height/(int)$content_font_size) . ';
    }
    /* Secondaty Fonts */
    .secondary {
        font-family:' . $content_secondary_font_family . ';
        font-size:' . $content_secondary_font_size . ';
        line-height:' . $content_secondary_line_height . ';
        '.(!empty($content_secondary_font_weight) ? 'font-weight: ' . $content_secondary_font_weight . ';' : '' ).'
        color: ' . $content_secondary_color . ';
    }

    /* Custom Fonts */
    .module_team .team_info,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .gt3_header_builder_component.gt3_header_builder_search_cat_component .gt3-search_cat-select,
    .main_wrapper .gt3_search_form:before,
    .widget_search .gt3_search_form label,
    .main_wrapper .gt3_search_form label,
    .main_wrapper .sidebar-container .widget_categories ul li > a:hover:before,
    .main_wrapper .sidebar-container .widget_product_categories ul li > a:hover:before,
    .main_wrapper .sidebar-container .widget_layered_nav ul li > a:hover:before,
    .logged-in-as a:hover,
    .sidebar-container .widget.widget_posts .recent_posts .post_title a,
    .gt3_header_builder_component .woocommerce-mini-cart__empty-message,
    .elementor-widget-gt3-core-tabs .ui-tabs-nav .ui-state-default a,
    .single_prev_next_posts .gt3_post_navi:after,
    .elementor-widget-gt3-core-portfolio .portfolio_wrapper.hover_type6 .text_wrap .title,
    .gt3_price_item-elementor .gt3_item_cost_wrapper h3,
    .gt3pg-isotope-item .text_info_wrapper {
        color: ' . $header_font_color . ';
    }
    .search-results .blogpost_title a {
        color: ' . $header_font_color . ' !important;
    }
    .search-results .blogpost_title a:hover,
    .select2-container--default li.select2-results__option[aria-selected="true"],
    ul.select2-results__options li:hover {
        color: ' . $theme_color . ' !important;
    }
    .gt3_icon_box__icon--number,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .strip_template .strip-item a span,
    .column1 .item_title a,
    .index_number,
    .price_item_btn a,
    .shortcode_tab_item_title,
    .gt3_twitter .twitt_title,
    .elementor-widget-gt3-core-counter .counter,
    .gt3_dropcaps,
    .dropcap,
    .single_prev_next_posts .gt3_post_navi:after {
        font-family: ' . $header_font_family . ';
        font-weight: ' . $header_font_weight . ';
    }
    .gt3-page-title .page_title_meta.cpt_portf * {
        font-weight: inherit;
    }
    .format-video .gt3_video__play_button:hover,
    .widget .calendar_wrap tbody td > a:before {
        background: ' . $theme_color . ';
    }
    h1,
    .elementor-widget-heading h1.elementor-heading-title {
        ' . (!empty($H1_font_family) ? 'font-family:' . $H1_font_family . ';' : '') . '
        ' . (!empty($H1_font_weight) ? 'font-weight:' . $H1_font_weight . ';' : '') . '
        ' . (!empty($H1_font_size) ? 'font-size:' . $H1_font_size . ';' : '') . '
        ' . (!empty($H1_font_line_height) ? 'line-height:' . $H1_font_line_height . ';' : '') . '
    }
    h2,
    .elementor-widget-heading h2.elementor-heading-title,
    .elementor-widget-gt3-core-blog .blogpost_title {
        ' . (!empty($H2_font_family) ? 'font-family:' . $H2_font_family . ';' : '') . '
        ' . (!empty($H2_font_weight) ? 'font-weight:' . $H2_font_weight . ';' : '') . '
        ' . (!empty($H2_font_size) ? 'font-size:' . $H2_font_size . ';' : '') . '
        ' . (!empty($H2_font_line_height) ? 'line-height:' . $H2_font_line_height . ';' : '') . '
    }
    h3,
    .elementor-widget-heading h3.elementor-heading-title,
    #customer_login h2,
    .gt3_header_builder__login-modal_container h2,
    .sidepanel .title{
        ' . (!empty($H3_font_family) ? 'font-family:' . $H3_font_family . ';' : '') . '
        ' . (!empty($H3_font_weight) ? 'font-weight:' . $H3_font_weight . ';' : '') . '
        ' . (!empty($H3_font_size) ? 'font-size:' . $H3_font_size . ';' : '') . '
        ' . (!empty($H3_font_line_height) ? 'line-height:' . $H3_font_line_height . ';' : '') . '
    }
    h4,
    .elementor-widget-heading h4.elementor-heading-title {
        ' . (!empty($H4_font_family) ? 'font-family:' . $H4_font_family . ';' : '') . '
        ' . (!empty($H4_font_weight) ? 'font-weight:' . $H4_font_weight . ';' : '') . '
        ' . (!empty($H4_font_size) ? 'font-size:' . $H4_font_size . ';' : '') . '
        ' . (!empty($H4_font_line_height) ? 'line-height:' . $H4_font_line_height . ';' : '') . '
    }
    h5,
    .elementor-widget-heading h5.elementor-heading-title {
        ' . (!empty($H5_font_family) ? 'font-family:' . $H5_font_family . ';' : '') . '
        ' . (!empty($H5_font_weight) ? 'font-weight:' . $H5_font_weight . ';' : '') . '
        ' . (!empty($H5_font_size) ? 'font-size:' . $H5_font_size . ';' : '') . '
        ' . (!empty($H5_font_line_height) ? 'line-height:' . $H5_font_line_height . ';' : '') . '
    }
    h6,
    .elementor-widget-heading h6.elementor-heading-title {
        ' . (!empty($H6_font_family) ? 'font-family:' . $H6_font_family . ';' : '') . '
        ' . (!empty($H6_font_weight) ? 'font-weight:' . $H6_font_weight . ';' : '') . '
        ' . (!empty($H6_font_size) ? 'font-size:' . $H6_font_size . ';' : '') . '
        ' . (!empty($H6_font_line_height) ? 'line-height:' . $H6_font_line_height . ';' : '') . '
        ' . (!empty($H6_font_color) ? 'color:' . $H6_font_color . ';' : '') . '
        ' . (!empty($H6_font_letter_spacing) ? 'letter-spacing:' . $H6_font_letter_spacing . ';' : '') . '
        ' . (!empty($H6_font_text_transform) ? 'text-transform:' . $H6_font_text_transform . ';' : '') . '
    }
    
	.diagram_item .chart,
    .item_title a ,
    .contentarea ul,
    .blog_post_media--link .blog_post_media__link_text p,
    .woocommerce-LostPassword a:hover{
        color:' . $header_font_color . ';
    }

    button,
    .gt3_header_builder_cart_component .buttons .button,
    .gt3_module_button a,
    .learn_more,
    .gt3_custom_tooltip:before,
    .gt3_custom_tooltip:after,
    blockquote,
    .elementor-widget-gt3-core-TestimonialsLite .testimonials-text,
    .quote_text,
    .quote_author,
    .blog_post_media__link_text {
        font-family:' . $content_secondary_font_family . ';
        '.(!empty($content_secondary_font_weight) ? 'font-weight: ' . $content_secondary_font_weight . ';' : '' ).'
    }

    /* Theme color */
    a,
    .calendar_wrap thead,
    .gt3_practice_list__image-holder i,
    .load_more_works:hover,
    .copyright a:hover,
    .price_item .items_text ul li:before,
    .price_item.most_popular .item_cost_wrapper h3,
    .gt3_practice_list__title a:hover,
    #select2-gt3_product_cat-results li,
    .listing_meta,
    ol > li:before,
    .main_wrapper #main_content ul.gt3_list_line li:before,
    .main_wrapper .elementor-section ul.gt3_list_line li:before,
    .main_wrapper #main_content ul.gt3_list_disc li:before,
    .main_wrapper .elementor-section ul.gt3_list_disc li:before,
    .top_footer a:hover,    
    .main_wrapper .sidebar-container .widget_categories ul > li.current-cat > a,
    .main_wrapper .sidebar-container .widget_categories ul > li > a:hover,
    .single_prev_next_posts a:hover .gt3_post_navi:after,
    .gt3_practice_list__link:before,
    .load_more_works,
    .woocommerce ul.products li.product .woocommerce-loop-product__title:hover,
    .woocommerce ul.cart_list li a:hover,
    ul.gt3_list_disc li:before,
	.woocommerce-MyAccount-navigation ul li:hover a,
    .woocommerce-MyAccount-navigation ul li.is-active a,
	.elementor-widget-gt3-core-portfolio .portfolio_wrapper.hover_type6 .text_wrap:hover .title,
    .elementor-widget-gt3-core-team .module_team.type3 .team_link a:hover,
    .elementor-widget-gt3-core-team .module_team .team_title__text a:hover,
    blockquote,
    .elementor-element-custom_color a:hover,    
    .woocommerce ul.products li.product:hover .price ins{
		color: ' . $theme_color . ';
	}
	.gt3_practice_list__link:before,
	.load_more_works,
    .woocommerce ul.products:not(.list) li.product .gt3_woocommerce_open_control_tag div a:before,
    .woocommerce ul.products:not(.list) li.product .gt3_woocommerce_open_control_tag .added_to_cart:hover,
    .woocommerce ul.products:not(.list) li.product .gt3_woocommerce_open_control_tag div a:hover,
    .blog_post_media--quote .quote_text:before,
    .blog_post_media__link_text:before{
        background-color: ' . $theme_color . ';
    }
    .comment-reply-link:hover,
    .main_wrapper .gt3_product_list_nav li a:hover {
        color: ' . $theme_color . ';
    }
    .widget .calendar_wrap table td#today:before {
        background: ' . $theme_color . ';
    }
    .calendar_wrap caption {
        background: ' . $theme_color2 . ';
    }
    .widget .calendar_wrap tbody td > a {
        color: ' . $theme_color2 . ';
    }
    .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
    div:not(.packery_wrapper) .blog_post_preview .listing_meta a,
    .blog_post_media--quote .quote_text a:hover {
        color: ' . $theme_color . ';
    }
    .blogpost_title a:hover,
    .woocommerce #reviews #respond input#submit:hover,
    .woocommerce #reviews a.button:hover,
    .woocommerce #reviews button.button:hover,
    .woocommerce #reviews input.button:hover {
        color: ' . $theme_color . ' !important;
    }
    .gt3_icon_box__link a:before,
    .gt3_icon_box__link a:before,
    .stripe_item-divider{
        background-color: ' . $theme_color . ';
    }
    .single-member-page .member-icon:hover,
    .single-member-page .team-link:hover,
    .sidebar .widget_nav_menu .menu .menu-item > a:hover,
    .widget.widget_recent_entries > ul > li:hover a,
    .gt3_widget > ul > li a:hover,  
    #main_content ul.wp-block-archives li > a:hover,
    #main_content ul.wp-block-categories li > a:hover,
    #main_content ul.wp-block-latest-posts li > a:hover,
    #respond #commentform p[class*="comment-form-"] > label.gt3_onfocus,
    .comment-notes .required,
    #cancel-comment-reply-link,
    .top_footer .widget.widget_recent_entries ul li > a:hover {
        color: ' . $theme_color . ';
    }

    /* menu fonts */
    .main-menu>.gt3-menu-categories-title,
    .main-menu>ul,
    .main-menu>div>ul,
    .column_menu>ul,
    .column_menu>.gt3-menu-categories-title,
    .column_menu>div>ul {
        font-family:' . esc_attr($menu_font_family) . ';
        font-weight:' . esc_attr($menu_font_weight) . ';
        line-height:' . esc_attr($menu_font_line_height) . ';
        font-size:' . esc_attr($menu_font_size) . ';
        '.(!empty($menu_font_letter_spacing) ? 'letter-spacing: ' . esc_attr($menu_font_letter_spacing) . ';' : '' ).'
        '.(!empty($menu_font_text_transform) ? 'text-transform: ' . esc_attr($menu_font_text_transform) . ';' : '' ).'
    }

    /* sub menu styles */
    .main-menu ul.sub-menu li.menu-item:hover > a:hover,
    .column_menu ul li.menu-item:hover > a:hover,
    .main-menu .current_page_item,
    .main-menu .current-menu-item,
    .main-menu .current-menu-ancestor,
    .gt3_header_builder_menu_component .column_menu .menu li.current_page_item > a,
    .gt3_header_builder_menu_component .column_menu .menu li.current-menu-item > a,
    .gt3_header_builder_menu_component .column_menu .menu li.current-menu-ancestor > a,
    .column_menu .current_page_item,
    .column_menu .current-menu-item,
    .column_menu .current-menu-ancestor{
        color: ' . esc_attr($sub_menu_color_hover) . ';
    }
    .header_search .header_search__inner:before{
        ' . (!empty($bg_body) ? 'background-color:' . $bg_body . ';' : '') . '
    }
    .header_search__inner .gt3_search_form__wrapper .header_search__inner_title{
        font-family: ' . $header_font_family . ';
        font-weight: ' . $header_font_weight . ';
        color: ' . $header_font_color . ';
    }
    .header_search__inner_close {
        border-color: ' . $content_color . ';
        background: ' . $content_color . ';
    }
    .header_search__inner .search_form:after{
        border-top-color: ' . $theme_color . ';
    }
    .main-menu ul li ul.sub-menu,
    .column_menu ul li ul.sub-menu,
    .main_header .header_search__inner .search_form,
    .mobile_menu_container {
        background-color: ' . (!empty($sub_menu_bg['rgba']) ? esc_attr($sub_menu_bg['rgba']) : "transparent") . ' ;
        color: ' . esc_attr($sub_menu_color) . ' ;
    }
    .main_header .header_search__inner .search_text::-webkit-input-placeholder{
        color: ' . esc_attr($content_color) . ' !important;
    }
    .main_header .header_search__inner .search_text:-moz-placeholder {
        color: ' . esc_attr($content_color) . ' !important;
    }
    .main_header .header_search__inner .search_text::-moz-placeholder {
        color: ' . esc_attr($content_color) . ' !important;
    }
    .main_header .header_search__inner .search_text:-ms-input-placeholder {
        color: ' . esc_attr($content_color) . ' !important;
    }
    .header_search__inner .search-field,
    .header_search__inner .search_text{
        color: ' . esc_attr($content_color) . ';
    }
    .header_search__inner .search-field:-webkit-autofill,
    .header_search__inner .search-field:-webkit-autofill:hover,
    .header_search__inner .search-field:-webkit-autofill:focus,
    .header_search__inner .search_text:-webkit-autofill,
    .header_search__inner .search_text:-webkit-autofill:hover,
    .header_search__inner .search_text:-webkit-autofill:focus{
        -webkit-text-fill-color: ' . esc_attr($content_color) . ';
    }
    input::-webkit-input-placeholder,
    textarea::-webkit-input-placeholder{
        color: ' . $content_color . ';
    }
    input:-moz-placeholder,
    textarea:-moz-placeholder {
        color: ' . $content_color . ';
    }
    input::-moz-placeholder,
    textarea::-moz-placeholder {
        color: ' . $content_color . ';
    }
    input:-ms-input-placeholder,
    textarea:-ms-input-placeholder {
        color: ' . $content_color . ';
    }

    /* widgets */
    body div[id*=\'ajaxsearchlitesettings\'].searchsettings fieldset .label:hover,
    body div[id*=\'ajaxsearchlite\'] .probox .proclose:hover,
    .module_team.type2 .team_title__text,
    .widget.widget_rss > ul > li a,
    .sidebar-container .widget.widget_posts .recent_posts .listing_meta span,
    .woocommerce ul.cart_list li .quantity,
    .woocommerce ul.product_list_widget li .quantity,
    .gt3_header_builder_cart_component__cart-container .total,
    .wpcf7-form label {
        color: ' . $header_font_color . ';
    }

    /* blog */
    .countdown-period,
    .gt3-page-title_default_color_a .gt3-page-title__content .gt3_breadcrumb a,
    .gt3-page-title_default_color_a .gt3-page-title__content .gt3_breadcrumb .gt3_pagination_delimiter,
    .module_team.type2 .team-positions,
    .widget.widget_recent_entries > ul > li a,
    .gt3_widget > ul > li a,
    #main_content ul.wp-block-archives li > a,
    #main_content ul.wp-block-categories li > a,
    #main_content ul.wp-block-latest-posts li > a,
    .comment-reply-link,
    .sidebar .widget_nav_menu .menu .menu-item > a,
    .gt3_module_button_list a,
    .blog_post_info,
    .likes_block.already_liked .icon,
    .likes_block.already_liked:hover .icon,
    .gt3_form label,
    .wpcf7-form .label,
    .wrapper_404 label,
    .widget .gt3_search_form label,
    #respond #commentform p[class*="comment-form-"] > label,
    .comment_author_says span,
    .search_form .search_text,
    .widget_search .search_form .search_submit,
    .search_result_form .search_form .search_submit,
    .search_result_form .search_form:before,
    .woocommerce-MyAccount-navigation ul li a,
    .main_wrapper .gt3_product_list_nav li a,
    .wp-block-image figcaption {
        color: ' . $content_color . ';
    }
    div:not(.packery_wrapper) .blog_post_preview .listing_meta,
    div:not(.packery_wrapper) .blog_post_preview .listing_meta a:hover {
        color: rgba('.gt3_HexToRGB($header_font_color).', 0.6);
    }
    .listing_meta span.post_category a:after {
        color: rgba('.gt3_HexToRGB($content_color).', 0.85) !important;
    }
    .blogpost_title i,
    .widget.widget_recent_comments > ul > li a:hover,
    .widget.widget_rss > ul > li:hover a,
    .sidebar-container .widget.widget_posts .recent_posts .post_title a:hover,
    .comment_info a:hover,
    .gt3_module_button_list a:hover,
    .elementor-widget-gt3-core-pricebox .price_button-elementor a:hover,
    .sidebar .widget .widget-title,
    .gt3_widget.woocommerce .widget-title,
    .header_search__inner .search_form .search_submit,
    .widget_search .search_form:before {
        color: ' . $theme_color . ';
    }
    .gt3_header_builder_cart_component__cart-container .total strong,
    .prev_next_links .title,
    .widget.widget_recent_comments > ul > li a {
        color: ' . $header_font_color . ';
    }

    .elementor-widget-gt3-core-pricebox .price_button-elementor a,
    .gt3_module_title .carousel_arrows a:hover span,
    .stripe_item:after,
    .packery-item .packery_overlay,
    .ui-datepicker .ui-datepicker-buttonpane button.ui-state-hover{
        background: ' . $theme_color . ';
    }
    .elementor-widget-gt3-core-pricebox .price_button-elementor a,
    .elementor-widget-gt3-core-pricebox .price_button-elementor a:hover,
    button:hover,
    .ui-datepicker .ui-datepicker-buttonpane button.ui-state-hover,
    .woocommerce ul.products li.product .gt3_woocommerce_open_control_tag_bottom div a,
    .woocommerce ul.products li.product .gt3_woocommerce_open_control_tag_bottom div a:hover {
        border-color: ' . $theme_color . ';
    }
    .gt3_module_title .carousel_arrows a:hover span:before {
        border-color: ' . $theme_color . ';
    }
    .gt3_module_title .carousel_arrows a span,
    .elementor-slick-slider .slick-slider .slick-prev:after,
    .elementor-slick-slider .slick-slider .slick-next:after {
        background: ' . $header_font_color . ';
    }
    .gt3_module_title .carousel_arrows a span:before {
        border-color: ' . $header_font_color . ';
    }
    .post_share_block:hover > a,
    .woocommerce ul.products li.product .gt3_woocommerce_open_control_tag_bottom div a:hover,
    .woocommerce ul.products.list li.product .gt3_woocommerce_open_control_tag div a:hover:before, 
    .woocommerce ul.products li.product .gt3_woocommerce_open_control_tag_bottom div a:hover:before,
    .woocommerce div.product form.cart .button:hover,
    .single-product.woocommerce div.product .product_meta a:hover,
    .woocommerce div.product span.price,
    .likes_block:hover .icon,
    .woocommerce .gt3-pagination_nav nav.woocommerce-pagination ul li a.prev:hover,
    .woocommerce .gt3-pagination_nav nav.woocommerce-pagination ul li a.next:hover,
    .woocommerce .gt3-pagination_nav nav.woocommerce-pagination ul li a.gt3_show_all:hover,
    .woocommerce div.product div.images div.woocommerce-product-gallery__trigger:hover{
        color: ' . $theme_color . ';
    }
    .gt3_practice_list__filter,
    .woocommerce ul.products li.product .price {
        color: ' . $header_font_color . ';
    }

    ul.products:not(.list) li.product:hover .gt3_woocommerce_open_control_tag div a{
        background: ' . $header_font_color . ';
    }

    .gt3_module_title .external_link .learn_more {
        line-height:' . $content_line_height . ';
    }



    .blog_post_media__link_text a:hover,
    h3#reply-title a,
    .comment_author_says a:hover,
    .dropcap,
    .gt3_custom_text a,
    .gt3_custom_button i {
        color: ' . $theme_color . ';
    }
    .main_wrapper #main_content ul[class*="gt3_list_"] li:before,
    .single .post_tags > span,
    h3#reply-title a:hover,
    .comment_author_says,
    .comment_author_says a {
        color: ' . $header_font_color . ';
    }

    ::-moz-selection{background: ' . $theme_color . '; ' . (!empty($bg_body) ? 'color:' . $bg_body . ';' : '') . '}
    ::selection{background: ' . $theme_color . '; ' . (!empty($bg_body) ? 'color:' . $bg_body . ';' : '') . '}
    ';

    //sticky header logo
    $header_sticky_height = gt3_option('header_sticky_height');
    $custom_css           .= '
    .gt3_practice_list__overlay:before {
        background-color: ' . $theme_color . ';
    }

    @media only screen and (max-width: 767px){
        .gt3-hotspot-shortcode-wrapper .gt3_tooltip{
            background-color: ' . $bg_body . ';
        }
    }
    ';

    $id = gt3_get_queried_object_id();

	$customize_shop_title = gt3_option("customize_shop_title");
	if (class_exists( 'WooCommerce' ) && (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) && $customize_shop_title == '1') {
		$page_title_overlay_color = gt3_option( 'shop_title_overlay_color' );
		$page_title_bg_color = gt3_option("shop_title_bg_color");
	}else{
		$page_title_overlay_color = gt3_option( 'page_title_overlay_color' );
		$page_title_bg_color = gt3_option("page_title_bg_color");
	}
    if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
        $mb_page_title_overlay_color = rwmb_meta('mb_page_title_overlay_color', array(), $id);
        $page_title_overlay_color = !empty($mb_page_title_overlay_color) ? $mb_page_title_overlay_color : $page_title_overlay_color;
    }

    if (!empty($page_title_overlay_color)) {
        $custom_css .= '.gt3-page-title_has_img_bg:before{
            background-image: radial-gradient(at center center, rgba('.gt3_HexToRGB($page_title_overlay_color).', 0.3) 0%, rgba('.gt3_HexToRGB($page_title_overlay_color).', 1) 85%);
        }';
    }

    if (!empty($page_title_bg_color)) {
        $custom_css .= '.body_pp .gt3_header_builder.header_over_bg{
            background-color: '.esc_attr($page_title_bg_color).';
        }';
    }

    // footer styles
    $footer_text_color    = gt3_option_compare('footer_text_color', 'mb_footer_switch', 'yes');
    $footer_heading_color = gt3_option_compare('footer_heading_color', 'mb_footer_switch', 'yes');
    $custom_css           .= '
    .top_footer .widget.widget_posts .recent_posts li > .recent_posts_content .post_title a,
    .top_footer .widget.widget_archive ul li > a,
    .top_footer .widget.widget_categories ul li > a,
    .top_footer .widget.widget_pages ul li > a,
    .top_footer .widget.widget_meta ul li > a,
    .top_footer .widget.widget_recent_comments ul li > a,
    .top_footer .widget.widget_recent_entries ul li > a,
    .main_footer .top_footer .widget h3.widget-title,
    .top_footer h1,.top_footer h2,.top_footer h3,.top_footer h4,.top_footer h5,.top_footer h6,
    .top_footer strong,
    .top_footer .widget-title,
    .top_footer .widget.widget_nav_menu ul li > a:hover{
        color: ' . esc_attr($footer_heading_color) . ' ;
    }
    .top_footer{
        color: ' . esc_attr($footer_text_color) . ';
    }
    ';

    $copyright_text_color = gt3_option_compare('copyright_text_color', 'mb_footer_switch', 'yes');
    $custom_css           .= '.main_footer .copyright{
        color: ' . esc_attr($copyright_text_color) . ';
    }';

    $custom_css .= '
    .gt3_header_builder__section--top .gt3_currency_switcher:hover ul,
    .gt3_header_builder__section--top .gt3_lang_switcher:hover ul{
        background-color:' . esc_attr($side_top_background) . ';
    }
    .gt3_header_builder__section--middle .gt3_currency_switcher:hover ul,
    .gt3_header_builder__section--middle .gt3_lang_switcher:hover ul{
        background-color:' . esc_attr($side_middle_background) . ';
    }
    .gt3_header_builder__section--bottom .gt3_currency_switcher:hover ul,
    .gt3_header_builder__section--bottom .gt3_lang_switcher:hover ul{
        background-color:' . esc_attr($side_bottom_background) . ';
    }
    ';

    $pre_footer_text_color = gt3_option_compare('pre_footer_text_color', 'pre_footer_switch', 'yes');
    if (!empty($pre_footer_text_color)) {
        $custom_css           .= '.main_footer .pre_footer{
            color: ' . esc_attr($pre_footer_text_color) . ';
        }';
    }


    // Sticky Single Product !
    if (!empty($logo_teblet_width["width"]) && $logo_teblet_width["width"] !== '') {
        $custom_css .= '
            @media only screen and (max-width: 1200px){
                .header_side_container .logo_container {
                    max-width: ' . (int)$logo_teblet_width["width"] . 'px;
                }
                .header_side_container .logo_container img{
                    height: auto !important;
                }
            }
        ';
    }elseif(!empty($logo_height['height'])){
        $custom_css .= '
            @media only screen and (max-width: 1200px){
                .header_side_container .logo_container .tablet_logo{
                    height: ' . (int)$logo_height['height'] . 'px;
                }
            }
        ';
    }


    if (!empty($logo_mobile_width["width"]) && $logo_mobile_width["width"] !== '') {
        $custom_css .= '
            @media only screen and (max-width: 767px){
                .header_side_container .logo_container {
                    max-width: ' . (int)$logo_mobile_width["width"] . 'px;
                }
                .header_side_container .logo_container img{
                    height: auto !important;
                }
            }
        ';
    }

    // Woocommerce
    $custom_css .= '
	.quantity-spinner.quantity-up:hover,
    .quantity-spinner.quantity-down:hover,
    .woocommerce .gt3-products-header .gridlist-toggle:hover,
    .elementor-widget-gt3-core-accordion .item_title .ui-accordion-header-icon:before,
    .elementor-element.elementor-widget-gt3-core-accordion .accordion_wrapper .item_title.ui-accordion-header-active.ui-state-active,
    .elementor-widget-gt3-core-accordion .accordion_wrapper .item_title:hover{
        color: ' . $theme_color . ';
    }
    .woocommerce #respond input#submit:hover,
    .woocommerce a.button:hover,
    .woocommerce input.button:hover,
    .woocommerce #respond input#submit.alt:hover,
    .woocommerce a.button.alt:hover,
    .woocommerce input.button.alt:hover,
    .woocommerce #reviews a.button:hover,
    .woocommerce #reviews button.button:hover,
    .woocommerce #reviews input.button:hover,
    .woocommerce #respond input#submit.disabled:hover,
    .woocommerce #respond input#submit:disabled:hover,
    .woocommerce #respond input#submit:disabled[disabled]:hover,
    .woocommerce a.button.disabled:hover,
    .woocommerce a.button:disabled:hover,
    .woocommerce a.button:disabled[disabled]:hover,
    .woocommerce input.button.disabled:hover,
    .woocommerce input.button:disabled:hover,
    .woocommerce input.button:disabled[disabled]:hover{
        border-color: ' . $theme_color . ';
        background-color: ' . $theme_color . ';
    }
    .woocommerce #respond input#submit.alt.disabled:hover,
    .woocommerce #respond input#submit.alt:disabled:hover,
    .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
    .woocommerce a.button.alt.disabled:hover,
    .woocommerce a.button.alt:disabled:hover,
    .woocommerce a.button.alt:disabled[disabled]:hover,
    .woocommerce button.button.alt.disabled:hover,
    .woocommerce button.button.alt:disabled:hover,
    .woocommerce button.button.alt:disabled[disabled]:hover,
    .woocommerce input.button.alt.disabled:hover,
    .woocommerce input.button.alt:disabled:hover,
    .woocommerce input.button.alt:disabled[disabled]:hover,
	.woocommerce div.product form.cart .qty{
		font-family: ' . $header_font_family . ';
	}
	.quantity-spinner.quantity-up:hover,
	.quantity-spinner.quantity-down:hover,
	.woocommerce .gt3-products-header .gridlist-toggle:hover,
    .elementor-widget-gt3-core-accordion .item_title .ui-accordion-header-icon:before,
    .elementor-element.elementor-widget-gt3-core-accordion .accordion_wrapper .item_title.ui-accordion-header-active.ui-state-active{
		color: ' . $theme_color . ';
	}
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce input.button.alt:hover,
	.woocommerce #reviews a.button:hover,
	.woocommerce #reviews button.button:hover,
	.woocommerce #reviews input.button:hover,
	.woocommerce #respond input#submit.disabled:hover,
	.woocommerce #respond input#submit:disabled:hover,
	.woocommerce #respond input#submit:disabled[disabled]:hover,
	.woocommerce a.button.disabled:hover,
	.woocommerce a.button:disabled:hover,
	.woocommerce a.button:disabled[disabled]:hover,
	.woocommerce input.button.disabled:hover,
	.woocommerce input.button:disabled:hover,
	.woocommerce input.button:disabled[disabled]:hover{
		border-color: ' . $theme_color . ';
		background-color: ' . $theme_color . ';
	}
	.woocommerce #respond input#submit.alt.disabled,
	.woocommerce #respond input#submit.alt:disabled,
	.woocommerce #respond input#submit.alt:disabled[disabled],
	.woocommerce a.button.alt.disabled,
	.woocommerce a.button.alt:disabled,
	.woocommerce a.button.alt:disabled[disabled],
	.woocommerce button.button.alt.disabled,
	.woocommerce button.button.alt:disabled,
	.woocommerce button.button.alt:disabled[disabled],
	.woocommerce input.button.alt.disabled,
	.woocommerce input.button.alt:disabled,
	.woocommerce input.button.alt:disabled[disabled]{
		color: ' . $theme_color . ';
	}
	.woocommerce #respond input#submit.alt.disabled:hover,
	.woocommerce #respond input#submit.alt:disabled:hover,
	.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
	.woocommerce a.button.alt.disabled:hover,
	.woocommerce a.button.alt:disabled:hover,
	.woocommerce a.button.alt:disabled[disabled]:hover,
	.woocommerce input.button.alt.disabled:hover,
	.woocommerce input.button.alt:disabled:hover,
	.woocommerce input.button.alt:disabled[disabled]:hover{
        background-color: ' . $theme_color . ';
        border-color: ' . $theme_color . ';
    }
    .woocommerce table.shop_table .product-quantity .qty.allotted,
    .woocommerce div.product form.cart .qty.allotted,
    .image_size_popup .close,
    #yith-quick-view-content .product_meta,
    .single-product.woocommerce div.product .product_meta,
    .woocommerce div.product form.cart .variations td,
    .woocommerce div.product .woocommerce-tabs ul.tabs li,
    .woocommerce .widget_shopping_cart .total,
    .woocommerce.widget_shopping_cart .total,
    .woocommerce table.shop_table thead th,
    .woocommerce table.woocommerce-checkout-review-order-table tfoot td .woocommerce-Price-amount,
    .gt3_custom_tooltip{
        color: ' . $header_font_color . ';
    }
    .gt3_price_item-elementor .label_text span{
        background: ' . $header_font_color . ';
    }
    .gt3_custom_tooltip:before {
        background: ' . $theme_color2 . ';
    }
    .gt3_custom_tooltip:after {
        border-color: ' . $theme_color2 . ' transparent transparent transparent;
    }
    .woocommerce button.button.alt:hover,
    .woocommerce .woocommerce-message a.button:hover,
     .woocommerce .woocommerce-info a.button:hover {
        background-color: transparent;
    }
    #yith-quick-view-content .product_meta a,
    #yith-quick-view-content .product_meta .sku,
    .single-product.woocommerce div.product .product_meta a,
    .single-product.woocommerce div.product .product_meta .sku,
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    .woocommerce ul.products li.product .woocommerce-loop-product__title,
    .search_result_form .search_form label,
    .woocommerce .star-rating::before,
    .woocommerce #reviews p.stars span a,
    .woocommerce p.stars span a:hover~a::before,
    .woocommerce p.stars.selected span a.active~a::before,
    .select2-container--default .select2-results__option--highlighted[aria-selected],
    .select2-container--default .select2-results__option--highlighted[data-selected],
    .cart_list.product_list_widget a.remove,
    .elementor-widget-gt3-core-accordion .accordion_wrapper .item_title,
    .woocommerce .gt3-pagination_nav nav.woocommerce-pagination ul li .gt3_pagination_delimiter,
	.woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item span.count,
    .widget_categories ul li .post_count,
    .woocommerce .widget_price_filter .price_slider_amount .button,
     .woocommerce div.product > .woocommerce-tabs ul.tabs li a{
        color: ' . $content_color . ';
    }   
    .woocommerce #reviews a.button:hover,
    .woocommerce #reviews button.button:hover,
    .woocommerce #reviews input.button:hover,
    .woocommerce div.product > .woocommerce-tabs ul.tabs li.active a,
    .woocommerce div.product > .woocommerce-tabs ul.tabs li.active a:hover,
    .widget .calendar_wrap table td#today,
    .woocommerce ul.products li.product .woocommerce-loop-product__title:hover,
    .woocommerce ul.products li.product .price ins,
    .woocommerce .gt3-products-bottom nav.woocommerce-pagination ul li .page-numbers.current,
    .woocommerce .gt3-products-bottom nav.woocommerce-pagination ul li:hover .page-numbers{
		color: ' . $theme_color . ';
	}

    .woocommerce.single-product #respond #commentform textarea:focus,
     .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover{
        border-bottom-color: ' . $theme_color . ';
    }
    .woocommerce .gridlist-toggle,
    .woocommerce .gt3-products-header .gt3-gridlist-toggle{
        background-color: ' . $bg_body . ';
    }
    ';

    $label_color_sale = gt3_option('label_color_sale');
    $label_color_hot  = gt3_option('label_color_hot');
    $label_color_new  = gt3_option('label_color_new');
    if (is_array($label_color_sale) && isset($label_color_sale['rgba'])) {
        $custom_css .= '
        .woocommerce ul.products li.product .onsale,
        #yith-quick-view-content .onsale,
        .woocommerce span.onsale{
            background-color: '.esc_attr($label_color_sale['rgba']).';
        }';
    }

    if (is_array($label_color_hot) && isset($label_color_hot['rgba'])) {
        $custom_css .= '
        .woocommerce ul.products li.product .onsale.hot-product,
        #yith-quick-view-content .onsale.hot-product,
        .woocommerce span.onsale.hot-product{
            background-color: '.esc_attr($label_color_hot['rgba']).';
        }';
    }

    if (is_array($label_color_new) && isset($label_color_new['rgba'])) {
        $custom_css .= '
        .woocommerce ul.products li.product .onsale.new-product,
        #yith-quick-view-content .onsale.new-product,
        .woocommerce span.onsale.new-product{
            background-color: '.esc_attr($label_color_new['rgba']).';
        }';
    }
    // Woocommerce end

    // Booked Appointments
    $custom_css .= '
    #ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a,#ui-datepicker-div.booked_custom_date_picker table.ui-datepicker-calendar tbody td.ui-datepicker-today a:hover,body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body #booked-profile-page .appt-block .google-cal-button > a,body .booked-modal p.booked-title-bar,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover,.booked-ms-modal .booked-book-appt {
        background:'.$theme_color.';
    }
    body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-list-view button.button, body .booked-list-view input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body #booked-profile-page .appt-block .google-cal-button > a,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active,body .booked-list-view a.booked_list_date_picker_trigger.booked-dp-active:hover {
        border-color:'.$theme_color.';
    }
    body .booked-modal .bm-window p i.fa,body .booked-modal .bm-window a,
    body .booked-appt-list .booked-public-appointment-title,
    body .booked-modal .bm-window p.appointment-title,
    .booked-ms-modal.visible:hover .booked-book-appt,
    body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-title,
    body .booked-form .booked-appointments .appointment-info i,
    body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time i.booked-icon,
    body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time {
        color:'.$theme_color.';
    }
    .booked-appt-list .timeslot.has-title .booked-public-appointment-title {
        color:inherit;
    }
    body table.booked-calendar td.today .date span,
    body table.booked-calendar td:hover .date span{
        border: 1px solid rgba('.gt3_HexToRGB($content_color).', 0.3);
    }
    body .booked-form .field label.field-label,
    body .booked-modal .bm-window p.appointment-info {
        color:'.$header_font_color.';
    }
    body #booked-profile-page input[type="submit"],
    body #booked-profile-page button,
    body .booked-list-view input[type="submit"],
    body .booked-list-view button,
    body table.booked-calendar input[type="submit"],
    body table.booked-calendar button,
    body .booked-modal input[type="submit"],
    body .booked-modal button,
    body .tooltipster-light .tooltipster-content {
        font-family:' . $content_font_family . ';
    }
    body .booked-modal button.cancel {
        border-color:'.$theme_color.' !important;
    }
    body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover,
    body .booked-form .booked-appointments,
    body .booked-modal input[type="submit"].button-primary:hover,
    body .booked-modal button.cancel,
    body .booked-modal button.cancel:hover,
    .woocommerce div.product form.cart div.quantity,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .woocommerce #review_form #respond input[type="date"],
    .woocommerce #review_form #respond input[type="email"],
    .woocommerce #review_form #respond input[type="number"],
    .woocommerce #review_form #respond input[type="password"],
    .woocommerce #review_form #respond input[type="search"],
    .woocommerce #review_form #respond input[type="tel"],
    .woocommerce #review_form #respond input[type="text"],
    .woocommerce #review_form #respond input[type="url"],
    .woocommerce #review_form #respond select,
    .woocommerce #review_form #respond textarea,
    .woocommerce-cart table.cart td.actions .coupon .input-text,
    .woocommerce table.shop_table td,
    .woocommerce-cart .cart_totals table.shop_table tr th,
    .woocommerce-cart .cart_totals table.shop_table tr td,
    #back_to_top,
    .select2-search--dropdown .select2-search__field,
    .woocommerce .return-to-shop a.button.wc-backward,
    .woocommerce .widget_shopping_cart .buttons a,
    .woocommerce.widget_shopping_cart .buttons a,
    .gt3_header_builder_cart_component .buttons .button {
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.1) !important;
    }
    #back_to_top.show:hover {
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.5) !important;
    }

    ';
    // Elementor start
    $custom_css .= '
    .price_item .item_cost_wrapper h3,
    .price_item-cost,
    .elementor-widget-slider-gt3 .slider_type_1 .controls .slick-position span:not(.all_slides),
    .elementor-widget-slider-gt3 .slider_type_3 .controls .slick-position span:not(.all_slides),
    .elementor-widget-slider-gt3 .controls .slick_control_text span:not(.all_slides),
    .elementor-widget-tabs .elementor-tab-desktop-title,
    .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
    .woocommerce.widget_product_categories ul li:hover > a,
    .product-categories > li.cat-parent:hover .gt3-button-cat-open,
    .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover > a,
    .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item:hover span,
    .cart_list.product_list_widget a.remove:hover,
    .woocommerce .return-to-shop a.button.wc-backward,
    .woocommerce ul.products li.product a:hover,
    .woocommerce table.shop_table td.product-remove a:hover:before,
    .woocommerce table.shop_table td.product-name a:hover,
    .isotope-filter a.active,
    .isotope-filter a:hover,
    .woocommerce div.product form.cart button.single_add_to_cart_button.button.alt:hover,
    .woocommerce .woocommerce-message a.button:hover,
    .woocommerce .woocommerce-info a.button:hover,
    .woocommerce-cart table.cart td.actions .coupon .button:hover,
    .wc-proceed-to-checkout a.checkout-button.button.alt.wc-forward:hover,
    body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button:hover,
    body .booked-modal input[type="submit"].button-primary:hover,
    body .booked-modal button.cancel{
        color: ' . $theme_color . ';
    }
    input[type="submit"],
    button,
    .woocommerce button.button.alt,
    .woocommerce-cart table.cart td.actions .coupon .button,
    .woocommerce-cart table.cart td.actions > .button,
    .wc-proceed-to-checkout a.checkout-button.button.alt.wc-forward,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce button.button,
    .woocommerce input.button,
    .woocommerce-Reviews #respond form#commentform input#submit,
    body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
    body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,
    body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block,
    body .booked-modal input[type="submit"].button-primary, 
    body .booked-modal button.cancel,
    body .booked-modal button.cancel:hover{
        font-family: ' . $header_font_family . ';
        font-weight: ' . $header_font_weight . ';
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.1);
        color: ' . $content_color . '
    }

    .gt3_single_team_info__item span {
        color: rgba('.gt3_HexToRGB($theme_color).', 0.7);
    }
    .gt3_single_team_info__item a:hover span,
    #back_to_top {
        color: ' . $theme_color . ';
    }

    .woocommerce ul.products li.product .gt3_woocommerce_open_control_tag .button,
    .search_form .search_text,
    .wrapper_404 .gt3_module_button_list a,
    .woocommerce-page div.product .woocommerce-tabs ul.tabs li,
    .woocommerce div.product > .woocommerce-tabs .panel,
    .woocommerce .woocommerce-error,
    .woocommerce .woocommerce-info,
    .woocommerce .woocommerce-message,
    .gt3_product_list_nav,
    body .booked-modal input[type="submit"].button-primary:hover,
    body .booked-modal button.cancel:hover,
    .view_more_link,
    .widget.widget_posts .recent_posts li,
    .gt3_post_footer,
    .tagcloud a,
    .post_block_info,
    pre,
    hr,
    .gt3_related_posts_wrap .related_item_wrapper:hover,
    .woocommerce-checkout .select2-container .select2-selection--single,
    .select2-container--default span.select2-selection--single,
    .gt3_qty_spinner,
    .woocommerce ul.product_list_widget li,
    .woocommerce.widget_shopping_cart ul.product_list_widget li,
    .woocommerce table.shop_table tbody th,
    .woocommerce table.shop_table tfoot td,
    .woocommerce table.shop_table tfoot th,
    .woocommerce-MyAccount-navigation ul li + li,
    fieldset,
    table tbody tr,
    table thead tr,
    table tfoot tr,
    table tbody th,
    table tfoot th,
    .wp-block-pullquote,
    .wp-block-table.is-style-stripes,
    .wp-block-button.is-style-outline {
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.1);
    }
    input[type="date"],
    input[type="email"],
    input[type="number"],
    input[type="password"],
    input[type="search"],
    input[type="tel"],
    input[type="text"],
    input[type="url"],
    select,
    textarea,
    input[type="submit"]:hover,
    button:hover,
    .select2-search--dropdown .select2-search__field {
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.1);
        color: ' . $content_color . ';
    }
    .mc_form_inside .mc_signup_submit:before {
        color: rgba('.gt3_HexToRGB($theme_color).', 0.3);
    }
    .mc_form_inside .mc_signup_submit:hover:before,
    .widget_search .search_form.button-hover:before,
    .search_result_form .search_form.button-hover:before {
        color: rgba('.gt3_HexToRGB($theme_color).', 0.5);
    }
    .price_item .label_text span,
    a.bordered:hover,
    .woocommerce ul.products li.product .gt3_woocommerce_open_control_tag_bottom div a,
    .woocommerce-cart .shipping-calculator-form .button:hover,
    .woocommerce #payment .woocommerce-page #place_order,
    .woocommerce #payment .woocommerce-page #place_order:hover,
    .prev_next_links_fullwidht .link_item,
    span.ui-slider-handle.ui-state-default.ui-corner-all.ui-state-hover,
    body table.compare-list .add-to-cart td a:hover,
    .woo_mini-count > span:not(:empty),
    #review_form form#commentform input#submit:hover,
    .infinite-scroll-request > div{
		background-color: ' . $theme_color . ';
	}
    ul.pagerblock li a,
    ul.pagerblock li span,
    .gt3_comments_pagination .page-numbers,
    .page-link .page-number,
    .woocommerce form#commentform input#submit,
    .woocommerce .woocommerce-message a.button,
    .woocommerce .woocommerce-info a.button {
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.1);
        color: ' . $content_color . ';
    }
    .woocommerce nav.woocommerce-pagination ul li a,
    body table.booked-calendar thead th,
    body table.booked-calendar thead th .monthName,
    body .booked-calendar-wrap .booked-appt-list .timeslot .spots-available,
    body .booked-modal button.cancel:hover,
    .gt3_author_box__name,
    .single-post .gt3_module_title h2,
    .wp-block-button.is-style-outline {
        color: ' . $content_color . ';
    }
    body .booked-modal button.cancel:hover,
    ul.select2-results__options li:before,
    ul.select2-results__options li.select2-results__message,
    .woocommerce .return-to-shop a.button.wc-backward:hover {
        color: ' . $content_color . ' !important;
    }
    ul.pagerblock li a:hover,
    ul.pagerblock li a.current,
    ul.pagerblock li a.current:hover,
    .page-link > span.page-number,
    .gt3_comments_pagination .page-numbers.current,
    .tagcloud a,
    .woocommerce .widget_price_filter .price_slider_amount .button:hover,
    .view_more_link,
    .tp-tabs-inner-wrapper .tp-tab-title:after {
        color: ' . $theme_color . ';
    }
    ul.pagerblock li a.current,
    ul.pagerblock li a.current:hover,
    .wp-block-table.is-style-stripes tr:nth-child(2n+1) {
        background-color: rgba('.gt3_HexToRGB($theme_color).', 0.1);
    }
    .proof_gallery .proof-photo__meta .separator {
        background-color: rgba('.gt3_HexToRGB($theme_color).', 0.1) !important;
    }
	.page-link > span.page-number,
	.elementor-widget-gt3-core-tabs .ui-tabs-nav .ui-state-default.ui-tabs-active a,
    #review_form form#commentform input#submit,
    .woocommerce nav.woocommerce-pagination ul li span.current,
    .woocommerce #respond input#submit,
    .woocommerce a.button,
    .woocommerce input.button,
    .woocommerce #respond input#submit.alt,
    .woocommerce a.button.alt,
    .woocommerce input.button.alt,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range {
        background-color: ' . $content_color . ';
    }

	a.bordered:hover,	
	.elementor-widget-tabs.elementor-tabs-view-horizontal .elementor-tab-desktop-title.elementor-active:after,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle:before,
    .woocommerce ul.products li.product .gt3_woocommerce_open_control_tag .button:hover{
		border-color: ' . $theme_color . ';
	}
	.price_item-cost,
	.countdown-section{
		font-family: ' . $header_font_family . ';
	}
    
    .price_item-cost span,
    .elementor-widget-slider-gt3 .controls .slick_control_text span.all_slides,
    .woocommerce ul.cart_list li a,
    .isotope-filter a,
    .view_more_link:hover,
    .quote_author,
    blockquote cite,
    blockquote code {
        color: ' . $content_color . ';
    }
    .fs_gallery_wrapper .status .first,
    .fs_gallery_wrapper .status .divider,
    .countdown-section,
    .page_nav_ancor a,
    .gt3_widget span.woocommerce-Price-amount.amount,
    .woocommerce .widget_price_filter .price_label,
    .woocommerce table.shop_table td.product-remove a,
    .woocommerce table.shop_table td.product-name a,
    .sidebar-container .widget.widget_posts .recent_posts .listing_meta span,
    .gt3_header_builder_cart_component:hover .gt3_header_builder_cart_component__cart{
		color: ' . $header_font_color . ';
	}

    /* PixProof */
    .mfp-container button.mfp-arrow-right:hover {
        border-left-color: ' . $theme_color . ';
    }
    .mfp-container button.mfp-arrow-left:hover {
        border-right-color: ' . $theme_color . ';
    }
    /* End PixProof */

    /* Map */
    .map_info_marker {
        background: ' . esc_attr(gt3_option('map_marker_info_background')) .';
    }
    .map_info_marker:after {
        border-color: ' . esc_attr(gt3_option('map_marker_info_background')) . ' transparent transparent transparent;
    }
    .marker_info_street_number,
    .marker_info_street,
    .footer_back2top .gt3_svg_line_icon,
    input[type="submit"]:hover,
    button:hover{
        color: ' . $theme_color . ';
    }
    .marker_info_desc {
        color: ' . esc_attr(gt3_option('map_marker_info_color')) . ';
    }
    .map_info_marker_content {
        font-family:' . $map_marker_font_family . ';
        font-weight:' . $map_marker_font_weight . ';
    }
    .marker_info_divider:after {
        background: ' . esc_attr(gt3_option('map_marker_info_color')) . ';
    }
    ';
    // Elementor end


    /* Elementor Buttons */
    $custom_css .= '
    .elementor-widget-gt3-core-button a {
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.1);
        color: ' . $content_color . ';
    }
    .elementor-widget-gt3-core-button a:hover {
        border-color: rgba('.gt3_HexToRGB($theme_color).', 0.1);
        color: ' . $theme_color . ';
    }
    ';
    /* Elementor Buttons end */


    function gt3_get_upper_responsive_value($options,$inherit_options){
        $options = $options === '' ? $inherit_options : $options;
        return $options;
    }

    // GT3 Header Builder styles
    foreach ($sections as $section) {

        if (strpos($section,'tablet')) {
            $responsive_res = explode('__',$section);
            if (is_array($responsive_res) && !empty($responsive_res[0])) {

                if (${'side_' . $section . '_custom'} == '1') {
                    ${'side_' . $section . '_background'} = gt3_get_upper_responsive_value(${'side_' . $section . '_background'},${'side_' . $responsive_res[0] . '_background'});
                    ${'side_' . $section . '_background2'} = gt3_get_upper_responsive_value(${'side_' . $section . '_background2'},${'side_' . $responsive_res[0] . '_background2'});
                    ${'side_' . $section . '_color'} = gt3_get_upper_responsive_value(${'side_' . $section . '_color'},${'side_' . $responsive_res[0] . '_color'});
                    ${'side_' . $section . '_color_hover'} = gt3_get_upper_responsive_value(${'side_' . $section . '_color_hover'},${'side_' . $responsive_res[0] . '_color_hover'});
                    ${'side_' . $section . '_height'} = gt3_get_upper_responsive_value(${'side_' . $section . '_height'},${'side_' . $responsive_res[0] . '_height'});
                    ${'side_' . $section . '_spacing'}['padding-left'] = gt3_get_upper_responsive_value(${'side_' . $section . '_spacing'}['padding-left'],${'side_' . $responsive_res[0] . '_spacing'}['padding-left']);
                    ${'side_' . $section . '_spacing'}['padding-right'] = gt3_get_upper_responsive_value(${'side_' . $section . '_spacing'}['padding-right'],${'side_' . $responsive_res[0] . '_spacing'}['padding-right']);
                    ${'side_' . $section . '_border_radius'} = gt3_get_upper_responsive_value(${'side_' . $section . '_border_radius'},${'side_' . $responsive_res[0] . '_border_radius'});
                    ${'side_' . $section . '_border'} = gt3_get_upper_responsive_value(${'side_' . $section . '_border'},${'side_' . $responsive_res[0] . '_border'});
                    ${'side_' . $section . '_border_color'}['rgba'] = gt3_get_upper_responsive_value(${'side_' . $section . '_border_color'}['rgba'],${'side_' . $responsive_res[0] . '_border_color'}['rgba']);
                }else{
                    ${'side_' . $section . '_background'} = ${'side_' . $responsive_res[0] . '_background'};
                    ${'side_' . $section . '_background2'} = ${'side_' . $responsive_res[0] . '_background2'};
                    ${'side_' . $section . '_color'} = ${'side_' . $responsive_res[0] . '_color'};
                    ${'side_' . $section . '_color_hover'} = ${'side_' . $responsive_res[0] . '_color_hover'};
                    ${'side_' . $section . '_height'} = ${'side_' . $responsive_res[0] . '_height'};
                    ${'side_' . $section . '_spacing'}['padding-left'] = ${'side_' . $responsive_res[0] . '_spacing'}['padding-left'];
                    ${'side_' . $section . '_spacing'}['padding-right'] = ${'side_' . $responsive_res[0] . '_spacing'}['padding-right'];
                    ${'side_' . $section . '_border_radius'} = ${'side_' . $responsive_res[0] . '_border_radius'};
                    ${'side_' . $section . '_border'} = ${'side_' . $responsive_res[0] . '_border'};
                    ${'side_' . $section . '_border_color'}['rgba'] = ${'side_' . $responsive_res[0] . '_border_color'}['rgba'];
                }

            }
        }

        if (strpos($section,'mobile')) {
            $responsive_res = explode('__',$section);
            if (is_array($responsive_res) && !empty($responsive_res[0])) {

                if (${'side_' . $section . '_custom'} == '1') {
                    ${'side_' . $section . '_background'} = gt3_get_upper_responsive_value(${'side_' . $section . '_background'},${'side_' . $responsive_res[0] . '__tablet_background'});
                    ${'side_' . $section . '_background2'} = gt3_get_upper_responsive_value(${'side_' . $section . '_background2'},${'side_' . $responsive_res[0] . '__tablet_background2'});
                    ${'side_' . $section . '_color'} = gt3_get_upper_responsive_value(${'side_' . $section . '_color'},${'side_' . $responsive_res[0] . '__tablet_color'});
                    ${'side_' . $section . '_color_hover'} = gt3_get_upper_responsive_value(${'side_' . $section . '_color_hover'},${'side_' . $responsive_res[0] . '__tablet_color_hover'});
                    ${'side_' . $section . '_height'} = gt3_get_upper_responsive_value(${'side_' . $section . '_height'},${'side_' . $responsive_res[0] . '__tablet_height'});
                    ${'side_' . $section . '_spacing'}['padding-left'] = gt3_get_upper_responsive_value(${'side_' . $section . '_spacing'}['padding-left'],${'side_' . $responsive_res[0] . '__tablet_spacing'}['padding-left']);
                    ${'side_' . $section . '_spacing'}['padding-right'] = gt3_get_upper_responsive_value(${'side_' . $section . '_spacing'}['padding-right'],${'side_' . $responsive_res[0] . '__tablet_spacing'}['padding-right']);
                    ${'side_' . $section . '_border_radius'} = gt3_get_upper_responsive_value(${'side_' . $section . '_border_radius'},${'side_' . $responsive_res[0] . '__tablet_border_radius'});
                    ${'side_' . $section . '_border'} = gt3_get_upper_responsive_value(${'side_' . $section . '_border'},${'side_' . $responsive_res[0] . '__tablet_border'});
                    ${'side_' . $section . '_border_color'}['rgba'] = gt3_get_upper_responsive_value(${'side_' . $section . '_border_color'}['rgba'],${'side_' . $responsive_res[0] . '__tablet_border_color'}['rgba']);
                }else{
                    ${'side_' . $section . '_background'} = ${'side_' . $responsive_res[0] . '__tablet_background'};
                    ${'side_' . $section . '_background2'} = ${'side_' . $responsive_res[0] . '__tablet_background2'};
                    ${'side_' . $section . '_color'} = ${'side_' . $responsive_res[0] . '__tablet_color'};
                    ${'side_' . $section . '_color_hover'} = ${'side_' . $responsive_res[0] . '__tablet_color_hover'};
                    ${'side_' . $section . '_height'} = ${'side_' . $responsive_res[0] . '__tablet_height'};
                    ${'side_' . $section . '_spacing'}['padding-left'] = ${'side_' . $responsive_res[0] . '__tablet_spacing'}['padding-left'];
                    ${'side_' . $section . '_spacing'}['padding-right'] = ${'side_' . $responsive_res[0] . '__tablet_spacing'}['padding-right'];
                    ${'side_' . $section . '_border_radius'} = ${'side_' . $responsive_res[0] . '__tablet_border_radius'};
                    ${'side_' . $section . '_border'} = ${'side_' . $responsive_res[0] . '__tablet_border'};
                    ${'side_' . $section . '_border_color'}['rgba'] = ${'side_' . $responsive_res[0] . '__tablet_border_color'}['rgba'];
                }

            }
        }



        $custom_css .= '
        .gt3_header_builder__section--'.$section.'{
            background-color:' . esc_attr(${'side_' . $section . '_background'}) . ';
            color:' . esc_attr(${'side_' . $section . '_color'}) . ';
        }
        .gt3_header_builder__section--'.$section.' .gt3_header_builder__section-container{
            height:' . (int)${'side_' . $section . '_height'} . 'px;
            '.(!empty(${'side_' . $section . '_background2'}) ? 'background-color:' . esc_attr(${'side_' . $section . '_background2'}) . ';' : '').'
        }
        .gt3_header_builder__section--'.$section.' ul.menu{
            line-height:' . (int)${'side_' . $section . '_height'} . 'px;
        }
        .gt3_header_builder__section--'.$section.' a:hover,
        .gt3_header_builder__section--'.$section.' .menu-item.active_item > a,
        .gt3_header_builder__section--'.$section.' .current-menu-item a,
        .gt3_header_builder__section--'.$section.' .current-menu-ancestor > a,
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_login_component:hover .wpd_login__user_name,
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:hover, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:focus, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:hover, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:focus, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover > a{
            color:' . esc_attr(${'side_' . $section . '_color_hover'}) . ';
        }
        ';

        if (!empty(${'side_' . $section . '_spacing'}) && is_array(${'side_' . $section . '_spacing'})) {
            if (!empty(${'side_' . $section . '_spacing'}['padding-left'])) {
                $custom_css .= '.gt3_header_builder__section--'.$section.' .gt3_header_builder__section-container{
                    padding-left:' . (int)${'side_' . $section . '_spacing'}['padding-left'] . 'px;
                }';
            }
            if (!empty(${'side_' . $section . '_spacing'}['padding-right'])) {
                $custom_css .= '.gt3_header_builder__section--'.$section.' .gt3_header_builder__section-container{
                    padding-right:' . (int)${'side_' . $section . '_spacing'}['padding-right'] . 'px;
                }';
            }
        }

        if (${'side_' . $section . '_border_radius'}) {
            $custom_css .= '.gt3_header_builder__section--'.$section.' .gt3_header_builder__section-container{
                    border-radius: 8px;
                }';
        }

        if (${'side_' . $section . '_border'}) {
            if (!empty(${'side_' . $section . '_border_color'}['rgba'])) {
                $custom_css .= '
                .gt3_header_builder__section--' . $section . '{
                    border-bottom: 1px solid ' . esc_attr(${'side_' . $section . '_border_color'}['rgba']) . ';
                }';
            }
        }
    }

    if ((bool)$header_sticky) {
        foreach ($desktop_sides as $sticky_side) {
            if ((bool)${'side_' . $sticky_side . '_sticky'}) {
                if (is_array(${'side_' . $sticky_side . '_background_sticky'}) && !empty(${'side_' . $sticky_side . '_background_sticky'}['rgba'])) {
                    ${'side_' . $sticky_side . '_background_sticky'} = ${'side_' . $sticky_side . '_background_sticky'}['rgba'];
                }
                if (is_array(${'side_' . $sticky_side . '_height_sticky'}) && ${'side_' . $sticky_side . '_height_sticky'}['height']) {
                    ${'side_' . $sticky_side . '_height_sticky'} = ${'side_' . $sticky_side . '_height_sticky'}['height'];
                }

                if (!empty(${'side_' . $sticky_side . '_spacing_sticky'}) && is_array(${'side_' . $sticky_side . '_spacing_sticky'})) {
                    if (!empty(${'side_' . $sticky_side . '_spacing_sticky'}['padding-left'])) {
                        $custom_css .= '.sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder__section-container{
                            padding-left:' . (int)${'side_' . $sticky_side . '_spacing_sticky'}['padding-left'] . 'px;
                        }';
                    }
                    if (!empty(${'side_' . $sticky_side . '_spacing_sticky'}['padding-right'])) {
                        $custom_css .= '.sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder__section-container{
                            padding-right:' . (int)${'side_' . $sticky_side . '_spacing_sticky'}['padding-right'] . 'px;
                        }';
                    }
                }
                $custom_css .= '
                .sticky_header .gt3_header_builder__section--' . $sticky_side . ',
                .sticky_header .gt3_header_builder__section--' . $sticky_side . '__tablet,
                .sticky_header .gt3_header_builder__section--' . $sticky_side . '__mobile{
                    background-color:' . esc_attr(${'side_' . $sticky_side . '_background_sticky'}) . ';
                    color:' . esc_attr(${'side_' . $sticky_side . '_color_sticky'}) . ';
                }
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' a:hover,
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' ul.menu > .menu-item.active_item > a,
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' ul.menu > .current-menu-item > a,
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' ul.menu > .current-menu-ancestor > a,
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_login_component:hover .wpd_login__user_name,
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:hover, 
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:focus, 
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a, 
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:hover, 
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:focus, 
                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover > a{
                    color:' . esc_attr(${'side_' . $sticky_side . '_color_hover_sticky'}) . ';
                }
                .sticky_header .gt3_header_builder__section--' . $sticky_side . ' .gt3_header_builder__section-container{
                    height:' . (int)${'side_' . $sticky_side . '_height_sticky'} . 'px;
                }
                .sticky_header .gt3_header_builder__section--' . $sticky_side . ' ul.menu{
                    line-height:' . (int)${'side_' . $sticky_side . '_height_sticky'} . 'px;
                }';
            }
        }
        $height_sticky = 30;
        if ((bool)$side_top_sticky) {
            $height_sticky = $height_sticky + (int)$side_top_height_sticky;
        }

        if ((bool)$side_middle_sticky) {
            $height_sticky = $height_sticky + (int)$side_middle_height_sticky;
        }

        if ((bool)$side_bottom_sticky) {
            $height_sticky = $height_sticky + (int)$side_bottom_height_sticky;
        }
        if (is_admin_bar_showing()) {
            $height_sticky = $height_sticky + 32;
        }
        $custom_css .= '
        div.gt3-single-product-sticky .gt3_thumb_grid,
        div.gt3-single-product-sticky .woocommerce-product-gallery:nth-child(1),
        div.gt3-single-product-sticky .gt3-single-content-wrapper{
            margin-top: '.(int)$height_sticky.'px;
        }
        div.gt3-single-product-sticky{
            margin-top: -'.(int)$height_sticky.'px;
        }';
    }
    // GT3 Header Builder end


    $custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '   ', '    '), '', $custom_css);
    if (wp_style_is('gt3-responsive')) {
        wp_add_inline_style('gt3-responsive', $custom_css);
    } else {
        wp_add_inline_style('gt3-theme', $custom_css);
    }
}

add_action('wp_enqueue_scripts', 'gt3_custom_styles', 30);
