<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-04-09
 * Time: 16:19
 */

$categories = get_categories(array(
  'parent' => 0,
));
?>

<aside class="sidenav">
  <a class="image logo d-block" href="<?php echo home_url() ?>">
    <img src="<?php echo cs_get_option('i_logo_url'); ?>" alt="logo">
  </a>
  <div class="sidenav-desc">
    <?php echo cs_get_option('i_site_description'); ?>
  </div>
  <nav class="menu menu-collapse">
    <?php foreach ($categories as $category): ?>
      <?php
      $terms = wpie_get_child_categories($category->term_id);
      $extend = get_term_meta($category->term_id, 'i_category_extend', true);
      $icon = wpie_array_get($extend, 'i_category_icon');
      $tag = wpie_array_get($extend, 'i_category_tag');
      $tag_color = wpie_array_get($extend, 'i_category_tag_color');
      ?>
      <div class="menu-group">
        <?php if ($terms): ?>
          <a class="menu-header">
            <i class="icon <?php echo $icon; ?>"></i>
            <?php echo $category->name; ?>
            <?php if ($tag): ?>
              <span class="tag" style="background: <?php echo $tag_color; ?>"><?php echo $tag ?></span>
            <?php endif; ?>
            <?php if ($terms): ?>
              <i class="menu-collapse-icon icon czs-angle-down-l"></i>
            <?php endif; ?>
          </a>
        <?php else: ?>
          <a href="#<?php echo $category->term_id; ?>" class="menu-item">
            <i class="icon <?php echo $icon; ?>"></i><?php echo $category->name; ?>
          </a>
        <?php endif; ?>

        <?php if ($terms): ?>
          <ul class="menu-list active">
            <?php foreach ($terms as $key => $term): ?>
              <?php
              $s_extend = get_term_meta($term->term_id, 'i_category_extend', true);
              $s_icon = wpie_array_get($s_extend, 'i_category_icon');
              $s_tag = wpie_array_get($s_extend, 'i_category_tag');
              $s_tag_color = wpie_array_get($s_extend, 'i_category_tag_color');
              ?>
              <li>
                <a class="menu-item" href="#<?php echo $term->term_id; ?>">
                  <?php if (!cs_get_option('i_sub_category_switcher') && $s_icon != ''): ?>
                    <i class="icon <?php echo $s_icon; ?>"></i>
                  <?php endif; ?>
                  <?php echo $term->name; ?>
                  <?php if ($s_tag): ?>
                    <span class="tag" style="background: <?php echo $s_tag_color; ?>"><?php echo $s_tag ?></span>
                  <?php endif; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    <div class="menu-group menu-about">
      <a class="menu-item"
         href="<?php echo get_page_link(get_page_by_path('about')); ?>">
        <i class="icon czs-about-l"></i>关于我们
      </a>
    </div>
    <?php if (cs_get_option('i_sidenav_button_switcher')): ?>
      <div class="menu-group menu-button">
        <div class="menu-item">
          <a class="btn btn-outline" href="<?php echo cs_get_option('i_sidenav_button_href') ?>" target="_blank">
            <i class="<?php echo cs_get_option('i_sidenav_button_icon') ?>"></i>
            <?php echo cs_get_option('i_sidenav_button_content') ?>
          </a>
        </div>
      </div>
    <?php endif; ?>
  </nav>
</aside>
