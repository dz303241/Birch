<?php get_header(); ?>
<div class="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
<?php $post_format = get_post_format(); ?>
<?php if ( has_post_thumbnail() ) : ?>
<div class="featured-media">
<?php the_post_thumbnail('post-image'); ?>
</div>
<?php endif; ?>
<div class="post-inner">
<div class="post-header">
<h1 class="post-title"><?php the_title(); ?></h1>
</div>
<div class="post-content">
<?php the_content(); ?>
</div>
<div class="clear"></div>
<div class="post-meta-bottom">
<?php $args = array('before' => '<div class="clear"></div><p class="page-links"><span class="title">' . '分页' . '</span>', 'after' => '</p>', 'link_before' => '<span>', 'link_after' => '</span>', 'separator' => '', 'pagelink' => '%', 'echo' => 1 ); wp_link_pages($args); ?>
<ul>
<li class="post-date"><a href="<?php the_permalink(); ?>"><?php the_date(get_option('date_format')); ?></a></li>
<?php if (has_category()) : ?>
<li class="post-categories">分类：<?php the_category(', '); ?></li>
<?php endif; ?>
<?php if (has_tag()) : ?>
<li class="post-tags"><?php the_tags('', ' '); ?></li>
<?php endif; ?>
<?php edit_post_link('编辑', '<li>', '</li>'); ?>
</ul>
<div class="clear"></div>
</div>
</div>
<?php $prev_post = get_previous_post(); $next_post = get_next_post();?>
<div class="post-navigation">
<?php if (!empty( $prev_post )): ?>
<a class="post-nav-prev" title="<?php echo '上一篇文章：' . esc_attr( get_the_title($prev_post) ); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>"><p>&larr; 上一篇文章</p></a>
<?php endif; ?>
<?php if (!empty( $next_post )): ?>
<a class="post-nav-next" title="<?php echo '下一篇文章：' . esc_attr( get_the_title($next_post) ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>"><p>下一篇文章 &rarr;</p></a>
<?php endif; ?>
<div class="clear"></div>
</div>
<?php comments_template( '', true ); ?>
</div>
<?php endwhile; else: ?>
<p>没有找到对应的内容，请尝试搜索。</p>
<?php endif; ?>
</div>
<?php get_footer(); ?>
