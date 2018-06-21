<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h2 class="page-title"><?php esc_html_e( 'Search Results', 'fauxbrick' ); ?></h2>
						</header><!-- .page-header -->

						<?php
							fauxbrick_the_posts_navigation();
							while ( have_posts() ) {
								the_post();
								get_template_part( 'content', 'search' );
							}
							fauxbrick_the_posts_navigation();
						?>

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
<?php
get_footer();
