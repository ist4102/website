<?php
/**
 * Template Name: 我的导航
 */
get_header();

if (!is_user_logged_in()) {
  wp_redirect(get_admin_url());
}

$navigations = get_user_meta(get_current_user_id(), 'navigation', true);
$idx = 100000;
?>

<div class="navigation">
  <div class="content">
    <div class="row-content">
      <div class="row">
        <?php if (!empty($navigations)): ?>
          <?php foreach ($navigations as $key => $navigation): ?>
            <?php $idx -= 1; ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <a class="card tooltip tooltip-bottom"
                 href="<?php echo $navigation['url'] ?>"
                 data-tooltip="<?php echo $navigation['url'] ?>"
                 style="z-index: <?php echo $idx; ?>;"
              >
                <div class="media">
                  <div class="media-left">
                    <div class="navigation-img">
                      <figure class="image">
                        <img src="<?php echo $navigation['image']; ?>" alt="">
                      </figure>
                    </div>
                  </div>
                  <div class="media-content">
                    <div class="card-title text-truncate">
                      <?php echo $navigation['name'] ?>
                    </div>
                    <div class="card-desc">
                      <?php echo $navigation['desc'] ?>
                    </div>
                  </div>
                </div>
                <div class="card-tools">
                  <i class="icon czs-trash-l card-delete" data-id="<?php echo $key ?>"></i>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
        <div class="col-xl-3 col-lg-4 col-sm-6 add-navigation-wrap">
          <div class="add-navigation">
          <span class="add-navigation-circle">
            <i class="icon czs-add"></i>
          </span>
          </div>
          <form class="navigation-submit" method="post">
            <div class="navigation-submit-close-wrap text-right">
              <i class="czs-close-l navigation-submit-close"></i>
            </div>
            <div class="form-group">
              <div class="form-field form-icons-left form-icon-right">
                <input type="text" name="name" class="form-control form-control-site-name" placeholder="网站名称"/>
                <i class="icon czs-file-l form-icon form-icon-left"></i>
              </div>
            </div>
            <div class="form-group">
              <div class="form-field form-icons-left form-icon-right">
                <input type="text" name="url" class="form-control" placeholder="网站地址"/>
                <i class="icon czs-network-l form-icon form-icon-left"></i>
              </div>
            </div>
            <div class="form-group">
              <div class="form-field form-icons-left form-icon-right">
                <input type="text" name="desc" class="form-control" placeholder="网站描述"/>
                <i class="icon czs-talk-l form-icon form-icon-left"></i>
              </div>
            </div>
            <div class="form-group">
              <div class="form-field form-icons-left form-icon-right">
                <input type="text" name="image" class="form-control" placeholder="图片链接"/>
                <i class="icon czs-image form-icon form-icon-left"></i>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-rounded btn-block">提交</button>
          </form>
        </div>
      </div>
    </div>
    <?php get_footer(); ?>
  </div>
</div>

