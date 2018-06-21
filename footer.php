		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="site-info">
							<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'fauxbrick' ), '<a href="https://github.com/emrikol/fauxbrick">fauxbrick</a>', '<a href="https://emrikol.com/" rel="designer">Emrikol</a>' ); ?>
							<span class="sep"> | </span>
							<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'fauxbrick' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'fauxbrick' ), 'WordPress' ); ?></a>
							<br/><?php printf(__('%1$s and %2$s.', 'kubrick'), '<a href="' . get_bloginfo('rss2_url') . '">' . __('Entries (RSS)', 'kubrick') . '</a>', '<a href="' . get_bloginfo('comments_rss2_url') . '">' . __('Comments (RSS)', 'kubrick') . '</a>'); ?>
						</div><!-- .site-info -->
					</div>
				</div>
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>

	</body>
</html>
