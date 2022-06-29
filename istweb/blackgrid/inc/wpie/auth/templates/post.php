<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'post_type' => 'post',
  'post_status' => array('publish', 'draft'),
  'paged' => $paged,
  'author' => $current_user->ID
);
$posts = new WP_Query($args);
?>
<?php if ($posts->have_posts()): ?>
  <div class="post-wrap">
    <?php while ($posts->have_posts()) : $posts->the_post(); ?>
      <?php get_template_part('template-parts/post/content', 'list'); ?>
    <?php endwhile; ?>
  </div>
  <?php get_template_part('template-parts/pagination'); ?>
<?php endif; ?>

