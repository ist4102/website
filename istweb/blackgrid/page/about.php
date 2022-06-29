<?php
/**
 * Template Name: 关于我们
 */
get_header();

?>

<div class="content">
  <div class="row">
    <div class="col-12">
      <div class="about page">
        <?php if (have_posts()): ?>
          <?php while (have_posts()) : the_post(); ?>
            <h4 class="about-title">
              <i class="fa fa-500px"></i><?php the_title(); ?>
            </h4>
            <div class="about-content page-content">
              <?php the_content(); ?>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php get_footer(); ?>
</div>
