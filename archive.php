<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package fauxbrick
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-8">
				<header class="page-header">

					<?php /* If this is a category archive */ if ( is_category() ) { ?>
					<h2 class="pagetitle"><?php printf( esc_html__( 'Archive for the &#8216;%s&#8217; Category', 'fauxbrick'), single_cat_title( '', false ) ); ?></h2>
					<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h2 class="pagetitle"><?php printf( esc_html__( 'Posts Tagged &#8216;%s&#8217;', 'fauxbrick' ), single_tag_title( '', false ) ); ?></h2>
					<?php /* If this is a daily archive */ } elseif ( is_day() ) { ?>
					<h2 class="pagetitle"><?php printf( esc_html_x( 'Archive for %s|Daily archive page', 'fauxbrick' ), get_the_time( esc_html__( 'F jS, Y', 'fauxbrick' ) ) ); ?></h2>
					<?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
					<h2 class="pagetitle"><?php printf( esc_html_x( 'Archive for %s|Monthly archive page', 'fauxbrick'), get_the_time( esc_html__( 'F, Y', 'fauxbrick' ) ) ); ?></h2>
					<?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
					<h2 class="pagetitle"><?php printf( esc_html_x( 'Archive for %s|Yearly archive page', 'fauxbrick' ), get_the_time( esc_html__( 'Y', 'fauxbrick' ) ) ); ?></h2>
					<?php /* If this is an author archive */ } elseif ( is_author() ) { ?>
					<h2 class="pagetitle"><?php esc_html_e( 'Author Archive', 'fauxbrick' ); ?></h2>
					<?php /* If this is a paged archive */ } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { ?>
					<h2 class="pagetitle"><?php esc_html_e( 'Blog Archives', 'fauxbrick' ); ?></h2>
					<?php } ?>

					<div class="navigation">
						<div class="alignleft"><?php next_posts_link( esc_html__( '&laquo; Older Entries', 'fauxbrick' ) ); ?></div>
						<div class="alignright"><?php previous_posts_link( esc_html__( 'Newer Entries &raquo;', 'fauxbrick' ) ); ?></div>
					</div>
				</header>
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
							?>

						<?php endwhile; ?>

						<?php fauxbrick_the_posts_navigation(); ?>

					<?php else : ?>

						<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<div id="sidebar" class="col-xs-12 col-sm-4 col-md-3 col-lg-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer();
