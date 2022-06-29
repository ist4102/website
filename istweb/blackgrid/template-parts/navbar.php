<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-04-09
 * Time: 16:23
 */
?>

<div class="navbar-burger mobile-navbar-burger d-block" id="navbar-burger">
  <span></span> <span></span> <span></span>
</div>

<nav class="navbar app-container" id="navbar">
  <div class="navbar-brand">
    <div class="navbar-burger d-block" id="navbar-burger">
      <span></span> <span></span> <span></span>
    </div>
  </div>
  <div class="navbar-item navbar-item-logo">
    <a class="image navbar-logo" href="<?php echo home_url() ?>">
      <img src="<?php echo cs_get_option('i_navbar_logo_url'); ?>" alt="logo">
    </a>
  </div>

  <div class="navbar-item navbar-item-notice" style="width: 100%">
    <?php get_template_part('template-parts/notice') ?>
  </div>

  <div class="navbar-end">
    <div class="navbar-item navbar-item-end">
      <div class="dropdown dropdown-hover dropdown-right">
        <i class="icon czs-setting dropdown-toggle" style="margin-right: 10px;"></i>
        <div class="dropdown-menu">
          <a class="dropdown-item">
            <label for="js-brief">卡片简化</label>
            <input type="checkbox" id="js-brief" class="js-switch" />
          </a>
          <a class="dropdown-item">
            <label for="js-dark">黑夜模式</label>
            <input type="checkbox" id="js-dark" class="js-switch" />
          </a>
        </div>
      </div>
      <div class="dropdown dropdown-hover dropdown-right">
        <i class="icon czs-weixin dropdown-toggle" style="margin-right: 10px;"></i>
        <div class="dropdown-menu wechat-qrcode-menu">
          <figure class="image wechat-qrcode">
            <img src="<?php echo cs_get_option('i_follow_wechat') ?>" alt="分享到微信">
          </figure>
        </div>
      </div>
      <?php if (cs_get_option('i_auth_switcher')): ?>
        <?php if (is_user_logged_in()): ?>
          <div class="dropdown dropdown-hover dropdown-right">
            <i class="icon czs-user-l dropdown-toggle" style="margin-right: 0"></i>
            <div class="dropdown-menu">
              <a class="dropdown-item"
                 href="<?php echo get_page_link(get_page_by_path('bookmark')); ?>">
                <i class="icon czs-bookmark-l"></i>我的书签
              </a>
              <a class="dropdown-item" href="<?php echo wp_logout_url(home_url()) ?>">
                <i class="icon czs-out-l"></i>登出
              </a>
            </div>
          </div>
        <?php else: ?>
          <span class="btn-modal" data-target="#modal-login">
          <i class="icon czs-user-l"></i>
        </span>
          <div class="modal" id="modal-login">
            <div class="modal-content">
              <header class="modal-header text-center">
                登录
                <div class="modal-close"><i class="czs-close-l"></i></div>
              </header>
              <div class="modal-body">
                <?php echo wpie_login_form(); ?>
              </div>
            </div>
          </div>
          <div class="modal" id="modal-register">
            <div class="modal-content">
              <header class="modal-header text-center">
                注册
                <div class="modal-close"><i class="czs-close-l"></i></div>
              </header>
              <div class="modal-body">
                <?php echo wpie_register_form(); ?>
              </div>
            </div>
          </div>
          <div class="modal" id="modal-lost">
            <div class="modal-content">
              <header class="modal-header text-center">
                忘记密码
                <div class="modal-close"><i class="czs-close-l"></i></div>
              </header>
              <div class="modal-body">
                <?php echo wpie_lost_pwd_form(); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</nav>
