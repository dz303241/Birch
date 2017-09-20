<?php if ( post_password_required() ) return; ?>
<?php if ( have_comments() ) : ?>
<div class="comments-container">
<div class="comments-inner">
<a name="comments"></a>
<h2 class="comments-title"><?php echo count($wp_query->comments_by_type['comment']) . ' '; echo _n( '条评论' , '条评论' , count($wp_query->comments_by_type['comment']) ); ?></h2>
<div class="comments">
<ol class="commentlist">
<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'jeff_design_comment' ) ); ?>
</ol>
<?php if (!empty($comments_by_type['pings'])) : ?>
<div class="pingbacks">
<h3 class="pingbacks-title"><?php echo count($wp_query->comments_by_type['pings']) . ' '; echo _n( '条引用', '条引用', count($wp_query->comments_by_type['pings']) ); ?></h3>
<ol class="pingbacklist">
<?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'jeff_design_comment' ) ); ?>
</ol>
</div>
<?php endif; ?>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<div class="comments-nav" role="navigation">
<div class="fleft">
<?php previous_comments_link( '&larr; ' . '旧的评论' ); ?>
</div>
<div class="fright">
<?php next_comments_link( '新的评论' . ' &rarr;' ); ?>
</div>
<div class="clear"></div>
</div>
<?php endif; ?>
</div>
</div>
</div>
<?php endif; ?>
<?php if ( ! comments_open() && ! is_page() ) : ?>
<div class="comments-container">
<div class="comments-inner">
<p class="no-comments"><?php _e( 'Comments are closed.'); ?></p>
</div>
</div>
<?php endif; ?>
<?php $comments_args = array(
'comment_notes_before' => '',
'comment_notes_after' => '',
'comment_field' => 
'<p class="comment-form-comment">
<label for="comment">评论内容</label>
<textarea id="comment" name="comment" cols="45" rows="6" required></textarea>
</p>',
'fields' => apply_filters( 'comment_form_default_fields', array(
'author' =>
'<p class="comment-form-author">
<label for="author">' . __('Name') . ( $req ? '<span class="required">*</span>' : '' ) . '</label> 
<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
</p>',
'email' =>
'<p class="comment-form-email">
<label for="email">' . __('Email') . ( $req ? '<span class="required">*</span>' : '' ) . '</label> 
<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />
</p>',
'url' =>
'<p class="comment-form-url">
<label for="url">' . __('Website') . '</label>
<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
</p>')
),
);
if ( comments_open() ) { echo '<div class="respond-container">'; }
comment_form($comments_args);
if ( comments_open() ) { echo '</div>'; }
?>