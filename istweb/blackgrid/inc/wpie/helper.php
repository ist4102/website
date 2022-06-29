<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-01-05
 * Time: 00:36
 */

function assets($resource)
{
  echo get_stylesheet_directory_uri() . "/assets/" . $resource;
}

function cherry_is_wp_login()
{
  if (in_array($_SERVER['PHP_SELF'], array('/wp-login.php', '/wp-register.php'))) {
    return true;
  }
  return false;
}

function cherry_strip_certain_tags($content, $tags, $count = null)
{
  foreach ($tags as $tag) {
    $content = preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/", '', $content, $count);
  }
  return $content;
}

function cherry_get_background_image($src)
{
  $src = cherry_get_src($src);
  return "background-image: url($src)";
}

function cherry_get_src($src)
{
  if (is('qiniu')) {
    $qiniu_url = cs_get_option('i_qiniu_url');
    $src = preg_replace("/(http|https):\/\/([^\/]+)/i", $qiniu_url, $src);
  }

  return $src;
}

function wpie_get_user_url($user)
{
  return home_url('/user/' . $user);
}

function wpie_array_get($array, $key, $default = null) {
  return isset($array[$key]) ? $array[$key] : $default;
}