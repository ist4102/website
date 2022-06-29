<?php

define('CHERRY_USER', get_template_directory_uri() . '/inc/cherry-user');

// Enable the user with no privileges
add_action('wp_ajax_nopriv_ajaxLogin', 'cherry_ajax_login');
add_action('wp_ajax_nopriv_ajaxRegister', 'cherry_ajax_register');
add_action('wp_ajax_updateAvatar', 'cherry_ajax_update_avatar');
add_action('wp_ajax_updateUser', 'cherry_ajax_update_user');

function cherry_ajax_update_user()
{
  $user = array(
    'ID' => $_POST['id'],
    'user_url' => $_POST['homepage'],
    'display_name' => $_POST['nickname'],
    'user_email' => $_POST['email'],
    'description' => $_POST['description']
  );
  $id = wp_update_user($user);
  if (is_wp_error($id)) {
    echo cherry_ajax_result(false, __('Update user information failed'));
  } else {
    echo cherry_ajax_result(true, __('Update user info successfully'));
  }
  die();
}

function cherry_ajax_login()
{
  $nonce = check_ajax_referer('ajax-login-nonce', 'login-security');
  if (!$nonce) {
    echo cherry_ajax_result(false, __('nonce错误'));
    die();
  }
  cherry_login($_POST['username'], $_POST['password'], __('登陆成功'));
  die();
}

function cherry_ajax_register()
{
  $nonce = check_ajax_referer('ajax-register-nonce', 'register-security');
  if (!$nonce) {
    echo cherry_ajax_result(false, __('nonce错误'));
    die();
  }
  // check whether password is equal to re-password
  if ($_POST['password'] != $_POST['re-password']) {
    echo cherry_ajax_result(false, __('两次密码输入不相同'));
    die();
  }
  $user = array();
  $user['user_login'] = sanitize_user($_POST['username']);
  $user['user_email'] = sanitize_email($_POST['email']);
  $user['user_pass'] = esc_attr($_POST['password']);
  $user['remember'] = true;
  $res = wp_insert_user($user);
  if (is_wp_error($res)) {
    $error = $res->get_error_codes();
    if (in_array('empty_user_login', $error)) {
      echo cherry_ajax_result(false, __($res->get_error_message('empty_user_login')));
    } elseif (in_array('existing_user_login', $error)) {
      echo cherry_ajax_result(false, __('用户名已经存在'));
    } elseif (in_array('existing_user_email', $error)) {
      echo cherry_ajax_result(false, __('邮箱已经存在'));
    }
  } else {
    // Set the global user object
    $current_user = get_user_by('id', $res);
    // set the WP login cookie
    wp_set_auth_cookie($res, true, is_ssl() ? true : false);
    echo cherry_ajax_result(true, __('注册成功'));
  }
  die();
}

function cherry_login($username, $password, $message)
{
  $user = array();
  $user['user_login'] = $username;
  $user['user_password'] = $password;
  $user['remember'] = true;
  $ret = wp_signon($user, is_ssl() ? true : false);
  if (is_wp_error($ret)) {
    echo cherry_ajax_result(false, __('用户名或者密码不符'));
  } else {
    wp_set_current_user($ret->ID);
    echo cherry_ajax_result(true, $message);
  }
}

function cherry_ajax_update_avatar()
{
  $uid = get_current_user_id();
  $uploadDir = wp_upload_dir();
  $avatarDir = $uploadDir['basedir'] . '/cherry_avatar/';
  $avatarDirUrl = $uploadDir['baseurl'] . '/cherry_avatar/';
  $avatar = $_FILES["avatar"];

  // check
  $imageType = array('image/jpg', 'image/gif', 'image/png', 'image/bmp', 'image/pjpeg', "image/jpeg");
  if (!in_array($avatar['type'], $imageType)) {
    echo cherry_ajax_result(false, __('don\'t support type ' . $avatar['type']));
    die();
  }

  if ($avatar['size'] > 1048576) {
    echo cherry_ajax_result(false, __('avatar大小超过1M'));
    die();
  }

  $names = explode('/', $avatar['type']);
  if (!file_exists($avatarDir)) {
    mkdir($avatarDir, 0777, true);
  }

  if (is_uploaded_file($avatar["tmp_name"])) {
    move_uploaded_file($avatar['tmp_name'], $avatarDir . "avatar-$uid.$names[1]");
    $avatarImageUrl = $avatarDirUrl . "avatar-$uid.$names[1]";
    if (!get_user_meta($uid, "avatar", false)) {
      add_user_meta($uid, "avatar", $avatarImageUrl, false);
    } else {
      update_user_meta($uid, "avatar", $avatarImageUrl, false);
    }
    echo cherry_ajax_result(true, __('avatar更新成功'), $avatarImageUrl);
  } else {
    echo cherry_ajax_result(false, __('this request is not a post'));
  }
  die();
}
