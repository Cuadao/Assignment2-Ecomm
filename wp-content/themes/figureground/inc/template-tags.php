<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Figure/Ground
 */

if ( ! function_exists( 'figureground_post_meta' ) ) :
function figureground_post_meta() {
?>	<ul>
<?php
	// Post format
	if ( has_post_format() && in_array( get_post_format(), array( 'aside', 'image', 'gallery', 'video', 'audio', 'quote', 'link' ) ) ) {
		$format = get_post_format();
		echo '<li class="post-format-icon"><a class="post-format-link" href="' . get_post_format_link( $format ) . '">View all ' . $format . ' posts</a></li>';
	} else {
		echo '<li class="post-format-icon empty"></li>';
	}
	
	// Author
	if ( is_multi_author() ) {
		printf( '<li class="post-author">%1$s</li>',
			sprintf( '<a href="%1$s" title="%2$s">%3$s<span class="author-name">%4$s</span></a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'figureground' ), get_the_author() ) ),
				get_avatar( get_the_author_meta( 'ID' ), 64 ),
				esc_html( get_the_author() )
			)
		);
	} else {
		echo '<li class="post-author empty"></li>';
	}

	// Date/time
	// Clock time icon.
	$clock = sprintf( '<canvas class="clock-canvas" aria-hidden="true" title="%1$s" data-minute="%2$s" data-hour="%3$s"></canvas>',
		esc_attr( get_the_time() ),
		absint( get_the_time( 'i' ) ),
		absint( get_the_time( 'g' ) )
	);

	// Date text and screen reader text.	
	$time_string = '<span class="screen-reader-text">' . __( 'Posted on: ', 'figureground' ) . '</span>';
	$time_string .= '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<span class="screen-reader-text">' . __( 'Updated on: ', 'figureground' ) . '</span>';
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'm d y' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<li class="posted-on">%1$s</li>', 'figureground' ),
		$clock . sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		)
	);

	// Categories
	if ( 'post' === get_post_type() && figureground_categorized_blog() ) {
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( __( ', ', 'figureground' ) );
		echo '<li class="post-categories"><button type="button" class="post-meta-toggle screen-reader-text">' . __( 'Toggle category list', 'figureground' ) . '</button><div class="post-categories-list">' . $category_list . '</div></li>';
	}

	// Tags
	if ( 'post' === get_post_type() && has_tag() ) {	
		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'figureground' ) );
		echo '<li class="post-tags"><button type="button" class="post-meta-toggle screen-reader-text">' . __( 'Toggle tags list', 'figureground' ) . '</button><div class="post-tags-list">' . $tag_list . '</div></li>';
	}

	// Comments
	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
		$class = 'comments-link';
		if ( 0 != get_comments_number() ) {
			$class .= ' has-comments';
		}
		if ( 10 <= get_comments_number() ) {
			$class .= ' double-digit';
		}
		echo '<li class="' . $class . '">';
		comments_popup_link();
		echo '</li>';
	}

	// Edit Link
	/* translators: %s is the post title */
	edit_post_link( sprintf( __( 'Edit %s', 'figureground' ), get_the_title() ), '<li class="edit-link">', '</li>' );
?>	</ul>
<?php
}
endif; // figureground_post_meta()


if ( ! function_exists( 'figureground_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable.
 */
function figureground_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
		return;
	}

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>" aria-label="<?php _e( 'Post', 'figureground' ); ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'figureground' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav" aria-hidden="true">' . _x( '&larr;', 'Previous post link', 'figureground' ) . '</span>&nbsp;%title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title&nbsp;<span class="meta-nav" aria-hidden="true">' . _x( '&rarr;', 'Next post link', 'figureground' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav" aria-hidden="true">&larr;</span> Older posts', 'figureground' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav" aria-hidden="true">&rarr;</span>', 'figureground' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // figureground_content_nav

if ( ! function_exists( 'figureground_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function figureground_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'figureground' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'figureground' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'figureground' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'figureground' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'figureground' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'figureground' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for figureground_comment()

if ( ! function_exists( 'figureground_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function figureground_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'figureground_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'figureground_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function figureground_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// Date text and screen reader text.
	printf( __( '<span class="posted-on">%1$s</span><span class="byline">%2$s</span>', 'figureground' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'figureground' ), get_the_author() ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function figureground_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so figureground_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so figureground_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in figureground_categorized_blog
 */
function figureground_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'figureground_category_transient_flusher' );
add_action( 'save_post',     'figureground_category_transient_flusher' );

/**
 * Display footer credits area.
 */
function figureground_footer_credits() {
	do_action( 'figureground_credits' ); 
	$sep_span = '<span class="sep" role="separator" aria-hidden="true"> | </span>'; ?>
	&copy <?php echo date('Y'); ?> <a href="<?php esc_attr( home_url() ); ?>" id="footer-copy-name"><?php echo esc_html( get_theme_mod( 'copy_name', get_bloginfo( 'name' ) ) ); ?></a>
	<?php if ( '' !== get_privacy_policy_url() ) { ?>
		<span class="privacy-policy">
			<?php echo $sep_span; the_privacy_policy_link(); ?>
		</span>
	<?php } if ( get_theme_mod( 'powered_by_wp', true ) || is_customize_preview() ) { ?>
		<span class="wordpress-credit" <?php if ( ! get_theme_mod( 'powered_by_wp', true ) && is_customize_preview() ) { echo 'style="display: none;"'; } ?>>
			<?php echo $sep_span; ?><a href="https://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'figureground' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'figureground' ), 'WordPress' ); ?></a>
		</span>
	<?php } if ( get_theme_mod( 'theme_meta', false ) || is_customize_preview() ) { ?>
		<span class="theme-credit" <?php if ( ! get_theme_mod( 'theme_meta', false ) && is_customize_preview() ) { echo 'style="display: none;"'; } ?>>
			<?php echo $sep_span; printf( __( 'Theme: %1$s by %2$s.', 'figureground' ), 'Figure/Ground', '<a href="https://celloexpressions.com/" rel="designer">Nick Halsey</a>' ); ?>
		</span>
	<?php }
}
