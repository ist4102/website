<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-03-25
 * Time: 16:51
 */
$extend = get_post_meta(get_the_ID(), 'i_post_extend', true);

$href = '';
if (!empty($extend) && array_key_exists('i_post_href', $extend)) {
  $href = $extend['i_post_href'];
}

$brief = cs_get_option('i_brief_card_switcher');

if ($_COOKIE['brief'] == 'true') {
  $brief = true;
}

if ($_COOKIE['brief'] == 'false') {
  $brief = false;
}
?>

<div class="col-xl-3 col-lg-4 col-md-6">
  <a class="card tooltip tooltip-bottom <?php if ($brief) echo "card-brief" ?>"
     data-pid="<?php echo get_the_ID(); ?>"
     data-tooltip="<?php echo wpie_get_post_excerpt(); ?>"
     href="<?php echo $href; ?>" style="z-index: <?php echo $idx; ?>;"
    <?php if (cs_get_option('i_navigation_href_blank_switcher')) {
      echo "target='_blank'";
    } ?>>
    <div class="media">
      <div class="media-left">
        <figure class="image image-rounded card-tn">
          <img src="<?php echo cherry_get_src(cherry_get_thumbnail_url()); ?>" alt="card-tn">
        </figure>
      </div>
      <div class="media-content">
        <div class="card-title text-truncate">
          <?php echo get_the_title(); ?>
        </div>
        <div class="card-desc">
          <?php echo wpie_get_post_excerpt(); ?>
        </div>
        <div class="card-meta">
          <span class="card-read">
            <i class="icon czs-eye-l"></i>
            <?php
            $visit_count = get_post_meta(get_the_ID(), 'visit_count', true);
            if ($visit_count == '') {
              $visit_count = 0;
            }
            ?>
            <?php echo $visit_count; ?>
          </span>
          <?php
          $loved = false;
          if (isset($_COOKIE['love_' . get_the_ID()])) {
            $loved = true;
          }
          $icon = 'czs-heart-l';
          $active = '';
          if ($loved) {
            $icon = 'czs-heart';
            $active = 'active';
          }
          ?>
          <span class="card-love <?php echo $active; ?>" data-pid="<?php echo get_the_ID(); ?>">
            <i class="icon <?php echo $icon; ?>"></i>
            <?php
            $love_count = get_post_meta(get_the_ID(), 'love_count', true);
            if ($love_count == '') {
              $love_count = 0;
            }
            ?>
            <span class="card-love-count">
            <?php echo $love_count; ?>
            </span>
          </span>
        </div>
      </div>
    </div>
  </a>
</div>
