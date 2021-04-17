<?php
/**
 * @package Figure/Ground
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
		</div>
	<?php endif; ?>

	<footer class="entry-meta">
		<?php figureground_post_meta(); ?>
	</footer>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php /* translators: %s is the post title */
		// False post format = standard/default post format. Always show content for other formats.
		if ( false !== get_post_format() || 'content' === get_theme_mod( 'archive_excerpt', 'content' ) ) {
			the_content( sprintf( __( 'Continue reading %s', 'figureground' ),
				'<span class="screen-reader-text">' . get_the_title() .
				' </span><span class="meta-nav" aria-hidden="true">&rarr;</span>' ) );
				
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'figureground' ),
				'after'  => '</div>',
			) );
		} else {
			the_excerpt();
		}
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->
