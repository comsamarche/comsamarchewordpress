<?php
/**
 * MaudTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MaudTheme
 */

if ( ! function_exists( 'maudtheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maudtheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MaudTheme, use a find and replace
		 * to change 'maudtheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'maudtheme', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'maudtheme' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'maudtheme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'maudtheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maudtheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'maudtheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'maudtheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maudtheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'maudtheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'maudtheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'maudtheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function maudtheme_scripts() {
	wp_enqueue_style( 'maudtheme-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-css', '//fonts.googleapis.com/css?family=Ubuntu:300,400,700|Nobile:500,700|' );
	wp_enqueue_style( 'font-fontawesome', '//use.fontawesome.com/releases/v5.0.6/css/all.css' );
	wp_enqueue_style( 'maudtheme-css', get_template_directory_uri() . '/assets/css/main.css' );

	if ( !is_admin() ) {

		// wp_deregister_script('jquery'); => Elementor compatibility
		wp_enqueue_script( 'acte-tabs-js', get_template_directory_uri() . '/assets/js/main/class-acte-tabs.js', array(), date('Ymd'), true );
		wp_enqueue_script( 'tweenmax', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js', array(), date('Ymd'), true );
	}
	//wp_enqueue_script( 'maudtheme-js', get_template_directory_uri() . '/assets/js/main.js', array(), date('Ymd'), true );

	wp_enqueue_script( 'maudtheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), date('Ymd'), true );

	wp_enqueue_script( 'maudtheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), date('Ymd'), true );

}
add_action( 'wp_enqueue_scripts', 'maudtheme_scripts' );

/**
 * Async Defer script
 */
function add_async_attribute($tag, $handle) {

	$scripts_to_async = array('google-map');

foreach($scripts_to_async as $async_script) {
	if ($async_script === $handle) {
		return str_replace(' src', ' async defer src', $tag);
	}
}
return $tag;
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

/**
 * GOOGLE MAP
 */
function enable_goolemap() {
	wp_enqueue_script( 'google-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyDc-4AxSAeXtaW3XLkOtcDFxY2JyhukA7A&callback=initMap', '', '', true);
	wp_enqueue_script( 'google-script', get_template_directory_uri() . '/js/google-map.js', array(), date('Ymd'), true );
}
//add_action( 'wp_enqueue_scripts', 'enable_goolemap' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Plugin human machine
 */
require get_template_directory() . '/machineHumanSvg.php';
