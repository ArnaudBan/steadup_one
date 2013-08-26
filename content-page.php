<?php
/**
 * The template used for displaying page content
 *
 */


// get bgcolor
$bgcolor = get_post_meta( get_the_ID(), 'steadup_page_bgcolor', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	<?php  if($bgcolor) echo 'style="background-color:'. $bgcolor .';"' ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->