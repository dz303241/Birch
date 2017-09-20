<?php get_header(); ?>
<div class="content">
<?php if (have_posts()) : ?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$total_post_count = wp_count_posts();
$published_post_count = $total_post_count->publish;
$total_pages = ceil( $published_post_count / $posts_per_page ); ?>
<div class="posts" id="posts">
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content'); ?>
<?php endwhile; ?>
<?php endif; ?>
</div>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="pagination-container">
<ul class="pagination">
<?php pagenavi(); ?>
</ul>
</div>
<?php endif; ?>
</div>
<?php get_footer(); ?>
