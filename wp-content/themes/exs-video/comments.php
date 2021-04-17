<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	//placehoders for fields
	$exs_commenter = wp_get_current_commenter();
	comment_form(
		array(

			'comment_field' => '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html_x( 'Comment', 'noun', 'exs-video' ) . '</label> <textarea id="comment" name="comment"  placeholder="' . esc_attr__( 'Comment', 'exs-video' ) . '" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
			'title_reply'   => esc_html__( 'Add a Comment', 'exs-video' ),
			'fields'        => array(

				'author' => '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'exs-video' ) . ' <span class="required">*</span></label> ' .
				            '<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'exs-video' ) . '" value="' . esc_attr( $exs_commenter['comment_author'] ) . '" size="30" maxlength="245" required="required" /></p>',
				'email'  => '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'exs-video' ) . ' <span class="required">*</span></label> ' .
				            '<input id="email" name="email" type="email" placeholder="' . esc_attr__( 'Email', 'exs-video' ) . '" value="' . esc_attr( $exs_commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" /></p>',
				'url'    => '',
			),

		)
	);

	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$exs_comments_number = get_comments_number();
			if ( '1' === $exs_comments_number ) {
				/* translators: %s: post title */
				echo esc_html_x( '1 Comment', 'comments title', 'exs-video' );
			} else {
				printf(
					esc_html(
						/* translators: 1: number of comments */
						_nx(
							'%1$s Comment',
							'%1$s Comments',
							$exs_comments_number,
							'comments title',
							'exs-video'
						)
					),
					esc_html(
						number_format_i18n(
							$exs_comments_number
						)
					)
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => exs_icon( 'reply', true ) . ' ' . esc_html__( 'Reply', 'exs-video' ),
					'login_text'  => exs_icon( 'reply', true ) . ' ' . esc_html__( 'Login to Reply', 'exs-video' ),
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			exs_get_the_posts_pagination_atts()
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'exs-video' ); ?></p>
		<?php
	endif; //comments_open

	?>
</div><!-- #comments -->
