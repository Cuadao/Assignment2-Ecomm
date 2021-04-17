<?php
/**
 * @package Figure/Ground
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>

	<footer class="entry-meta">
		<?php figureground_post_meta(); ?>
	</footer>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php /* translators: %s is the post title */
		the_content( sprintf( __( 'Continue reading %s', 'figureground' ),
			'<span class="screen-reader-text">' . get_the_title() .
			' </span><span class="meta-nav">&rarr;</span>' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'figureground' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->