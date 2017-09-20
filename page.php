<?php get_header(); ?>
<div class="content">		
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>				
<div <?php post_class('post single'); ?>>
<?php if ( has_post_thumbnail() ) : ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' ); $thumb_url = $thumb['0']; ?>
<div class="featured-media">
<?php the_post_thumbnail('post-image'); ?>
</div>
<?php endif; ?>
<div class="post-inner">
<div class="post-header">
<h2 class="post-title"><?php the_title(); ?></h2>
</div>
<div class="post-content">
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="clear"></div><p class="page-links">' . '分页' . ' &after=</p>&seperator= <span class="sep">/</span> '); ?>
</div>
</div>
<?php if ( comments_open() ) : ?>
<?php comments_template( '', true ); ?>
<?php endif; ?>
</div>
<?php endwhile; else: ?>
<p>没有找到对应的内容，请尝试搜索。</p>
<?php endif; ?>
<div class="clear"></div>
</div>
<?php get_footer(); ?>