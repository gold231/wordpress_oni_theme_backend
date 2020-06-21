<?php


if (!class_exists( 'RWMB_Loader' )) {
	return;
}



add_filter( 'rwmb_meta_boxes', 'gt3_pteam_meta_boxes' );
function gt3_pteam_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      	=> esc_html__( 'Team Options', 'oni' ),
        'post_types' 	=> array( 'team' ),
        'context' 		=> 'advanced',
        'fields'     	=> array(
        	array(
	            'name' 			=> esc_html__( 'Member Job', 'oni' ),
	            'id'   			=> 'position_member',
	            'type' 			=> 'text',
	            'class' => 'field-inputs'
	        ),

	        array(
	            'name' 			=> esc_html__( 'Short Description', 'oni' ),
	            'id'   			=> 'member_short_desc',
	            'type' 			=> 'textarea'
	        ),
			array(
				'name' 			=> esc_html__( 'Fields', 'oni' ),
	            'id'   			=> 'social_url',
	            'type' 			=> 'social',
	            'clone' => true,
	            'sort_clone'     => true,
	            'desc' 			=> esc_html__( 'Description', 'oni' ),
	            'options' => array(
					'name'    => array(
						'name' 			=> esc_html__( 'Title', 'oni' ),
						'type_input' => "text"
						),
					'description' => array(
						'name' 			=> esc_html__( 'Text', 'oni' ),
						'type_input' => "text"
						),
					'address' => array(
						'name' 			=> esc_html__( 'Url', 'oni' ),
						'type_input' => "text"
						),
				),
	        ),
	        array(
				'name' 			=> esc_html__( 'Icons', 'oni' ),
				'id'          	=> "icon_selection",
				'type'        	=> 'select_icon',
				'text_option' => true,
				'options'     	=> function_exists('gt3_get_all_icon') ? gt3_get_all_icon() : '',
				'clone' => true,
				'sort_clone'     => true,
				'placeholder' => esc_html__( 'Select an icon', 'oni' ),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),
	        array(
		        'name'             => esc_html__( 'Signature', 'oni' ),
		        'id'               => "mb_signature",
		        'type'             => 'image_advanced',
		        'max_file_uploads' => 1,
	        ),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_blog_meta_boxes' );
function gt3_blog_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      	=> esc_html__( 'Post Format Layout', 'oni' ),
		'post_types' 	=> array( 'post' ),
		'context' 		=> 'advanced',
		'fields'     	=> array(
			// Standard Post Format
			array(
				'name' 			=> esc_html__( 'You can use only featured image for this post-format', 'oni' ),
				'id' 			=> "post_format_standard",
				'type' 			=> 'static-text',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','0'),
							array('post-format-selector-0','=','standard')
						),
					),
				),
			),
			// Gallery Post Format
			array(
				'name' 			=> esc_html__( 'Gallery images', 'oni' ),
				'id' 			=> "post_format_gallery_images",
				'type' 			=> 'image_advanced',
				'max_file_uploads' => '',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','gallery'),
							array('post-format-selector-0','=','gallery')
						),
					),
				),
			),
			// Video Post Format
			array(
				'name' 			=> esc_html__( 'oEmbed', 'oni' ),
				'id'   			=> "post_format_video_oEmbed",
				'desc' 			=> esc_html__( 'enter URL', 'oni' ),
				'type' 			=> 'oembed',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','video'),
							array('post-format-selector-0','=','video')
						),
						array(
							array('post_format_video_select','=','oEmbed')
						)
					),
				),
			),
			// Audio Post Format
			array(
				'name' 			=> esc_html__( 'oEmbed', 'oni' ),
				'id'   			=> "post_format_audio_oEmbed",
				'desc' 			=> esc_html__( 'enter URL', 'oni' ),
				'type' 			=> 'oembed',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','audio'),
							array('post-format-selector-0','=','audio')
						),
						array(
							array('post_format_audio_select','=','oEmbed')
						)
					),
				),
			),
			// Quote Post Format
			array(
				'name' 			=> esc_html__( 'Quote Author', 'oni' ),
				'id' 			=> "post_format_qoute_author",
				'type' 			=> 'text',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			array(
				'name' 			=> esc_html__( 'Author Image', 'oni' ),
				'id' 			=> "post_format_qoute_author_image",
				'type' 			=> 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			array(
				'name' 			=> esc_html__( 'Quote Content', 'oni' ),
				'id' 			=> "post_format_qoute_text",
				'type' 			=> 'textarea',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			// Link Post Format
			array(
				'name' 			=> esc_html__( 'Link URL', 'oni' ),
				'id' 			=> "post_format_link",
				'type' 			=> 'url',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link'),
							array('post-format-selector-0','=','link')
						),
					),
				),
			),
			array(
				'name' 			=> esc_html__( 'Link Text', 'oni' ),
				'id' 			=> "post_format_link_text",
				'type' 			=> 'text',
				'attributes' 	=>  array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link'),
							array('post-format-selector-0','=','link')
						),
					),
				),
			),


		)
	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_page_layout_meta_boxes' );
