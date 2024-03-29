<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once EXS_THEME_PATH . '/inc/customizer/class-exs-block-extra-button-control.php';
require_once EXS_THEME_PATH . '/inc/customizer/class-exs-block-heading-control.php';
require_once EXS_THEME_PATH . '/inc/customizer/class-exs-slider-control.php';
require_once EXS_THEME_PATH . '/inc/customizer/class-exs-dropdown-category-control.php';
require_once EXS_THEME_PATH . '/inc/customizer/class-exs-hidden-customize-control.php';
require_once EXS_THEME_PATH . '/inc/customizer/class-exs-customizer.php';
require_once EXS_THEME_PATH . '/inc/customizer/customizer-woocommerce.php';
require_once EXS_THEME_PATH . '/inc/customizer/customizer-helpers.php';

//customizer theme settings
if ( ! function_exists( 'exs_customizer_settings_array' ) ) :
	function exs_customizer_settings_array() {
		return apply_filters(
			'exs_customizer_options',
			//panels -> sections -> settings
			array(
				//////////////////////
				//registering panels//
				//////////////////////
				'panel_theme'                           => array(
					'type'            => 'panel',
					'label'           => esc_html__( 'ExS Theme options', 'exs' ),
					'description'     => esc_html__( 'Theme specific options', 'exs' ),
					'priority'        => 130,
					'active_callback' => '',
				),
				////////////////////////
				//registering sections//
				////////////////////////
				/*
				make sure that you have appropriate panel registered above
				otherwise do not pass 'panel' key
				*/
				//global settings preset. It will change multiple options over 'Theme options' panel
				'section_presets'                       => array(
					'type'            => 'section',
					'panel'           => 'panel_theme',
					'label'           => esc_html__( 'Theme Presets', 'exs' ),
					'description'     => esc_html__( 'Customizer options presets. Will change multiple options over \'Theme options\' Customizer panel', 'exs' ),
					'priority'        => 100,
					'active_callback' => '__return_false',
				),
				'section_skins'                         => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Theme Skins', 'exs' ),
					'description' => esc_html__( 'Change your theme skins CSS and manage your JS files', 'exs' ),
					'priority'    => 100,
				),
				'section_layout'                        => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Theme Layout', 'exs' ),
					'description' => esc_html__( 'Site layout options', 'exs' ),
					'priority'    => 100,
				),
				'section_buttons'                       => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Theme Buttons', 'exs' ),
					'description' => esc_html__( 'Buttons options', 'exs' ),
					'priority'    => 100,
				),
				'section_meta'                          => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Theme Meta', 'exs' ),
					'description' => esc_html__( 'Email, phone, address etc. Appears in various template parts depending from choosen sections layout', 'exs' ),
					'priority'    => 100,
				),
				'section_side_nav'                      => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Side Menu', 'exs' ),
					'description' => esc_html__( 'Side menu options. Please add menu or widgets to \'Side Menu\' position to display side menu on your site', 'exs' ),
					'priority'    => 100,
				),
				//template parts layout sections
				'section_header'                        => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Header Section', 'exs' ),
					'description' => esc_html__( 'Choose header options', 'exs' ),
					'priority'    => 100,
				),
				'section_title'                         => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Title Section', 'exs' ),
					'description' => esc_html__( 'Choose title options. Yoast SEO plugin required for breadcrumbs', 'exs' ),
					'priority'    => 100,
				),
				'section_main'                          => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Main Section', 'exs' ),
					'description' => esc_html__( 'Choose main section options', 'exs' ),
					'priority'    => 100,
				),
				'section_footer_top'                    => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Top Footer Section', 'exs' ),
					'description' => esc_html__( 'Choose top footer section options', 'exs' ),
					'priority'    => 100,
				),
				'section_footer'                        => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Footer Section', 'exs' ),
					'description' => esc_html__( 'Choose footer options', 'exs' ),
					'priority'    => 100,
				),
				'section_copyright'                     => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Copyright Section', 'exs' ),
					'description' => esc_html__( 'Choose copyright options', 'exs' ),
					'priority'    => 100,
				),
				'section_blog'                          => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Blog', 'exs' ),
					'description' => esc_html__( 'Blog display options', 'exs' ),
					'priority'    => 100,
				),
				'section_blog_post'                     => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Single Post', 'exs' ),
					'description' => esc_html__( 'Single post display options', 'exs' ),
					'priority'    => 100,
				),
				'section_search'                        => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Search Results', 'exs' ),
					'description' => esc_html__( 'Search results display options', 'exs' ),
					'priority'    => 100,
				),
				'section_404'                           => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( '404 page', 'exs' ),
					'description' => esc_html__( '404 page options', 'exs' ),
					'priority'    => 100,
				),
				'section_typography'                    => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Typography', 'exs' ),
					'description' => esc_html__( 'Set global typography settings', 'exs' ),
					'priority'    => 100,
				),
				'section_fonts'                         => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Google Fonts', 'exs' ),
					'description' => esc_html__( 'Choose Google fonts', 'exs' ),
					'priority'    => 100,
				),
				'section_special_categories'            => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Services, Portfolio, Team', 'exs' ),
					'description' => esc_html__( 'Choose separate categories for displaying Services, Portfolio, Team. They will be removed from regular blog displaying', 'exs' ),
					'priority'    => 100,
				),
				'section_animation'                     => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Animation', 'exs' ),
					'description' => esc_html__( 'You can select elements that you want to animate on your page', 'exs' ),
					'priority'    => 100,
				),
				'section_contact_messages'              => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Contact forms messages', 'exs' ),
					'description' => esc_html__( 'Set your messages for ExS ajax contact form patterns', 'exs' ),
					'priority'    => 100,
				),
				'section_messages'                      => array(
					'type'        => 'section',
					'panel'       => 'panel_theme',
					'label'       => esc_html__( 'Popup messages', 'exs' ),
					'description' => esc_html__( 'You can set popup messages that will appear at the top and at the bottom of your site', 'exs' ),
					'priority'    => 100,
				),
				///////////////////////
				//registering options//
				///////////////////////
				/*
				make sure that you have registered appropriate section above
				or used default sections as 'section' key's value:
					'title_tagline' - Site Title & Tagline
					'colors' - Colors
					'header_image' - Header Image
					'background_image' - Background Image
					'nav' - Navigation
					'static_front_page' - Static Front Page
				*/
				/*
				available types:
					'checkbox'
					'color'
					'dropdown-pages'
					'file'
					'image'
					'radio'
					'select'
					'text'
					'textarea'
					'url'
					'dropdown-category' - our custom dropdown
					'block-heading' - our custom block heading
					'hidden-option' - our custom hidden option
				make sure that you have provide an array with 'choices' key for 'select' and 'radio':
					'choices' => array(
						'choice_1' => esc_html__( 'Choice 1', 'exs' ),
						...
					)
				*/
				//////////////////////
				//Hidden Demo Number//
				//////////////////////
				'demo_number'                           => array(
					'type'    => 'hidden-option',
					'section' => 'section_presets',
					'default' => esc_html( exs_option( 'demo_number', '' ) ),
				),
				//////////
				//colors//
				//////////
				//see _variables.scss
				//see options.php for defaults
				// colorLight
				// colorFont
				// colorFontMuted
				// colorBackground
				// colorBorder
				// colorDark
				// colorDarkMuted
				// colorMain
				// colorMain2
				'colorLight'                            => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Light color', 'exs' ),
					'default'     => esc_html( exs_option( 'colorLight', '#ffffff' ) ),
					'description' => esc_html__( 'Using as a background for light sections and as a font color in inversed sections.', 'exs' ),
				),
				'colorFont'                             => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Font color', 'exs' ),
					'default'     => esc_html( exs_option( 'colorFont', '#555555' ) ),
					'description' => esc_html__( 'Using as a font color.', 'exs' ),
				),
				'colorFontMuted'                        => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Font muted color', 'exs' ),
					'default'     => esc_html( exs_option( 'colorFontMuted', '#666666' ) ),
					'description' => esc_html__( 'Using as a font muted color.', 'exs' ),
				),
				'colorBackground'                       => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Light grey background color', 'exs' ),
					'default'     => esc_html( exs_option( 'colorBackground', '#f7f7f7' ) ),
					'description' => esc_html__( 'Using as a light grey background.', 'exs' ),
				),
				'colorBorder'                           => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Grey border color', 'exs' ),
					'default'     => esc_html( exs_option( 'colorBorder', '#e1e1e1' ) ),
					'description' => esc_html__( 'Using as a border color.', 'exs' ),
				),
				'colorDark'                             => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Dark color', 'exs' ),
					'default'     => esc_html( exs_option( 'colorDark', '#444444' ) ),
					'description' => esc_html__( 'Using as a links color for light sections and as a background for inversed sections.', 'exs' ),
				),
				'colorDarkMuted'                        => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Darker color', 'exs' ),
					'default'     => esc_html( exs_option( 'colorDarkMuted', '#222222' ) ),
					'description' => esc_html__( 'Using as headings color and a background for darker inversed sections.', 'exs' ),
				),
				'colorMain'                             => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Main accent color #1', 'exs' ),
					'default'     => esc_html( exs_option( 'colorMain', '#148BCC' ) ),
					'description' => esc_html__( 'Using as a main accent color.', 'exs' ),
				),
				'colorMain2'                            => array(
					'type'        => 'color',
					'section'     => 'colors',
					'label'       => esc_html__( 'Main accent color #2', 'exs' ),
					'default'     => esc_html( exs_option( 'colorMain2', '#428AB2' ) ),
					'description' => esc_html__( 'Using as a main accent second color.', 'exs' ),
				),
				'color_meta_icons'                      => array(
					'type'    => 'select',
					'section' => 'colors',
					'label'   => esc_html__( 'Color for icons in post meta', 'exs' ),
					'default' => esc_html( exs_option( 'color_meta_icons', '' ) ),
					'choices' => array(
						''                      => esc_html__( 'Default', 'exs' ),
						'meta-icons-main'       => esc_html__( 'Accent color', 'exs' ),
						'meta-icons-main2'      => esc_html__( 'Accent color 2', 'exs' ),
						'meta-icons-border'     => esc_html__( 'Borders color', 'exs' ),
						'meta-icons-dark'       => esc_html__( 'Dark color', 'exs' ),
						'meta-icons-dark-muted' => esc_html__( 'Darker color', 'exs' ),
					),
				),
				///////////////////////////
				//homepage slider section//
				///////////////////////////
				// static_front_page
				'intro_block_heading'                   => array(
					'type'        => 'block-heading',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Intro Section', 'exs' ),
					'description' => esc_html__( 'Set your settings for homepage intro section. Leave blank if not needed.', 'exs' ),
				),
				'intro_position'                        => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Section Position', 'exs' ),
					'default' => esc_html( exs_option( 'intro_position', '' ) ),
					'choices' => array(
						''       => esc_html__( 'Hidden', 'exs' ),
						'before' => esc_html__( 'Before header', 'exs' ),
						'after'  => esc_html__( 'After header', 'exs' ),
					),
				),
				'intro_layout'                          => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Section Layout', 'exs' ),
					'default' => esc_html( exs_option( 'intro_layout', '' ) ),
					'choices' => array(
						''             => esc_html__( 'Background image', 'exs' ),
						'image-left'   => esc_html__( 'Left side image', 'exs' ),
						'image-right'  => esc_html__( 'Right side image', 'exs' ),
						'image-top'    => esc_html__( 'Top image', 'exs' ),
						'image-bottom' => esc_html__( 'Bottom image', 'exs' ),
					),
				),
				'intro_fullscreen'                      => array(
					'type'    => 'checkbox',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Full Screen Intro Height', 'exs' ),
					'default' => esc_html( exs_option( 'intro_fullscreen', false ) ),
				),
				'intro_background'                      => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Section Background', 'exs' ),
					'default' => esc_html( exs_option( 'intro_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'intro_background_image'                => array(
					'type'    => 'image',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Section Image', 'exs' ),
					'default' => esc_html( exs_option( 'intro_background_image', '' ) ),
				),
				'intro_image_animation'                 => array(
					'type'        => 'select',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Animation for intro image', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => esc_html( exs_option( 'intro_image_animation', '' ) ),
					'choices'     => exs_get_animation_options(),
				),
				'intro_background_image_cover'          => array(
					'type'    => 'checkbox',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Cover background image', 'exs' ),
					'default' => esc_html( exs_option( 'intro_background_image_cover', false ) ),
				),
				'intro_background_image_fixed'          => array(
					'type'    => 'checkbox',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Fixed background image', 'exs' ),
					'default' => esc_html( exs_option( 'intro_background_image_fixed', false ) ),
				),
				'intro_background_image_overlay'        => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Overlay for background image', 'exs' ),
					'default' => esc_html( exs_option( 'intro_background_image_overlay', '' ) ),
					'choices' => exs_customizer_background_overlay_array(),
				),
				'intro_heading'                         => array(
					'type'    => 'text',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Section Heading text', 'exs' ),
					'default' => esc_html( exs_option( 'intro_heading', '' ) ),
				),
				'intro_heading_mt'                      => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Heading top margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_heading_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'intro_heading_mb'                      => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Heading bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_heading_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'intro_heading_animation'               => array(
					'type'        => 'select',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Animation for intro heading', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => esc_html( exs_option( 'intro_heading_animation', '' ) ),
					'choices'     => exs_get_animation_options(),
				),
				'intro_description'                     => array(
					'type'    => 'textarea',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Section description text', 'exs' ),
					'default' => esc_html( exs_option( 'intro_description', '' ) ),
				),
				'intro_description_mt'                  => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Description top margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_description_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'intro_description_mb'                  => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Description bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_description_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'intro_description_animation'           => array(
					'type'        => 'select',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Animation for intro description text', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => esc_html( exs_option( 'intro_description_animation', '' ) ),
					'choices'     => exs_get_animation_options(),
				),
				'intro_button_text_first'               => array(
					'type'    => 'text',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Primary Action Button Text', 'exs' ),
					'default' => esc_html( exs_option( 'intro_button_text_first', '' ) ),
				),
				'intro_button_url_first'                => array(
					'type'    => 'url',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Primary Action Button URL', 'exs' ),
					'default' => esc_html( exs_option( 'intro_button_url_first', '' ) ),
				),
				'intro_button_first_animation'          => array(
					'type'        => 'select',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Animation for first intro button', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => esc_html( exs_option( 'intro_button_first_animation', '' ) ),
					'choices'     => exs_get_animation_options(),
				),
				'intro_button_text_second'              => array(
					'type'    => 'text',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Secondary Action Button Text', 'exs' ),
					'default' => esc_html( exs_option( 'intro_button_text_second', '' ) ),
				),
				'intro_button_url_second'               => array(
					'type'    => 'url',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Secondary Action Button URL', 'exs' ),
					'default' => esc_html( exs_option( 'intro_button_url_second', '' ) ),
				),
				'intro_button_second_animation'         => array(
					'type'        => 'select',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Animation for second intro button', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => esc_html( exs_option( 'intro_button_second_animation', '' ) ),
					'choices'     => exs_get_animation_options(),
				),
				'intro_buttons_mt'                      => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Buttons top margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_buttons_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'intro_buttons_mb'                      => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Buttons bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_buttons_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'intro_shortcode'                       => array(
					'type'        => 'text',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Intro Section Shortcode', 'exs' ),
					'description' => esc_html__( 'You can put shortcode here. It will appear below Intro description', 'exs' ),
					'default'     => esc_html( exs_option( 'intro_shortcode', '' ) ),
				),
				'intro_shortcode_mt'                    => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Shortcode top margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_shortcode_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'intro_shortcode_mb'                    => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Shortcode bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'intro_shortcode_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'intro_shortcode_animation'             => array(
					'type'        => 'select',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Animation for intro shortcode', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => esc_html( exs_option( 'intro_shortcode_animation', '' ) ),
					'choices'     => exs_get_animation_options(),
				),
				'intro_alignment'                       => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Section Text Alignment', 'exs' ),
					'default' => esc_html( exs_option( 'intro_alignment', 'text-left' ) ),
					'choices' => array(
						'text-left'   => esc_html__( 'Left', 'exs' ),
						'text-center' => esc_html__( 'Centered', 'exs' ),
						'text-right'  => esc_html__( 'Right', 'exs' ),
					),
				),
				'intro_extra_padding_top'               => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro section top padding', 'exs' ),
					'default' => esc_html( exs_option( 'intro_extra_padding_top', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pt-0'  => esc_html__( '0', 'exs' ),
						'pt-1'  => esc_html__( '1em', 'exs' ),
						'pt-2'  => esc_html__( '2em', 'exs' ),
						'pt-3'  => esc_html__( '3em', 'exs' ),
						'pt-4'  => esc_html__( '4em', 'exs' ),
						'pt-5'  => esc_html__( '5em', 'exs' ),
						'pt-6'  => esc_html__( '6em', 'exs' ),
						'pt-7'  => esc_html__( '7em', 'exs' ),
						'pt-8'  => esc_html__( '8em', 'exs' ),
						'pt-9'  => esc_html__( '9em', 'exs' ),
						'pt-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'intro_extra_padding_bottom'            => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro section bottom padding', 'exs' ),
					'default' => esc_html( exs_option( 'intro_extra_padding_bottom', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pb-0'  => esc_html__( '0', 'exs' ),
						'pb-1'  => esc_html__( '1em', 'exs' ),
						'pb-2'  => esc_html__( '2em', 'exs' ),
						'pb-3'  => esc_html__( '3em', 'exs' ),
						'pb-4'  => esc_html__( '4em', 'exs' ),
						'pb-5'  => esc_html__( '5em', 'exs' ),
						'pb-6'  => esc_html__( '6em', 'exs' ),
						'pb-7'  => esc_html__( '7em', 'exs' ),
						'pb-8'  => esc_html__( '8em', 'exs' ),
						'pb-9'  => esc_html__( '9em', 'exs' ),
						'pb-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'intro_show_search'                     => array(
					'type'    => 'checkbox',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Show search form', 'exs' ),
					'default' => esc_html( exs_option( 'intro_show_search', false ) ),
				),
				'intro_font_size'                       => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro section font size', 'exs' ),
					'default' => esc_html( exs_option( 'intro_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				/////////////////
				//intro teasers//
				/////////////////
				'intro_teasers_block_heading'           => array(
					'type'        => 'block-heading',
					'section'     => 'static_front_page',
					'label'       => esc_html__( 'Teasers settigns', 'exs' ),
					'description' => esc_html__( 'You can show teasers on your homepage at the top of your main section. Leave blank if not needed.', 'exs' ),
				),
				'intro_teaser_section_layout'           => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Layout for intro teasers section', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_section_layout', '' ) ),
					'choices' => array(
						''                            => esc_html__( 'Disabled', 'exs' ),
						'container'                   => esc_html__( 'Container width', 'exs' ),
						'container-fluid'             => esc_html__( 'Full width', 'exs' ),
						'container top-overlap'       => esc_html__( 'Container width top overlap', 'exs' ),
						'container-fluid top-overlap' => esc_html__( 'Full width top overlap', 'exs' ),
					),
				),
				'intro_teaser_section_background'       => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Teasers Section Background', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_section_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'intro_teaser_section_padding_top'      => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Teasers Section top padding', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_section_padding_top', '' ) ),
					'choices' => array(
						''     => esc_html__( 'None', 'exs' ),
						'pt-1' => esc_html__( '1em', 'exs' ),
						'pt-2' => esc_html__( '2em', 'exs' ),
						'pt-3' => esc_html__( '3em', 'exs' ),
						'pt-4' => esc_html__( '4em', 'exs' ),
						'pt-5' => esc_html__( '5em', 'exs' ),
					),
				),
				'intro_teaser_section_padding_bottom'   => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Teasers Section bottom padding', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_section_padding_bottom', '' ) ),
					'choices' => array(
						''     => esc_html__( 'None', 'exs' ),
						'pb-1' => esc_html__( '1em', 'exs' ),
						'pb-2' => esc_html__( '2em', 'exs' ),
						'pb-3' => esc_html__( '3em', 'exs' ),
						'pb-4' => esc_html__( '4em', 'exs' ),
						'pb-5' => esc_html__( '5em', 'exs' ),
					),
				),
				'intro_teaser_font_size'                => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Teasers section font size', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'intro_teaser_layout'                   => array(
					'type'    => 'select',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Layout for intro teasers', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_layout', '' ) ),
					'choices' => array(
						''            => esc_html__( 'Vertical', 'exs' ),
						'text-center' => esc_html__( 'Vertical Centered', 'exs' ),
						'horizontal'  => esc_html__( 'Horizontal', 'exs' ),
					),
				),
				'intro_teaser_heading'                  => array(
					'type'    => 'text',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Teasers Heading text', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_heading', '' ) ),
				),
				'intro_teaser_description'              => array(
					'type'    => 'textarea',
					'section' => 'static_front_page',
					'label'   => esc_html__( 'Intro Teasers description text', 'exs' ),
					'default' => esc_html( exs_option( 'intro_teaser_description', '' ) ),
				),
				////////
				//logo//
				////////
				//to existing 'title_tagline' section
				'logo'                                  => array(
					'type'    => 'select',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Logo Layout', 'exs' ),
					'default' => esc_html( exs_option( 'logo', '' ) ),
					'choices' => array(
						'1' => esc_html__( 'Left image and right text', 'exs' ),
						'2' => esc_html__( 'Top image and bottom text', 'exs' ),
						'3' => esc_html__( 'Image between text', 'exs' ),
					),
				),
				'logo_text_primary'                     => array(
					'type'    => 'text',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Logo Primary Text', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_primary', '' ) ),
				),
				'logo_text_primary_fs'                            => array(
					'type'    => 'slider',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Primary Text Font Size', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_primary_fs', '' ) ),
					'description' => esc_html__( 'It will be applied to logo primary text. Value in pixels', 'exs' ),
					'atts'        => array(
						'min'         => '9',
						'max'         => '22',
						'step'        => '1',
					),
				),
				'logo_text_primary_fs_xl'                            => array(
					'type'    => 'slider',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Primary Text Font Size for Large Screens', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_primary_fs_xl', '' ) ),
					'description' => esc_html__( 'It will be applied to logo primary text for screens larger then 1200px. Value in pixels', 'exs' ),
					'atts'        => array(
						'min'         => '9',
						'max'         => '22',
						'step'        => '1',
					),
				),
				'logo_text_primary_hidden'                    => array(
					'type'    => 'select',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Hide logo primary text on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_primary_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),
				'logo_text_secondary'                   => array(
					'type'    => 'text',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Logo Secondary Text', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_secondary', '' ) ),
				),
				'logo_text_secondary_fs'                            => array(
					'type'    => 'slider',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Primary Text Font Size', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_secondary_fs', '' ) ),
					'description' => esc_html__( 'It will be applied to logo secondary text. Value in pixels', 'exs' ),
					'atts'        => array(
						'min'         => '9',
						'max'         => '22',
						'step'        => '1',
					),
				),
				'logo_text_secondary_fs_xl'                            => array(
					'type'    => 'slider',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Primary Text Font Size for Large Screens', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_secondary_fs_xl', '' ) ),
					'description' => esc_html__( 'It will be applied to logo secondary text for screens larger then 1200px. Value in pixels', 'exs' ),
					'atts'        => array(
						'min'         => '9',
						'max'         => '22',
						'step'        => '1',
					),
				),
				'logo_text_secondary_hidden'            => array(
					'type'    => 'select',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Hide logo secondary text on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'logo_text_secondary_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),
				'header_top_tall'                       => array(
					'type'        => 'checkbox',
					'section'     => 'title_tagline',
					'label'       => esc_html__( 'Logo additional vertical padding', 'exs' ),
					'description' => esc_html__( 'Will make header taller in top position', 'exs' ),
					'default'     => esc_html( exs_option( 'header_top_tall', false ) ),
				),
				'logo_background'                       => array(
					'type'    => 'select',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Logo Background', 'exs' ),
					'default' => esc_html( exs_option( 'logo_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'logo_padding_horizontal'               => array(
					'type'        => 'checkbox',
					'section'     => 'title_tagline',
					'label'       => esc_html__( 'Logo additional horizontal padding', 'exs' ),
					'description' => esc_html__( 'This will add an extra horizontal padding for logo', 'exs' ),
					'default'     => esc_html( exs_option( 'logo_padding_horizontal', false ) ),
				),
				////////////////////
				//skins and assets//
				////////////////////
				'skins_extra'                           => array(
					'type'        => 'extra-button',
					'label'       => esc_html__( 'Site skins', 'exs' ),
					'description' => esc_html__( 'Change your site look and feel without changing your theme with growing number of CSS skins in your Customizer', 'exs' ),
					'section'     => 'section_skins',
				),
				////////////////////
				//layout and skins//
				////////////////////
				'main_container_width'                  => array(
					'type'        => 'radio',
					'section'     => 'section_layout',
					'label'       => esc_html__( 'Global container max width', 'exs' ),
					'default'     => esc_html( exs_option( 'main_container_width', '1140' ) ),
					'description' => esc_html__( 'Can be overridden by different page template', 'exs' ),
					'choices' => array(
						'1400' => esc_html__( '1400px', 'exs' ),
						'1140' => esc_html__( '1140px', 'exs' ),
						'960'  => esc_html__( '960px', 'exs' ),
						'720'  => esc_html__( '720px', 'exs' ),
					),
				),
				'blog_container_width'                  => array(
					'type'    => 'radio',
					'section' => 'section_layout',
					'label'   => esc_html__( 'Archive container max width', 'exs' ),
					'default' => esc_html( exs_option( 'blog_container_width', '' ) ),
					'choices' => array(
						''     => esc_html__( 'Inherit from Global', 'exs' ),
						'1400' => esc_html__( '1400px', 'exs' ),
						'1140' => esc_html__( '1140px', 'exs' ),
						'960'  => esc_html__( '960px', 'exs' ),
						'720'  => esc_html__( '720px', 'exs' ),
					),
				),
				'blog_single_container_width'           => array(
					'type'    => 'radio',
					'section' => 'section_layout',
					'label'   => esc_html__( 'Single post container max width', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_container_width', '' ) ),
					'choices' => array(
						''     => esc_html__( 'Inherit from Global', 'exs' ),
						'1400' => esc_html__( '1400px', 'exs' ),
						'1140' => esc_html__( '1140px', 'exs' ),
						'960'  => esc_html__( '960px', 'exs' ),
						'720'  => esc_html__( '720px', 'exs' ),
					),
				),
				'search_container_width'               => array(
					'type'    => 'radio',
					'section' => 'section_layout',
					'label'   => esc_html__( 'Search results container max width', 'exs' ),
					'default' => esc_html( exs_option( 'search_container_width', '' ) ),
					'choices' => array(
						''     => esc_html__( 'Inherit from Global', 'exs' ),
						'1400' => esc_html__( '1400px', 'exs' ),
						'1140' => esc_html__( '1140px', 'exs' ),
						'960'  => esc_html__( '960px', 'exs' ),
						'720'  => esc_html__( '720px', 'exs' ),
					),
				),
				'preloader'                             => array(
					'type'     => 'select',
					'section'  => 'section_layout',
					'label'    => esc_html__( 'Page preloader', 'exs' ),
					'default'  => esc_html( exs_option( 'preloader', '' ) ),
					'priority' => 200,
					'choices'  => array(
						''       => esc_html__( 'No preloader', 'exs' ),
						'cover'  => esc_html__( 'Cover page preloader', 'exs' ),
						'corner' => esc_html__( 'Corner page preloader', 'exs' ),
					),
				),
				'box_fade_in'                           => array(
					'type'     => 'checkbox',
					'section'  => 'section_layout',
					'label'    => esc_html__( 'Fade in page on load', 'exs' ),
					'default'  => esc_html( exs_option( 'box_fade_in', '' ) ),
					'priority' => 200,
				),
				'totop'                                 => array(
					'type'     => 'checkbox',
					'section'  => 'section_layout',
					'label'    => esc_html__( 'Enable page \'to top\' button', 'exs' ),
					'default'  => esc_html( exs_option( 'totop', '' ) ),
					'priority' => 200,
				),
				'assets_lightbox'                            => array(
					'type'            => 'checkbox',
					'section'         => 'section_layout',
					'label'           => esc_html__( 'Load LightBox for galleries and YouTube video links', 'exs' ),
					'description'     => esc_html__( 'If checked will loads additional LightBox JS and CSS files to open images and YouTube video links in the LightBox PopUp', 'exs' ),
					'default'         => exs_option( 'assets_lightbox', false ),
				),
				//always min assets for best performance
				'assets_min'                            => array(
					'type'            => 'checkbox',
					'section'         => 'section_layout',
					'label'           => esc_html__( 'Use minified version of CSS files', 'exs' ),
					'description'     => esc_html__( 'You can use compressed versions of your static files for best performance', 'exs' ),
					'default'         => exs_option( 'assets_min', false ),
				),
				'post_thumbnails_fullwidth'             => array(
					'type'        => 'checkbox',
					'section'     => 'section_layout',
					'label'       => esc_html__( 'Make post thumbnails full width', 'exs' ),
					'description' => esc_html__( 'If your featured images are narrower than post width, they will be stretched', 'exs' ),
					'default'     => esc_html( exs_option( 'post_thumbnails_fullwidth', '' ) ),
					'priority'    => 200,
				),
				///////////
				//buttons//
				///////////
				'buttons_uppercase'                     => array(
					'type'    => 'checkbox',
					'section' => 'section_buttons',
					'label'   => esc_html__( 'Uppercase buttons', 'exs' ),
					'default' => esc_html( exs_option( 'buttons_uppercase', '' ) ),
				),
				'buttons_bold'                          => array(
					'type'    => 'checkbox',
					'section' => 'section_buttons',
					'label'   => esc_html__( 'Bold text buttons', 'exs' ),
					'default' => esc_html( exs_option( 'buttons_bold', '' ) ),
				),
				'buttons_colormain'                     => array(
					'type'    => 'checkbox',
					'section' => 'section_buttons',
					'label'   => esc_html__( 'Accent color buttons', 'exs' ),
					'default' => esc_html( exs_option( 'buttons_colormain', '' ) ),
				),
				'buttons_outline'                       => array(
					'type'    => 'checkbox',
					'section' => 'section_buttons',
					'label'   => esc_html__( 'Outlined buttons', 'exs' ),
					'default' => esc_html( exs_option( 'buttons_outline', '' ) ),
				),
				'buttons_big'                           => array(
					'type'    => 'checkbox',
					'section' => 'section_buttons',
					'label'   => esc_html__( 'Bigger buttons', 'exs' ),
					'default' => esc_html( exs_option( 'buttons_big', '' ) ),
				),
				'buttons_radius'                        => array(
					'type'    => 'select',
					'section' => 'section_buttons',
					'label'   => esc_html__( 'Border radius', 'exs' ),
					'default' => esc_html( exs_option( 'buttons_radius', '' ) ),
					'choices' => array(
						''             => esc_html__( 'Default', 'exs' ),
						'btns-rounded' => esc_html__( 'Rounded corners', 'exs' ),
						'btns-round'   => esc_html__( 'Round corners', 'exs' ),
					),
				),
				'buttons_fs'                            => array(
					'type'    => 'select',
					'section' => 'section_buttons',
					'label'   => esc_html__( 'Font Size', 'exs' ),
					'default' => esc_html( exs_option( 'buttons_fs', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				////////
				//meta//
				////////
				'meta_email'                            => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Email', 'exs' ),
					'default' => esc_html( exs_option( 'meta_email', '' ) ),
				),
				'meta_email_label'                      => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Email label', 'exs' ),
					'default' => esc_html( exs_option( 'meta_email_label', '' ) ),
				),
				'meta_phone'                            => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Phone', 'exs' ),
					'default' => esc_html( exs_option( 'meta_phone', '' ) ),
				),
				'meta_phone_label'                      => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Phone label', 'exs' ),
					'default' => esc_html( exs_option( 'meta_phone_label', '' ) ),
				),
				'meta_address'                          => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Address', 'exs' ),
					'default' => esc_html( exs_option( 'meta_address', '' ) ),
				),
				'meta_address_label'                    => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Address label', 'exs' ),
					'default' => esc_html( exs_option( 'meta_address_label', '' ) ),
				),
				'meta_opening_hours'                    => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Opening hours', 'exs' ),
					'default' => esc_html( exs_option( 'meta_opening_hours', '' ) ),
				),
				'meta_opening_hours_label'              => array(
					'type'    => 'text',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Opening hours label', 'exs' ),
					'default' => esc_html( exs_option( 'meta_opening_hours_label', '' ) ),
				),
				//social links
				'meta_facebook'                         => array(
					'type'    => 'url',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Facebook URL', 'exs' ),
					'default' => esc_html( exs_option( 'meta_facebook', '' ) ),
				),
				'meta_twitter'                          => array(
					'type'    => 'url',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Twitter URL', 'exs' ),
					'default' => esc_html( exs_option( 'meta_twitter', '' ) ),
				),
				'meta_youtube'                          => array(
					'type'    => 'url',
					'section' => 'section_meta',
					'label'   => esc_html__( 'YouTube URL', 'exs' ),
					'default' => esc_html( exs_option( 'meta_youtube', '' ) ),
				),
				'meta_instagram'                        => array(
					'type'    => 'url',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Instagram URL', 'exs' ),
					'default' => esc_html( exs_option( 'meta_instagram', '' ) ),
				),
				'meta_pinterest'                        => array(
					'type'    => 'url',
					'section' => 'section_meta',
					'label'   => esc_html__( 'Pinterest URL', 'exs' ),
					'default' => esc_html( exs_option( 'meta_pinterest', '' ) ),
				),
				'meta_linkedin'                         => array(
					'type'    => 'url',
					'section' => 'section_meta',
					'label'   => esc_html__( 'LinkedIn URL', 'exs' ),
					'default' => esc_html( exs_option( 'meta_linkedin', '' ) ),
				),
				'meta_github'                           => array(
					'type'    => 'url',
					'section' => 'section_meta',
					'label'   => esc_html__( 'GitHub URL', 'exs' ),
					'default' => esc_html( exs_option( 'meta_github', '' ) ),
				),
				/////////////
				//side menu//
				/////////////
				'side_extra'                            => array(
					'type'        => 'extra-button',
					'label'       => esc_html__( 'Side panel (menu)', 'exs' ),
					'description' => esc_html__( 'Set your side menu, make it always visible for large screens and many more in your Customizer', 'exs' ),
					'section'     => 'section_side_nav',
				),
				//////////
				//header//
				//////////
				//header image options
				//section 'header_image'
				'header_image_background_image_cover'   => array(
					'type'    => 'checkbox',
					'section' => 'header_image',
					'label'   => esc_html__( 'Cover background image', 'exs' ),
					'default' => esc_html( exs_option( 'header_image_background_image_cover', false ) ),
				),
				'header_image_background_image_fixed'   => array(
					'type'    => 'checkbox',
					'section' => 'header_image',
					'label'   => esc_html__( 'Fixed background image', 'exs' ),
					'default' => esc_html( exs_option( 'header_image_background_image_fixed', false ) ),
				),
				'header_image_background_image_overlay' => array(
					'type'    => 'select',
					'section' => 'header_image',
					'label'   => esc_html__( 'Overlay for background image', 'exs' ),
					'default' => esc_html( exs_option( 'header_image_background_image_overlay', '' ) ),
					'choices' => exs_customizer_background_overlay_array(),
				),
				//header
				'header'                                => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Header Layout', 'exs' ),
					'default' => esc_html( exs_option( 'header', '1' ) ),
					'choices' => array(
						''  => esc_html__( 'Disabled', 'exs' ),
						'1' => esc_html__( 'Left logo and right menu', 'exs' ),
						'2' => esc_html__( 'Top centered logo and bottom menu', 'exs' ),
						'3' => esc_html__( 'Top left logo and bottom menu', 'exs' ),
						'4' => esc_html__( 'Topline inside header section', 'exs' ),
					),
				),
				'header_logo_hidden'                    => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Hide logo in header section on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'header_logo_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),
				'header_fluid'                          => array(
					'type'    => 'checkbox',
					'section' => 'section_header',
					'label'   => esc_html__( 'Full Width Header', 'exs' ),
					'default' => esc_html( exs_option( 'header_fluid', true ) ),
				),
				'header_background'                     => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Header Background', 'exs' ),
					'default' => esc_html( exs_option( 'header_background', 'l' ) ),
					'choices' => exs_customizer_backgrounds_array( true ),
				),
				'header_align_main_menu'                => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Align main menu', 'exs' ),
					'default' => esc_html( exs_option( 'header_align_main_menu', true ) ),
					'choices' => array(
						''            => esc_html__( 'Default', 'exs' ),
						'menu-right'  => esc_html__( 'Right', 'exs' ),
						'menu-center' => esc_html__( 'Center', 'exs' ),
					),
				),
				'header_toggler_menu_main'              => array(
					'type'    => 'checkbox',
					'section' => 'section_header',
					'label'   => esc_html__( 'Put main menu mobile toggler in header', 'exs' ),
					'default' => esc_html( exs_option( 'header_toggler_menu_main', true ) ),
				),
				'header_absolute'                       => array(
					'type'    => 'checkbox',
					'section' => 'section_header',
					'label'   => esc_html__( 'Position absolute header', 'exs' ),
					'default' => esc_html( exs_option( 'header_absolute', false ) ),
				),
				'header_transparent'                    => array(
					'type'        => 'checkbox',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Remove background color', 'exs' ),
					'description' => esc_html__( 'Make header transparent', 'exs' ),
					'default'     => esc_html( exs_option( 'header_transparent', false ) ),
				),
				'header_menu_uppercase'                 => array(
					'type'        => 'checkbox',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Uppercase menu items', 'exs' ),
					'default'     => esc_html( exs_option( 'header_menu_uppercase', false ) ),
				),
				'header_menu_bold'                      => array(
					'type'        => 'checkbox',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Bold menu items', 'exs' ),
					'default'     => esc_html( exs_option( 'header_menu_bold', false ) ),
				),
				'header_border_top'                     => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Top border', 'exs' ),
					'default' => esc_html( exs_option( 'header_border_top', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'header_border_bottom'                  => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Bottom border', 'exs' ),
					'default' => esc_html( exs_option( 'header_border_bottom', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'header_font_size'                      => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Header section font size', 'exs' ),
					'default' => esc_html( exs_option( 'header_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'header_sticky'                         => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Sticky Header', 'exs' ),
					'default' => esc_html( exs_option( 'header_sticky', false ) ),
					'choices' => array(
						''                 => esc_html__( 'Disabled', 'exs' ),
						'always-sticky'    => esc_html__( 'Always visible', 'exs' ),
						'scrolltop-sticky' => esc_html__( 'Visible on scrolling to top', 'exs' ),
					),
				),
				'header_login_links'                    => array(
					'type'        => 'checkbox',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Show Login/Logout links', 'exs' ),
					'default'     => esc_html( exs_option( 'header_login_links', false ) ),
					'description' => esc_html__( 'Show login link if user is not logged in. Show register link if registration enabled. Show logout link if user is logged in.', 'exs' ),
				),
				'header_login_links_hidden'             => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Hide Login/Logout links on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'header_login_links_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),
				'header_search'                         => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Show Search in Header', 'exs' ),
					'default' => esc_html( exs_option( 'header_search', '' ) ),
					'choices' => array(
						''       => esc_html__( 'Disabled', 'exs' ),
						'button' => esc_html__( 'Search Modal button', 'exs' ),
						'form'   => esc_html__( 'Search Form', 'exs' ),
					),
				),
				'header_search_hidden'                    => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Hide search on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'header_search_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),
				'header_button_text'                    => array(
					'type'    => 'text',
					'section' => 'section_header',
					'label'   => esc_html__( 'Header Action Button Text', 'exs' ),
					'default' => esc_html( exs_option( 'header_button_text', '' ) ),
				),
				'header_button_url'                     => array(
					'type'    => 'url',
					'section' => 'section_header',
					'label'   => esc_html__( 'Header Action Button URL', 'exs' ),
					'default' => esc_html( exs_option( 'header_button_url', '' ) ),
				),
				'header_button_hidden'                    => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Hide Action Button on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'header_button_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),
				//toplogo in header
				'header_toplogo_options_heading'        => array(
					'type'        => 'block-heading',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Header Top Logo section options', 'exs' ),
					'description' => esc_html__( 'Top Log section appears only on certain heading layouts (optional).', 'exs' ),
				),
				'header_toplogo_background'             => array(
					'type'        => 'select',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Header Logo Section Background', 'exs' ),
					'default'     => esc_html( exs_option( 'header_toplogo_background', 'l' ) ),
					'description' => esc_html__( 'Background for top logo section, if header layout contains it', 'exs' ),
					'choices'     => exs_customizer_backgrounds_array( true ),
				),
				'header_toplogo_social_hidden'                    => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Hide Top Logo Social icons on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'header_toplogo_social_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),
				'header_toplogo_meta_hidden'                    => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Hide Top Logo Meta on screens:', 'exs' ),
					'default' => esc_html( exs_option( 'header_toplogo_meta_hidden', '' ) ),
					'choices' => exs_customizer_responsive_display_array(),
				),

				//topline in header
				//heading
				'header_topline_options_heading'        => array(
					'type'        => 'block-heading',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Header topline options', 'exs' ),
					'description' => esc_html__( 'You need to fill theme meta options to show them in header topline.', 'exs' ),
				),
				'topline'                               => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Topline Layout', 'exs' ),
					'default' => esc_html( exs_option( 'topline', '' ) ),
					'choices' => array(
						''  => esc_html__( 'Disabled', 'exs' ),
						'1' => esc_html__( 'Left meta and right social links', 'exs' ),
						'2' => esc_html__( 'Left menu and right social links', 'exs' ),
						'3' => esc_html__( 'Left social links and right menu', 'exs' ),
						'4' => esc_html__( 'Left custom text and right social links', 'exs' ),

					),
				),
				'topline_fluid'                         => array(
					'type'    => 'checkbox',
					'section' => 'section_header',
					'label'   => esc_html__( 'Full Width Header Topline', 'exs' ),
					'default' => esc_html( exs_option( 'topline_fluid', true ) ),
				),
				'topline_background'                    => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Header Topline Background', 'exs' ),
					'default' => esc_html( exs_option( 'topline_background', 'l' ) ),
					'choices' => exs_customizer_backgrounds_array( true ),
				),
				'meta_topline_text'                     => array(
					'type'        => 'textarea',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Topline custom text', 'exs' ),
					'description' => esc_html__( 'Appears on different topline layouts', 'exs' ),
					'default'     => esc_html( exs_option( 'meta_topline_text', '' ) ),
				),
				'topline_font_size'                     => array(
					'type'    => 'select',
					'section' => 'section_header',
					'label'   => esc_html__( 'Topline section font size', 'exs' ),
					'default' => esc_html( exs_option( 'topline_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'topline_login_links'                    => array(
					'type'        => 'checkbox',
					'section'     => 'section_header',
					'label'       => esc_html__( 'Show Login/Logout links', 'exs' ),
					'default'     => esc_html( exs_option( 'topline_login_links', false ) ),
					'description' => esc_html__( 'Show login link if user is not logged in. Show register link if registration enabled. Show logout link if user is logged in.', 'exs' ),
				),
				/////////
				//title//
				/////////
				'title'                                 => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Title Layout', 'exs' ),
					'default' => esc_html( exs_option( 'title', '1' ) ),
					'choices' => array(
						'1' => esc_html__( 'Title above breadcrumbs', 'exs' ),
						'2' => esc_html__( 'Title inline with breadcrumbs', 'exs' ),
						'3' => esc_html__( 'Title above breadcrumbs centered', 'exs' ),

					),
				),
				'title_fluid'                         => array(
					'type'    => 'checkbox',
					'section' => 'section_title',
					'label'   => esc_html__( 'Full Width Title Section', 'exs' ),
					'default' => esc_html( exs_option( 'title_fluid' ) ),
				),
				'title_show_title'                      => array(
					'type'    => 'checkbox',
					'section' => 'section_title',
					'label'   => esc_html__( 'Show title in title section instead of content area', 'exs' ),
					'default' => esc_html( exs_option( 'title_show_title', '' ) ),
				),
				'title_show_breadcrumbs'                => array(
					'type'    => 'checkbox',
					'section' => 'section_title',
					'label'   => esc_html__( 'Show breadcrumbs (Yoast SEO or Rank Math plugins required)', 'exs' ),
					'default' => esc_html( exs_option( 'title_show_breadcrumbs', true ) ),
				),
				'title_show_search'                     => array(
					'type'    => 'checkbox',
					'section' => 'section_title',
					'label'   => esc_html__( 'Show search form', 'exs' ),
					'default' => esc_html( exs_option( 'title_show_search', false ) ),
				),
				'title_background'                      => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Title Background', 'exs' ),
					'default' => esc_html( exs_option( 'title_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'title_border_top'                      => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Top border', 'exs' ),
					'default' => esc_html( exs_option( 'title_border_top', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'title_border_bottom'                   => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Bottom border', 'exs' ),
					'default' => esc_html( exs_option( 'title_border_bottom', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'title_extra_padding_top'               => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Top padding', 'exs' ),
					'default' => esc_html( exs_option( 'title_extra_padding_top', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pt-0'  => esc_html__( '0', 'exs' ),
						'pt-1'  => esc_html__( '1em', 'exs' ),
						'pt-2'  => esc_html__( '2em', 'exs' ),
						'pt-3'  => esc_html__( '3em', 'exs' ),
						'pt-4'  => esc_html__( '4em', 'exs' ),
						'pt-5'  => esc_html__( '5em', 'exs' ),
						'pt-6'  => esc_html__( '6em', 'exs' ),
						'pt-7'  => esc_html__( '7em', 'exs' ),
						'pt-8'  => esc_html__( '8em', 'exs' ),
						'pt-9'  => esc_html__( '9em', 'exs' ),
						'pt-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'title_extra_padding_bottom'            => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Bottom padding', 'exs' ),
					'default' => esc_html( exs_option( 'title_extra_padding_bottom', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pb-0'  => esc_html__( '0', 'exs' ),
						'pb-1'  => esc_html__( '1em', 'exs' ),
						'pb-2'  => esc_html__( '2em', 'exs' ),
						'pb-3'  => esc_html__( '3em', 'exs' ),
						'pb-4'  => esc_html__( '4em', 'exs' ),
						'pb-5'  => esc_html__( '5em', 'exs' ),
						'pb-6'  => esc_html__( '6em', 'exs' ),
						'pb-7'  => esc_html__( '7em', 'exs' ),
						'pb-8'  => esc_html__( '8em', 'exs' ),
						'pb-9'  => esc_html__( '9em', 'exs' ),
						'pb-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'title_font_size'                       => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Title section font size', 'exs' ),
					'default' => esc_html( exs_option( 'title_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'title_hide_taxonomy_name'              => array(
					'type'        => 'checkbox',
					'section'     => 'section_title',
					'label'       => esc_html__( 'Hide taxonomy name', 'exs' ),
					'description' => esc_html__( 'You can hide a taxonomy name on taxonomy archives page', 'exs' ),
					'default'     => esc_html( exs_option( 'title_hide_taxonomy_name', false ) ),
				),
				'title_background_image'                => array(
					'type'    => 'image',
					'section' => 'section_title',
					'label'   => esc_html__( 'Title Section Background Image', 'exs' ),
					'default' => esc_html( exs_option( 'title_background_image', '' ) ),
				),
				'title_background_image_cover'          => array(
					'type'    => 'checkbox',
					'section' => 'section_title',
					'label'   => esc_html__( 'Cover background image', 'exs' ),
					'default' => esc_html( exs_option( 'title_background_image_cover', false ) ),
				),
				'title_background_image_fixed'          => array(
					'type'    => 'checkbox',
					'section' => 'section_title',
					'label'   => esc_html__( 'Fixed background image', 'exs' ),
					'default' => esc_html( exs_option( 'title_background_image_fixed', false ) ),
				),
				'title_background_image_overlay'        => array(
					'type'    => 'select',
					'section' => 'section_title',
					'label'   => esc_html__( 'Overlay for background image', 'exs' ),
					'default' => esc_html( exs_option( 'title_background_image_overlay', '' ) ),
					'choices' => exs_customizer_background_overlay_array(),
				),
				////////////////
				//main section//
				////////////////
				'main_sidebar_width'                    => array(
					'type'    => 'select',
					'section' => 'section_main',
					'label'   => esc_html__( 'Sidebar width on big screens', 'exs' ),
					'default' => esc_html( exs_option( 'main_sidebar_width', '' ) ),
					'choices' => array(
						'33' => esc_html__( 'Default - 1/3 - 33%', 'exs' ),
						'25' => esc_html__( '1/4 - 25%', 'exs' ),
					),
				),
				'main_gap_width'                        => array(
					'type'    => 'select',
					'section' => 'section_main',
					'label'   => esc_html__( 'Sidebar gap width', 'exs' ),
					'default' => esc_html( exs_option( 'main_gap_width', '' ) ),
					'choices' => array(
						''  => esc_html__( 'Default', 'exs' ),
						'1' => esc_html__( '1em', 'exs' ),
						'2' => esc_html__( '2em', 'exs' ),
						'3' => esc_html__( '3em', 'exs' ),
						'4' => esc_html__( '4em', 'exs' ),
					),
				),
				'main_sidebar_sticky'                   => array(
					'type'    => 'checkbox',
					'section' => 'section_main',
					'label'   => esc_html__( 'Sticky sidebar', 'exs' ),
					'default' => esc_html( exs_option( 'main_sidebar_sticky', false ) ),
				),
				'main_extra_padding_top'                => array(
					'type'    => 'select',
					'section' => 'section_main',
					'label'   => esc_html__( 'Top padding', 'exs' ),
					'default' => esc_html( exs_option( 'main_extra_padding_top', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pt-0'  => esc_html__( '0', 'exs' ),
						'pt-1'  => esc_html__( '1em', 'exs' ),
						'pt-2'  => esc_html__( '2em', 'exs' ),
						'pt-3'  => esc_html__( '3em', 'exs' ),
						'pt-4'  => esc_html__( '4em', 'exs' ),
						'pt-5'  => esc_html__( '5em', 'exs' ),
						'pt-6'  => esc_html__( '6em', 'exs' ),
						'pt-7'  => esc_html__( '7em', 'exs' ),
						'pt-8'  => esc_html__( '8em', 'exs' ),
						'pt-9'  => esc_html__( '9em', 'exs' ),
						'pt-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'main_extra_padding_bottom'             => array(
					'type'    => 'select',
					'section' => 'section_main',
					'label'   => esc_html__( 'Bottom padding', 'exs' ),
					'default' => esc_html( exs_option( 'main_extra_padding_bottom', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pb-0'  => esc_html__( '0', 'exs' ),
						'pb-1'  => esc_html__( '1em', 'exs' ),
						'pb-2'  => esc_html__( '2em', 'exs' ),
						'pb-3'  => esc_html__( '3em', 'exs' ),
						'pb-4'  => esc_html__( '4em', 'exs' ),
						'pb-5'  => esc_html__( '5em', 'exs' ),
						'pb-6'  => esc_html__( '6em', 'exs' ),
						'pb-7'  => esc_html__( '7em', 'exs' ),
						'pb-8'  => esc_html__( '8em', 'exs' ),
						'pb-9'  => esc_html__( '9em', 'exs' ),
						'pb-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'main_font_size'                        => array(
					'type'    => 'select',
					'section' => 'section_main',
					'label'   => esc_html__( 'Main section font size', 'exs' ),
					'default' => esc_html( exs_option( 'main_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'sidebar_font_size'                     => array(
					'type'    => 'select',
					'section' => 'section_main',
					'label'   => esc_html__( 'Sidebar font size', 'exs' ),
					'default' => esc_html( exs_option( 'sidebar_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'main_sidebar_widgets_heading'          => array(
					'type'        => 'block-heading',
					'section'     => 'section_main',
					'label'       => esc_html__( 'Style widget titles', 'exs' ),
					'description' => esc_html__( 'Change styles for sidebar widget titles.', 'exs' ),
				),
				'main_sidebar_widgets_title_uppercase'  => array(
					'type'    => 'checkbox',
					'section' => 'section_main',
					'label'   => esc_html__( 'Uppercase widget titles', 'exs' ),
					'default' => esc_html( exs_option( 'main_sidebar_widgets_title_uppercase', false ) ),
				),
				'main_sidebar_widgets_title_bold'       => array(
					'type'    => 'checkbox',
					'section' => 'section_main',
					'label'   => esc_html__( 'Bold widget titles', 'exs' ),
					'default' => esc_html( exs_option( 'main_sidebar_widgets_title_bold', false ) ),
				),
				'main_sidebar_widgets_title_decor'      => array(
					'type'    => 'checkbox',
					'section' => 'section_main',
					'label'   => esc_html__( 'Decorated widget titles', 'exs' ),
					'default' => esc_html( exs_option( 'main_sidebar_widgets_title_decor', false ) ),
				),

				//////////////
				//footer_top//
				//////////////
				'footer_top'                                => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Layout', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top', '' ) ),
					'choices' => array(
						''  => esc_html__( 'Disabled', 'exs' ),
						'1' => esc_html__( 'Single column', 'exs' ),
						'2' => esc_html__( 'Single column centered', 'exs' ),
						'3' => esc_html__( 'Two columns', 'exs' ),
					),
				),
				'footer_top_content_heading_text'                   => array(
					'type'        => 'block-heading',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Top Footer Section Content', 'exs' ),
					'description' => esc_html__( 'Set top footer section content. Leave blank if some options not needed.', 'exs' ),
				),
				'footer_top_image'                               => array(
					'type'        => 'image',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Top Footer Section Image', 'exs' ),
					'description' => esc_html__( 'Set top footer section image. Useful if you want to display another logo', 'exs' ),
				),
				'footer_top_pre_heading'                         => array(
					'type'    => 'text',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Pre Heading text', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_pre_heading', '' ) ),
				),
				'footer_top_pre_heading_mt'                      => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Pre Heading top margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_pre_heading_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'footer_top_pre_heading_mb'                      => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Pre Heading bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_pre_heading_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'footer_top_pre_heading_animation'               => array(
					'type'        => 'select',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Animation for pre heading', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => exs_option( 'footer_top_pre_heading_animation', '' ),
					'choices'     => exs_get_animation_options(),
				),
				'footer_top_heading'                         => array(
					'type'    => 'text',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Heading text', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_heading', '' ) ),
				),
				'footer_top_heading_mt'                      => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Heading top margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_heading_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'footer_top_heading_mb'                      => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Heading bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_heading_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'footer_top_heading_animation'               => array(
					'type'        => 'select',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Animation for heading', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => exs_option( 'footer_top_heading_animation', '' ),
					'choices'     => exs_get_animation_options(),
				),
				'footer_top_description'                     => array(
					'type'    => 'textarea',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Description text', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_description', '' ) ),
				),
				'footer_top_description_mt'                  => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Description top margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_description_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'footer_top_description_mb'                  => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Description bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_description_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'footer_top_description_animation'           => array(
					'type'        => 'select',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Animation for description text', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => exs_option( 'footer_top_description_animation', '' ),
					'choices'     => exs_get_animation_options(),
				),
				'footer_top_shortcode'                       => array(
					'type'        => 'text',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Shortcode', 'exs' ),
					'description' => esc_html__( 'You can put shortcode here. It will appear below description', 'exs' ),
					'default'     => exs_option( 'footer_top_shortcode', '' ),
				),
				'footer_top_shortcode_mt'                    => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Shortcode top margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_shortcode_mt', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'footer_top_shortcode_mb'                    => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Shortcode bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_shortcode_mb', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				'footer_top_shortcode_animation'             => array(
					'type'        => 'select',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Animation for shortcode', 'exs' ),
					'description' => esc_html__( 'Animation should be enabled', 'exs' ),
					'default'     => exs_option( 'footer_top_shortcode_animation', '' ),
					'choices'     => exs_get_animation_options(),
				),
				'footer_top_options_heading_text'                   => array(
					'type'        => 'block-heading',
					'section'     => 'section_footer_top',
					'label'       => esc_html__( 'Top Footer Section Options', 'exs' ),
					'description' => esc_html__( 'Set top footer section display and layout options.', 'exs' ),
				),
				'footer_top_fluid'                          => array(
					'type'    => 'checkbox',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Full Width Section', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_fluid', false ) ),
				),
				'footer_top_background'                     => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Background', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'footer_top_border_top'                     => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Top border', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_border_top', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'footer_top_border_bottom'                  => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Bottom border', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_border_bottom', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'footer_top_extra_padding_top'              => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Top padding', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_extra_padding_top', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pt-0'  => esc_html__( '0', 'exs' ),
						'pt-1'  => esc_html__( '1em', 'exs' ),
						'pt-2'  => esc_html__( '2em', 'exs' ),
						'pt-3'  => esc_html__( '3em', 'exs' ),
						'pt-4'  => esc_html__( '4em', 'exs' ),
						'pt-5'  => esc_html__( '5em', 'exs' ),
						'pt-6'  => esc_html__( '6em', 'exs' ),
						'pt-7'  => esc_html__( '7em', 'exs' ),
						'pt-8'  => esc_html__( '8em', 'exs' ),
						'pt-9'  => esc_html__( '9em', 'exs' ),
						'pt-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'footer_top_extra_padding_bottom'           => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Bottom padding', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_extra_padding_bottom', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pb-0'  => esc_html__( '0', 'exs' ),
						'pb-1'  => esc_html__( '1em', 'exs' ),
						'pb-2'  => esc_html__( '2em', 'exs' ),
						'pb-3'  => esc_html__( '3em', 'exs' ),
						'pb-4'  => esc_html__( '4em', 'exs' ),
						'pb-5'  => esc_html__( '5em', 'exs' ),
						'pb-6'  => esc_html__( '6em', 'exs' ),
						'pb-7'  => esc_html__( '7em', 'exs' ),
						'pb-8'  => esc_html__( '8em', 'exs' ),
						'pb-9'  => esc_html__( '9em', 'exs' ),
						'pb-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'footer_top_font_size'                      => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Font Size', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'footer_top_background_image'               => array(
					'type'    => 'image',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Background Image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_background_image', '' ) ),
				),
				'footer_top_background_image_cover'         => array(
					'type'    => 'checkbox',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Cover background image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_background_image_cover', false ) ),
				),
				'footer_top_background_image_fixed'         => array(
					'type'    => 'checkbox',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Fixed background image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_background_image_fixed', false ) ),
				),
				'footer_top_background_image_overlay'       => array(
					'type'    => 'select',
					'section' => 'section_footer_top',
					'label'   => esc_html__( 'Overlay for background image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_top_background_image_overlay', '' ) ),
					'choices' => exs_customizer_background_overlay_array(),
				),

				//////////
				//footer//
				//////////
				'footer'                                => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Footer Layout', 'exs' ),
					'default' => esc_html( exs_option( 'footer', '1' ) ),
					'choices' => array(
						''  => esc_html__( 'Disabled', 'exs' ),
						'1' => esc_html__( 'Equal columns', 'exs' ),
						'2' => esc_html__( 'First one half column', 'exs' ),
						'3' => esc_html__( 'Second one half column', 'exs' ),
						'4' => esc_html__( 'Full Width', 'exs' ),
						'5' => esc_html__( 'Full Width centered', 'exs' ),
						'6' => esc_html__( 'Full Width centered narrow', 'exs' ),

					),
				),
				'footer_layout_gap'                     => array(
					'type'        => 'select',
					'section'     => 'section_footer',
					'label'       => esc_html__( 'Footer widgets gap', 'exs' ),
					'description' => esc_html__( 'Used only for multiple columns layouts', 'exs' ),
					'default'     => esc_html( exs_option( 'footer_layout_gap', '' ) ),
					'choices'     => exs_get_feed_layout_gap_options(),
				),
				'footer_fluid'                          => array(
					'type'    => 'checkbox',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Full Width Footer', 'exs' ),
					'default' => esc_html( exs_option( 'footer_fluid', false ) ),
				),
				'footer_background'                     => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Footer Background', 'exs' ),
					'default' => esc_html( exs_option( 'footer_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'footer_border_top'                     => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Top border', 'exs' ),
					'default' => esc_html( exs_option( 'footer_border_top', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'footer_border_bottom'                  => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Bottom border', 'exs' ),
					'default' => esc_html( exs_option( 'footer_border_bottom', '' ) ),
					'choices' => exs_customizer_borders_array(),
				),
				'footer_extra_padding_top'              => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Top padding', 'exs' ),
					'default' => esc_html( exs_option( 'footer_extra_padding_top', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pt-0'  => esc_html__( '0', 'exs' ),
						'pt-1'  => esc_html__( '1em', 'exs' ),
						'pt-2'  => esc_html__( '2em', 'exs' ),
						'pt-3'  => esc_html__( '3em', 'exs' ),
						'pt-4'  => esc_html__( '4em', 'exs' ),
						'pt-5'  => esc_html__( '5em', 'exs' ),
						'pt-6'  => esc_html__( '6em', 'exs' ),
						'pt-7'  => esc_html__( '7em', 'exs' ),
						'pt-8'  => esc_html__( '8em', 'exs' ),
						'pt-9'  => esc_html__( '9em', 'exs' ),
						'pt-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'footer_extra_padding_bottom'           => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Bottom padding', 'exs' ),
					'default' => esc_html( exs_option( 'footer_extra_padding_bottom', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pb-0'  => esc_html__( '0', 'exs' ),
						'pb-1'  => esc_html__( '1em', 'exs' ),
						'pb-2'  => esc_html__( '2em', 'exs' ),
						'pb-3'  => esc_html__( '3em', 'exs' ),
						'pb-4'  => esc_html__( '4em', 'exs' ),
						'pb-5'  => esc_html__( '5em', 'exs' ),
						'pb-6'  => esc_html__( '6em', 'exs' ),
						'pb-7'  => esc_html__( '7em', 'exs' ),
						'pb-8'  => esc_html__( '8em', 'exs' ),
						'pb-9'  => esc_html__( '9em', 'exs' ),
						'pb-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'footer_font_size'                      => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Footer section font size', 'exs' ),
					'default' => esc_html( exs_option( 'footer_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'footer_background_image'               => array(
					'type'    => 'image',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Footer Section Background Image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_background_image', '' ) ),
				),
				'footer_background_image_cover'         => array(
					'type'    => 'checkbox',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Cover background image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_background_image_cover', false ) ),
				),
				'footer_background_image_fixed'         => array(
					'type'    => 'checkbox',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Fixed background image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_background_image_fixed', false ) ),
				),
				'footer_background_image_overlay'       => array(
					'type'    => 'select',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Overlay for background image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_background_image_overlay', '' ) ),
					'choices' => exs_customizer_background_overlay_array(),
				),
				'footer_widgets_heading'               => array(
					'type'        => 'block-heading',
					'section'     => 'section_footer',
					'label'       => esc_html__( 'Style widget titles', 'exs' ),
					'description' => esc_html__( 'Change styles for footer widget titles.', 'exs' ),
				),
				'footer_sidebar_widgets_title_uppercase' => array(
					'type'    => 'checkbox',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Uppercase widget titles', 'exs' ),
					'default' => esc_html( exs_option( 'footer_sidebar_widgets_title_uppercase', false ) ),
				),
				'footer_sidebar_widgets_title_bold'      => array(
					'type'    => 'checkbox',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Bold widget titles', 'exs' ),
					'default' => esc_html( exs_option( 'footer_sidebar_widgets_title_bold', false ) ),
				),
				'footer_sidebar_widgets_title_decor'     => array(
					'type'    => 'checkbox',
					'section' => 'section_footer',
					'label'   => esc_html__( 'Decorated widget titles', 'exs' ),
					'default' => esc_html( exs_option( 'footer_sidebar_widgets_title_decor', false ) ),
				),
				/////////////
				//copyright//
				/////////////
				'copyright'                             => array(
					'type'    => 'select',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Copyright Layout', 'exs' ),
					'default' => esc_html( exs_option( 'copyright', '1' ) ),
					'choices' => array(
						''  => esc_html__( 'Disabled', 'exs' ),
						'1' => esc_html__( 'Only copyright (centered)', 'exs' ),
						'2' => esc_html__( 'Only copyright (left aligned)', 'exs' ),
						'3' => esc_html__( 'Left copyright and right menu', 'exs' ),
						'4' => esc_html__( 'Left copyright and right social icons', 'exs' ),
						'5' => esc_html__( 'Left copyright, menu and right social icons', 'exs' ),
					),
				),
				'copyright_text'                        => array(
					'type'        => 'textarea',
					'section'     => 'section_copyright',
					'label'       => esc_html__( 'Copyright text', 'exs' ),
					'description' => esc_html__( 'Site name will be displayed, if leave empty', 'exs' ),
					'default'     => esc_html( exs_option( 'copyright_text', '' ) ),
				),
				'copyright_fluid'                       => array(
					'type'    => 'checkbox',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Full Width copyright', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_fluid', true ) ),
				),
				'copyright_background'                  => array(
					'type'    => 'select',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Copyright Background', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'copyright_extra_padding_top'           => array(
					'type'    => 'select',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Top padding', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_extra_padding_top', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pt-0'  => esc_html__( '0', 'exs' ),
						'pt-1'  => esc_html__( '1em', 'exs' ),
						'pt-2'  => esc_html__( '2em', 'exs' ),
						'pt-3'  => esc_html__( '3em', 'exs' ),
						'pt-4'  => esc_html__( '4em', 'exs' ),
						'pt-5'  => esc_html__( '5em', 'exs' ),
						'pt-6'  => esc_html__( '6em', 'exs' ),
						'pt-7'  => esc_html__( '7em', 'exs' ),
						'pt-8'  => esc_html__( '8em', 'exs' ),
						'pt-9'  => esc_html__( '9em', 'exs' ),
						'pt-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'copyright_extra_padding_bottom'        => array(
					'type'    => 'select',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Bottom padding', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_extra_padding_bottom', '' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'pb-0'  => esc_html__( '0', 'exs' ),
						'pb-1'  => esc_html__( '1em', 'exs' ),
						'pb-2'  => esc_html__( '2em', 'exs' ),
						'pb-3'  => esc_html__( '3em', 'exs' ),
						'pb-4'  => esc_html__( '4em', 'exs' ),
						'pb-5'  => esc_html__( '5em', 'exs' ),
						'pb-6'  => esc_html__( '6em', 'exs' ),
						'pb-7'  => esc_html__( '7em', 'exs' ),
						'pb-8'  => esc_html__( '8em', 'exs' ),
						'pb-9'  => esc_html__( '9em', 'exs' ),
						'pb-10' => esc_html__( '10em', 'exs' ),
					),
				),
				'copyright_font_size'                   => array(
					'type'    => 'select',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Copyright section font size', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_font_size', '' ) ),
					'choices' => exs_customizer_font_size_array(),
				),
				'copyright_background_image'            => array(
					'type'    => 'image',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Copyright Section Background Image', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_background_image', '' ) ),
				),
				'copyright_background_image_cover'      => array(
					'type'    => 'checkbox',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Cover background image', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_background_image_cover', false ) ),
				),
				'copyright_background_image_fixed'      => array(
					'type'    => 'checkbox',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Fixed background image', 'exs' ),
					'default' => esc_html( exs_option( 'copyright_background_image_fixed', false ) ),
				),
				'copyright_background_image_overlay'    => array(
					'type'    => 'select',
					'section' => 'section_copyright',
					'label'   => esc_html__( 'Overlay for background image', 'exs' ),
					'default' => esc_html( exs_option( 'footer_background_image_overlay', '' ) ),
					'choices' => exs_customizer_background_overlay_array(),
				),
				//////////////
				//typography//
				//////////////
				'typo_body_heading'      => array(
					'type'        => 'block-heading',
					'section'     => 'section_typography',
					'label'       => esc_html__( 'Settings for BODY', 'exs' ),
					'description' => esc_html__( 'Set your settings for BODY tag. Leave blank for theme defaults.', 'exs' ),
				),
				'typo_body_size'                       => array(
					'type'        => 'slider',
					'label'       => esc_html__( 'Global Font Size (px)', 'exs' ),
					'description' => esc_html__( 'Set a global font size in pixels. It will be applied to BODY tag. Can be overriden in the individual sections settings', 'exs' ),
					'default'     => esc_html( exs_option( 'typo_body_size', '' ) ),
					'section'     => 'section_typography',
					'atts'        => array(
						'min'         => '9',
						'max'         => '22',
						'step'        => '1',
					),
				),
				'typo_body_weight'                       => array(
					'type'        => 'select',
					'label'       => esc_html__( 'Global Font Weight', 'exs' ),
					'description' => esc_html__( 'Set a global font weight. It will be applied to BODY tag.', 'exs' ),
					'default'     => esc_html( exs_option( 'typo_body_weight', '' ) ),
					'section'     => 'section_typography',
					'choices'     => array(
						''    => esc_html__( 'Default', 'exs' ),
						'100' => esc_html__( '100', 'exs' ),
						'300' => esc_html__( '300', 'exs' ),
						'400' => esc_html__( '400', 'exs' ),
						'500' => esc_html__( '500', 'exs' ),
						'700' => esc_html__( '700', 'exs' ),
						'900' => esc_html__( '900', 'exs' ),
					),
				),
				'typo_body_line_height'                       => array(
					'type'        => 'slider',
					'label'       => esc_html__( 'Global Line Height (em)', 'exs' ),
					'description' => esc_html__( 'It will be applied to BODY tag. Value in ems', 'exs' ),
					'section'     => 'section_typography',
					'default'     => esc_html( exs_option( 'typo_body_line_height', '' ) ),
					'atts'        => array(
						'min'         => '0.8',
						'max'         => '3',
						'step'        => '0.01',
					),
				),
				'typo_body_letter_spacing'                    => array(
					'type'        => 'slider',
					'label'       => esc_html__( 'Global Letter Spacing (em)', 'exs' ),
					'description' => esc_html__( 'It will be applied to BODY tag. Value in ems', 'exs' ),
					'section'     => 'section_typography',
					'default'     => esc_html( exs_option( 'typo_body_letter_spacing', '' ) ),
					'atts'        => array(
						'min'         => '-0.2',
						'max'         => '0.5',
						'step'        => '0.005',
					),
				),
				'typo_p_margin_bottom'                        => array(
					'type'        => 'slider',
					'label'       => esc_html__( 'Paragraphs Bottom Margin (em)', 'exs' ),
					'description' => esc_html__( 'It will be applied to P tag. Value in ems', 'exs' ),
					'section'     => 'section_typography',
					'default'     => esc_html( exs_option( 'typo_p_margin_bottom', '' ) ),
					'atts'        => array(
						'min'         => '0',
						'max'         => '3',
						'step'        => '0.05',
					),
				),
				/////////
				//fonts//
				/////////
				'font_body_extra'                       => array(
					'type'        => 'extra-button',
					'label'       => esc_html__( 'Google Fonts', 'exs' ),
					'description' => esc_html__( 'Activate Google Fonts in your Customizer and set custom fonts for your body text and headings', 'exs' ),
					'section'     => 'section_fonts',
				),
				////////
				//blog//
				////////
				'blog_layout'                           => array(
					'type'    => 'select',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Blog feed layout', 'exs' ),
					'default' => esc_html( exs_option( 'blog_layout', '' ) ),
					'choices' => exs_get_feed_layout_options(),
				),
				'blog_layout_gap'                       => array(
					'type'        => 'select',
					'section'     => 'section_blog',
					'label'       => esc_html__( 'Blog feed layout gap', 'exs' ),
					'description' => esc_html__( 'Used only for grid and masonry layouts', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_layout_gap', '' ) ),
					'choices'     => exs_get_feed_layout_gap_options(),
				),
				'blog_sidebar_position'                 => array(
					'type'        => 'radio',
					'section'     => 'section_blog',
					'label'       => esc_html__( 'Blog sidebar position', 'exs' ),
					'description' => esc_html__( 'Can be overriden for certain category on category edit page', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_sidebar_position', 'right' ) ),
					'choices'     => exs_get_sidebar_position_options(),
				),
				'blog_page_name'                        => array(
					'type'    => 'text',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Blog page name. Default: \'Blog\'', 'exs' ),
					'default' => esc_html( exs_option( 'blog_page_name', esc_html__( 'Blog', 'exs' ) ) ),
				),
				'blog_show_full_text'                   => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show full text instead of excerpt', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_full_text', false ) ),
				),
				'blog_excerpt_length'                   => array(
					'type'        => 'number',
					'section'     => 'section_blog',
					'label'       => esc_html__( 'Custom excerpt length', 'exs' ),
					'description' => esc_html__( 'Words amount', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_excerpt_length', '' ) ),
				),
				'blog_read_more_text'                   => array(
					'type'    => 'text',
					'section' => 'section_blog',
					'label'   => esc_html__( '\'Read More\' text. Leave blank to hide', 'exs' ),
					'default' => esc_html( exs_option( 'blog_read_more_text', '' ) ),
				),
				'blog_hide_taxonomy_type_name'          => array(
					'type'        => 'checkbox',
					'section'     => 'section_blog',
					'label'       => esc_html__( 'Hide taxonomy type name in title section', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_hide_taxonomy_type_name', false ) ),
					'description' => esc_html__( 'You can hide taxonomy name (ex. \'Tag:\') word if you want.', 'exs' ),
				),
				'blog_meta_options_heading'             => array(
					'type'        => 'block-heading',
					'section'     => 'section_blog',
					'label'       => esc_html__( 'Post meta options', 'exs' ),
					'description' => esc_html__( 'Select what post meta you want to show in blog feed. Not all layouts will show post meta even if it is checked.', 'exs' ),
				),
				'blog_hide_meta_icons'                  => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Hide icons in the post meta', 'exs' ),
					'default' => esc_html( exs_option( 'blog_hide_meta_icons', false ) ),
				),
				'blog_show_author'                      => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show author', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_author', true ) ),
				),
				'blog_show_author_avatar'               => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show author avatar', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_author_avatar', false ) ),
				),
				'blog_before_author_word'               => array(
					'type'    => 'text',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Text before author', 'exs' ),
					'default' => esc_html( exs_option( 'blog_before_author_word', '' ) ),
				),
				'blog_show_date'                        => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show date', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_date', true ) ),
				),
				'blog_before_date_word'                 => array(
					'type'    => 'text',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Text before date', 'exs' ),
					'default' => esc_html( exs_option( 'blog_before_date_word', '' ) ),
				),
				'blog_show_human_date'                        => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show human difference date', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_human_date', false ) ),
				),
				'blog_show_categories'                  => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show categories', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_categories', true ) ),
				),
				'blog_before_categories_word'           => array(
					'type'    => 'text',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Text before categories', 'exs' ),
					'default' => esc_html( exs_option( 'blog_before_categories_word', '' ) ),
				),
				'blog_show_tags'                        => array(
					'type'    => 'checkbox',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show tags', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_tags', '' ) ),
				),
				'blog_before_tags_word'                 => array(
					'type'    => 'text',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Text before tags', 'exs' ),
					'default' => esc_html( exs_option( 'blog_before_tags_word', '' ) ),
				),
				'blog_show_comments_link'               => array(
					'type'    => 'select',
					'section' => 'section_blog',
					'label'   => esc_html__( 'Show comments count', 'exs' ),
					'default' => esc_html( exs_option( 'blog_show_comments_link', true ) ),
					'choices' => array(
						''       => esc_html__( 'None', 'exs' ),
						'text'   => esc_html__( 'Comments number with text', 'exs' ),
						'number' => esc_html__( 'Only comments number', 'exs' ),
					),
				),
				////////
				//post//
				////////
				//same as blog (except post nav and author bio)
				'blog_single_layout'                    => array(
					'type'    => 'select',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Blog post layout', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_layout', '' ) ),
					'choices' => exs_get_post_layout_options(),
				),
				'blog_single_sidebar_position'          => array(
					'type'        => 'radio',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Blog post sidebar position', 'exs' ),
					'description' => esc_html__( 'Can be overriden for certain post by selecting appropriate post template', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_sidebar_position', 'right' ) ),
					'choices'     => exs_get_sidebar_position_options(),
				),
				'blog_single_first_embed_featured'      => array(
					'type'        => 'select',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Show first post oEmbed instead of featured image', 'exs' ),
					'description' => esc_html__( 'You can replace a featured image with first oEmbed video in the post', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_first_embed_featured', '' ) ),
					'choices'     => array(
						''        => esc_html__( 'No', 'exs' ),
						'all'     => esc_html__( 'All posts', 'exs' ),
						'video'   => esc_html__( 'Only video post format', 'exs' ),
					),
				),
				'blog_single_fullwidth_featured'      => array(
					'type'        => 'checkbox',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Fullwidth featured image and video', 'exs' ),
					'description' => esc_html__( 'Blog post sidebar position should be set as "No Sidebar"', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_fullwidth_featured', false ) ),
				),
				'blog_single_show_author_bio'           => array(
					'type'        => 'checkbox',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Show Author Bio', 'exs' ),
					'description' => esc_html__( 'You need to fill Biographical Info to display author bio', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_show_author_bio', true ) ),
				),
				'blog_single_author_bio_about_word'     => array(
					'type'        => 'text',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( '\'About author\' intro word', 'exs' ),
					'description' => esc_html__( 'Leave blank if not needed', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_author_bio_about_word', '' ) ),
				),
				'blog_single_post_nav_heading'          => array(
					'type'    => 'block-heading',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Posts navigation settings', 'exs' ),
				),
				'blog_single_post_nav'                  => array(
					'type'    => 'select',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Posts Navigation', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_post_nav', '' ) ),
					'choices' => array(
						''          => esc_html__( 'Disabled', 'exs' ),
						'title'     => esc_html__( 'Only title', 'exs' ),
						'bg'        => esc_html__( 'Background featured image', 'exs' ),
						'thumbnail' => esc_html__( 'Thumbnail featured image', 'exs' ),
					),
				),
				'blog_single_post_nav_word_prev'        => array(
					'type'        => 'text',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( '\'Previous post\' word', 'exs' ),
					'description' => esc_html__( 'Post navigation has to be chosen', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_post_nav_word_prev', esc_html__( 'Prev', 'exs' ) ) ),
				),
				'blog_single_post_nav_word_next'        => array(
					'type'        => 'text',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( '\'Next post\' word', 'exs' ),
					'description' => esc_html__( 'Post navigation has to be chosen', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_post_nav_word_next', esc_html__( 'Next', 'exs' ) ) ),
				),
				'blog_single_related_posts_heading'     => array(
					'type'        => 'block-heading',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Related posts settings', 'exs' ),
					'description' => esc_html__( 'Related posts are based on post tags', 'exs' ),
				),
				'blog_single_related_posts'             => array(
					'type'    => 'select',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Related posts', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_related_posts', '' ) ),
					'choices' => array(
						''                => esc_html__( 'Hidden', 'exs' ),
						'list'            => esc_html__( 'Simple list', 'exs' ),
						'list-thumbnails' => esc_html__( 'List with thumbnails', 'exs' ),
						'grid'            => esc_html__( 'Posts grid', 'exs' ),
					),
				),
				'blog_single_related_posts_title'       => array(
					'type'        => 'text',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Related posts title', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_related_posts_title', '' ) ),
					'description' => esc_html__( 'Related posts heading title', 'exs' ),
				),
				'blog_single_related_posts_number'      => array(
					'type'        => 'number',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Related posts number', 'exs' ),
					'default'     => esc_html( exs_option( 'blog_single_related_posts_number', '' ) ),
					'description' => esc_html__( 'Related posts layout has to be chosen', 'exs' ),
				),
				'blog_single_meta_options_heading'      => array(
					'type'        => 'block-heading',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Single post meta options', 'exs' ),
					'description' => esc_html__( 'Select what post meta you want to show in single post. Not all layouts will show post meta even if it is checked.', 'exs' ),
				),
				'blog_single_hide_meta_icons'           => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Hide icons in the post meta', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_hide_meta_icons', false ) ),
				),
				'blog_single_show_author'               => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show author', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_show_author', true ) ),
				),
				'blog_single_show_author_avatar'        => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show author avatar', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_show_author_avatar', false ) ),
				),
				'blog_single_before_author_word'        => array(
					'type'    => 'text',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Text before author', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_before_author_word', '' ) ),
				),
				'blog_single_show_date'                 => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show date', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_show_date', true ) ),
				),
				'blog_single_before_date_word'          => array(
					'type'    => 'text',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Text before date', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_before_date_word', '' ) ),
				),
				'blog_single_show_human_date'                        => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show human difference date', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_show_human_date', false ) ),
				),
				'blog_single_show_categories'           => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show categories', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_show_categories', true ) ),
				),
				'blog_single_before_categories_word'    => array(
					'type'    => 'text',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Text before categories', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_before_categories_word', '' ) ),
				),
				'blog_single_show_tags'                 => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show tags', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_show_tags', true ) ),
				),
				'blog_single_before_tags_word'          => array(
					'type'    => 'text',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Text before tags', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_before_tags_word', '' ) ),
				),
				'blog_single_show_comments_link'        => array(
					'type'    => 'select',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show comments count', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_show_comments_link', true ) ),
					'choices' => array(
						''       => esc_html__( 'None', 'exs' ),
						'text'   => esc_html__( 'Comments number with text', 'exs' ),
						'number' => esc_html__( 'Only comments number', 'exs' ),
					),
				),
				'blog_single_toc_heading'      => array(
					'type'        => 'block-heading',
					'section'     => 'section_blog_post',
					'label'       => esc_html__( 'Single post Table of Contents', 'exs' ),
					'description' => esc_html__( 'You can auto generate a Table of Contents based on heading tags that are exists in your post', 'exs' ),
				),
				'blog_single_toc_enabled'                 => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Enable Table of Contents', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_toc_enabled', false ) ),
				),
				'blog_single_toc_title'          => array(
					'type'    => 'text',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Table of Contents title', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_toc_title', '' ) ),
				),
				'blog_single_toc_background'        => array(
					'type'    => 'select',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Show comments count', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_toc_background', '' ) ),
					'choices' => exs_customizer_backgrounds_array(),
				),
				'blog_single_toc_bordered'             => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Add border', 'exs' ),
					'default' => exs_option( 'blog_single_toc_bordered', false ),
				),
				'blog_single_toc_shadow'               => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Add shadow', 'exs' ),
					'default' => exs_option( 'blog_single_toc_shadow', false ),
				),
				'blog_single_toc_rounded'              => array(
					'type'    => 'checkbox',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Rounded', 'exs' ),
					'default' => exs_option( 'blog_single_toc_rounded', false ),
				),
				'blog_single_toc_mt'                      => array(
					'type'    => 'select',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Table of contents top margin', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_toc_mt', 'mt-2' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mt-0'  => '0',
						'mt-05' => '0.5em',
						'mt-1'  => '1em',
						'mt-15' => '1.5em',
						'mt-2'  => '2em',
						'mt-3'  => '3em',
						'mt-4'  => '4em',
						'mt-5'  => '5em',
					),
				),
				'blog_single_toc_mb'                      => array(
					'type'    => 'select',
					'section' => 'section_blog_post',
					'label'   => esc_html__( 'Table of contents bottom margin', 'exs' ),
					'default' => esc_html( exs_option( 'blog_single_toc_mb', 'mb-2' ) ),
					'choices' => array(
						''      => esc_html__( 'Default', 'exs' ),
						'mb-0'  => '0',
						'mb-05' => '0.5em',
						'mb-1'  => '1em',
						'mb-15' => '1.5em',
						'mb-2'  => '2em',
						'mb-3'  => '3em',
						'mb-4'  => '4em',
						'mb-5'  => '5em',
					),
				),
				//////////
				//search//
				//////////
				'search_layout'                  => array(
					'type'    => 'select',
					'section' => 'section_search',
					'label'   => esc_html__( 'Search results layout', 'exs' ),
					'default' => esc_html( exs_option( 'search_layout', '' ) ),
					'choices' => array(
						''                                => esc_html__( 'Default - top featured image', 'exs' ),
						'default-wide-image'              => esc_html__( 'Wide featured image', 'exs' ),
						'meta-top'                        => esc_html__( 'Meta above image', 'exs' ),
						'meta-side'                       => esc_html__( 'Side post meta', 'exs' ),
						'default-absolute'                => esc_html__( 'Image with meta overlap', 'exs' ),
						'side'                            => esc_html__( 'Side featured image', 'exs' ),
						'side-small'                      => esc_html__( 'Side small featured image', 'exs' ),
						'side-small 2'                    => esc_html__( 'Side small featured image - 2 columns', 'exs' ),
						'side-small 2 masonry'            => esc_html__( 'Side small featured image - 2 columns Masonry', 'exs' ),
						'title-only'                      => esc_html__( 'Only title (no image, meta and excerpt)', 'exs' ),
						'title-meta-only'                 => esc_html__( 'Only title and meta (no image and excerpt)', 'exs' ),
					),
				),
				'search_sidebar_position'        => array(
					'type'    => 'radio',
					'section' => 'section_search',
					'label'   => esc_html__( 'Search results sidebar position', 'exs' ),
					'default' => esc_html( exs_option( 'search_sidebar_position', 'no' ) ),
					'choices' => exs_get_sidebar_position_options(),
				),
				'search_show_full_text'          => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show full text instead of excerpt', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_full_text', false ) ),
				),
				'search_excerpt_length'          => array(
					'type'        => 'number',
					'section'     => 'section_search',
					'label'       => esc_html__( 'Custom excerpt length', 'exs' ),
					'description' => esc_html__( 'Words amount', 'exs' ),
					'default'     => esc_html( exs_option( 'search_excerpt_length', '' ) ),
				),
				'search_read_more_text'          => array(
					'type'    => 'text',
					'section' => 'section_search',
					'label'   => esc_html__( '\'Read More\' text. Leave blank to hide', 'exs' ),
					'default' => esc_html( exs_option( 'search_read_more_text', '' ) ),
				),
				'search_meta_options_heading'    => array(
					'type'        => 'block-heading',
					'section'     => 'section_search',
					'label'       => esc_html__( 'Post meta options', 'exs' ),
					'description' => esc_html__( 'Select what post meta you want to show in blog feed. Not all layouts will show post meta even if it is checked.', 'exs' ),
				),
				'search_hide_meta_icons'         => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Hide icons in the post meta', 'exs' ),
					'default' => esc_html( exs_option( 'search_hide_meta_icons', false ) ),
				),
				'search_show_author'             => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show author', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_author', true ) ),
				),
				'search_show_author_avatar'      => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show author avatar', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_author_avatar', false ) ),
				),
				'search_before_author_word'      => array(
					'type'    => 'text',
					'section' => 'section_search',
					'label'   => esc_html__( 'Text before author', 'exs' ),
					'default' => esc_html( exs_option( 'search_before_author_word', '' ) ),
				),
				'search_show_date'               => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show date', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_date', true ) ),
				),
				'search_before_date_word'        => array(
					'type'    => 'text',
					'section' => 'section_search',
					'label'   => esc_html__( 'Text before date', 'exs' ),
					'default' => esc_html( exs_option( 'search_before_date_word', '' ) ),
				),
				'search_show_human_date'         => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show human difference date', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_human_date', false ) ),
				),
				'search_show_categories'         => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show categories', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_categories', true ) ),
				),
				'search_before_categories_word'  => array(
					'type'    => 'text',
					'section' => 'section_search',
					'label'   => esc_html__( 'Text before categories', 'exs' ),
					'default' => esc_html( exs_option( 'search_before_categories_word', '' ) ),
				),
				'search_show_tags'               => array(
					'type'    => 'checkbox',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show tags', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_tags', '' ) ),
				),
				'search_before_tags_word'        => array(
					'type'    => 'text',
					'section' => 'section_search',
					'label'   => esc_html__( 'Text before tags', 'exs' ),
					'default' => esc_html( exs_option( 'search_before_tags_word', '' ) ),
				),
				'search_show_comments_link'      => array(
					'type'    => 'select',
					'section' => 'section_search',
					'label'   => esc_html__( 'Show comments count', 'exs' ),
					'default' => esc_html( exs_option( 'search_show_comments_link', true ) ),
					'choices' => array(
						''       => esc_html__( 'None', 'exs' ),
						'text'   => esc_html__( 'Comments number with text', 'exs' ),
						'number' => esc_html__( 'Only comments number', 'exs' ),
					),
				),
				///////
				//404//
				///////
				'404_title'      => array(
					'type'    => 'text',
					'section' => 'section_404',
					'label'   => esc_html__( '404 Page Title', 'exs' ),
					'default' => esc_html( exs_option( '404_title', esc_html__( '404', 'exs' ) ) ),
					'description' => esc_html__( 'Appears in the title section', 'exs' ),
				),
				'404_heading'      => array(
					'type'    => 'text',
					'section' => 'section_404',
					'label'   => esc_html__( '404 Page Heading', 'exs' ),
					'default' => esc_html( exs_option( '404_heading', esc_html__( '404', 'exs' ) ) ),
				),
				'404_subheading'      => array(
					'type'    => 'text',
					'section' => 'section_404',
					'label'   => esc_html__( '404 Page Subheading', 'exs' ),
					'default' => esc_html( exs_option( '404_subheading', esc_html__( 'Oops, page not found!', 'exs' ) ) ),
				),
				'404_text_top'      => array(
					'type'    => 'text',
					'section' => 'section_404',
					'label'   => esc_html__( '404 Page Top Text', 'exs' ),
					'default' => esc_html( exs_option( '404_text_top', esc_html__( 'You can search what interested:', 'exs' ) ) ),
				),
				'404_show_searchform'               => array(
					'type'    => 'checkbox',
					'section' => 'section_404',
					'label'   => esc_html__( 'Show Search Form', 'exs' ),
					'default' => esc_html( exs_option( '404_show_searchform', true ) ),
				),
				'404_text_bottom'      => array(
					'type'    => 'text',
					'section' => 'section_404',
					'label'   => esc_html__( '404 Page Bottom Text', 'exs' ),
					'default' => esc_html( exs_option( '404_text_bottom', esc_html__( 'Or', 'exs' ) ) ),
				),
				'404_text_button'      => array(
					'type'    => 'text',
					'section' => 'section_404',
					'label'   => esc_html__( '404 Page Button Text', 'exs' ),
					'default' => esc_html( exs_option( '404_text_button', esc_html__( 'Go To Home', 'exs' ) ) ),
				),
				'404_text_button_url'      => array(
					'type'    => 'text',
					'section' => 'section_404',
					'label'   => esc_html__( '404 Page Button URL', 'exs' ),
					'default' => esc_html( exs_option( '404_text_button_url', '' ) ),
					'description' => esc_html__( 'Home page ULR will be used by default', 'exs' ),

				),

				//////////////////////
				//special categories//
				//////////////////////
				'special_categories_extra'              => array(
					'type'        => 'extra-button',
					'label'       => esc_html__( 'Special categories', 'exs' ),
					'description' => esc_html__( 'Set a post categories for your Portfolio, Services and Team members without using Custom Post Types', 'exs' ),
					'section'     => 'section_special_categories',
				),
				/////////////
				//animation//
				/////////////
				'animation_extra'                       => array(
					'type'        => 'extra-button',
					'label'       => esc_html__( 'Animation Extra Features', 'exs' ),
					'description' => esc_html__( 'Activate animation in your Customizer and set animation for your posts, widgets and any Gutenberg block', 'exs' ),
					'section'     => 'section_animation',
				),
				////////////////////
				//contact messages//
				////////////////////
				'contact_message_success'               => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Success message', 'exs' ),
					'default' => esc_html( exs_option( 'contact_message_success', '' ) ),
					'description' => esc_html__( 'Message that will be displayed after success form submission', 'exs' ),
					'section'     => 'section_contact_messages',
				),
				'contact_message_fail'                  => array(
					'type'    => 'text',
					'label'   => esc_html__( 'Error message', 'exs' ),
					'default' => esc_html( exs_option( 'contact_message_fail', '' ) ),
					'description' => esc_html__( 'Message that will be displayed if there was error', 'exs' ),
					'section'     => 'section_contact_messages',
				),
				//////////////////
				//popup messages//
				//////////////////
				'popup_extra'                           => array(
					'type'        => 'extra-button',
					'label'       => esc_html__( 'Pop-up Messages', 'exs' ),
					'description' => esc_html__( 'Add your top and bottom pop-up messages easily', 'exs' ),
					'section'     => 'section_messages',
				),
			) //options array
		); //apply_filters
	}
endif;


//init customizer with 'exs_customizer_settings_array' settings filter
add_action( 'init', 'exs_init_customizer_class' );
if ( ! function_exists( 'exs_init_customizer_class' ) ) :
	function exs_init_customizer_class() {
		$exs_customizer = new ExS_Customizer(
			exs_customizer_settings_array()
		);
	}
endif;
