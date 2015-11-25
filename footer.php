<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package fauxbrick
 */
?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="site-info">
							<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'fauxbrick' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'fauxbrick' ), 'WordPress' ); ?></a>
							<span class="sep"> | </span>
							<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'fauxbrick' ), 'fauxbrick', '<a href="http://emrikol.com/" rel="designer">Emrikol</a>' ); ?>
						</div><!-- .site-info -->
					</div>
				</div>
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>

	</body>
</html>
