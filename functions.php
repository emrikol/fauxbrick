<?php
/**
 * fauxbrick functions and definitions
 *
 * @package fauxbrick
 */

if ( ! defined( "THEME_DIR" ) ) {
	define( "THEME_DIR", get_template_directory() );
}
if ( ! defined( "THEME_URI" ) ) {
	define( "THEME_URI", get_template_directory_uri() );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 688; /* pixels */
}

if ( ! function_exists( 'fauxbrick_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fauxbrick_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fauxbrick, use a find and replace
	 * to change 'fauxbrick' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fauxbrick', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 688, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'fauxbrick' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fauxbrick_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // fauxbrick_setup
add_action( 'after_setup_theme', 'fauxbrick_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function fauxbrick_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fauxbrick' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'fauxbrick_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fauxbrick_scripts() {
	wp_enqueue_style( 'fauxbrick-style', get_stylesheet_uri() );

	wp_enqueue_style( 'fauxbrick-style' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fauxbrick_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function fauxbrick_modify_read_more_link() {
	return '<a class="more-link" href="' . esc_url( get_permalink() ) . '">Read the rest of this entry &raquo;</a>';
}
add_filter( 'the_content_more_link', 'fauxbrick_modify_read_more_link' );

function fauxbrick_wpkses_allowed_html($allowed, $context){
	if ( is_array( $context ) ) {
		return $allowed;
	}

	if ( 'post' === $context ) {
		$allowed['time']['class'] = true;
		$allowed['time']['datetime'] = true;
	}

	return $allowed;
}
add_filter('wp_kses_allowed_html', 'fauxbrick_wpkses_allowed_html', 10, 2);

function fauxbrick_responsive_oembed( $html ){
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	return'<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html','fauxbrick_responsive_oembed', 10, 1 );