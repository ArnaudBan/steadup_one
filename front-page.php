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

				// Display the blog
				if( get_the_ID() == get_option( 'page_for_posts' ) ){
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="entry-header">
							<h1 class="entry-title">
								<a href="<?php echo get_permalink( get_the_ID() ) ?>">
									<?php the_title(); ?>
								</a>
							</h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
							$the_posts_args = array(
									'post_type' => 'post'
								);
							$the_posts = new WP_Query( $the_posts_args );
							if( $the_posts->have_posts() ){
								while($the_posts->have_posts()){
									$the_posts->the_post();
									get_template_part( 'content', get_post_format() );
								}
								wp_reset_postdata();
							}
							?>
						</div>

					</article>
					<?php

				} else {

					get_template_part( 'content', 'page');
				}

			}

		}
		?>
		</div><!-- #content -->

<?php
get_footer();