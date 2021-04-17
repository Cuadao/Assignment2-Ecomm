<?php
/**
 * The template used for displaying hero content
 *
 * @package Catch_Revolution
 */

$catch_revolution_enable_section = get_theme_mod( 'catch_revolution_hero_content_visibility', 'disabled' );

if ( ! catch_revolution_check_section( $catch_revolution_enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type-hero' );

