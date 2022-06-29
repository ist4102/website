<div class="login-wrap d-none py-4">
  <div class="tab-nav justify-content-center" data-tab-content="tab-content">
    <div class="tab-li active">登陆</div>
    <div class="tab-li">注册</div>
  </div>
  <div class="tab-content p-6" id="tab-content">
    <form class="form-login tab-item active" method="post">
      <div class="form-item">
        <input placeholder="输入用户名" class="username form-field" type="text" name="username">
      </div>
      <div class="form-item">
        <input placeholder="输入密码" class="password form-field" type="password" name="password">
      </div>
      <a class="lost text-primary mb-2 d-block" href="<?php echo wp_lostpassword_url(); ?>">
        忘记密码？
      </a>
      <ul class="list-unstyled mb-2 d-flex justify-content-between">
        <!--                <li>-->
        <!--                    <a class="text-geek" target="_blank" href="-->
        <?php //echo github_oauth_url(); ?><!--">-->
        <!--                        <i class="czs-github"></i>-->
        <!--                    </a>-->
        <!--                </li>-->
        <!--                <li>-->
        <!--                    <a class="text-danger" target="_blank" href="-->
        <?php //echo github_oauth_url(); ?><!--">-->
        <!--                        <i class="czs-weibo"></i>-->
        <!--                    </a>-->
        <!--                </li>-->
        <!--                <li>-->
        <!--                    <a class="text-success" target="_blank" href="-->
        <?php //echo github_oauth_url(); ?><!--">-->
        <!--                        <i class="czs-wechat"></i>-->
        <!--                    </a>-->
        <!--                </li>-->
      </ul>
      <?php wp_nonce_field('ajax-login-nonce', 'login-security'); ?>
      <input class="btn btn-success btn-block form-login-submit" type="submit" value="登陆" name="submit">
    </form>
    <form class="form-register tab-item" method="post">
      <div class="form-item">
        <input placeholder="输入用户名" class="username form-field" type="text" name="username">
      </div>
      <div class="form-item">
        <input placeholder="输入邮箱" class="email form-field" type="text" name="email">
      </div>
      <div class="form-item">
        <input placeholder="输入密码" class="password form-field" type="password" name="password">
      </div>
      <div class="form-item">
        <input placeholder="重复密码" class="password form-field" type="password" name="re-password">
      </div>
      <input class="btn btn-primary btn-block form-register-submit" type="submit" value="注册" name="submit">
      <?php wp_nonce_field('ajax-register-nonce', 'register-security'); ?>
    </form>
  </div>
</div>
