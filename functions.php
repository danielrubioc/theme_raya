<?php

add_action( 'wp_enqueue_scripts', function () { 
	// registers scripts and stylesheets
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css', [], false );
	wp_enqueue_style( 'theme', get_template_directory_uri().'/assets/css/theme.css', [], false );   
	wp_enqueue_script( 'jquery' ); 
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',[], true );  
} );

add_action( 'init', 'wp_enqueue_scripts');


// Register Noticia Post Type
function noticia_post_type() {

	$labels = array(
		'name'                  => _x( 'Noticias', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Noticia', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Noticias', 'text_domain' ),
		'name_admin_bar'        => __( 'Noticias', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Nueva Noticia', 'text_domain' ),
		'add_new'               => __( 'Agregar noticias', 'text_domain' ),
		'new_item'              => __( 'Nueva Noticia', 'text_domain' ),
		'edit_item'             => __( 'Editar noticia', 'text_domain' ),
		'update_item'           => __( 'Actualizar noticia', 'text_domain' ),
		'view_item'             => __( 'Ver noticia', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'noticia', 'text_domain' ),
		'description'           => __( 'Noticias raya', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'editor', 'title' ),
		'taxonomies'            => array( 'category'),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'noticia', $args );

}
add_action( 'init', 'noticia_post_type', 0 );


// Register Custom Taxonomy
function year_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Años', 'Taxonomy General Name', 'year' ),
		'singular_name'              => _x( 'Año', 'Taxonomy Singular Name', 'year' ),
		'menu_name'                  => __( 'Año', 'year' ),
		'all_items'                  => __( 'Años', 'year' ),
		'parent_item'                => __( 'Parent Item', 'year' ),
		'parent_item_colon'          => __( 'Parent Item:', 'year' ),
		'new_item_name'              => __( 'New Item', 'year' ),
		'add_new_item'               => __( 'Add New Item', 'year' ),
		'edit_item'                  => __( 'Edit Item', 'year' ),
		'update_item'                => __( 'Update Item', 'year' ),
		'view_item'                  => __( 'View Item', 'year' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'year' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'year' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'year' ),
		'popular_items'              => __( 'Popular Items', 'year' ),
		'search_items'               => __( 'Search Items', 'year' ),
		'not_found'                  => __( 'Not Found', 'year' ),
		'no_terms'                   => __( 'No items', 'year' ),
		'items_list'                 => __( 'Items list', 'year' ),
		'items_list_navigation'      => __( 'Items list navigation', 'year' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'year', array( 'noticia' ), $args );

}
add_action( 'init', 'year_taxonomy', 0 );




function misha_my_load_more_scripts() { 
	global $wp_query; 
	$wp_query->set('post_type', 'noticia');
	$wp_query->set('posts_per_page', 2);
	$wp_query->set('paged', 2);
	$wp_query->set('offset', 4);

	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/assets/js/myloadmore.js', array('jquery') ); 
	wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );

function misha_loadmore_ajax_handler(){ 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish'; 
	$args = array(
		'post_type'=>array('noticia'),
		'paged' => $_POST['page'] + 1,
		'posts_per_page'  => 2
	);  
	// it is always better to use WP_Query but not here
	query_posts( $args ); 
	if( have_posts() ) :  
		// run the loop
		while( have_posts() ): the_post();   
			get_template_part( 'template-parts/post/content', get_post_format() );  
		endwhile; 
	endif;
	die; 
} 
 
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}