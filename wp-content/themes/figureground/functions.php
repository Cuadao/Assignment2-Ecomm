<?php
/**
 * Figure/Ground functions and definitions.
 *
 * @package Figure/Ground
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 576; /* pixels */
}

if ( ! function_exists( 'figureground_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function figureground_setup() {

	/**
	 * Make theme available for translation via language packs.
	 */
	load_theme_textdomain( 'figureground' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style', 'navigation-widgets' ) );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 640, 320, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'figureground' ),
		'social'  => __( 'Social', 'figureground' ),
	) );

	/**
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'video', 'audio', 'quote', 'link' ) );

	/**
	 * Enable support for automatic feed links.
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Set up custom logos.
	 *
	 * There is no logo by default, and logos are fairly small in this theme.
	 */
	$defaults = array(
		'width'                  => 48,
		'height'                 => 48,
		'flex-height'            => false,
		'flex-width'             => true,
		'header-text'            => false,
		'unlink-homepage-logo' 	 => true,
	);
	add_theme_support( 'custom-logo', $defaults );

	/**
	 * Allow widgets to be previewed faster in the customizer with selective refresh.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Add theme support for starter content.
	 */
	add_theme_support( 'starter-content', array(
		// No widgets by default for simplicity.
		'posts' => array(
			'about',
			'contact',
		),

		'options' => array(
			'show_on_front' => 'posts',
		),

		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary Menu', 'figureground' ),
				'items' => array(
					'link_home' => array( // The core `page_home` item is wrong. See https://core.trac.wordpress.org/ticket/39104.
						'title' => __( 'Home', 'figureground' ),
						'url' => get_home_url(),
					),
					'page_about',
					'page_contact',
				),
			),
			'social' => array(
				'name' => __( 'Social Links Menu', 'figureground' ),
				'items' => array(
					'link_facebook',
					'link_twitter',
					'link_youtube',
					'link_email',
				),
			),
		),
	) );

	// Disable user-defined font size selection to encourage consistency.
	add_theme_support( 'disable-custom-font-sizes' );

	// Disable color pickers in the editor in favor of colors defined in the customizer.
	add_theme_support( 'disable-custom-colors' );

	// Load classic editor styles into the block editor.
	add_theme_support( 'editor-styles' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css', 'genericons/genericons/genericons.css', figureground_fonts_url() ) );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for wide alignments in the block editor;
	add_theme_support( 'align-wide' );

	// Add support for custom color scheme.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Figure/Ground Dark', 'figureground' ),
				'slug'  => 'fg-dark',
				'color' => get_theme_mod( 'fg_color_dark', '#222222' ),
			),
			array(
				'name'  => __( 'Figure/Ground Light', 'figureground' ),
				'slug'  => 'fg-light',
				'color' => get_theme_mod( 'fg_color_light', '#f7f7ec' ),
			),
			array(
				'name'  => __( 'Accent Light', 'figureground' ),
				'slug'  => 'accent-light',
				'color' => get_theme_mod( 'accent_color_light', '#87f' ),
			),
			array(
				'name'  => __( 'Accent Dark', 'figureground' ),
				'slug'  => 'accent-dark',
				'color' => get_theme_mod( 'accent_color_dark', '#903' ),
			),
		)
	);

	// Disable gradients.
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'editor-gradient-presets', array() );
}
endif; // figureground_setup
add_action( 'after_setup_theme', 'figureground_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function figureground_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'figureground' ),
		'id'            => 'main',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'figureground_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function figureground_scripts() {
	wp_enqueue_style( 'figureground-style', get_stylesheet_uri() );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons/genericons.css', '3.0.3' );
	wp_enqueue_style( 'figureground-fonts', figureground_fonts_url() );
	
	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'main' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	// Includes misc. theme scripts.
	wp_enqueue_script( 'figureground-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20190203', true );

	// Load Figure/Ground animation.
	wp_enqueue_script( 'figureground', get_template_directory_uri() . '/js/figure-ground.js', array( 'jquery' ), '20190115', false );

	// Load clock icons.
	wp_enqueue_script( 'figureground-clocks', get_template_directory_uri() . '/js/clocks.js', array( 'figureground' ), '20200706', false );

	// Load theme options to pass to the Figure/Ground script.
	$type = esc_html( get_theme_mod( 'fg_type', 'rhombus' ) );
	$maxh = absint( get_theme_mod( 'fg_max_height', 160 ) );
	$maxw = absint( get_theme_mod( 'fg_max_width', 160 ) );
	$maxr = $maxw * 2 / 3;
	$linet = 3;
	$delay = absint( get_theme_mod( 'fg_speed', 0 ) );
	$initial = absint( get_theme_mod( 'fg_initial', 320 ) );
	$color = sanitize_hex_color( get_theme_mod( 'fg_color_dark', '#222' ) );
	$bcolor = sanitize_hex_color( get_theme_mod( 'fg_color_light', '#f7f7ec' ) );

	// Pass data to JS.
	$settings = array(
		'type'    => $type,
		'maxw'    => $maxw,
		'maxh'    => $maxh,
		'maxr'    => $maxr,
		'linet'   => $linet,
		'delay'   => $delay,
		'initial' => $initial,
		'color'   => $color,
		'bcolor'  => $bcolor,
	);

	wp_localize_script( 'figureground', 'figureGroundSettings', $settings );

	// Misc. theme scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'figureground-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20140623' );
	}
}
add_action( 'wp_enqueue_scripts', 'figureground_scripts' );

/**
 * Get the url of the webfonts required for the theme.
 *
 * @since Figure/Ground 1.0
 *
 * @return string Fonts url.
 */
function figureground_fonts_url() {
	$font_families = array();
	$font_families[] = 'Raleway:400,600';
	$font_families[] = 'Merriweather Sans:400,700,400italic';
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );

	return $fonts_url;
}

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Figure/Ground 1.3
 */
function figureground_block_editor_styles() {
	// Add custom fonts. These do not work with `add_editor_style` in the block editor.
	wp_enqueue_style( 'figureground-fonts', figureground_fonts_url(), array(), null );
	wp_enqueue_style( 'figureground-genericons', 'genericons/genericons/genericons.css', array(), null );
}
add_action( 'enqueue_block_editor_assets', 'figureground_block_editor_styles' );

/**
 * Adjust content_width value for post-formatted posts.
 *
 * @since Figure/Ground 1.0
 *
 * @return void
 */
function figureground_content_width() {
	global $content_width;

	if ( has_post_format() ) {
		$content_width = 448;
	}
}
add_action( 'template_redirect', 'figureground_content_width' );

/**
 * Customize the excerpt display.
 */
function figureground_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	global $post;
	
	$title = sprintf ( __( 'Read more %s', 'figureground' ),
		'<span class="screen-reader-text">' . esc_html( get_the_title() ) .
		' </span><span class="meta-nav" aria-hidden="true"> &rarr;</span>' );

	return '&hellip;<div><a class="excerpt-more button" href="' . esc_url( get_permalink( $post->ID ) ) . '">' . $title . '</a></div>';
}
add_filter( 'excerpt_more', 'figureground_excerpt_more' );

function figureground_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 60;
}
add_filter( 'excerpt_length', 'figureground_excerpt_length' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Register theme options via the Customizer.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load custom styles for embeds.
 */
require get_template_directory() . '/inc/embed-styles.php';