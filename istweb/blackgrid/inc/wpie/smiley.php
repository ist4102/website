<?php

define('SMILEY_SRC_URL', get_template_directory_uri() . '/inc/cherry/assets/images/smiley/');
define('SMILEY_SRC_PATH', get_template_directory() . '/inc/cherry/assets/images/smiley/');

add_filter('smilies_src', 'cherry_smiley_src', 1, 10);
function cherry_smiley_src($src, $img, $site_url)
{
  $img = rtrim($img, "png");
  return SMILEY_SRC_URL . $img . 'png';
}

function cherry_get_wpsmiliestrans()
{
  $smiley_map = cherry_get_smiley_map();
  $output = '';
  foreach ($smiley_map as $tag => $name) {
    $js = "javascript:grin('$tag')";
    $src = cherry_get_src(SMILEY_SRC_URL . $name);
    $output .= "<a class='wp-smiley-item' href=$js><img class='wp-smiley' src='$src'/></a >";
  }
  return $output;
}

function cherry_get_smiley_map()
{
//    $smiley_map = array();
//    $files = glob(SMILEY_SRC_PATH . "*.png");
//    foreach ($files as $file) {
//        $name = str_replace(SMILEY_SRC_PATH, "", $file);
//        $tag = str_replace(".png", "", $name);
//        $smiley_map[":" . $tag . ":"] = $name;
//    }
//    return $smiley_map;
  $smiley_map = array(
    ':mrgreen:' => 'mrgreen.png',
//        ':neutral:' => 'neutral.png',
    ':twisted:' => 'twisted.png',
    ':arrow:' => 'arrow.png',
//        ':shock:' => 'eek.png',
//        ':smile:' => 'smile.png',
    ':???:' => 'confused.png',
    ':cool:' => 'cool.png',
    ':evil:' => 'evil.png',
//        ':grin:' => 'biggrin.png',
    ':idea:' => 'idea.png',
    ':oops:' => 'redface.png',
//        ':razz:' => 'razz.png',
    ':roll:' => 'rolleyes.png',
//        ':wink:' => 'wink.png',
    ':cry:' => 'cry.png',
//        ':eek:' => 'surprised.png',
    ':lol:' => 'lol.png',
//        ':mad:' => 'mad.png',
//        ':sad:' => 'sad.png',
    '8-)' => 'cool.png',
    '8-O' => 'eek.png',
    ':-(' => 'sad.png',
    ':-)' => 'smile.png',
//        ':-?' => 'confused.png',
//        ':-D' => 'biggrin.png',
    ':-P' => 'razz.png',
    ':-o' => 'surprised.png',
    ':-x' => 'mad.png',
//        ':-|' => 'neutral.png',
//        ';-)' => 'wink.png',
//        '8O' => 'eek.png',
//        ':(' => 'sad.png',
//        ':)' => 'smile.png',
//        ':?' => 'confused.png',
    ':D' => 'biggrin.png',
//        ':P' => 'razz.png',
//        ':o' => 'surprised.png',
//        ':x' => 'mad.png',
    ':|' => 'neutral.png',
    ';)' => 'wink.png',
//        ':!:' => 'exclaim.png',
    ':?:' => 'question.png',
  );
  return $smiley_map;
}

add_filter('init', 'cherry_init_wpsmiliestrans');
function cherry_init_wpsmiliestrans()
{
  global $wpsmiliestrans;
  foreach (cherry_get_smiley_map() as $tag => $name) {
    $wpsmiliestrans[$tag] = $name;
  }
}