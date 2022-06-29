<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-03-25
 * Time: 12:11
 */
?>

<footer class="footer">
  <?php echo cs_get_option('i_code_footer'); ?>
  <div class="copyright" data-id="">
    <span class="copyright">
      Copyright © <?php echo cherry_get_site_date(); ?>
    </span>
    <?php bloginfo('name') ?> - <?php echo cs_get_option('i_site_description'); ?>
    <a class="site-record" target="_blank"
       href="<?php echo cs_get_option("i_site_record_href"); ?>">
      <?php echo cs_get_option('i_site_record'); ?>
    </a>
  </div>
</footer>
<?php
$submit_href = cs_get_option('i_submit_href');
if (empty($submit_href)) {
  $submit_href = get_admin_url();
}
?>

<div class="fix-tools">
  <div class="fighting">
    <i class="czs-arrow-up-l"></i>
  </div>
  <a class="submit-wrap" href="<?php echo $submit_href; ?>" target="_blank">
    <div class="submit">
      <i class="icon czs-talk-l"></i>
    </div>
    <span class="submit-desc">投稿</span>
  </a>
</div>
<script>
  <?php echo cs_get_option('i_seo_statistics'); ?>
</script>
<?php wp_footer(); ?>
</main>
</body>
</html>