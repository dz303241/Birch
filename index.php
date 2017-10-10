<?php get_header(); ?>
<div class="content">
<?php if ( !is_home() ) { ?>
  <div class="page-title">
  <h3><?php if ( is_day() ) : ?><?php echo get_the_date( get_option('date_format') ); ?>
  <?php elseif ( is_month() ) : ?><?php echo get_the_date('F Y'); ?>
  <?php elseif ( is_year() ) : ?><?php echo get_the_date('Y'); ?>
  <?php elseif ( is_category() ) : ?><?php printf( '分类：%s', '' . single_cat_title( '', false ) . '' ); ?>
  <?php elseif ( is_tag() ) : ?><?php printf( '标签：%s', '' . single_tag_title( '', false ) . '' ); ?>
  <?php elseif ( is_author() ) : ?><?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?><?php printf( '作者：%s', $curauth->display_name ); ?>
  <?php elseif ( is_search() ) : ?>搜索结果：<?php echo ' "' . get_search_query() . '"'; ?>
  <?php else : ?>存档<?php endif; ?>
  </h3>
  </div>
<?php } ?>
<?php if (have_posts()) : ?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$total_post_count = wp_count_posts();
$published_post_count = $total_post_count->publish;
$total_pages = ceil( $published_post_count / $posts_per_page ); ?>
<div class="posts" id="posts">
<?php while (have_posts()) : the_post(); ?>
  <div class="post-container">
    <?php if ( has_post_thumbnail() ) : ?>
  <a class="featured-media" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumb'); ?></a>
  <?php endif; ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php $post_title = get_the_title(); if ( !empty( $post_title ) ) : ?>
  <div class="post-header">
  <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
  </div>
  <?php endif; ?>
  <div class="post-excerpt">
  <?php the_excerpt(); ?>
  </div>
  <div class="posts-meta">
  <?php the_category(', '); ?> / <?php the_time(get_option('date_format')); ?>
  </div>
  </div>
  </div>
<?php endwhile; ?>
<?php else : ?>
  <div id="posts">
    <div class="post-inner"><center><?php if ( is_search() ) { ?>没有找到对应的内容，请尝试其他关键词。<?php } else { ?>空空如也！<?php } ?></center></div>
  </div>
<?php endif; ?>
</div>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="pagination-container">
<?php
  the_posts_pagination( array(
    'mid_size' =>1,
    'prev_text' =>'<span>&larr;</span>',
    'next_text' =>'<span>&rarr;</span>',
  ) );
?>
</div>
<?php endif; ?>
</div>
<?php get_footer(); ?>
