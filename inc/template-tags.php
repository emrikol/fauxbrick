<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package fauxbrick
 */

if ( ! function_exists( 'fauxbrick_the_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function fauxbrick_the_posts_navigation() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'fauxbrick' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( '&laquo; Older Entries', 'fauxbrick' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer Entries &raquo;', 'fauxbrick' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	}
endif;

if ( ! function_exists( 'fauxbrick_the_post_navigation' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function fauxbrick_the_post_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'fauxbrick' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'fauxbrick_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function fauxbrick_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="hidden updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'fauxbrick' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( 'by %s', 'post author', 'fauxbrick' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . wp_kses_post( $posted_on ) . '</span><span class="byline"> ' . wp_kses_post( $byline ) . '</span>';

	}
endif;

if ( ! function_exists( 'fauxbrick_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function fauxbrick_entry_footer() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'fauxbrick' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'fauxbrick' ) . '</span>', $tags_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'fauxbrick' ) );
			if ( $categories_list && fauxbrick_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'fauxbrick' ) . '</span>', $categories_list );
			}
		}

		edit_post_link( esc_html__( 'Edit', 'fauxbrick' ), '<span class="edit-link"> | ', '</span>' );

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"> | ';
			comments_popup_link( esc_html__( 'No Comments &raquo;', 'fauxbrick' ), esc_html__( '1 Comment &raquo;', 'fauxbrick' ), esc_html__( '% Comments &raquo;', 'fauxbrick' ) );
			echo '</span>';
		} elseif ( ! is_single() && ! post_password_required() && ( ! comments_open() ) ) {
			echo '<span> | Comments Off</span>';
		}

	}
endif;

if ( ! function_exists( 'fauxbrick_the_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function fauxbrick_the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			$title = sprintf( __( 'Category: %s', 'fauxbrick' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( 'Tag: %s', 'fauxbrick' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author: %s', 'fauxbrick' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'fauxbrick' ), get_the_date( _x( 'Y', 'yearly archives date format', 'fauxbrick' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'fauxbrick' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'fauxbrick' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'fauxbrick' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'fauxbrick' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'fauxbrick' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'fauxbrick' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s', 'fauxbrick' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'fauxbrick' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'fauxbrick' );
		}

		/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
		$title = apply_filters( 'fauxbrick_get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo wp_kses_post( $before . $title . $after );
		}
	}
endif;

if ( ! function_exists( 'fauxbrick_the_archive_description' ) ) :
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function fauxbrick_the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'fauxbrick_get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
			echo wp_kses_post( $before . $description . $after );
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fauxbrick_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'fauxbrick_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'fauxbrick_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so fauxbrick_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so fauxbrick_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in fauxbrick_categorized_blog.
 */
function fauxbrick_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'fauxbrick_categories' );
}
add_action( 'edit_category', 'fauxbrick_category_transient_flusher' );
add_action( 'save_post', 'fauxbrick_category_transient_flusher' );

function fauxbrick_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php
	endif; // End is_singular()
}
