<?php
/**
 * Template part for displaying posts
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

$exs_author_avatar  = exs_option( 'blog_show_author_avatar', '' );
$item_content_class = ! empty( $exs_author_avatar ) ? ' has-avatar' : '';

?>
<div class="grid-item">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/Article" itemscope="itemscope">
		<?php
		exs_post_thumbnail();
		?>
		<div class="item-content<?php echo esc_attr( $item_content_class ); ?>">
			<?php if ( get_the_title() ) : ?>
			<header class="entry-header entry-header-small">
				<?php
				exs_sticky_post_label();
				the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				?>
			</header><!-- .entry-header -->
			<?php endif; //get_the_title ?>

			<footer
				class="entry-footer entry-footer-top-author"><?php exs_entry_meta( true, true, false, false, false ); ?></footer>
			<!-- .entry-footer -->

			<div class="entry-content" itemprop="text">
				<?php

				the_excerpt();

				wp_link_pages(
					exs_get_wp_link_pages_atts()
				);
				?>
			</div><!-- .entry-content -->

			<footer
				class="entry-footer  entry-footer-bottom"><?php exs_entry_meta( false, false, false, true, false ); ?></footer>
			<!-- .entry-footer -->

		</div><!-- .item-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .grid-item -->
