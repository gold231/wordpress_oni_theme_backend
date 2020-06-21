<?php
	
function gt3_child_scripts() {
	wp_enqueue_style( 'gt3-parent-style', get_template_directory_uri(). '/style.css' );
    wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' );
}
add_action( 'wp_enqueue_scripts', 'gt3_child_scripts' );

/**
 * Your code here.
 *
 */

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_size_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it size for your posts
 
function create_size_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Size', 'taxonomy general name' ),
    'singular_name' => _x( 'Size', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Size' ),
    'all_items' => __( 'All Size' ),
    'parent_item' => __( 'Parent Size' ),
    'parent_item_colon' => __( 'Parent Size:' ),
    'edit_item' => __( 'Edit Size' ), 
    'update_item' => __( 'Update Size' ),
    'add_new_item' => __( 'Add New Size' ),
    'new_item_name' => __( 'New Size Name' ),
    'menu_name' => __( 'Size' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('size',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'size' ),
  ));
 
}






//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_chronology1_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it Chronology1 for your posts
 
function create_chronology1_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Chronology1', 'taxonomy general name' ),
    'singular_name' => _x( 'Chronology1', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Chronology1' ),
    'all_items' => __( 'All Chronology1' ),
    'parent_item' => __( 'Parent Chronology1' ),
    'parent_item_colon' => __( 'Parent Chronology1:' ),
    'edit_item' => __( 'Edit Chronology1' ), 
    'update_item' => __( 'Update Chronology1' ),
    'add_new_item' => __( 'Add New Chronology1' ),
    'new_item_name' => __( 'New Chronology1 Name' ),
    'menu_name' => __( 'Chronology1' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('chronology1',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'chronology1' ),
  ));
 
}

