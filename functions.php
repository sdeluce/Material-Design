<?php
/**
 * Material Design functions and definitions
 *
 * @package Material Design
 */

if ( ! function_exists( 'materialdesign_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function materialdesign_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Material Design, use a find and replace
	 * to change 'materialdesign' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'materialdesign', get_template_directory() . '/languages' );

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
	add_image_size( 'blog', 500, 450, true );

	$args = array(
		'default-color' => '#eceff1'
	);
add_theme_support( 'custom-background', $args );

	function custom_excerpt_length( $length ) {
		return 25;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

	function new_excerpt_more( $more ) {
		//return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'materialdesign' ) . '</a>';
		return ' ...';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'materialdesign', array( 'class' => "fuck", ) ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'materialdesign_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // materialdesign_setup
add_action( 'after_setup_theme', 'materialdesign_setup' );

function mytheme_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'materialdesign_reading_time' , array(
		'title'      => __( 'Reading time', 'materialdesign' ),
		'priority'   => 28,
	));

	$wp_customize->add_setting('materialdesign_reading_word_per_min', array(
        'default'        => '200',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('materialdesign_wpm', array(
        'label'      => __('Words per minutes', 'materialdesign'),
        'section'    => 'materialdesign_reading_time',
        'settings'   => 'materialdesign_reading_word_per_min',
    ));

    $wp_customize->add_setting('materialdesign_reading_format', array(
        'default'        => 'min',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'example_select_box', array(
        'label'   => __('Select the format', 'materialdesign'),
        'section' => 'materialdesign_reading_time',
        'settings' => 'materialdesign_reading_format',
        'type'    => 'select',
        'choices'    => array(
            'min' => __('xx min', 'materialdesign'),
            'sec' => __('x:xx sec', 'materialdesign'),
        ),
    ));
 

}
add_action( 'customize_register', 'mytheme_customize_register' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function materialdesign_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'materialdesign_content_width', 640 );
}
add_action( 'after_setup_theme', 'materialdesign_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function materialdesign_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'materialdesign' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'materialdesign_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function materialdesign_scripts() {
	wp_enqueue_style( 'materialdesign-style', get_stylesheet_uri() );

	wp_enqueue_script( 'materialdesign', get_template_directory_uri() . '/js/app.min.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'materialdesign_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
