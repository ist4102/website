<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-04-21
 * Time: 23:25
 */
?>
<?php if (cs_get_option('i_notice_carousel_switcher') && cs_get_option('i_notice_carousel_group')): ?>
  <div class="notice-carousel">
    <div class="notice-carousel-wrap">
      <?php foreach (cs_get_option('i_notice_carousel_group') as $notice): ?>
        <div class="notice-item">
          <i class="<?php echo $notice['i_notice_carousel_icon']; ?>"></i>
          <a class="notice-content" target="_blank" href="<?php echo $notice['i_notice_carousel_href'] ?>">
            <?php echo $notice['i_notice_carousel_content']; ?>
          </a>
          <a class="notice-link text-primary" target="_blank" href="<?php echo $notice['i_notice_carousel_href'] ?>">
            <?php echo $notice['i_notice_carousel_href_content'] ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
