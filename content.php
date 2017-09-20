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
