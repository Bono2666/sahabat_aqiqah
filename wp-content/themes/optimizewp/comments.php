<div class="mkdf-comment-holder clearfix" id="comments">
	<div class="mkdf-comment-number">
		<div class="mkdf-comment-number-inner">
			<h5><?php comments_number( esc_html__('No Comments','optimizewp'), '1'.esc_html__(' Comment ','optimizewp'), '% '.esc_html__(' Comments ','optimizewp')); ?></h5>
		</div>
	</div>
<div class="mkdf-comments">
<?php if ( post_password_required() ) : ?>
				<p class="mkdf-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'optimizewp' ); ?></p>
			</div></div>
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>

	<ul class="mkdf-comment-list">
		<?php wp_list_comments(array( 'callback' => 'optimize_mikado_comment')); ?>
	</ul>


<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'optimizewp'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div></div>
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$mkdf_consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( 'Post a Comment','optimizewp' ),
	'title_reply_to' => esc_html__( 'Post a Reply to %s','optimizewp' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply','optimizewp' ),
	'label_submit' => esc_html__( 'Submit','optimizewp' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_attr__( 'Type...','optimizewp' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="mkdf-three-columns clearfix"><div class="mkdf-three-columns-inner"><div class="mkdf-column"><div class="mkdf-column-inner"><input id="author" name="author" placeholder="'. esc_attr__( 'Your full name','optimizewp' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="mkdf-column"><div class="mkdf-column-inner"><input id="email" name="email" placeholder="'. esc_attr__( 'E-mail address','optimizewp' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
		'website' => '<div class="mkdf-column"><div class="mkdf-column-inner"><input id="url" name="url" type="text" placeholder="'. esc_attr__( 'Website','optimizewp' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div>',
		'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $mkdf_consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'optimizewp' ) . '</label></p>' . '</div></div>'
		 ) ) );
 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="mkdf-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
 <div class="mkdf-comment-form">
	<?php comment_form($args); ?>
</div>
								
							


