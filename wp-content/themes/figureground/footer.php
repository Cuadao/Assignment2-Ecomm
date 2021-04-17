<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=content div and all content after.
 *
 * @package Figure/Ground
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'main' ) ) : ?>
			<div class="widgets-container" role="complementary">
				<div class="widget-area">
					<?php dynamic_sidebar( 'main' ); ?>
				</div><!-- .widget-area -->
			</div><!-- .widgets-container -->
		<?php endif; ?>
		<div class="site-info" role="contentinfo">
			<?php figureground_footer_credits(); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>