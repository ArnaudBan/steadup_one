<?php
/**
 * The functions of the theme
 */

// TODO custom background

// TODO add meta "background-color" to the page


/**
 * Somme custom query form the theme
 *
 * @param object $wp_query
 */
function abso_custom_query( $wp_query){

	//var_dump($wp_query);

	// All the page on the front page
	if( !is_admin() && $wp_query->is_main_query() ){
		$wp_query->set( 'post_type', 'page' );
		$wp_query->set( 'posts_per_page', -1 );
		$wp_query->set( 'orderby', 'menu_order' );
		$wp_query->set( 'order', 'ASC' );
		$wp_query->set( 'page_id', '' );
	}
}
add_action( 'pre_get_posts', 'abso_custom_query');