<?php
/**
 * The functions of the theme
 */

// TODO custom background

// TODO add meta "background-color" to the page


/**
 * add style and JS
 */
function abso_enqueue_script(){
	wp_enqueue_style( 'screen', get_template_directory_uri() . '/styles/screen.css', array(), '20130818', 'all' );
}
add_action( 'wp_enqueue_scripts', 'abso_enqueue_script' );

/**
 * Somme custom query form the theme
 *
 * @param object $wp_query
 */
function abso_custom_query( $wp_query){

	if( ! is_admin() && $wp_query->is_main_query() ){

		// All the page on the front page
		if( $wp_query->get( 'page_id' ) == get_option( 'page_on_front' ) ){
			$wp_query->set( 'post_type', 'page' );
			$wp_query->set( 'posts_per_page', -1 );
			$wp_query->set( 'orderby', 'menu_order' );
			$wp_query->set( 'order', 'ASC' );
			$wp_query->set( 'page_id', '' );
		}
	}

	return $wp_query;
}
add_action( 'pre_get_posts', 'abso_custom_query');