<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<div class="content">
<div class="page-title">
<h4>搜索结果：<?php echo ' "' . get_search_query() . '"'; ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; if ( "1" < $wp_query->max_num_pages ) : ?>
<span><?php printf( '第 %s 页，共 %s 页', $paged, $wp_query->max_num_pages ); ?></span>
<div class="clear"></div>
<?php endif; ?></h4>
</div>
<div class="posts" id="posts">
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content'); ?>
<?php endwhile; ?>
</div>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="archive-nav">
<?php echo get_next_posts_link( '下一页' . ' &rarr;'); ?>
<?php echo get_previous_posts_link( '&larr; ' . '上一页'); ?>
<div class="clear"></div>
</div>
<?php endif; ?>
</div>
<?php else : ?>
<div class="content">
<div class="page-title">
<h4>搜索结果：<?php echo ' "' . get_search_query() . '"'; ?></h4>
</div>
<div class="post single">
<div class="post-inner">
<div class="post-content">
<p>没有对应的内容，请尝试其他关键词。</p>
<?php get_search_form(); ?>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>