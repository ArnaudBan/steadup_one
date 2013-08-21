<?php
/**
 * The functions of the theme
 */


function abso_steadup_setup(){

	$header_args = array(
		'default-image'          => get_template_directory_uri(). '/styles/images/header-default.jpg',
		'random-default'         => false,
		'width'                  => 1000,
		'height'                 => 667,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '#262829',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => 'abso_admin_steadup_head',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $header_args );
}
add_action('after_setup_theme', 'abso_steadup_setup');

function abso_admin_steadup_head(){
	?>
	<style type="text/css">

		#headimg{
			text-align: center;
			padding: 20px 2%;
			background-size: cover;
			background-repeat: no-repeat;
		}

		#headimg h1{
			font-size: px_to_em( 30 );
			font-weight: bold;
			margin: 15px;
		}

		#headimg h1 a{
			text-decoration: none;
			color: #262829;
		}

		#headimg h1 a:hover, #headimg h1 a:focus{
			color: #e95a50;
		}

		}
	</style>

	<?php
}

// TODO custom background

// TODO add meta "background-color" to the page


/**
 * add style and JS
 */
function abso_enqueue_script(){
	wp_enqueue_style( 'screen', get_template_directory_uri() . '/styles/screen.css', array(), '20130818', 'all' );

	wp_enqueue_script( 'abso_scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '20130820', true );
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