
<?php $unique_id = uniqid( 'search-form-' ); ?>

<form role="search" method="get" class="search_form gt3_search_form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr($unique_id); ?>"><?php echo _x( 'Search', 'label', 'oni' ); ?></label>
    <input class="search_text" id="<?php echo esc_attr($unique_id); ?>" type="text" name="s" placeholder="<?php esc_attr_e('Search', 'oni'); ?>">
    <button type="submit" class="search_submit"><i class="fa fa-search"></i></button>
</form>