function gt3_page_layout_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      	=> esc_html__( 'Page Layout', 'oni' ),
        'post_types' 	=> array( 'page' , 'post', 'team', 'product', 'proof_gallery', 'portfolio' ),
        'context' 		=> 'advanced',
        'fields'     	=> array(
        	array(
				'name' 			=> esc_html__( 'Page Sidebar Layout', 'oni' ),
				'id'          	=> "mb_page_sidebar_layout",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' => esc_html__( 'default', 'oni' ),
					'none' 	  => esc_html__( 'None', 'oni' ),
					'left'    => esc_html__( 'Left', 'oni' ),
					'right'   => esc_html__( 'Right', 'oni' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),
			array(
				'name' 			=> esc_html__( 'Page Sidebar', 'oni' ),
				'id'          	=> "mb_page_sidebar_def",
				'type'        	=> 'select',
				'options'     	=> gt3_get_all_sidebar(),
				'multiple'    	=> false,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_page_sidebar_layout','!=','default'),
						array('mb_page_sidebar_layout','!=','none'),
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'gt3_header_meta_boxes');
function gt3_header_meta_boxes($meta_boxes) {
    $preset_opt = gt3_option('gt3_header_builder_presets');
    $presets_array = array();
    if (isset($preset_opt['current_active'])) {
        unset($preset_opt['current_active']);
    }
    if (isset($preset_opt['def_preset'])) {
        unset($preset_opt['def_preset']);
    }
    if (isset($preset_opt['items_count'])) {
        unset($preset_opt['items_count']);
    }
    $presets_array['default'] = esc_html__( 'Default from Theme Options', 'oni' );
    if (empty($preset_opt) || !is_array($preset_opt)) {
        return $meta_boxes;
    }
    foreach ($preset_opt as $key => $value) {
        if (!empty($value['title'])) {
            $presets_array[$key] = $value['title'];
        }else{
            $presets_array[$key] = esc_html__( 'No Name', 'oni' );
        }
    }

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Header Builder', 'oni' ),
        'post_types' 	=> array( 'page', 'post', 'team', 'product', 'proof_gallery', 'portfolio' ),
        'context' => 'advanced',
        'fields'     => array(
            array(
                'name'     => esc_html__( 'Choose presets', 'oni' ),
                'id'          => "mb_header_presets",
                'type'        => 'select',
                'options'     => $presets_array,
                'multiple'    => false,
                'std'         => 'default', 
            ),
        )
    );
    return $meta_boxes;
}


add_filter( 'rwmb_meta_boxes', 'gt3_page_title_meta_boxes' );
function gt3_page_title_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      	=> esc_html__( 'Page Title Options', 'oni' ),
        'post_types' 	=> array( 'page', 'post', 'team', 'product', 'proof_gallery', 'portfolio' ),
        'context' 		=> 'advanced',
        'fields'     	=> array(
			array(
				'name'     		=> esc_html__( 'Show Page Title', 'oni' ),
				'id'          	=> "mb_page_title_conditional",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' 		=> esc_html__( 'default', 'oni' ),
					'yes' 			=> esc_html__( 'yes', 'oni' ),
					'no' 			=> esc_html__( 'no', 'oni' ),
				),
				'multiple'    	=> false,
				'std'         	=> 'default',
			),
			array(
				'id'   			=> 'mb_page_title_use_feature_image',
				'name' 			=> esc_html__( 'Use featured image for the page title background', 'oni' ),
				'type' 			=> 'checkbox',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','!=','no'),
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Title Overlay Color', 'oni' ),
				'id'   			=> "mb_page_title_overlay_color",
				'type' 			=> 'color',
				'std'         	=> '',
				'js_options' 	=> array(
					'defaultColor' 	=> '',
				),
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','!=','no'),
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Sub Title Text', 'oni' ),
				'id'   			=> "mb_page_sub_title",
				'type' 			=> 'textarea',
				'cols' 			=> 20,
				'rows' 			=> 3,
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','!=','no'),
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Sub Title Text Color', 'oni' ),
				'id'   			=> "mb_page_sub_title_color",
				'type' 			=> 'color',
				'std'         	=> '',
				'js_options' 	=> array(
					'defaultColor' 	=> '',
				),
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','!=','no'),
					)),
				),
			),

			array(
				'id'   			=> 'mb_show_breadcrumbs',
				'name' 			=> esc_html__( 'Show Breadcrumbs', 'oni' ),
				'type' 			=> 'checkbox',
				'std'  			=> 1,
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Vertical Alignment', 'oni' ),
				'id'       		=> 'mb_page_title_vertical_align',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'top' 			=> esc_html__( 'top', 'oni' ),
					'middle' 		=> esc_html__( 'middle', 'oni' ),
					'bottom' 		=> esc_html__( 'bottom', 'oni' ),
				),
				'multiple' 		=> false,
				'std'         	=> 'middle',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Horizontal Alignment', 'oni' ),
				'id'       		=> 'mb_page_title_horizontal_align',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'left' 			=> esc_html__( 'left', 'oni' ),
					'center' 		=> esc_html__( 'center', 'oni' ),
					'right' 		=> esc_html__( 'right', 'oni' ),
				),
				'multiple' 		=> false,
				'std'         	=> 'center',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Font Color', 'oni' ),
				'id'   			=> "mb_page_title_font_color",
				'type' 			=> 'color',
				'std'         	=> '#ffffff',
				'js_options' 	=> array(
					'defaultColor' 	=> '#ffffff',
				),
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Background Color', 'oni' ),
				'id'   			=> "mb_page_title_bg_color",
				'type' 			=> 'color',
				'std'  			=> '#0a0b0b',
				'js_options' 	=> array(
					'defaultColor' 	=> '#0a0b0b',
				),
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Title Background Image', 'oni' ),
				'id' 			=> "mb_page_title_bg_image",
				'type' 			=> 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type' 	=> 'image',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Background Repeat', 'oni' ),
				'id'       		=> 'mb_page_title_bg_repeat',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'no-repeat' 	=> esc_html__( 'no-repeat', 'oni' ),
					'repeat' 		=> esc_html__( 'repeat', 'oni' ),
					'repeat-x' 		=> esc_html__( 'repeat-x', 'oni' ),
					'repeat-y' 		=> esc_html__( 'repeat-y', 'oni' ),
					'inherit' 		=> esc_html__( 'inherit', 'oni' ),
				),
				'multiple' 		=> false,
				'std'         	=> 'no-repeat',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Background Size', 'oni' ),
				'id'       		=> 'mb_page_title_bg_size',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'inherit' 		=> esc_html__( 'inherit', 'oni' ),
					'cover' 		=> esc_html__( 'cover', 'oni' ),
					'contain' 		=> esc_html__( 'contain', 'oni' )
				),
				'multiple' 		=> false,
				'std'         	=> 'cover',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Background Attachment', 'oni' ),
				'id'       		=> 'mb_page_title_bg_attachment',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'fixed' 		=> esc_html__( 'fixed', 'oni' ),
					'scroll' 		=> esc_html__( 'scroll', 'oni' ),
					'inherit' 		=> esc_html__( 'inherit', 'oni' )
				),
				'multiple' 		=> false,
				'std'         	=> 'scroll',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Background Position', 'oni' ),
				'id'       		=> 'mb_page_title_bg_position',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'left top' 		=> esc_html__( 'left top', 'oni' ),
					'left center' 	=> esc_html__( 'left center', 'oni' ),
					'left bottom' 	=> esc_html__( 'left bottom', 'oni' ),
					'center top' 	=> esc_html__( 'center top', 'oni' ),
					'center center' => esc_html__( 'center center', 'oni' ),
					'center bottom' => esc_html__( 'center bottom', 'oni' ),
					'right top' 	=> esc_html__( 'right top', 'oni' ),
					'right center' 	=> esc_html__( 'right center', 'oni' ),
					'right bottom' 	=> esc_html__( 'right bottom', 'oni' ),
				),
				'multiple' 		=> false,
				'std'         	=> 'center center',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Height', 'oni' ),
				'id'   			=> "mb_page_title_height",
				'type' 			=> 'number',
				'std'  			=> 215,
				'min'  			=> 0,
				'step' 			=> 1,
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'id'   			=> 'mb_page_title_top_border',
				'name' 			=> esc_html__( 'Set Page Title Top Border?', 'oni' ),
				'type' 			=> 'checkbox',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
				    	array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Title Top Border Color', 'oni' ),
				'id'   			=> "mb_page_title_top_border_color",
				'type' 			=> 'color',
				'std'  			=> '',
				'js_options' 	=> array(
					'defaultColor' => '',
				),
				'attributes' 	=> array(
				    'data-dependency' => array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_top_border','=',true)
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Title Top Border Opacity', 'oni' ),
				'id'   			=> "mb_page_title_top_border_color_opacity",
				'type' 			=> 'number',
				'std'  			=> 1,
				'min'  			=> 0,
				'max'  			=> 1,
				'step' 			=> 0.01,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_top_border','=',true)
					)),
				),
			),

			array(
				'id'   			=> 'mb_page_title_bottom_border',
				'name' 			=> esc_html__( 'Set Page Title Bottom Border?', 'oni' ),
				'type' 			=> 'checkbox',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Title Bottom Border Color', 'oni' ),
				'id'   			=> "mb_page_title_bottom_border_color",
				'type' 			=> 'color',
				'std'  			=> '',
				'js_options' 	=> array(
					'defaultColor' => '',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Page Title Bottom Border Opacity', 'oni' ),
				'id'   			=> "mb_page_title_bottom_border_color_opacity",
				'type' 			=> 'number',
				'std'  			=> 1,
				'min'  			=> 0,
				'max'  			=> 1,
				'step' 			=> 0.01,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_page_title_conditional','=','yes'),
						array('mb_page_title_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Title Bottom Margin', 'oni' ),
				'id'   			=> "mb_page_title_bottom_margin",
				'type' 			=> 'number',
				'std'  			=> 80,
				'min'  			=> 0,
				'step' 			=> 1,
				'attributes' 	=> array(
				    'data-dependency' => array( array(
				    	array('mb_page_title_conditional','=','yes')
					)),
				),
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_footer_meta_boxes' );
function gt3_footer_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      	=> esc_html__( 'Footer Options', 'oni' ),
        'post_types' 	=> array( 'page', 'post', 'proof_gallery', 'portfolio' ),
        'context' 		=> 'advanced',
        'fields'     	=> array(
			array(
				'name' 			=> esc_html__( 'Prefooter Map', 'oni' ),
				'id'          	=> "mb_map_prefooter",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' => esc_html__( 'default', 'oni' ),
					'show' 	  => esc_html__( 'Show', 'oni' ),
					'hide'    => esc_html__( 'Hide', 'oni' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),
			array(
				'name' 			=> esc_html__( 'Show Footer', 'oni' ),
				'id'          	=> "mb_footer_switch",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' 		=> esc_html__( 'default', 'oni' ),
					'yes' 			=> esc_html__( 'yes', 'oni' ),
					'no' 			=> esc_html__( 'no', 'oni' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),
			array(
				'name' 			=> esc_html__( 'Footer Column', 'oni' ),
				'id'          	=> "mb_footer_column",
				'type'        	=> 'select',
				'options'     	=> array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'multiple'    	=> false,
				'std'  			=> '4',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column 1', 'oni' ),
				'id'          	=> "mb_footer_sidebar_1",
				'type'        	=> 'select',
				'options'     	=> gt3_get_all_sidebar(),
				'multiple'    	=> false,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column 2', 'oni' ),
				'id'          	=> "mb_footer_sidebar_2",
				'type'        	=> 'select',
				'options'     	=> gt3_get_all_sidebar(),
				'multiple'    	=> false,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column 3', 'oni' ),
				'id'          	=> "mb_footer_sidebar_3",
				'type'        	=> 'select',
				'options'     	=> gt3_get_all_sidebar(),
				'multiple'    	=> false,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column 4', 'oni' ),
				'id'          	=> "mb_footer_sidebar_4",
				'type'        	=> 'select',
				'options'     	=> gt3_get_all_sidebar(),
				'multiple'    	=> false,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2'),
						array('mb_footer_column','!=','3')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column 5', 'oni' ),
				'id'          	=> "mb_footer_sidebar_5",
				'type'        	=> 'select',
				'options'     	=> gt3_get_all_sidebar(),
				'multiple'    	=> false,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2'),
						array('mb_footer_column','!=','3'),
						array('mb_footer_column','!=','4')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column Layout', 'oni' ),
				'id'          	=> "mb_footer_column2",
				'type'        	=> 'select',
				'options'     	=> array(
					'6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '75% / 25%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',
				),
				'multiple'    	=> false,
				'std'  			=> '6-6',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','2')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column Layout', 'oni' ),
				'id'          	=> "mb_footer_column3",
				'type'        	=> 'select',
				'options'     	=> array(
					'4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',
					'5-5-2' => '42% / 42% / 16%',
					'4-5-3' => '33% / 42% / 25%',
				),
				'multiple'    	=> false,
				'std'  			=> '5-5-2',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','3')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Column Layout', 'oni' ),
				'id'          	=> "mb_footer_column5",
				'type'        	=> 'select',
				'options'     	=> array(
                    '2-3-2-2-3' => '16% / 25% / 16% / 16% / 25%',
                    '3-2-2-2-3' => '25% / 16% / 16% / 16% / 25%',
                    '3-2-3-2-2' => '25% / 16% / 26% / 16% / 16%',
                    '3-2-3-3-2' => '25% / 16% / 16% / 25% / 16%',
				),
				'multiple'    	=> false,
				'std'  			=> '2-3-2-2-3',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','5')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Title Text Align', 'oni' ),
				'id'          	=> "mb_footer_align",
				'type'        	=> 'select',
				'options'     	=> array(
					'left' 	 => 'Left',
                    'center' => 'Center',
                    'right'  => 'Right'
				),
				'multiple'    	=> false,
				'std'  			=> 'left',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Padding Top (px)', 'oni' ),
				'id'   			=> "mb_padding_top",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 57,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Padding Bottom (px)', 'oni' ),
				'id'   			=> "mb_padding_bottom",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 57,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Padding Left (px)', 'oni' ),
				'id'   			=> "mb_padding_left",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 0,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Padding Right (px)', 'oni' ),
				'id'   			=> "mb_padding_right",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 0,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   			=> 'mb_footer_full_width',
				'name' 			=> esc_html__( 'Full Width Footer', 'oni' ),
				'type' 			=> 'select_advanced',
				'options'  		=> array(
                    'default'        => esc_html__( 'Default', 'oni' ),
                    'strech_footer'  => esc_html__( 'Strech Footer', 'oni' ),
                    'strech_content' => esc_html__( 'Strech Footer and Content', 'oni' ),
				),
				'multiple' 		=> false,
				'std'  			=> 'default',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Background Size', 'oni' ),
				'id'       		=> 'mb_footer_bg_size',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'inherit' 		=> esc_html__( 'inherit', 'oni' ),
					'cover' 		=> esc_html__( 'cover', 'oni' ),
					'contain' 		=> esc_html__( 'contain', 'oni' )
				),
				'multiple' 		=> false,
				'std'  			=> 'cover',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Background Color', 'oni' ),
				'id'   			=> "mb_footer_bg_color",
				'type' 			=> 'color',
				'std'  			=> '#191a1c',
				'js_options' 	=> array(
					'defaultColor' => '#191a1c',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Text Color', 'oni' ),
				'id'   			=> "mb_footer_text_color",
				'type' 			=> 'color',
				'std'  			=> '#ffffff',
				'js_options' 	=> array(
					'defaultColor' => '#ffffff',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Heading Color', 'oni' ),
				'id'   			=> "mb_footer_heading_color",
				'type' 			=> 'color',
				'std'  			=> '#9da1a5',
				'js_options' 	=> array(
					'defaultColor' => '#9da1a5',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Background Image', 'oni' ),
				'id'            => "mb_footer_bg_image",
				'type'          => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'     => 'image',
				'attributes' 	=> array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Background Repeat', 'oni' ),
				'id'       		=> 'mb_footer_bg_repeat',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'no-repeat' 	=> esc_html__( 'no-repeat', 'oni' ),
					'repeat' 		=> esc_html__( 'repeat', 'oni' ),
					'repeat-x' 		=> esc_html__( 'repeat-x', 'oni' ),
					'repeat-y' 		=> esc_html__( 'repeat-y', 'oni' ),
					'inherit' 		=> esc_html__( 'inherit', 'oni' ),
				),
				'multiple' 		=> false,
				'std'  			=> 'repeat',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Background Size', 'oni' ),
				'id'       		=> 'mb_footer_bg_size',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'inherit' 		=> esc_html__( 'inherit', 'oni' ),
					'cover' 		=> esc_html__( 'cover', 'oni' ),
					'contain' 		=> esc_html__( 'contain', 'oni' )
				),
				'multiple' 		=> false,
				'std'  			=> 'cover',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Background Attachment', 'oni' ),
				'id'       		=> 'mb_footer_attachment',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'fixed'   		=> esc_html__( 'fixed', 'oni' ),
					'scroll' 		=> esc_html__( 'scroll', 'oni' ),
					'inherit' 		=> esc_html__( 'inherit', 'oni' )
				),
				'multiple' 		=> false,
				'std'  			=> 'scroll',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Background Position', 'oni' ),
				'id'       		=> 'mb_footer_bg_position',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'left top' 		=> esc_html__( 'left top', 'oni' ),
					'left center' 	=> esc_html__( 'left center', 'oni' ),
					'left bottom' 	=> esc_html__( 'left bottom', 'oni' ),
					'center top' 	=> esc_html__( 'center top', 'oni' ),
					'center center' => esc_html__( 'center center', 'oni' ),
					'center bottom' => esc_html__( 'center bottom', 'oni' ),
					'right top' 	=> esc_html__( 'right top', 'oni' ),
					'right center' 	=> esc_html__( 'right center', 'oni' ),
					'right bottom' 	=> esc_html__( 'right bottom', 'oni' ),
				),
				'multiple' 		=> false,
				'std'  			=> 'center center',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   			=> 'mb_footer_top_border',
				'name' 			=> esc_html__( 'Set Footer Top Border?', 'oni' ),
				'type' 			=> 'checkbox',
				'std'  			=> 1,
				'attributes' 	=>  array(
					'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Border Color', 'oni' ),
				'id'   			=> "mb_footer_top_border_color",
				'type' 			=> 'color',
				'std'  			=> '',
				'js_options' 	=> array(
					'defaultColor' 	=> '#ffffff',
				),
				'attributes' 	=>  array(
					'data-dependency' => array( array(
						array('mb_footer_top_border','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Footer Border Opacity', 'oni' ),
				'id'   			=> "mb_footer_top_border_color_opacity",
				'type' 			=> 'number',
				'std'  			=> 0.1,
				'min'  			=> 0,
				'max'  			=> 1,
				'step' 			=> 0.01,
				'attributes' 	=>  array(
					'data-dependency' => array( array(
						array('mb_footer_top_border','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   			=> 'mb_copyright_switch',
				'name' 			=> esc_html__( 'Show Copyright', 'oni' ),
				'type' 			=> 'checkbox',
				'std'  			=> 1,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Editor', 'oni' ),
				'id'   			=> "mb_copyright_editor",
				'type' 			=> 'textarea',
				'cols' 			=> 20,
				'rows' 			=> 3,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Title Text Align', 'oni' ),
				'id'       		=> 'mb_copyright_align',
				'type'     		=> 'select',
				'options'  		=> array(
					'left'   => esc_html__( 'left', 'oni' ),
					'center' => esc_html__( 'center', 'oni' ),
					'right'  => esc_html__( 'right', 'oni' ),
				),
				'multiple' 		=> false,
				'std'  			=> 'left',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Padding Top (px)', 'oni' ),
				'id'   			=> "mb_copyright_padding_top",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 20,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Padding Bottom (px)', 'oni' ),
				'id'   			=> "mb_copyright_padding_bottom",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 20,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Padding Left (px)', 'oni' ),
				'id'   			=> "mb_copyright_padding_left",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 0,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Padding Right (px)', 'oni' ),
				'id'   			=> "mb_copyright_padding_right",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 0,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Background Color', 'oni' ),
				'id'   			=> "mb_copyright_bg_color",
				'type' 			=> 'color',
				'std'  			=> '#191a1c',
				'js_options' 	=> array(
					'defaultColor' => '#191a1c',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Text Color', 'oni' ),
				'id'   			=> "mb_copyright_text_color",
				'type' 			=> 'color',
				'std'  			=> '#9da1a5',
				'js_options' 	=> array(
					'defaultColor' => '#9da1a5',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   			=> 'mb_copyright_top_border',
				'name' 			=> esc_html__( 'Set Copyright Top Border?', 'oni' ),
				'type' 			=> 'checkbox',
				'std'  			=> 1,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Border Color', 'oni' ),
				'id'   			=> "mb_copyright_top_border_color",
				'type' 			=> 'color',
				'std'  			=> '',
				'js_options' 	=> array(
					'defaultColor' 	=> '',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Copyright Border Opacity', 'oni' ),
				'id'   			=> "mb_copyright_top_border_color_opacity",
				'type' 			=> 'number',
				'std'  			=> 1,
				'min'  			=> 0,
				'max'  			=> 1,
				'step' 			=> 0.01,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),

			//prefooter
			array(
				'id'   			=> 'mb_pre_footer_switch',
				'name' 			=> esc_html__( 'Show Pre Footer Area', 'oni' ),
				'type' 			=> 'checkbox',
				'std'  			=> 0,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Editor', 'oni' ),
				'id'   			=> "mb_pre_footer_editor",
				'type' 			=> 'textarea',
				'cols' 			=> 20,
				'rows' 			=> 3,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Title Text Align', 'oni' ),
				'id'       		=> 'mb_pre_footer_align',
				'type'     		=> 'select',
				'options'  		=> array(
					'left'   => esc_html__( 'left', 'oni' ),
					'center' => esc_html__( 'center', 'oni' ),
					'right'  => esc_html__( 'right', 'oni' ),
				),
				'multiple' 		=> false,
				'std'  			=> 'left',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Padding Top (px)', 'oni' ),
				'id'   			=> "mb_pre_footer_padding_top",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 20,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Padding Bottom (px)', 'oni' ),
				'id'   			=> "mb_pre_footer_padding_bottom",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 20,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Padding Left (px)', 'oni' ),
				'id'   			=> "mb_pre_footer_padding_left",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 0,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Padding Right (px)', 'oni' ),
				'id'   			=> "mb_pre_footer_padding_right",
				'type' 			=> 'number',
				'min'  			=> 0,
				'step' 			=> 1,
				'std'  			=> 0,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),


			array(
				'name' 			=> esc_html__( 'Background Color', 'oni' ),
				'id'   			=> "mb_pre_footer_bg_color",
				'type' 			=> 'color',
				'std'  			=> '#191a1c',
				'js_options' 	=> array(
					'defaultColor' => '#191a1c',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Text Color', 'oni' ),
				'id'   			=> "mb_pre_footer_text_color",
				'type' 			=> 'color',
				'std'  			=> '#9da1a5',
				'js_options' 	=> array(
					'defaultColor' => '#9da1a5',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),


			array(
				'id'   			=> 'mb_pre_footer_bottom_border',
				'name' 			=> esc_html__( 'Set Pre Footer Bottom Border?', 'oni' ),
				'type' 			=> 'checkbox',
				'std'  			=> 1,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Border Color', 'oni' ),
				'id'   			=> "mb_pre_footer_bottom_border_color",
				'type' 			=> 'color',
				'std'  			=> '',
				'js_options' 	=> array(
					'defaultColor'   => '',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_pre_footer_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Pre Footer Border Opacity', 'oni' ),
				'id'   			=> "mb_pre_footer_bottom_border_color_opacity",
				'type' 			=> 'number',
				'std'  			=> 1,
				'min'  			=> 0,
				'max'  			=> 1,
				'step' 			=> 0.01,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_pre_footer_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_pre_footer_bottom_border','=',true)
					)),
				),
			),
        ),
     );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_preloader_meta_boxes' );
function gt3_preloader_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      	=> esc_html__( 'Preloader Options', 'oni' ),
        'post_types' 	=> array( 'page', 'proof_gallery', 'portfolio' ),
        'context' 		=> 'advanced',
        'fields'     	=> array(
        	array(
				'name' 			=> esc_html__( 'Preloader', 'oni' ),
				'id'          	=> "mb_preloader",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' => esc_html__( 'default', 'oni' ),
					'custom'  => esc_html__( 'custom', 'oni' ),
					'none' 	  => esc_html__( 'none', 'oni' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),
        	array(
				'name' 			=> esc_html__( 'Preloader type', 'oni' ),
				'id'          	=> "mb_preloader_type",
				'type'        	=> 'select',
				'options'     	=> array(
					'linear' 		=> esc_html__( 'Linear', 'oni' ),
					'circle' 		=> esc_html__( 'Circle', 'oni' ),
					'theme'         => esc_html__( 'Theme', 'oni' ),
				),
				'multiple'    	=> false,
				'circle'		=> 'default',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Preloader Background', 'oni' ),
				'id'   			=> "mb_preloader_background",
				'type' 			=> 'color',
				'std'  			=> '#191a1c',
				'js_options' 	=> array(
					'defaultColor'  => '#191a1c',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Preloader Stroke Background Color', 'oni' ),
				'id'   			=> "mb_preloader_item_color",
				'type' 			=> 'color',
				'std'  			=> '#ffffff',
				'js_options' 	=> array(
					'defaultColor'  => '#ffffff',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom'),
					    array('mb_preloader_type','!=','theme'),
				    )),
				),
			),
			array(
				'name' 			=> esc_html__( 'Preloader Stroke Foreground Color', 'oni' ),
				'id'   			=> "mb_preloader_item_color2",
				'type' 			=> 'color',
				'std'  			=> '#435bb2',
				'js_options' 	=> array(
					'defaultColor'  => '#435bb2',
				),
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Preloader Circle Width in px (Diameter)', 'oni' ),
				'id'   			=> "mb_preloader_item_width",
				'type' 			=> 'number',
				'std'  			=> 120,
				'min'  			=> 0,
				'step' 			=> 1,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom'),
						array('mb_preloader_type','!=','linear'),
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Preloader Circle Stroke Width', 'oni' ),
				'id'   			=> "mb_preloader_item_stroke",
				'type' 			=> 'number',
				'std'  			=> 2,
				'min'  			=> 0,
				'max'  			=> 1000,
				'step' 			=> 1,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom'),
					    array('mb_preloader_type','!=','linear'),
				    )),
				),
			),
			array(
				'name' 			=> esc_html__( 'Preloader Logo', 'oni' ),
				'id' 			=> "mb_preloader_item_logo",
				'type' 			=> 'image_advanced',
				'size'			=> 'full',
				'max_file_uploads' => 1,
				'max_status' 	=> true,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Preloader Logo Width in px', 'oni' ),
				'id'   			=> "mb_preloader_item_logo_width",
				'type' 			=> 'number',
				'std'  			=> 45,
				'min'  			=> 0,
				'max'  			=> 1000,
				'step' 			=> 1,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom'),
					    array('mb_preloader_type','!=','linear'),
				    )),
				),
			),
			array(
				'id'   			=> 'mb_preloader_full',
				'name' 			=> esc_html__( 'Preloader Fullscreen', 'oni' ),
				'type' 			=> 'checkbox',
				'std'  			=> 1,
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_preloader','=','custom')
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_portfolio_meta_boxes' );
function gt3_portfolio_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      	=> esc_html__( 'Portfolio Options', 'oni' ),
		'post_types' 	=> array( 'portfolio' ),
		'context' 		=> 'advanced',
		'fields'     	=> array(
			array(
				'name'     		=> esc_html__( 'Portfolio Post Title', 'oni' ),
				'id'          	=> "mb_portfolio_title_conditional",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' 		=> esc_html__( 'default', 'oni' ),
					'yes' 			=> esc_html__( 'yes', 'oni' ),
					'no' 			=> esc_html__( 'no', 'oni' ),
				),
				'multiple'    	=> false,
				'std'         	=> 'default',
			),
		)
	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_shortcode_meta_boxes' );
function gt3_shortcode_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      	=> esc_html__( 'Shortcode Above Content', 'oni' ),
		'post_types' 	=> array( 'page' ),
		'context' 		=> 'advanced',
		'fields'     	=> array(
			array(
				'name' 			=> esc_html__( 'Shortcode', 'oni' ),
				'id'   			=> "mb_page_shortcode",
				'type' 			=> 'textarea',
				'cols' 			=> 20,
				'rows' 			=> 3
			),
		),
     );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_single_product_meta_boxes' );
function gt3_single_product_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      	=> esc_html__( 'Single Product Settings', 'oni' ),
        'post_types' 	=> array( 'product' ),
        'context' 		=> 'advanced',
        'fields'     	=> array(
        	array(
				'name' 			=> esc_html__( 'Single Product Page Settings', 'oni' ),
				'id'          	=> "mb_single_product",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' => esc_html__( 'default', 'oni' ),
					'custom'  => esc_html__( 'Custom', 'oni' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),

			array(
				'name' 			=> esc_html__( 'Product Page Layout', 'oni' ),
				'id'          	=> "mb_product_container",
				'type'        	=> 'select',
				'options'     	=> array(
					'container' 	=> esc_html__( 'Container', 'oni' ),
					'full_width' 	=> esc_html__( 'Full Width', 'oni' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'container',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
						array('mb_single_product','=','custom')
					)),
				),
			),

            // Thumbnails Layout Settings
            array(
                'name' 			=> esc_html__( 'Thumbnails Layout', 'oni' ),
                'id'          	=> "mb_thumbnails_layout",
                'type'        	=> 'select',
                'options'     	=> array(
                    'horizontal' 	=> esc_html__( 'Thumbnails Bottom', 'oni' ),
                    'vertical' 		=> esc_html__( 'Thumbnails Left', 'oni' ),
                    'thumb_grid' 	=> esc_html__( 'Thumbnails Grid', 'oni' ),
                    'thumb_vertical'=> esc_html__( 'Thumbnails Vertical Grid', 'oni' ),
                ),
                'multiple'    	=> false,
                'std'  			=> 'horizontal',
                'attributes' 	=>  array(
                    'data-dependency' => array( array(
                        array('mb_single_product','=','custom')
                    )),
                ),
            ),
            array(
                'id'   			=> 'mb_sticky_thumb',
                'name' 			=> esc_html__( 'Sticky Thumbnails', 'oni' ),
                'type' 			=> 'checkbox',
                'attributes' 	=>  array(
                    'data-dependency' => array( array(
                        array('mb_single_product','=','custom'),
                        array('mb_thumbnails_layout','!=','thumb_vertical'),
                    )),
                ),
            ),
        	array(
				'name' 			=> esc_html__( 'Size Guide for this product', 'oni' ),
				'id'          	=> "mb_img_size_guide",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' => esc_html__( 'default', 'oni' ),
					'custom'  => esc_html__( 'Custom', 'oni' ),
					'none'    => esc_html__( 'None', 'oni' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),
			array(
				'id'   			=> 'mb_size_guide',
				'name' 			=> esc_html__( 'Size guide Popup Image', 'oni' ),
				'type' 			=> 'image_advanced',
				'attributes' 	=>  array(
				    'data-dependency' => array( array(
				    	array('mb_img_size_guide','=','custom')
					)),
				),
			),
            array(
                'name'     => esc_html__('Image Size for Masonry Layout', 'oni'),
                'id'       => "mb_img_size_masonry",
                'type'     => 'select',
                'options'  => array(
                    'small_h_rect' => esc_html__('Small Horizontal Rectangle', 'oni'),
                    'large_h_rect' => esc_html__('Large Horizontal Rectangle', 'oni'),
                    'large_v_rect' => esc_html__('Large Vertical Rectangle', 'oni'),
                    'large_rect'   => esc_html__('Large 2x Rectangle', 'oni'),
                ),
                'multiple' => false,
                'std'      => 'small_h_rect',
            ),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_body_meta_boxes' );
function gt3_body_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      	=> esc_html__( 'Body Background Options', 'oni' ),
		'post_types' 	=> array( 'page', 'post', 'team', 'product', 'proof_gallery', 'portfolio' ),
		'context' 		=> 'advanced',
		'fields'     	=> array(
			array(
				'name'     		=> esc_html__( 'Body Background', 'oni' ),
				'id'          	=> "mb_body_conditional",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' 		=> esc_html__( 'default', 'oni' ),
					'custom' 			=> esc_html__( 'custom', 'oni' ),
				),
				'multiple'    	=> false,
				'std'         	=> 'default',
			),
			array(
				'name' 			=> esc_html__( 'Body Background Color', 'oni' ),
				'id'   			=> "mb_body_bg_color",
				'type' 			=> 'color',
				'std'  			=> '#191a1c',
				'js_options' 	=> array(
					'defaultColor' 	=> '#191a1c',
				),
				'attributes' 	=> array(
					'data-dependency' => array( array(
						array('mb_body_conditional','=','custom')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Body Background Image', 'oni' ),
				'id' 			=> "mb_body_bg_image",
				'type' 			=> 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type' 	=> 'image',
				'attributes' 	=> array(
					'data-dependency' => array( array(
						array('mb_body_conditional','=','custom')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Body Background Repeat', 'oni' ),
				'id'       		=> 'mb_body_bg_repeat',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'no-repeat' 	=> esc_html__( 'no-repeat', 'oni' ),
					'repeat' 		=> esc_html__( 'repeat', 'oni' ),
					'repeat-x' 		=> esc_html__( 'repeat-x', 'oni' ),
					'repeat-y' 		=> esc_html__( 'repeat-y', 'oni' ),
					'inherit' 		=> esc_html__( 'inherit', 'oni' ),
				),
				'multiple' 		=> false,
				'std'         	=> 'no-repeat',
				'attributes' 	=> array(
					'data-dependency' => array( array(
						array('mb_body_conditional','=','custom')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Body Background Size', 'oni' ),
				'id'       		=> 'mb_body_bg_size',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'inherit' 		=> esc_html__( 'inherit', 'oni' ),
					'cover' 		=> esc_html__( 'cover', 'oni' ),
					'contain' 		=> esc_html__( 'contain', 'oni' )
				),
				'multiple' 		=> false,
				'std'         	=> 'cover',
				'attributes' 	=> array(
					'data-dependency' => array( array(
						array('mb_body_conditional','=','custom')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Body Background Attachment', 'oni' ),
				'id'       		=> 'mb_body_bg_attachment',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'fixed' 		=> esc_html__( 'fixed', 'oni' ),
					'scroll' 		=> esc_html__( 'scroll', 'oni' ),
					'inherit' 		=> esc_html__( 'inherit', 'oni' )
				),
				'multiple' 		=> false,
				'std'         	=> 'scroll',
				'attributes' 	=> array(
					'data-dependency' => array( array(
						array('mb_body_conditional','=','custom')
					)),
				),
			),
			array(
				'name'     		=> esc_html__( 'Body Background Position', 'oni' ),
				'id'       		=> 'mb_body_bg_position',
				'type'     		=> 'select_advanced',
				'options'  		=> array(
					'left top' 		=> esc_html__( 'left top', 'oni' ),
					'left center' 	=> esc_html__( 'left center', 'oni' ),
					'left bottom' 	=> esc_html__( 'left bottom', 'oni' ),
					'center top' 	=> esc_html__( 'center top', 'oni' ),
					'center center' => esc_html__( 'center center', 'oni' ),
					'center bottom' => esc_html__( 'center bottom', 'oni' ),
					'right top' 	=> esc_html__( 'right top', 'oni' ),
					'right center' 	=> esc_html__( 'right center', 'oni' ),
					'right bottom' 	=> esc_html__( 'right bottom', 'oni' ),
				),
				'multiple' 		=> false,
				'std'         	=> 'center center',
				'attributes' 	=> array(
					'data-dependency' => array( array(
						array('mb_body_conditional','=','custom')
					)),
				),
			),
		),
	);
	return $meta_boxes;
}