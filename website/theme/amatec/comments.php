<?php
/**
 * Comments — native WordPress comments, styled to the AMATEC blog design.
 *
 * @package AMATEC
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<div class="comments-title">
			<h2 class="h2">
				<?php
				$count = get_comments_number();
				if ( '1' === (string) $count ) {
					esc_html_e( 'One comment', 'amatec' );
				} else {
					/* translators: %s: comment count. */
					printf( esc_html__( '%s comments', 'amatec' ), esc_html( number_format_i18n( $count ) ) );
				}
				?>
			</h2>
		</div>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'avatar_size'=> 44,
				'short_ping' => true,
			) );
			?>
		</ol>

		<?php the_comments_pagination(); ?>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$fields    = array(
		'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'amatec' ) . ( $req ? ' <span class="req" style="color:var(--orange-600)">*</span>' : '' ) . '</label>'
			. '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="Your name"' . ( $req ? ' required' : '' ) . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'amatec' ) . ( $req ? ' <span class="req" style="color:var(--orange-600)">*</span>' : '' ) . '</label>'
			. '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="you@email.com"' . ( $req ? ' required' : '' ) . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'amatec' ) . '</label>'
			. '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="https://" /></p>',
	);

	comment_form( array(
		'class_form'           => 'comment-form',
		'title_reply'          => esc_html__( 'Leave a Reply', 'amatec' ),
		'title_reply_before'   => '<div class="comments-title comment-respond-title"><h2 class="h2" id="reply-title" style="font-size:30px;">',
		'title_reply_after'    => '</h2></div>',
		'comment_notes_before' => '<p class="bp" style="margin-top:12px;color:var(--fg2);">' . esc_html__( 'Your email address will not be published. Required fields are marked', 'amatec' ) . ' <span style="color:var(--orange-600)">*</span></p>',
		'label_submit'         => esc_html__( 'Post Comment', 'amatec' ),
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Add Comment', 'amatec' ) . ' <span class="req" style="color:var(--orange-600)">*</span></label>'
			. '<textarea id="comment" name="comment" rows="5" placeholder="Share your thoughts…" required></textarea></p>',
		'fields'               => $fields,
	) );
	?>
</div>
