<?php
/**
 * Main template
 *
 */

get_header();
?>
<div id="content" class="site-content" role="main">

		<?php
		if ( have_posts() ){
			while ( have_posts() ){
				the_post();
				get_template_part( 'content', 'page');

			}

		}
		?>
		</div><!-- #content -->

<?php
get_footer();