<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-format="<?php echo esc_attr( get_post_format() ); ?>">
	<?php
		// Post thumbnail.
		fauxbrick_post_thumbnail();
	?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php fauxbrick_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'fauxbrick' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fauxbrick' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php fauxbrick_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
