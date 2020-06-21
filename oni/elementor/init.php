<?php

add_filter('gt3/core/builder_support', function($supports){
	$supports[] = 'elementor';

	return $supports;
});

add_filter('gt3/elementor/widgets/register', function($widgets){
	$widgets = array(
		'TestimonialsLite',
		'Tabs',
		'Accordion',
		'Divider',
		'BlogBoxed',
		'Button',
		'Portfolio',
		'Team',
		'ProcessBar',
		'PieChart',
		'GoogleMap',
		'CustomMeta',
		'Sharing',
		'ImageCarousel',
		'ImageInfoBox',
		'Flipbox',
		'Blog',
		'PriceBox',
		'Countdown',
		'ImageProcessBar',
		'Counter',
		'InfoList',
	);
	if (class_exists('RevSlider')) {
		$widgets[] = 'RevolutionSlider';
	}
	if (class_exists('WooCommerce')) {
		$widgets[] = 'ShopList';
	}
	return $widgets;
});

add_action('elementor/element/gt3-core-blog/general_section/before_section_end', function($element,$args){
	/* @var \Elementor\Widget_Base $element */
	$element->update_control('packery_en',array(
		'condition'=>array(
			'show'=>'newer'
		)
	));
	$element->update_control('static_info_block',array(
		'condition'=>array(
			'show'=>'newer'
		)
	));
},20,2);

add_action('elementor/element/gt3-core-tabs/style_section/before_section_end', function($element,$args){
	/* @var \Elementor\Widget_Base $element */
	$element->update_control('tab_padding',array(
		'default'     => array(
			'top' => '19',
			'right' => '30',
			'bottom' => '19',
			'left' => '30',
		)
	));
	$element->update_control('tab_border_radius',array(
		'default'     => array(
			'size' => 0,
			'unit' => 'px',
		),
	));


},20,2);

add_action('elementor/element/gt3-core-processbar/style_section/before_section_end', function($element,$args){
	$element->add_control(
		'heading_color',
		array(
			'label'   => esc_html__('Heading Color','oni'),
			'type'    => Elementor\Controls_Manager::COLOR,
			'selectors'   => array(
				'{{WRAPPER}}.elementor-widget-gt3-core-processbar .gt3_process_item__number,{{WRAPPER}}.elementor-widget-gt3-core-processbar  .gt3_process_item__heading' => 'color: {{VALUE}};',
			),
		)
	);
	$element->add_control(
		'point_color',
		array(
			'label'   => esc_html__('Point Color','oni'),
			'type'    => Elementor\Controls_Manager::COLOR,
			'selectors'   => array(
				'{{WRAPPER}}.elementor-widget-gt3-core-processbar .gt3_process_item__circle_wrapp' => 'color: {{VALUE}};',
				'{{WRAPPER}}.elementor-widget-gt3-core-processbar .gt3_process_item .gt3_process_item__circle_wrapp .gt3_process_item__circle_line_before' => 'background-image: linear-gradient(90deg, transparent 0%, {{VALUE}} 100%);background-color: {{VALUE}};',
				'{{WRAPPER}}.elementor-widget-gt3-core-processbar .gt3_process_item .gt3_process_item__circle_wrapp .gt3_process_item__circle_line_after' => 'background-image: linear-gradient(90deg, {{VALUE}} 0%, transparent 100% );background-color: {{VALUE}};',
				'{{WRAPPER}}.elementor-widget-gt3-core-processbar.vertical_style-2 .gt3_process_item .gt3_process_item__circle_wrapp .gt3_process_item__circle_line_before' => 'background-image: linear-gradient(0deg, {{VALUE}} 0%, transparent 100%);background-color: {{VALUE}};',
				'{{WRAPPER}}.elementor-widget-gt3-core-processbar.vertical_style-2 .gt3_process_item .gt3_process_item__circle_wrapp .gt3_process_item__circle_line_after' => 'background-image: linear-gradient(0deg, transparent 0%, {{VALUE}} 100% );background-color: {{VALUE}};',
			),
		)
	);
},20,2);


