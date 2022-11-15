<?php

// Import CSS & JS
function enqueue_styles() {
    wp_enqueue_style( 'parent-theme', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() . '/assets/css/styles.css');
}

function bootstrap_enqueue_scripts() {
    $dependencies = array('jquery');
    wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', $dependencies, '3.3.6', true );
}

add_action( 'wp_enqueue_scripts', 'enqueue_styles' ,1);
add_action( 'wp_enqueue_scripts', 'bootstrap_enqueue_scripts',1 ); 

// Create custom post types
function create_medarbejder_posttype() {
    register_post_type( 'medarbejdere',
    array(
      'labels' => array(
       'name' => __( 'Medarbejdere' ),
       'singular_name' => __( 'Medarbejder' ),
       'add_new' => __( 'Opret medarbejder' ),
       'add_new_item' => __( 'Tilføj ny medarbejder' ),
      ),
      'hierarchical' => false,
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'medarbejder'),
      'menu_icon' => 'dashicons-businessperson',
      'supports' => array('title', 'thumbnail'),
    ),
    'taxonomies', array('Afdelinger'),
    );
}
add_action( 'init', 'create_medarbejder_posttype' );

// Create taxonomies
function create_afdeling_taxonomy() {
  
      $labels = array(
        'name' => _x( 'Afdelinger', 'taxonomy general name' ),
        'singular_name' => _x( 'Afdeling', 'taxonomy singular name' ),
        'search_items' =>  __( 'Søg Afdeling' ),
        'all_items' => __( 'Alle Afdelinger' ),
        'parent_item' => __( 'Forældre Afdeling' ),
        'parent_item_colon' => __( 'Forældre afdeling:' ),
        'edit_item' => __( 'Ændre afdeling' ), 
        'update_item' => __( 'Opdater afdeling' ),
        'add_new_item' => __( 'Opret ny afdeling' ),
        'new_item_name' => __( 'Ny afdeling navn' ),
        'menu_name' => __( 'Afdelinger' ),
      );    
      
      register_taxonomy('afdelinger',array('medarbejdere'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'subject' ),
      ));
}

add_action( 'init', 'create_afdeling_taxonomy', 0 );

// Read custom template for products in "udlejning" category
add_filter( 'template_include', 'custom_single_product_template_include', 50, 1 );
function custom_single_product_template_include( $template ) {
    if ( is_singular('product') && (has_term( 'udlejning', 'product_cat')) ) {
        $template = get_stylesheet_directory() . '/woocommerce/single-product-udlejning.php';
    } 
    return $template;
}

// Remove general tab for products in "udlejning" category
function remove_tab($tabs){
  if (has_term( array( 'udlejning' ), 'product_cat' )) {
    unset($tabs['general']);
  }
  return($tabs);  
}

add_filter('woocommerce_product_data_tabs', 'remove_tab', 10, 1);


