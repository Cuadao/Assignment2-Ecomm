<?php
/**
 * Custom styling for external embeds.
 */

add_action( 'embed_head', 'figureground_embed_head' );
function figureground_embed_head() {
	$light = sanitize_hex_color( get_theme_mod( 'fg_color_light', '#f7f7ec' ) );
	$dark = sanitize_hex_color( get_theme_mod( 'fg_color_dark', '#222' ) );
?>
<style type="text/css">
	/* Figure/Ground Theme Styles for External Embeds */
	.wp-embed {
		padding: 23px;
		font-size: 16px;
		color: <?php echo $dark; ?>;
		font-weight: 300;
		background: <?php echo $light; ?>;
		border: 1px solid #222;
	}

	.wp-embed .wp-embed-heading a,
	.wp-embed a,
	.wp-embed .wp-embed-more {
		color: <?php echo $dark; ?>;
	}

	.wp-embed .wp-embed-more {
		text-decoration: underline;
	}

	.wp-embed .wp-embed-more:hover,
	.wp-embed .wp-embed-more:focus {
		opacity: .7;
		text-decoration: none;
	}

	.wp-embed-footer {
		margin-top: 24px;
	}

	.wp-embed-featured-image {
		margin-bottom: 16px;
	}
</style>
<?php
}
