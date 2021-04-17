<?php
/**
 * Figure/Ground Customizer Options
 *
 * @package Figure/Ground
 */

/**
 * Add theme options to the customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customize manager object.
 */
function figureground_customize_register( $wp_customize ) {
	// postMessage support for blog name and description.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add the archive content display setting and control, using a core section.
	$wp_customize->add_setting( 'archive_excerpt' , array(
		'default'			=> 'content',
		'transport'         => 'refresh',
		'sanitize_callback' => 'figureground_sanitize_archive_display',
	) );
	
	$wp_customize->add_control( 'archive_excerpt', array(
		'label'			=> __( 'Archive Views Display', 'figureground' ),
		'description'	=> __( 'Post content will be displayed as an excerpt or the full content on the home/blog page, date archives, and category/tag pages.', 'figureground' ),
		'section'		=> 'static_front_page',
		'type'			=> 'radio',
		'choices'		=> array(
			'content'	=> __( 'Full Content', 'figureground' ),
			'excerpt'		=> __( 'Excerpts', 'figureground' ),
		),
	) );

	// Add the footer/copyright information section, settings & controls.
	$wp_customize->add_section( 'footer' , array(
		'title'	   => __( 'Footer', 'figureground' ),
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'copy_name' , array(
		'default'	        => get_bloginfo( 'name' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_setting( 'powered_by_wp' , array(
		'default'	        => true,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'figureground_sanitize_checkbox',
	) );

	$wp_customize->add_setting( 'theme_meta' , array(
		'default'	        => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'figureground_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'copy_name', array(
		'label'   => __( 'Copyright Name', 'figureground' ),
		'section' => 'footer',
		'type'    => 'text',
	) );

	$wp_customize->add_control( 'powered_by_wp', array(
		'label'   => __( 'Proudly Powered By WordPress', 'figureground' ),
		'section' => 'footer',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_control( 'theme_meta', array(
		'label'   => __( 'Theme Information', 'figureground' ),
		'section' => 'footer',
		'type'    => 'checkbox',
	) );

	// Add the Figure/Ground section.
	$wp_customize->add_section( 'figure_ground' , array(
		'title'	      => __( 'Figure/Ground', 'figureground' ),
		'description' => __( 'These settings control the background animation. Try out the different modes, adjust the pattern scale, and tweak the speed or turn off the animation.', 'figureground' ),
		'priority'    => 60,
	) );

	// Add the Figure/Ground settings, which all support postMessage.
	$wp_customize->add_setting( 'fg_type' , array(
		'default'			=> 'rhombus',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'figureground_sanitize_type',
	) );

	$wp_customize->add_setting( 'fg_max_width' , array(
		'default'			=> 160,
		'transport'         => 'postMessage',
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_setting( 'fg_max_height' , array(
		'default'			=> 160,
		'transport'         => 'postMessage',
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_setting( 'fg_speed' , array(
		'default'			=> 0,
		'transport'         => 'postMessage',
		'sanitize_callback'	=> 'absint',
	) );

	$wp_customize->add_setting( 'fg_initial' , array(
		'default'			=> 320,
		'transport'         => 'postMessage',
		'sanitize_callback'	=> 'absint',
	) );

	// Add the color settings.
	$wp_customize->add_setting( 'fg_color_dark' , array(
		'default'     => '#222222',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'fg_color_light' , array(
		'default'     => '#f7f7ec',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'accent_color_light' , array(
		'default'     => '#87f',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'accent_color_dark' , array(
		'default'     => '#903',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	// Add the color customization controls.
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fg_color_light', array(
		'label'        => __( 'Figure/Ground Light Color', 'figureground' ),
		'section'    => 'colors',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fg_color_dark', array(
		'label'        => __( 'Figure/Ground Dark Color', 'figureground' ),
		'section'    => 'colors',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_light', array(
		'label'        => __( 'Light Accent Color', 'figureground' ),
		'section'    => 'colors',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color_dark', array(
		'label'        => __( 'Dark Accent Color', 'figureground' ),
		'section'    => 'colors',
	) ) );

	// Add the Figure/Ground controls.
	$wp_customize->add_control( 'fg_type', array(
		'label'		=> __( 'Pattern', 'figureground' ),
		'section'	=> 'figure_ground',
		'type'		=> 'radio',
		'choices'	=> array(
			'orthogonal'	=> __( 'Orthogonal', 'figureground' ),
			'circular'		=> __( 'Circular', 'figureground' ),
			'rhombus'		=> __( 'Rhombus', 'figureground' ),
		),
	) );

	$wp_customize->add_control( 'fg_max_width', array(
		'label'		  => __( 'Max Width', 'figureground' ),
		'section'	  => 'figure_ground',
		'type'        => 'range',
		'input_attrs' => array(
			'min'  => 16,
			'max'  => 512,
			'step' => 16,
		),
	) );

	$wp_customize->add_control( 'fg_max_height', array(
		'label'		  => __( 'Max Height', 'figureground' ),
		'section'	  => 'figure_ground',
		'type'        => 'range',
		'input_attrs' => array(
			'min'  => 16,
			'max'  => 512,
			'step' => 16,
		),
	) );

	$wp_customize->add_control( 'fg_speed', array(
		'label'		  => __( 'Speed', 'figureground' ),
		'description' => __( 'Delay between animations in milliseconds: lower is faster. To turn the animation off, set this to 0.', 'figureground' ),
		'section'	  => 'figure_ground',
		'type'      => 'range',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 6000,
			'step' => 300,
		),
	) );

	$wp_customize->add_control( 'fg_initial', array(
		'label'		=> __( 'Initial Density', 'figureground' ),
		'section'	=> 'figure_ground',
		'type'      => 'range',
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 640,
			'step' => 32,
		),
	) );

	// This filter allows the colors CSS to be generated from each of the separate settings and updated as needed.
	add_filter( 'theme_mod_figureground_colors_css', 'figureground_generate_colors_css' );

	// Partial refresh for better user experience (faster loading of changes).
	// This is a supplement to the initial postMessage setting update that handles PHP 
	// logic more complex than basic color swaps in the CSS (such as contrast ratios and generated colors).
	$wp_customize->selective_refresh->add_partial( 'figureground_colors', array(
		'selector'        => '#figureground-colors',
		'settings'        => array( 'fg_color_light', 'fg_color_dark', 'accent_color_light', 'accent_color_dark' ),
		'render_callback' => 'figureground_generate_colors_css',
	) );

	// Add selective refresh support for the title and tagline, and the footer options.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
	    'selector' => '.site-title a',
	    'render_callback' => 'figureground_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	    'selector' => '.site-description',
	    'render_callback' => 'figureground_customize_partial_blogdescription',
	) );
	$wp_customize->selective_refresh->add_partial( 'footer_credits', array(
	    'selector' => '.site-info',
		'settings' => array( 'copy_name', 'powered_by_wp', 'theme_meta' ),
	    'render_callback' => 'figureground_footer_credits',
	) );
}
add_action( 'customize_register', 'figureground_customize_register' );

// Contains functions that generate CSS for all color modification patterns.
require( 'color-patterns.php' );

/**
 * Returns the CSS output of the custom colors.
 *
 * @since Figure/Ground 1.0
 *
 * @return string
 */
function figureground_generate_colors_css() {
	return figureground_fg_colors_css() . figureground_accent_colors_css();
}

/**
 * Caches the CSS output of the custom colors.
 *
 * @since Figure/Ground 1.0
 *
 * @return void
 */
function figureground_rebuild_color_patterns() {
	set_theme_mod( 'figureground_colors_css', figureground_generate_colors_css() );
}
// Allow custom colors to work on child themes by not hardcoding "figureground".
$figureground_theme = get_stylesheet();
add_action( "update_option_theme_mods_$figureground_theme", 'figureground_rebuild_color_patterns' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function figureground_customize_preview_js() {
	wp_enqueue_script( 'figureground_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20200706', true );
}
add_action( 'customize_preview_init', 'figureground_customize_preview_js' );

/**
 * Sanitize the Figure/Ground type value.
 *
 * @since Figure/Ground 1.0
 *
 * @param string $layout Type.
 * @return string Filtered type (orthogonal|circular).
 */
function figureground_sanitize_type( $type ) {
	if ( ! in_array( $type, array( 'orthogonal', 'circular', 'rhombus' ) ) ) {
		$type = 'orthogonal';
	}

	return $type;
}

/**
 * Sanitize the archive display value.
 *
 * @since Figure/Ground 1.0
 *
 * @param string $layout Type.
 * @return string Filtered type (orthogonal|circular).
 */
function figureground_sanitize_archive_display( $type ) {
	if ( ! in_array( $type, array( 'content', 'excerpt' ) ) ) {
		$type = 'content';
	}

	return $type;
}
/**
 * Sanitize a checkbox input to 1 or 0.
 *
 * @since Figure/Ground 1.1
 *
 * @return void
 */
function figureground_sanitize_checkbox( $input ) {
    if ( $input ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Output the custom colors CSS in the <head>.
 *
 * @since Figure/Ground 1.0
 * @since Figure/Ground 1.1 Added colors as data- attributes in the customizer preview.
 */
function figureground_custom_colors_head() {
	$data = '';
	if ( is_customize_preview() ) {
		$colors = array(
			'fg_color_light' => '#f7f7ec',
			'fg_color_dark' => '#222222',
			'accent_color_light' => '#8877ff',
			'accent_color_dark' => '#990033',
		);
		foreach ( $colors as $color => $default ) {
			 $data .= ' data-' . $color . '="' . esc_attr( get_theme_mod( $color, $default ) ) . '"';
		}
	}
	echo '<style type="text/css" id="figureground-colors"' . $data . '>' .
		get_theme_mod( 'figureground_colors_css', '' ) .
	'</style>';
}
add_action( 'wp_head', 'figureground_custom_colors_head' );

/**
 * Filter the body classes to add the circular class based on theme option.
 *
 * @since Figure/Ground 1.0
 *
 * @param array $classes Body classes.
 * @return array Filtered body classes.
 */
function figureground_customizer_body_class( $classes ) {
	if ( 'circular' === get_theme_mod( 'fg_type', 'orthogonal' ) ) {
		$classes[] = 'circular';
	} elseif ( 'rhombus' === get_theme_mod( 'fg_type', 'orthogonal' ) ) {
		$classes[] = 'rhombus';
	}

	return $classes;
}
add_filter( 'body_class', 'figureground_customizer_body_class' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @since Figure/Ground 1.2
 * @see figureground_customize_register()
 *
 * @return void
 */
function figureground_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Figure/Ground 1.2
 * @see figureground_customize_register()
 *
 * @return void
 */
function figureground_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
