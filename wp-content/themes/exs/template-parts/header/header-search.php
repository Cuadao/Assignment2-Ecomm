<?php
/**
 * The header search template file
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

$exs_search = exs_option( 'header_search', '' );

if ( empty( $exs_search ) ) {
	return;
}

$exs_hidden_class = exs_option( 'header_search_hidden' );

switch ( $exs_search ) :
	case 'button':
		?>
		<div class="header-search <?php echo esc_attr( $exs_hidden_class ); ?>">
			<button id="search_toggle"
					aria-controls="search_dropdown"
					aria-expanded="false"
					aria-label="<?php esc_attr_e( 'Search Dropdown Toggler', 'exs' ); ?>"
			>
				<?php
				exs_icon( 'magnify' );
				?>
			</button>
		</div><!-- .header-search -->
		<?php
		break;

	//form
	default:
		?>
		<div class="header-search <?php echo esc_attr( $exs_hidden_class ); ?>">
			<?php get_search_form(); ?>
		</div><!-- .header-search -->
		<?php
endswitch;
