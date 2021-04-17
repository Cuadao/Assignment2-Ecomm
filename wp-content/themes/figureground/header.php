<?php
/**
 * The Header for the theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Figure/Ground
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
} ?>
<div class="skip-link"><a href="#content" class="screen-reader-text "><?php _e( 'Skip to content', 'figureground' ); ?></a></div>
<canvas id="figure-ground" role="img" aria-label="<?php esc_attr_e( 'Solid/void dynamic background graphic', 'figureground' ); ?>"></canvas>
<?php if ( 0 < absint( get_theme_mod( 'fg_speed', 0 ) || is_customize_preview() ) ) {
	echo '<button type="button" id="figureground-animation-toggle"  class="on"><span class="pause">'
			. __( 'Pause', 'figureground' ) . '</span><span class="play">'
			. __( 'Play', 'figureground' ) . '</span><span class="screen-reader-text"> '
			. __( 'background graphic animation', 'figureground' ) . '</button>';
} ?>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="header-inner">
			<div class="site-branding">
				<h1 class="site-title">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
						the_custom_logo();
					} elseif ( get_header_image() ) { // Back compat for Figure/Ground 1.X ?>
						<img src="<?php header_image(); ?>" class="site-logo" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
					<?php } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="title"><?php bloginfo( 'name' ); ?></span></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Main', 'figureground' ); ?>">
				<button type="button" class="menu-toggle"><span class="screen-reader-text"><?php _e( 'Menu', 'figureground' ); ?></span></button>

				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class' => 'nav-menu',
					'depth' => 1,
				) );
				if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'container'       => 'div',
							'container_id'    => 'menu-social',
							'container_class' => 'menu',
							'menu_id'         => 'menu-social-items',
							'menu_class'      => 'menu-items',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => '',
						)
					);
				}
				get_search_form(); ?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