if (class_exists('\gt3_photo_video_galery_pro')) {
	gt3_photo_video_galery_pro::instance()->actions();
	if (class_exists('\gt3pg_pro_plugin_updater')) {
		gt3pg_pro_plugin_updater::instance()->status = 'valid';
	}
}

if (class_exists('\GT3\PhotoVideoGalleryPro\Autoload')) {
	\GT3\PhotoVideoGalleryPro\Autoload::instance()->Init();
}

add_filter('gt3pg-pro/blocks/allowed', function($blocks){
	return array_unique(array_merge($blocks, array(
		'Grid',
		'Masonry',
		'Packery',
		'Slider',
		'Thumbnails',
		'FSSlider',
		'FS_Slider',
		'Shift',
		'Instagram',
		'Justified',
		'Kenburns',
		'Flow',
		'Ribbon',
		'BeforeAfter',
		'Before_After',
	)));
});

// Meta
add_filter( 'gt3/core/render/blog/listing_meta', function ($compile) {
	return '<div class="listing_meta_wrap">'.$compile.'</div>';
});

// Media height
add_filter( 'gt3/core/render/blog/media_height', function () {
	return '700';
});

// Post comments
add_filter( 'gt3/core/render/blog/post_comments', function () {

	if (get_comments_number(get_the_ID()) == 1) {
		$comments_text = esc_html__('comment', 'oni');
	} else {
		$comments_text = esc_html__('comments', 'oni');
	}

	if ((int)get_comments_number(get_the_ID()) != 0) {
		return '<span class="post_comments"><a href="' . esc_url(get_comments_link()) . '" title="' . esc_attr(get_comments_number(get_the_ID())) . ' ' . $comments_text . '">' . esc_html(get_comments_number(get_the_ID())) . ' ' . $comments_text . '</a></span>';
	}

});

// Post author
add_filter( 'gt3/core/render/blog/post_author', function () {
	return '<span class="post_author">' . esc_html__('by', 'oni') . ' <a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a></span>';
});

// Post bottom Area
add_filter( 'gt3/core/render/blog/listing_btn', function ($listing_btn, $settings) {

	$show_likes = gt3_option('blog_post_likes');
	$show_share = gt3_option('blog_post_share');

	$all_likes = gt3pb_get_option("likes");

	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');

	$btn_compile = '<div class="clear post_clear"></div><div class="gt3_post_footer">';

	if(!empty($settings['post_btn_link'])) {
		$btn_compile .= '<div class="gt3_module_button_list"><a href="'. esc_url(get_permalink()) .'">'. $settings['post_btn_link_title'] .'</a></div>';
	}

	if ($show_share == "1" || $show_likes == "1") {
		$btn_compile .= '<div class="blog_post_info">';

		if (function_exists('gt3_blog_post_sharing')) {
			ob_start();
			gt3_blog_post_sharing($show_share,$featured_image);
			$btn_compile .= ob_get_clean();
		}

		if (function_exists('gt3_blog_post_likes')) {
			ob_start();
			gt3_blog_post_likes($show_likes,$all_likes);
			$btn_compile .= ob_get_clean();
		}

		$btn_compile .= '</div>';
	}

	$btn_compile .= '<div class="clear"></div></div>';

	return $btn_compile;

}, 10, 2);

// BlogBoxed
add_filter( 'gt3/core/render/blogboxed/block_wrap_start', function () {
	return '<div class="gt3blogboxed_block_wrap">';
});

add_filter( 'gt3/core/render/blogboxed/block_wrap_end', function () {
	return '</div>';
});

// Team
add_filter( 'gt3/core/render/team/team_img_prop', function () {
	$img_ratio = '1.2125';
	return $img_ratio;
});

// Price Table Type Controls Added
add_action('elementor/element/gt3-core-pricebox/basic_section/after_section_start', function($element,$args){
	/* @var \Elementor\Widget_Base $element */
	$element->add_control(
		'view_type',
		array(
			'label'       => esc_html__('View Type', 'oni'),
			'type'        => Elementor\Controls_Manager::SELECT,
			'options'     => array(
				'type1' => esc_html__('Type 1', 'oni'),
				'type2' => esc_html__('Type 2', 'oni'),
			),
			'default'     => 'type1',
		)
	);
},20,2);
