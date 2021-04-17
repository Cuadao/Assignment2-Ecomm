<?php
/**
 * Functions that return the color patterns for the Figure/Ground theme.
 */

require( 'color-calculations.php' );

function figureground_fg_colors_css() {
	$fg_light = get_theme_mod( 'fg_color_light', '#f7f7ec' );
	$fg_dark = get_theme_mod( 'fg_color_dark', '#222222' );

	// Defaults for both, so don't need to do anything.
	if ( '#f7f7ec' === $fg_light && '#222222' === $fg_dark && ! is_customize_preview() ) {
		return '';
	}

	$css = '';

	// Check contrast between figure/ground colors.
	if ( 4.5 > figureground_contrast_ratio( $fg_light, $fg_dark ) ) {
		// There isn't enough contrast, so we need to adjust the chosen colors.
		// Start by lightening light, up to white.
		while ( 4.5 > figureground_contrast_ratio( $fg_light, $fg_dark )
				&& 1 > figureground_relative_luminance( $fg_light ) ) {
					$fg_light = figureground_adjust_color( $fg_light, 8 );
				}
		// Do we need to do more?
		if ( 4.5 > figureground_contrast_ratio( $fg_light, $fg_dark ) ) {
			// Darken the dark color until we get there (should never reach anywhere near black).
			while ( 4.5 > figureground_contrast_ratio( $fg_light, $fg_dark )
					&& 0 < figureground_relative_luminance( $fg_dark ) ) {
						$fg_dark = figureground_adjust_color( $fg_dark, -8 );
					}
		}
	}

	// Dark figure/ground color.
	$css .= '
	body,
	button,
	input,
	select,
	textarea,
	.main-navigation li.current_page_item a:hover,
	.main-navigation li.current-menu-item a:hover,
	.error404 .page-content,
	.site-main article:nth-child(even) .entry-thumbnail,
	.site-main article:nth-child(even) .entry-meta,
	.site-main article:nth-child(even) .entry-header,
	.site-main article:nth-child(even) .entry-content,
	.site-main article:nth-child(even) .entry-summary,
	.site-main article.formatted-post:nth-child(even) a.post-format-link:before,
	.site-main article:nth-child(even) footer.entry-meta li.edit-link a:before,
	.site-main article:nth-child(even) .entry-title a,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(even),
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(odd),
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(even) a,
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(odd) a,
	.gallery-item:nth-of-type(even) .gallery-caption,
	.wp-block-gallery .blocks-gallery-image:nth-of-type(even) figcaption,
	.wp-block-gallery .blocks-gallery-item:nth-of-type(even) figcaption,
	.hentry .mejs-container .mejs-controls .mejs-time span,
	.widget .mejs-container .mejs-controls .mejs-time span,
	.hentry .mejs-overlay-button,
	.widget .mejs-overlay-button,
	.hentry .mejs-controls .mejs-button button,
	.widget .mejs-controls .mejs-button button,
	article:nth-child(even) .mejs-overlay:hover .mejs-overlay-button,
	.wp-playlist.wp-playlist-light,
	.wp-playlist-light .wp-playlist-item,
	.wp-playlist-light .wp-playlist-playing,
	.wp-playlist-light .wp-playlist-item .wp-playlist-caption,
	.comments-title,
	.comment-list > li:nth-child(even) article.comment-body,
	.comment-respond,
	p.no-comments,
	aside.widget:nth-child(even),
	#menu-social li a,
	.has-fg-dark-color,
	#figureground-animation-toggle:hover,
	#figureground-animation-toggle:focus {
		color: ' . $fg_dark . ';
	}

	header#masthead,
	.main-navigation.toggled .nav-menu,
	header.page-header,
	.site-main article .entry-thumbnail,
	.site-main article .entry-meta,
	.site-main article .entry-header,
	.site-main article .entry-content,
	.site-main article .entry-summary,
	.site-main article.formatted-post a.post-format-link:before,
	.site-main article footer.entry-meta li.edit-link a:before,
	.site-main nav.post-navigation,
	.site-main nav.paging-navigation,
	article.formatted-post a.post-format-link:before,
	footer.entry-meta li,
	.hentry .mejs-controls .mejs-time-rail .mejs-time-loaded,
	.widget .mejs-controls .mejs-time-rail .mejs-time-loaded,
	.hentry .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
	.widget .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
	article:nth-child(even) .mejs-mediaelement,
	article:nth-child(even) .mejs-container .mejs-controls,
	article:nth-child(odd) .wp-playlist.wp-playlist-light,
	.comment-list .pingback,
	aside.widget,
	.site-info,
	.gallery-caption,
	.alignwide figcaption,
	.alignfull figcaption,
	.wp-block-gallery .blocks-gallery-image figcaption,
	.wp-block-gallery .blocks-gallery-item figcaption,
	#figureground-animation-toggle {
		background: ' . $fg_dark . ';
	}

	.site-main article:nth-child(even) blockquote {
		border-left-color: ' . $fg_dark . ';
	}

	#figureground-animation-toggle {
		border-color: ' . $fg_dark . ';
	}

	article:nth-child(even) .hentry .mejs-overlay-button,
	article.comment-body,
	.comment-navigation,
	.has-fg-dark-background-color {
		background-color: ' . $fg_dark . ';
	}

	::selection {
		color: ' . $fg_dark . ';
	}

	::-moz-selection {
		color: ' . $fg_dark . ';
	}';

	// Generated color.
	$fg_mid = figureground_adjust_color( $fg_light, -64 );
	$css .= '
	h2.site-description {
		color: ' . $fg_mid . ';
	}';

	// Light figure/ground color.
	$css .= '
	body,
	canvas#figure-ground,
	.error404 .page-content,
	.site-main article:nth-child(even) .entry-thumbnail,
	.site-main article:nth-child(even) .entry-meta,
	.site-main article:nth-child(even) .entry-header,
	.site-main article:nth-child(even) .entry-content,
	.site-main article:nth-child(even) .entry-summary,
	.site-main article.formatted-post:nth-child(even) a.post-format-link:before,
	.site-main article:nth-child(even) footer.entry-meta li.edit-link a:before,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(even),
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(odd),
	.hentry .mejs-mediaelement,
	.widget .mejs-mediaelement,
	.hentry .mejs-container .mejs-controls,
	.widget .mejs-container .mejs-controls,
	article:nth-child(even) .mejs-controls .mejs-time-rail .mejs-time-loaded,
	article:nth-child(even) .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
	.wp-playlist.wp-playlist-light,
	.comments-title,
	p.no-comments,
	aside.widget:nth-child(even),
	#menu-social li a,
	.gallery-item:nth-of-type(even) .gallery-caption,
	.wp-block-gallery .blocks-gallery-image:nth-of-type(even) figcaption,
	.wp-block-gallery .blocks-gallery-item:nth-of-type(even) figcaption,
	#figureground-animation-toggle:hover,
	#figureground-animation-toggle:focus {
		background: ' . $fg_light . ';
	}

	.hentry .mejs-overlay-button,
	.widget .mejs-overlay-button,
	.comment-list > li:nth-child(even) article.comment-body,
	.comment-respond,
	.has-fg-light-background-color {
		background-color: ' . $fg_light . ';
	}

	blockquote {
		border-color: ' . $fg_light . ';
	}

	.button,
	.site-main .entry-content .button,
	.wp-block-button__link,
	.site-main .entry-content .wp-block-file__button,
	.site-main .entry-content .wp-block-button__link,
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.button:hover,
	.site-main .entry-content .button:hover,
	.wp-block-button__link:hover,
	.site-main .entry-content .wp-block-file__button:hover,
	.site-main .entry-content .wp-block-button__link:hover,
	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	.button:focus,
	.site-main .entry-content .button:focus,
	.wp-block-button__link:focus,
	.site-main .entry-content .wp-block-file__button:focus,
	.site-main .entry-content .wp-block-button__link:focus,
	button:focus,
	input[type="button"]:focus,
	input[type="reset"]:focus,
	input[type="submit"]:focus,
	header#masthead,
	h1.site-title a,
	.site-header .search-form label:before,
	.menu-toggle,
	.main-navigation li a,
	header.page-header,
	.site-main article .entry-thumbnail,
	.site-main article .entry-meta,
	.site-main article .entry-header,
	.site-main article .entry-content,
	.site-main article .entry-summary,
	.site-main article.formatted-post a.post-format-link:before,
	.site-main article footer.entry-meta li.edit-link a:before,
	.site-main article .entry-title a,
	article.sticky,
	article.sticky .entry-header,
	article.sticky .entry-content,
	article.sticky h1.entry-title a:hover,
	.site-main nav.post-navigation,
	.site-main nav.paging-navigation,
	article.formatted-post a.post-format-link:before,
	footer.entry-meta li,
	footer.entry-meta li.posted-on a,
	footer.entry-meta li.comments-link a,
	footer.entry-meta li.image-size a,
	footer.entry-meta li.posted-in a,
	footer.entry-meta li div,
	.hentry .mejs-overlay:hover .mejs-overlay-button,
	.widget .mejs-overlay:hover .mejs-overlay-button,
	article:nth-child(even) .mejs-container .mejs-controls .mejs-time span,
	article:nth-child(even) .mejs-controls .mejs-button button,
	article:nth-child(odd) .wp-playlist.wp-playlist-light,
	article:nth-child(odd) .wp-playlist-light .wp-playlist-item,
	article:nth-child(odd) .wp-playlist-light .wp-playlist-playing,
	article:nth-child(odd) .wp-playlist-light .wp-playlist-item .wp-playlist-caption,
	article.comment-body,
	.comment-list .comment.bypostauthor > article.comment-body,
	.comment-list .pingback,
	.comment-navigation,
	aside.widget,
	.site-info a,
	.site-info,
	.gallery-caption,
	.wp-block-gallery .blocks-gallery-image figcaption,
	.wp-block-gallery .blocks-gallery-item figcaption,
	.has-fg-light-color,
	.alignwide figcaption,
	.alignfull figcaption {
		color: ' . $fg_light . ';
	}

	footer.entry-meta li.toggled,
	footer.entry-meta li div a {
		color: ' . $fg_light . ' !important;
	}';

	return $css;
}

