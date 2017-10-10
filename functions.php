<?php
add_action( 'after_setup_theme', 'jeff_design_setup' );
function jeff_design_setup() {
add_theme_support( 'automatic-feed-links' );
add_custom_background();
remove_action('wp_head', 'wp_generator');
remove_filter('comment_text', 'make_clickable', 9);
remove_filter('the_content', 'wptexturize');
remove_filter('wp_head', 'CID_css');
wp_deregister_script( 'l10n' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 620;
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size ( 88, 88, true );
add_image_size( 'post-image', 973, 9999 );
add_image_size( 'post-thumb', 508, 9999 );
register_nav_menu( 'primary', __('Primary Menu') );
}

function jeff_design_load_javascript() {
if ( !is_admin() ) {
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'jeff_design_global', get_template_directory_uri().'/script.js', array('jquery'), '', true );
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
wp_enqueue_script( 'comment-reply' );}
}
}
add_action( 'wp_enqueue_scripts', 'jeff_design_load_javascript' );

function jeff_design_load_style() { if ( !is_admin() ) { wp_enqueue_style( 'jeff_design_style', get_stylesheet_uri() );	}}
add_action('wp_print_styles', 'jeff_design_load_style');

function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

function comment_mail_notify ($comment_id) {
	$comment = get_comment($comment_id);
	$parent_id = $comment -> comment_parent ? $comment -> comment_parent : '';
	$spam_confirmed = $comment -> comment_approved;

	if (($parent_id != '') && ($spam_confirmed != 'spam')) {

		$wp_email = 'webmaster@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
		$to = trim(get_comment($parent_id) -> comment_author_email);

		$subject = '你在 [' . get_option("blogname") . '] 的留言有了回应';
		$message = '
	<div style="background-color:#EEF2FA;border:1px solid #D8E3E8;color:#111;padding:0 15px;border-radius:5px;">
		<p>' . trim(get_comment($parent_id) -> comment_author) . ', 你好!</p>
		<p>你曾在《' . get_the_title($comment -> comment_post_ID) . '》的留言:<br>' . trim(get_comment($parent_id) -> comment_content) . '</p>
		<p>' . trim($comment -> comment_author) . ' 给你的回应:<br />' . trim($comment -> comment_content) . '<br></p>
		<p>你可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整内容</a></p>
		<p>感谢你对 <a href="' . get_option('home') . '" target="_blank">' . get_option('blogname') . '</a> 的关注。</p>
		<p><strong>您可以直接回复此邮件与我联系！</strong></p>
	</div>';

		$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
		$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";

		wp_mail($to, $subject, $message, $headers);
	}
}
add_action('comment_post', 'comment_mail_notify');

function a(){echo base64_decode('PC9hPjwvcD4NCjxwPlRoZW1lIGJ5IDxhIGhyZWY9Imh0dHA6Ly93d3cuamVmZmRlc2lnbi5uZXQvIiB0YXJnZXQ9Il9ibGFuayI+SmVmZiBEZXNpZ248L2E+PC9wPg0KPC9kaXY+');};
function html_js_class () { echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";}
add_action( 'wp_head', 'html_js_class', 1 );

add_filter('next_posts_link_attributes', 'jeff_design_posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'jeff_design_posts_link_attributes_2');

function jeff_design_posts_link_attributes_1() { return 'class="archive-nav-older fleft"';}
function jeff_design_posts_link_attributes_2() { return 'class="archive-nav-newer fright"';}

function jeff_design_custom_excerpt_length( $length ) { return 28;}
add_filter( 'excerpt_length', 'jeff_design_custom_excerpt_length', 999 );

function jeff_design_new_excerpt_more( $more ) { return '...';}
add_filter( 'excerpt_more', 'jeff_design_new_excerpt_more' );

add_filter('body_class','jeff_design_is_mobile_body_class');
function jeff_design_is_mobile_body_class( $classes ){
if ( wp_is_mobile() ){ $classes[] = 'wp-is-mobile';}
else{ $classes[] = 'wp-is-not-mobile';}
return $classes;
}

if ( ! function_exists( 'jeff_design_comment' ) ) :
function jeff_design_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
case 'pingback' :
case 'trackback' :
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">引用：<?php comment_author_link(); ?> <?php edit_comment_link( '编辑', '<span class="edit-link">', '</span>' ); ?></li>
<?php break; default : global $post;?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<div id="comment-<?php comment_ID(); ?>" class="comment">
<div class="comment-header">
<div class="comment-header-inner">
<h4><?php echo get_comment_author_link(); ?></h4>
<div class="comment-meta">
<a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date(get_option('date_format')) ?></a>
</div>
</div>
</div>
<div class="comment-content">
<?php comment_text(); ?>
</div>
<div class="comment-actions">
<?php if ( '0' == $comment->comment_approved ) : ?>
<p class="comment-awaiting-moderation fright">您的评论需等待审核。</p>
<?php endif; ?>
<div class="fleft">
<?php comment_reply_link( array(
'reply_text' 	=>  	'回复',
'depth'			=> 		$depth,
'max_depth' 	=> 		$args['max_depth'],
'before'		=>		'',
'after'			=>		''
)
);
?><?php edit_comment_link( '编辑', '<span class="sep">/</span>', '' ); ?>
</div>
<div class="clear"></div>
</div>
</div>
<?php break; endswitch; } endif;?>
