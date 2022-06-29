<?php

function cherry_get_thumbnail_style()
{
  return cherry_get_background_image(cherry_get_thumbnail_url());
}

/**
 * @return false|mixed|null|string
 */
function cherry_get_thumbnail_url()
{
  if (has_post_thumbnail()) {
    $thumbnail_url = get_the_post_thumbnail_url();
  } else {
    $thumbnail_url = cherry_get_post_first_image();
  }
  $qiniu_switcher = cs_get_option('i_qiniu_switcher');
  $qiniu_url = cs_get_option('i_qiniu_url');
  if ($qiniu_switcher && $qiniu_url) {
    $site = get_site_url();
    if (strpos($thumbnail_url, $site) !== false) {
      return preg_replace("/(http|https):\/\/([^\/]+)/i", $qiniu_url, $thumbnail_url);
    }
  }
  return $thumbnail_url;
}

/*
 * get the first image from the given post
 */
function cherry_get_post_first_image()
{
  $post = get_post();
  preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  if (empty($matches) || empty($matches[1])) {
    return cs_get_option('i_thumbnail_default');
  } elseif ($matches && isset($matches[1]) && isset($matches[1][0])) {
    return $matches[1][0];
  }
  return false;
}

