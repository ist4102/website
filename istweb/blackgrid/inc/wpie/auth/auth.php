<?php

include('rewrite.php');
include('ajax-user.php');
include('ajax-post.php');
include('oauth/github.php');
include('follower/ajax-follow.php');
include('follower/follower.php');

/**
 * add login template to footer
 */
function cherry_user_load_login()
{
  include('templates/login.php');
}

add_action('wp_footer', 'cherry_user_load_login');

function wpie_login_form($redirect = '')
{
  if ($redirect == '') {
    $redirect = home_url();
  }
  $action = wp_login_url();
  $register = wp_registration_url();
  $lost = wp_lostpassword_url();
  return "<form class='form' action='$action' method='post'>
			<div class='form-group'>
			  <div class='form-field form-icons-left'>
				  <input type='username' name='log' class='form-control' placeholder='用户名或电子邮件地址' size='20'>
				  <i class='icon czs-user-l form-icon form-icon-left'></i>
        </div>
			</div>
			<div class='form-group'>
			  <div class='form-field form-icons-left'>
          <input type='password' name='pwd' class='form-control' placeholder='密码' size='20'>
				  <i class='icon czs-lock-l form-icon form-icon-left'></i>
				</div>
			</div>
      <div class='form-group' style='font-size: 14px;'>
        <div class='form-check text-gray' style='font-size: 12px;'>
         <input name='rememberme' type='checkbox' id='rememberme' value='forever'>
         <label for='rememberme'>记住我的登录信息</label>
        </div>
      </div>
      <div class='form-group'>
        <input type='submit' name='wp-submit' id='wp-submit' class='btn btn-primary btn-rounded btn-block' value='登录'>
        <input type='hidden' name='redirect_to' value='$redirect'>
      </div>
      <div class='form-group text-center' style='font-size: 12px;'>
        <span class='text-gray btn-modal cursor-pointer' data-target='#modal-register' title='注册一个新的帐户'>注册</span>｜
        <span class='text-gray btn-modal cursor-pointer' data-target='#modal-lost' title='忘记密码'>忘记密码</span>
      </div>
		</form>";
}

function wpie_register_form()
{
  $register = wp_registration_url();
  $lost = wp_lostpassword_url();
  return "<form action='$register' method='post' novalidate='novalidate'>
	<div class='form-group'>
    <div class='form-field form-icons-left'>
      <input type='username' name='user_login' class='form-control' placeholder='用户名'>
      <i class='icon czs-user-l form-icon form-icon-left'></i>
    </div>
	</div>
	<div class='form-group'>
    <div class='form-field form-icons-left'>
      <input type='email' name='user_email' class='form-control' placeholder='电子邮件'>
      <i class='icon czs-message-l form-icon form-icon-left'></i>
    </div>
	</div>
	<div class='form-group'>
    <small class='form-text text-gray'>注册确认信将会被寄给您。</small>
  </div>
  <div class='form-group'>
    <input type='hidden' name='redirect_to' value=''>
    <input type='submit' name='wp-submit' class='btn btn-primary btn-rounded btn-block' value='注册'>
  </div>
 <div class='form-group text-center' style='font-size: 12px;'>
    <span class='text-gray btn-modal cursor-pointer' data-target='#modal-login' title='登录'>登录</span> |
    <span class='text-gray btn-modal cursor-pointer' data-target='#modal-lost' title='忘记密码'>忘记密码</span>
  </div>
</form>";
}

function wpie_lost_pwd_form()
{
  $lost = wp_lostpassword_url();
  return "<form action='$lost' method='post'>
	<div class='form-group'>
    <div class='form-field form-icons-left'>
      <input type='text' name='user_login' class='form-control' placeholder='用户名或电子邮件地址'>
      <i class='icon czs-message-l form-icon form-icon-left'></i>
		</div>
  </div>
  <div class='form-group'>
    <input type='hidden' name='redirect_to' value=''>
    <input type='submit' name='wp-submit' class='btn btn-primary btn-rounded btn-block' value='获取新密码'>
  </div>
  <div class='form-group text-center' style='font-size: 12px;'>
    <span class='text-gray btn-modal cursor-pointer' data-target='#modal-login' title='登录'>登录</span> |
    <span class='text-gray btn-modal cursor-pointer' data-target='#modal-register' title='注册一个新的帐户'>注册</span>
  </div>
</form>
";
}
