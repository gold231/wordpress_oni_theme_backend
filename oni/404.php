<?php get_header();

$page_bg = gt3_option('page_404_bg');
$page_bg_url  = $page_bg['url'];
get_header();
if (empty($page_bg_url)) {
	$number_404 = '<img src="'. esc_url(get_template_directory_uri() . '/img/404.png') . '" alt="'. esc_attr__('404', 'oni') .'" />';
	$class_404 = 'without_bg';
} else {
	$number_404 = '<h1 class="number_404">'. esc_html__('404', 'oni') .'</h1>';
	$class_404 = '';
}
?>
	<div class="wrapper_404 <?php echo esc_attr($class_404); ?>" <?php echo !empty($page_bg_url) ? "style='background-image: url(".esc_url($page_bg_url).")';" : "" ?> >
		<div class="container_vertical_wrapper">
			<div class="container">
				<?php echo (($number_404)); ?>
				<p><?php echo esc_html__('Ooops... there is so much dark that we can\'t see anything', 'oni'); ?></p>
				<div class="gt3_module_button_list"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Go to back', 'oni'); ?></a></div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>