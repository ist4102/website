<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-04-12
 * Time: 23:10
 */
$args = array(
  'taxonomy' => 'category',
  'category__in' => $category->term_id,
  'post_type' => 'post',
  'orderby' => 'date',
  'order' => 'ASC',
  'posts_per_page' => -1,
);
$loop = new WP_Query($args);

$extend = get_term_meta($category->term_id, 'i_category_extend', true);
$icon = '';
if (!empty($extend)) {
  $icon = $extend['i_category_icon'];
}
?>

  <div class="col-12">
    <div class="section-title <?php if (!$loop->have_posts()) echo 'inactive'; ?>"
         id="<?php echo $category->term_id; ?>">
      <i class="icon <?php echo $icon; ?>"></i>
      <?php echo $category->name ?>
    </div>
  </div>
<?php $idx = 100000; ?>
<?php if ($loop->have_posts()) : ?>
  <?php while ($loop->have_posts()) : $loop->the_post(); ?>
    <?php $idx -= 1; ?>
    <?php set_query_var('idx', $idx) ?>
    <?php get_template_part('template-parts/card'); ?>
  <?php endwhile; ?>
<?php endif; ?>