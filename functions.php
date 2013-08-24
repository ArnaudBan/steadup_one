<?php
/**
 * The functions of the theme
 */


function abso_steadup_setup(){

	$header_args = array(
		'default-image'          => 'http://placehold.it/400x300&text=LOGO',
		'random-default'         => false,
		'width'                  => 400,
		'height'                 => 300,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '#262829',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => 'abso_steadup_head_style',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $header_args );


	$args = array(
		'default-color' => '000000',
		'default-image'      => get_template_directory_uri(). '/styles/images/header-default.jpg',
		'wp-head-callback'   => 'abso_custom_background_cb',
	);
	add_theme_support( 'custom-background', $args );
}
add_action('after_setup_theme', 'abso_steadup_setup');

function abso_steadup_head_style(){

	$text_color = get_header_textcolor();

		// If no custom options for text are set, let's bail
		if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
			return;

		// If we get this far, we have custom styles.
		?>
		<style type="text/css" id="twentytwelve-header-css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px 1px 1px 1px); /* IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text, use that.
			else :
		?>
			.site-header h1 a,
			.site-header h2 {
				color: #<?php echo $text_color; ?>;
			}
		<?php endif; ?>
		</style>
		<?php
}


/**
 * Custom background callback
 * @return echo CSS
 */
function abso_custom_background_cb(){
	// $background is the saved custom image, or the default image.
	$background = set_url_scheme( get_background_image() );

	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_theme_mod( 'background_color' );

	if ( ! $background && ! $color )
		return;

	$body_color = $color ? "background-color: #$color;" : '';
	$style = '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		if( $repeat == 'no-repeat' )
			$repeat .= " background-repeat: $repeat; background-size: cover;";
		else
			$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		if( $position == 'center' )
			$position = " background-position: center $position;";
		else
			$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) || $attachment == 'scroll' )
			$attachment = 'absolute';
		$attachment = " position: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}
	?>
	<style type="text/css">
		body.custom-background{
			<?php echo $body_color ?>
		}
		body.custom-background .background-img{
			<?php echo trim( $style ); ?>
		}
	</style>
	<?php
}


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