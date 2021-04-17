<?php
/**
 * The side navigation template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! has_nav_menu( 'side' ) && ! is_active_sidebar( 'sidebar-side' ) ) {
	return;
}

$exs_side_nav_background           = exs_option( 'side_nav_background', 'l' );
$exs_side_nav_position             = exs_option( 'side_nav_position', '' );
$exs_side_nav_sticked_class        = exs_option( 'side_nav_sticked', '' ) ? 'sticked' : '';
$exs_side_nav_sticked_shadow_class = exs_option( 'side_nav_sticked_shadow', '' ) ? 'header-sticked-shadow' : '';
$exs_side_nav_sticked_border_class = exs_option( 'side_nav_sticked_border', '' ) ? 'header-sticked-border' : '';
$exs_side_nav_header_overlap_class = exs_option( 'side_nav_header_overlap', '' ) ? 'header-over-side-nav' : '';
$exs_side_nav_logo_position        = exs_option( 'side_nav_logo_position', '' );
$exs_side_nav_social_position      = exs_option( 'side_nav_social_position', '' );
$exs_side_nav_meta_position        = exs_option( 'side_nav_meta_position', '' );
$exs_side_nav_font_size            = exs_option( 'side_nav_font_size', '' );
$exs_toggler_side_in_header        = exs_option( 'header', '' );
//if header exists - double check that option to put toggler in header is active
if ( ! empty( $exs_toggler_side_in_header ) ) {
	$exs_toggler_side_in_header = exs_option( 'header_toggler_menu_side', false );
}
$exs_side_nav_toggler_class = ! $exs_toggler_side_in_header ? 'has-toggler' : '';
?>
<div id="side_nav" class="<?php echo esc_attr( $exs_side_nav_position . ' ' . $exs_side_nav_sticked_class . ' ' . $exs_side_nav_header_overlap_class . ' ' . $exs_side_nav_toggler_class . ' ' . $exs_side_nav_font_size . ' ' . $exs_side_nav_sticked_shadow_class . ' ' . $exs_side_nav_sticked_border_class ); ?>">
	<div id="nav_side" class="side-nav <?php echo esc_attr( $exs_side_nav_background ); ?>" aria-label="<?php esc_attr_e( 'Side Menu', 'exs-video' ); ?>">
		<?php
		if ( 'top' === $exs_side_nav_logo_position ) {
			get_template_part( 'template-parts/header/logo/logo', exs_template_part( 'logo', '1' ) );
		}

		if ( 'top' === $exs_side_nav_meta_position ) {
			$exs_phone   = exs_option( 'meta_phone' );
			$exs_email   = exs_option( 'meta_email' );
			$exs_address = exs_option( 'meta_address' );

			if (
				! empty( $exs_phone )
				||
				! empty( $exs_email )
				||
				! empty( $exs_address )
			) :
				?>
				<span class="meta">
			<?php
			endif; //any meta

			if ( ! empty( $exs_phone ) ) :
				?>
				<span class="icon-inline">
				<?php exs_icon( 'phone-outline' ); ?>
					<span><?php echo wp_kses_post( $exs_phone ); ?></span>
				</span>
			<?php
			endif; //phone
			if ( ! empty( $exs_email ) ) :
				?>
				<span class="icon-inline">
				<?php exs_icon( 'email-outline' ); ?>
					<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $exs_email ) ); ?>"><?php echo sanitize_email( $exs_email ); ?></a>
				</span>
			<?php
			endif; //email
			if ( ! empty( $exs_address ) ) :
				?>
				<span class="icon-inline">
				<?php exs_icon( 'map-marker-outline' ); ?>
					<span><?php echo wp_kses_post( $exs_address ); ?></span>
				</span>
			<?php
			endif; //address

			if (
				! empty( $exs_phone )
				||
				! empty( $exs_email )
				||
				! empty( $exs_address )
			) :
				?>
				</span>
			<?php
			endif; //any meta
		}

		if ( 'top' === $exs_side_nav_social_position ) {
			exs_social_links();
		}

		if ( has_nav_menu( 'side' ) ) :
			wp_nav_menu(
				array(
					'theme_location'  => 'side',
					'container'       => 'nav',
					'container_class' => 'widget widget_nav_menu',
					'menu_class'      => 'side-menu',
				)
			);
		endif;

		if ( is_active_sidebar( 'sidebar-side' ) ) :
			dynamic_sidebar( 'sidebar-side' );
		endif; //is_active_sidebar

		if ( 'bottom' === $exs_side_nav_logo_position ) {
			get_template_part( 'template-parts/header/logo/logo', exs_template_part( 'logo', '1' ) );
		}

		if ( 'bottom' === $exs_side_nav_meta_position ) :
			$exs_phone   = exs_option( 'meta_phone' );
			$exs_email   = exs_option( 'meta_email' );
			$exs_address = exs_option( 'meta_address' );

			if (
				! empty( $exs_phone )
				||
				! empty( $exs_email )
				||
				! empty( $exs_address )
			) :
				?>
				<span class="meta">
			<?php
			endif; //any meta

			if ( ! empty( $exs_phone ) ) :
				?>
				<span class="icon-inline">
				<?php exs_icon( 'phone-outline' ); ?>
					<span><?php echo wp_kses_post( $exs_phone ); ?></span>
				</span>
			<?php
			endif; //phone
			if ( ! empty( $exs_email ) ) :
				?>
				<span class="icon-inline">
				<?php exs_icon( 'email-outline' ); ?>
					<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $exs_email ) ); ?>"><?php echo sanitize_email( $exs_email ); ?></a>
				</span>
			<?php
			endif; //email
			if ( ! empty( $exs_address ) ) :
				?>
				<span class="icon-inline">
				<?php exs_icon( 'map-marker-outline' ); ?>
					<span><?php echo wp_kses_post( $exs_address ); ?></span>
				</span>
			<?php
			endif; //address

			if (
				! empty( $exs_phone )
				||
				! empty( $exs_email )
				||
				! empty( $exs_address )
			) :
				?>
				</span>
			<?php
			endif; //any meta
		endif; //side_nav_meta_position

		if ( 'bottom' === $exs_side_nav_social_position ) {
			exs_social_links();
		}
		?>
	</div><!-- .side-nav -->
	<?php if ( empty( $exs_toggler_side_in_header ) ) : ?>
		<button id="nav_side_toggle" class="nav-btn"
		        aria-controls="nav_side"
		        aria-expanded="false"
		        aria-label="<?php esc_attr_e( 'Side Menu Toggler', 'exs-video' ); ?>"
		>
			<span></span>
		</button>
	<?php
	//echo closing button if main button is inside header section
	else :
		?>
		<button id="nav_side_close" class="nav-btn"
		        aria-controls="nav_side"
		        aria-expanded="true"
		        aria-label="<?php esc_attr_e( 'Side Menu Close', 'exs-video' ); ?>"
		>
			<span></span>
		</button>
	<?php endif; ?>
</div><!-- #side_nav -->
