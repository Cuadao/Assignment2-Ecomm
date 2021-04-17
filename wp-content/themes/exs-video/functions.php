<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//background #f9f9f9
//border #e5e5e5

//load parent CSS
if ( ! function_exists( 'exs_video_enqueue_static' ) ) :
	/**
	 * exs_video_enqueue_static
	 *
	 * @return void
	 * @since 0.0.1
	 */
	function exs_video_enqueue_static() {

		$min = exs_option( 'assets_min' ) && ! EXS_DEV_MODE ? 'min/' : '';
		//remove parent side nav
		wp_dequeue_style( 'exs-sidenav' );
		//main theme css file
		wp_enqueue_style( 'exs-video-style', get_stylesheet_directory_uri() . '/assets/css/' . $min . 'main.css', array( 'exs-style' ), wp_get_theme()->get( 'Version' ) );

	}
endif;
add_action( 'wp_enqueue_scripts', 'exs_video_enqueue_static', 20 );

//register side menu

if ( ! function_exists( 'exs_video_setup' ) ) :
	function exs_video_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this theme, use a find and replace
		 * to change 'exs-video' to the name of your theme in all the template files.
		 */
		load_child_theme_textdomain( 'exs-video', get_stylesheet_directory() . '/languages' );

		register_nav_menus(
			array(
				'side' => esc_html__( 'Side Menu', 'exs-video' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'exs_video_setup' );

//register side widget area
if ( ! function_exists( 'exs_video_widgets_init' ) ) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function exs_video_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Side menu', 'exs-video' ),
				'id'            => 'sidebar-side',
				'description'   => esc_html__( 'Add widgets here to appear in side menu sidebar.', 'exs-video' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);
	}
endif;
add_action( 'widgets_init', 'exs_video_widgets_init' );


//load side menu
if ( ! function_exists( 'exs_video_action_remove_parent_header_action' ) ) :
	function exs_video_action_remove_parent_header_action() {
		remove_action( 'exs_action_before_header', 'exs_extra_action_header_templates' );
	}
endif;
add_action( 'init', 'exs_video_action_remove_parent_header_action' );

if ( ! function_exists( 'exs_video_action_header_templates' ) ) :
	function exs_video_action_header_templates() {
		get_template_part( 'extra/template-parts/messages' );
		get_template_part( 'template-parts/side-nav' );
	}
endif;
add_action( 'exs_action_before_header', 'exs_video_action_header_templates' );

//load side menu
if ( ! function_exists( 'exs_video_default_options' ) ) :
	function exs_video_default_options() {
		return array(
			'demo_number'                           => '',
			'colorLight'                            => '#ffffff',
			'colorFont'                             => '#030303',
			'colorFontMuted'                        => '#606060',
			'colorBackground'                       => '#f9f9f9',
			'colorBorder'                           => '#e5e5e5',
			'colorDark'                             => '#444444',
			'colorDarkMuted'                        => '#020202',
			'colorMain'                             => '#d22525',
			'colorMain2'                            => '#b61010',
			'color_meta_icons'                      => 'meta-icons-main',
			'intro_block_heading'                   => '',
			'intro_position'                        => '',
			'intro_layout'                          => '',
			'intro_fullscreen'                      => '',
			'intro_background'                      => '',
			'intro_background_image'                => '',
			'intro_image_animation'                 => 'zoomIn',
			'intro_background_image_cover'          => '1',
			'intro_background_image_fixed'          => '1',
			'intro_background_image_overlay'        => '',
			'intro_heading'                         => '',
			'intro_heading_mt'                      => '',
			'intro_heading_mb'                      => '',
			'intro_heading_animation'               => 'fadeInUp',
			'intro_description'                     => '',
			'intro_description_mt'                  => '',
			'intro_description_mb'                  => '',
			'intro_description_animation'           => 'fadeInUp',
			'intro_button_text_first'               => '',
			'intro_button_url_first'                => '',
			'intro_button_first_animation'          => 'fadeInUp',
			'intro_button_text_second'              => '',
			'intro_button_url_second'               => '',
			'intro_button_second_animation'         => 'fadeInUp',
			'intro_buttons_mt'                      => '',
			'intro_buttons_mb'                      => '',
			'intro_shortcode'                       => '',
			'intro_shortcode_mt'                    => '',
			'intro_shortcode_mb'                    => '',
			'intro_shortcode_animation'             => '',
			'intro_alignment'                       => 'text-center',
			'intro_extra_padding_top'               => 'pt-5',
			'intro_extra_padding_bottom'            => 'pb-5',
			'intro_show_search'                     => '',
			'intro_font_size'                       => '',
			'intro_teasers_block_heading'           => '',
			'intro_teaser_section_layout'           => '',
			'intro_teaser_section_background'       => '',
			'intro_teaser_section_padding_top'      => 'pt-5',
			'intro_teaser_section_padding_bottom'   => 'pb-5',
			'intro_teaser_font_size'                => '',
			'intro_teaser_layout'                   => 'text-center',
			'intro_teaser_heading'                  => '',
			'intro_teaser_description'              => '',
			'logo'                                  => '1',
			'logo_text_primary'                     => '',
			'logo_text_secondary'                   => '',
			'header_top_tall'                       => '',
			'logo_background'                       => '',
			'logo_padding_horizontal'               => '',
			'skins_extra'                           => '',
			'main_container_width'                  => '1400',
			'blog_container_width'                  => '',
			'blog_single_container_width'           => '1140',
			'preloader'                             => '',
			'box_fade_in'                           => '',
			'totop'                                 => '',
			'assets_min'                            => '1',
			'buttons_uppercase'                     => '',
			'buttons_bold'                          => '',
			'buttons_colormain'                     => '1',
			'buttons_outline'                       => '',
			'buttons_radius'                        => '',
			'buttons_fs'                            => '',
			'meta_email'                            => '',
			'meta_email_label'                      => '',
			'meta_phone'                            => '',
			'meta_phone_label'                      => '',
			'meta_address'                          => '',
			'meta_address_label'                    => '',
			'meta_opening_hours'                    => '',
			'meta_opening_hours_label'              => '',
			'meta_facebook'                         => '',
			'meta_twitter'                          => '',
			'meta_youtube'                          => '',
			'meta_instagram'                        => '',
			'meta_pinterest'                        => '',
			'meta_linkedin'                         => '',
			'meta_github'                           => '',
			'side_extra'                            => '',
			'header_image_background_image_cover'   => '1',
			'header_image_background_image_fixed'   => '1',
			'header_image_background_image_overlay' => '',
			'header'                                => '1',
			'header_fluid'                          => '1',
			'header_background'                     => 'l',
			'header_toplogo_background'             => 'l',
			'header_align_main_menu'                => '',
			'header_toggler_menu_main'              => '1',
			'header_absolute'                       => '',
			'header_transparent'                    => '',
			'header_border_top'                     => '',
			'header_border_bottom'                  => '',
			'header_font_size'                      => '',
			'header_sticky'                         => 'always-sticky',
			'header_search'                         => 'form',
			'header_button_text'                    => '',
			'header_button_url'                     => '',
			'header_topline_options_heading'        => '',
			'topline'                               => '',
			'topline_fluid'                         => '1',
			'topline_background'                    => 'i c',
			'meta_topline_text'                     => '',
			'topline_font_size'                     => 'fs-14',
			'title'                                 => '1',
			'title_show_title'                      => '',
			'title_show_breadcrumbs'                => '1',
			'title_show_search'                     => '',
			'title_background'                      => '',
			'title_border_top'                      => '',
			'title_border_bottom'                   => '',
			'title_extra_padding_top'               => 'pt-3',
			'title_extra_padding_bottom'            => '',
			'title_font_size'                       => '',
			'title_hide_taxonomy_name'              => '',
			'title_background_image'                => '',
			'title_background_image_cover'          => '1',
			'title_background_image_fixed'          => '1',
			'title_background_image_overlay'        => '',
			'main_sidebar_width'                    => '25',
			'main_gap_width'                        => '',
			'main_sidebar_sticky'                   => '1',
			'main_extra_padding_top'                => '',
			'main_extra_padding_bottom'             => 'pb-5',
			'main_font_size'                        => 'fs-14',
			'sidebar_font_size'                     => 'fs-14',
			'footer_top'                            => '',
			'footer_top_content_heading_text'       => '',
			'footer_top_pre_heading'                => '',
			'footer_top_pre_heading_mt'             => '',
			'footer_top_pre_heading_mb'             => '',
			'footer_top_pre_heading_animation'      => '',
			'footer_top_heading'                    => '',
			'footer_top_heading_mt'                 => '',
			'footer_top_heading_mb'                 => '',
			'footer_top_heading_animation'          => '',
			'footer_top_description'                => '',
			'footer_top_description_mt'             => '',
			'footer_top_description_mb'             => '',
			'footer_top_description_animation'      => '',
			'footer_top_shortcode'                  => '',
			'footer_top_shortcode_mt'               => '',
			'footer_top_shortcode_mb'               => '',
			'footer_top_shortcode_animation'        => '',
			'footer_top_options_heading_text'       => '',
			'footer_top_fluid'                      => '',
			'footer_top_background'                 => '',
			'footer_top_border_top'                 => '',
			'footer_top_border_bottom'              => '',
			'footer_top_extra_padding_top'          => '',
			'footer_top_extra_padding_bottom'       => '',
			'footer_top_font_size'                  => '',
			'footer_top_background_image'           => '',
			'footer_top_background_image_cover'     => '',
			'footer_top_background_image_fixed'     => '',
			'footer_top_background_image_overlay'   => '',
			'footer'                                => '1',
			'footer_layout_gap'                     => '30',
			'footer_fluid'                          => '',
			'footer_background'                     => 'l',
			'footer_border_top'                     => '',
			'footer_border_bottom'                  => 'container',
			'footer_extra_padding_top'              => 'pt-5',
			'footer_extra_padding_bottom'           => 'pb-1',
			'footer_font_size'                      => 'fs-14',
			'footer_background_image'               => '',
			'footer_background_image_cover'         => '1',
			'footer_background_image_fixed'         => '1',
			'footer_background_image_overlay'       => '',
			'copyright'                             => '1',
			'copyright_text'                        => '&copy; [year] - All rights reserved',
			'copyright_fluid'                       => '',
			'copyright_background'                  => 'l',
			'copyright_extra_padding_top'           => 'pt-2',
			'copyright_extra_padding_bottom'        => 'pb-2',
			'copyright_font_size'                   => 'fs-14',
			'copyright_background_image'            => '',
			'copyright_background_image_cover'      => '',
			'copyright_background_image_fixed'      => '',
			'copyright_background_image_overlay'    => '',
			'font_body_extra'                       => '',
			'blog_layout'                           => 'cols 4',
			'blog_layout_gap'                       => '15',
			'blog_sidebar_position'                 => 'no',
			'blog_page_name'                        => '',
			'blog_show_full_text'                   => '',
			'blog_excerpt_length'                   => '0',
			'blog_read_more_text'                   => '',
			'blog_hide_taxonomy_type_name'          => '',
			'blog_meta_options_heading'             => '',
			'blog_hide_meta_icons'                  => '1',
			'blog_show_author'                      => '1',
			'blog_show_author_avatar'               => '1',
			'blog_before_author_word'               => '',
			'blog_show_date'                        => '1',
			'blog_before_date_word'                 => '',
			'blog_show_human_date'                  => '1',
			'blog_show_categories'                  => '',
			'blog_before_categories_word'           => '',
			'blog_show_tags'                        => '',
			'blog_before_tags_word'                 => '',
			'blog_show_comments_link'               => 'text',
			'blog_single_layout'                    => '',
			'blog_single_sidebar_position'          => 'right',
			'blog_single_first_embed_featured'      => 'all',
			'blog_single_show_author_bio'           => '',
			'blog_single_author_bio_about_word'     => '',
			'blog_single_post_nav_heading'          => '',
			'blog_single_post_nav'                  => '',
			'blog_single_post_nav_word_prev'        => '',
			'blog_single_post_nav_word_next'        => '',
			'blog_single_related_posts_heading'     => '',
			'blog_single_related_posts'             => '',
			'blog_single_related_posts_title'       => '',
			'blog_single_related_posts_number'      => '3',
			'blog_single_meta_options_heading'      => '',
			'blog_single_hide_meta_icons'           => '1',
			'blog_single_show_author'               => '1',
			'blog_single_show_author_avatar'        => '1',
			'blog_single_before_author_word'        => '',
			'blog_single_show_date'                 => '1',
			'blog_single_before_date_word'          => '',
			'blog_single_show_human_date'           => '',
			'blog_single_show_categories'           => '1',
			'blog_single_before_categories_word'    => '',
			'blog_single_show_tags'                 => '0',
			'blog_single_before_tags_word'          => '',
			'blog_single_show_comments_link'        => 'text',
			'special_categories_extra'              => '',
			'animation_extra'                       => '',
			'popup_extra'                           => '',
			'preset'                                => '',
			'skin'                                  => '',
			'jquery_to_footer'                      => '',
			'side_nav_position'                     => '',
			'side_nav_background'                   => 'l',
			'side_nav_sticked'                      => '1',
			'side_nav_sticked_shadow'               => '',
			'side_nav_sticked_border'               => '',
			'side_nav_header_overlap'               => '1',
			'side_nav_font_size'                    => 'fs-14',
			'header_toggler_menu_side'              => '1',
			'side_nav_logo_position'                => '',
			'side_nav_meta_position'                => 'bottom',
			'side_nav_social_position'              => 'bottom',
			'font_body_heading'                     => '',
			'font_body'                             => '{"font":"Roboto","variant":["300","regular","500","700"],"subset":[]}',
			'font_headings_heading'                 => '',
			'font_headings'                         => '{"font":"","variant":[],"subset":[]}',
			'category_portfolio_heading'            => '',
			'category_portfolio'                    => '',
			'category_portfolio_layout'             => 'cols-absolute-no-meta 3',
			'category_portfolio_layout_gap'         => '5',
			'category_portfolio_sidebar_position'   => 'no',
			'category_services_heading'             => '',
			'category_services'                     => '',
			'category_services_layout'              => 'cols-excerpt 3',
			'category_services_layout_gap'          => '60',
			'category_services_sidebar_position'    => 'no',
			'category_team_heading'                 => '',
			'category_team'                         => '',
			'category_team_layout'                  => 'cols-excerpt 3',
			'category_team_layout_gap'              => '50',
			'category_team_sidebar_position'        => 'no',
			'animation_enabled'                     => '',
			'animation_sidebar_widgets'             => '',
			'animation_footer_widgets'              => '',
			'animation_feed_posts'                  => '',
			'animation_feed_posts_thumbnail'        => '',
			'message_top_heading'                   => '',
			'message_top_id'                        => '',
			'message_top_text'                      => '',
			'message_top_close_button_text'         => '',
			'message_top_background'                => 'l m',
			'message_top_font_size'                 => '',
			'message_bottom_heading'                => '',
			'message_bottom_id'                     => '',
			'message_bottom_text'                   => '',
			'message_bottom_close_button_text'      => '',
			'message_bottom_background'             => 'l m',
			'message_bottom_font_size'              => '',
			'message_bottom_layout'                 => '',
			'message_bottom_bordered'               => '',
			'message_bottom_shadow'                 => '',
			'message_bottom_rounded'                => '',
			'intro_teaser_image_1'                  => '',
			'intro_teaser_title_1'                  => '',
			'intro_teaser_text_1'                   => '',
			'intro_teaser_link_1'                   => '',
			'intro_teaser_button_text_1'            => '',
			'intro_teaser_image_2'                  => '',
			'intro_teaser_title_2'                  => '',
			'intro_teaser_text_2'                   => '',
			'intro_teaser_link_2'                   => '',
			'intro_teaser_button_text_2'            => '',
			'intro_teaser_image_3'                  => '',
			'intro_teaser_title_3'                  => '',
			'intro_teaser_text_3'                   => '',
			'intro_teaser_link_3'                   => '',
			'intro_teaser_button_text_3'            => '',
			'intro_teaser_image_4'                  => '',
			'intro_teaser_title_4'                  => '',
			'intro_teaser_text_4'                   => '',
			'intro_teaser_link_4'                   => '',
			'intro_teaser_button_text_4'            => '',
		);
	}
endif;
add_filter( 'exs_default_theme_options', 'exs_video_default_options' );

//add plugins for various demos
add_filter( 'exs_required_plugins_array', 'exs_video_get_required_plugins_array' );
if ( ! function_exists( 'exs_video_get_required_plugins_array' ) ) :
	function exs_video_get_required_plugins_array( $exs_demos_array ) {
		//override default required plugins array
		$exs_demos_array = array(
			//Following plugins are required for all demo contents:
			'default' => array(
				array(
					'name'     => esc_html__( 'Comments Like Dislike', 'exs-video' ),
					'slug'     => 'comments-like-dislike',
					'required' => false,
				),
				array(
					'name'     => esc_html__( 'Posts Like Dislike', 'exs-video' ),
					'slug'     => 'posts-like-dislike',
					'required' => false,
				),
				array(
					'name'     => esc_html__( 'Post Views Counter', 'exs-video' ),
					'slug'     => 'post-views-counter',
					'required' => false,
				),
			),
		);
		return $exs_demos_array;
	}
endif;

//get theme option from default or from customizer
if ( ! function_exists( 'exs_option' ) ) :
	function exs_option( $exs_option_name, $exs_default_value = '' ) {
		//get theme defaults
		$exs_defaults = exs_get_default_options_array();

		//lowest priority is basic default value from theme defaults
		$exs_return = ( isset( $exs_defaults[ $exs_option_name ] ) ) ? $exs_defaults[ $exs_option_name ] : $exs_default_value;

		unset( $exs_defaults );

		//theme_mods are higher - if not empty - overriding value from theme default
		$exs_return = get_theme_mod( $exs_option_name, $exs_return );

		return $exs_return;
	}
endif;
