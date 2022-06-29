<?php

/**
 * get post excerpt by specific length content(supporting chinese)
 * @param string $post
 * @param int $length
 * @return string
 */
function wpie_get_post_excerpt($post = '', $length = 180)
{
  if (!$post) {
    $post = get_post();
  }
  $post_excerpt = $post->post_excerpt;
  if ($post_excerpt == '') {
    $content = $post->post_content;
    $content = strip_shortcodes($content);
    $content = wp_strip_all_tags($content);
    $pattern = '~(http|https)://[^\s]*~i';
    $content = preg_replace($pattern, '', $content);
    $post_excerpt = mb_strimwidth($content, 0, $length, '…', 'utf-8');
  }

  $post_excerpt = wp_strip_all_tags($post_excerpt);
  $post_excerpt = trim(preg_replace("/[\n\r\t ]+/", ' ', $post_excerpt), ' ');
  return $post_excerpt;
}

/**
 * return the timestamp of the latest post
 * @return false|int
 */
function cherry_get_latest_post_date()
{
  global $wpdb;
  $sql = "SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1";
  return strtotime($wpdb->get_var($sql));
}