<?php get_header(); ?>
<div class="content">
<div class="page-title">
<h4><?php if ( is_day() ) : ?><?php echo get_the_date( get_option('date_format') ); ?>
<?php elseif ( is_month() ) : ?><?php echo get_the_date('F Y'); ?>
<?php elseif ( is_year() ) : ?><?php echo get_the_date('Y'); ?>
<?php elseif ( is_category() ) : ?><?php printf( '分类：%s', '' . single_cat_title( '', false ) . '' ); ?>
<?php elseif ( is_tag() ) : ?><?php printf( '标签：%s', '' . single_tag_title( '', false ) . '' ); ?>
<?php elseif ( is_author() ) : ?><?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?><?php printf( '作者：%s', $curauth->display_name ); ?>
<?php else : ?>存档<?php endif; ?>			
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if ( "1" < $wp_query->max_num_pages ) : ?>
<span><?php printf( '第 %s 页，共 %s 页', $paged, $wp_query->max_num_pages ); ?></span>
<div class="clear"></div>
<?php endif; ?></h4>
</div>
<?php if ( have_posts() ) : ?>
<?php rewind_posts(); ?>
<div class="posts" id="posts">
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content'); ?>
<?php endwhile; ?>
</div>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="archive-nav">
<?php echo get_next_posts_link( '&laquo; ' . '上一页'); ?>
<?php echo get_previous_posts_link( '下一页' . ' &raquo;'); ?>
<div class="clear"></div>
</div>
<?php endif; ?>
<?php endif; ?>
</div>
<?php get_footer(); ?>