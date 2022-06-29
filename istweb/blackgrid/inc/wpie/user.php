<?php

function cherry_is_admin()
{
  return is_user_logged_in() && current_user_can('manage_options');
}

function cherry_is_editor()
{
  return is_user_logged_in()
    && current_user_can('publish_pages')
    && !current_user_can('manage_options');
}

function cherry_is_author()
{
  return is_user_logged_in()
    && current_user_can('publish_posts')
    && !current_user_can('publish_pages');
}

function cherry_is_contributor()
{
  return is_user_logged_in()
    && current_user_can('edit_posts')
    && !current_user_can('publish_posts');
}

function cherry_is_subscriber()
{
  return is_user_logged_in()
    && current_user_can('read')
    && !current_user_can('edit_posts');
}

function cherry_get_role($uid)
{
  $user = get_userdata($uid);
  switch ($user->roles) {
    case in_array('administrator', $user->roles):
      return "管理员";
      break;
    case in_array('editor', $user->roles):
      return "编辑";
      break;
    case in_array('author', $user->roles):
      return "作者";
      break;
    case in_array('contributor', $user->roles):
      return "投稿者";
      break;
    case in_array('subscriber', $user->roles):
      return "订阅者";
      break;
    default:
      return "default";
  }
}
