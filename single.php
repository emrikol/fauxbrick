<?php
/**
 * The template for displaying all single posts.
 *
 * @package fauxbrick
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'single' ); ?>

							<?php //fauxbrick_the_post_navigation(); ?>

							<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>

						<?php endwhile; // end of the loop. ?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<div id="sidebar" class="col-xs-12 col-sm-4 col-md-3 col-lg-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php get_footer();