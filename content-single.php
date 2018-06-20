<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-post-format="<?php echo esc_attr( get_post_format() ); ?>">
	<?php
		// Post thumbnail.
		fauxbrick_post_thumbnail();
	?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php fauxbrick_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
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