function figureground_accent_colors_css() {
	$accent_light = get_theme_mod( 'accent_color_light', '#87f' );
	$accent_dark = get_theme_mod( 'accent_color_dark', '#903' );
	$fg_light = get_theme_mod( 'fg_color_light', '#f7f7ec' );
	$fg_dark = get_theme_mod( 'fg_color_dark', '#222222' );
	$css = '';

	// Check contrast between figure/ground and accent colors.
	if ( 3 > figureground_contrast_ratio( $accent_light, $fg_dark ) ) {
		// There isn't enough contrast, so we need to adjust the chosen color.
		// Only change the accent color, so 3:1 contrast may not be acheived.
		while ( 3 > figureground_contrast_ratio( $accent_light, $fg_dark )
				&& 1 > figureground_relative_luminance( $accent_light ) ) {
					$accent_light = figureground_adjust_color( $accent_light, 8 );
				}
	}

	if ( 3 > figureground_contrast_ratio( $accent_dark, $fg_light ) ) {
		// There isn't enough contrast, so we need to adjust the chosen color.
		// Only change the accent color, so 3:1 contrast may not be acheived.
		while ( 3 > figureground_contrast_ratio( $accent_dark, $fg_light )
				&& 0 < figureground_relative_luminance( $accent_dark ) ) {
					$accent_dark = figureground_adjust_color( $accent_dark, -8 );
				}
	}

	// Light accent color, which must contrast with the dark figure/ground color.
	$css .= '
	.site-header .search-field:focus,
	.main-navigation.toggled .nav-menu,
	#menu-social ul {
		border-color: ' . $accent_light . ';
	}
	.main-navigation a:hover,
	article:nth-child(even) .mejs-controls .mejs-time-rail .mejs-time-current,
	#menu-social li a:hover,
	#menu-social li a:focus {
		background: ' . $accent_light . ';
	}
	article:nth-child(even) .mejs-overlay:hover .mejs-overlay-button,
	.has-accent-light-background-color {
		background-color: ' . $accent_light . ';
	}
	a,
	.menu-toggle:focus,
	.menu-toggle:hover,
	.main-navigation.toggled .menu-toggle,
	.main-navigation.toggled .nav-menu:before,
	.main-navigation li.current_page_item a,
	.main-navigation li.current-menu-item a,
	.site-main article a,
	.site-main article .entry-title a:hover,
	.site-main article .entry-title a:active,
	.site-main article .entry-title a:focus,
	article.formatted-post a.post-format-link:hover:before,
	article.formatted-post a.post-format-link:active:before,
	article.formatted-post a.post-format-link:focus:before,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(odd) a:hover,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(odd) a:active,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(odd) a:focus,
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(even) a:hover,
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(even) a:active,
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(even) a:focus,
	.site-main article footer.entry-meta li.edit-link a:hover:before,
	.site-main article footer.entry-meta li.edit-link a:active:before,
	.site-main article footer.entry-meta li.edit-link a:focus:before,
	article:nth-child(even) .mejs-controls .mejs-button button:hover,
	article:nth-child(odd) .wp-playlist-light .wp-playlist-item .wp-playlist-caption:hover,
	.has-accent-light-color {
		color: ' . $accent_light . ';
	}';

	// Modified light accent color.
	$accent_lighter = figureground_adjust_color( $accent_light, 64 );
	$css .= '
	a:hover,
	a:focus,
	a:active {
		color: ' . $accent_lighter . ';
	}
	::selection {
		background: ' . $accent_lighter . ';
	}
	::-moz-selection {
		background: ' . $accent_lighter . ';
	}

	.site-main article a:hover,
	.site-main article a:active,
	.site-main article a:focus {
		color: ' . $accent_lighter . ';
	}';

	// Dark accent color, must contrast with light figure/ground color.
	$css .= '
	.button,
	.entry-content .button,
	.wp-block-button__link,
	.site-main .entry-content .wp-block-file__button,
	.site-main .entry-content .wp-block-button__link,
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	article.sticky,
	article.sticky .entry-header,
	article.sticky .entry-content,
	footer.entry-meta li div,
	.hentry .mejs-controls .mejs-time-rail .mejs-time-current,
	.widget .mejs-controls .mejs-time-rail .mejs-time-current {
		background: ' . $accent_dark . ';
	}
	footer.entry-meta li.toggled {
		background: ' . $accent_dark . ' !important;
	}
	.hentry .mejs-overlay:hover .mejs-overlay-button,
	.widget .mejs-overlay:hover .mejs-overlay-button,
	.comment-list .comment.bypostauthor > article.comment-body,
	.has-accent-dark-background-color {
		background-color: ' . $accent_dark . ';
	}
	.site-main article:nth-child(even) a,
	.site-main article:nth-child(even) .entry-title a:hover,
	.site-main article:nth-child(even) .entry-title a:active,
	.site-main article:nth-child(even) .entry-title a:focus,
	.site-main article.formatted-post:nth-child(even) a.post-format-link:hover:before,
	.site-main article.formatted-post:nth-child(even) a.post-format-link:active:before,
	.site-main article.formatted-post:nth-child(even) a.post-format-link:focus:before,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(even) a:hover,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(even) a:active,
	.site-main article:nth-child(odd) footer.entry-meta li:nth-child(even) a:focus,
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(odd) a:hover,
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(odd) a:active,
	.site-main article:nth-child(even) footer.entry-meta li:nth-child(odd) a:focus,
	.site-main article:nth-child(even) footer.entry-meta li.edit-link a:hover:before,
	.site-main article:nth-child(even) footer.entry-meta li.edit-link a:active:before,
	.site-main article:nth-child(even) footer.entry-meta li.edit-link a:focus:before,
	.hentry .mejs-controls .mejs-button button:hover,
	.widget .mejs-controls .mejs-button button:hover,
	.wp-playlist-light .wp-playlist-item .wp-playlist-caption:hover,
	.comment-respond a,
	.comment-list > li:nth-child(even) article.comment-body a,
	aside.widget:nth-child(even) a,
	.has-accent-dark-color {
		color: ' . $accent_dark . ';
	}';

	// Modified dark accent color.
	$accent_dark_lightened = figureground_adjust_color( $accent_dark, 64 );
	$css .= '
	.button:hover,
	.entry-content .button:hover,
	.wp-block-button__link:hover,
	.site-main .entry-content .wp-block-file__button:hover,
	.site-main .entry-content .wp-block-button__link:hover,
	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	.button:focus,
	.entry-content .button:focus,
	.wp-block-button__link:focus,
	.site-main .entry-content .wp-block-file__button:focus,
	.entry-content .wp-block-button__link:focus,
	button:focus,
	input[type="button"]:focus,
	input[type="reset"]:focus,
	input[type="submit"]:focus {
		background: ' . $accent_dark_lightened . ';
	}

	.site-main article:nth-child(even) a:hover,
	.site-main article:nth-child(even) a:active,
	.site-main article:nth-child(even) a:focus,
	.comment-respond a:hover,
	.comment-respond a:active,
	.comment-respond a:focus,
	.comment-list > li:nth-child(even) article.comment-body a:hover,
	.comment-list > li:nth-child(even) article.comment-body a:active
	.comment-list > li:nth-child(even) article.comment-body a:focus,
	aside.widget:nth-child(even) a:hover,
	aside.widget:nth-child(even) a:active,
	aside.widget:nth-child(even) a:focus {
		color: ' . $accent_dark_lightened . ';
	}';

	return $css;
}