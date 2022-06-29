<?php

add_action('wp_ajax_postContent', 'cherry_ajax_post');

function cherry_ajax_post()
{
  $latest_post_date = cherry_get_latest_post_date();
  if ((date_i18n('U') - $latest_post_date) < 20) {
    echo cherry_ajax_result(false, '投稿太快了');
    die();
  }

  $title = isset($_POST['submit-title']) ? trim(htmlspecialchars($_POST['submit-title'], ENT_QUOTES)) : '';
  $category = isset($_POST['cat']) ? (int)$_POST['cat'] : 0;
  $tag = isset($_POST['tag']) ? wp_filter_nohtml_kses($_POST['tag']) : '';
  $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '';
  $content = isset($_POST['submit-content']) ? trim(wp_kses_post($_POST['submit-content'])) : '';
  if (empty($title) || mb_strlen($title) > 100) {
    echo cherry_ajax_result(false, '标题必须填写，且长度不得超过100字');
    die();
  }
  if (empty($content) || mb_strlen($content) > 5000 || mb_strlen($content) < 100) {
    echo cherry_ajax_result(false, '内容必须填写，且长度不得超过5000字，不得少于100字' . mb_strlen($content));
    die();
  }

  $submit = array(
    'post_title' => $title,
    'post_content' => $content,
    'tags_input' => $tag,
    'subject' => $subject,
    'post_category' => array($category)
  );
  if (cherry_is_admin() || cherry_is_editor() || cherry_is_author()) {
    $submit['post_status'] = 'publish';
  }
  $status = 1;
  $status = wp_insert_post($submit);
  $user = wp_get_current_user();
  if ($status != 0) {
    wp_mail($user->user_email, $title, '投稿成功');
    echo cherry_ajax_result(true, '投稿成功');
  } else {
    echo cherry_ajax_result(false, '投稿失败');
  }
  die();
}
