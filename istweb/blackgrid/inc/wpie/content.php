<?php

function cherry_get_embedded_media($type = array())
{
  $content = do_shortcode(apply_filters('the_content', get_the_content()));
  $embed = get_media_embedded_in_content($content, $type);
  if (empty($embed)) {
    return '';
  }

  if (in_array('audio', $type)) {
    $output = str_replace('?visual=true', '?visual=true', $embed[0]);
  } else {
    $output = $embed[0];
  }
  return $output;
}

function cherry_get_galleries_by_ids($ids)
{
  $idArr = explode(',', $ids);
  $args = array(
    'post__in' => $idArr,
    'post_type' => 'attachment',
    'posts_per_page' => 20,
  );
  $attachments = get_posts($args);
  $output = array();

  foreach ($attachments as $attachment) {
    $meta = wp_get_attachment_metadata($attachment->ID);
    $url = wp_get_attachment_url($attachment->ID);

    $reg = "/(http|https):\/\/([^\/]+)/i";
    $qiniu_switcher = cs_get_option('i_qiniu_switcher');
    $qiniu_url = cs_get_option('i_qiniu_url');
    if ($qiniu_switcher && $qiniu_url) {
      $url = preg_replace($reg, $qiniu_url, $url);
    }
    array_push($output, array(
      'id' => $attachment->ID,
      'src' => $url,
      'caption' => $attachment->post_excerpt,
      'width' => $meta['width'],
      'height' => $meta['height']
    ));
  }
  return $output;
}

function cherry_get_post_galleries()
{
  $galleries = get_post_galleries('', false);
  if (empty($galleries)) {
    return false;
  }
  $ids = wp_list_pluck($galleries, 'ids');
  $idArr = explode(',', implode(',', $ids));
  $args = array(
    'post__in' => $idArr,
    'post_type' => 'attachment',
    'posts_per_page' => 20,
  );
  $attachments = get_posts($args);
  $output = array();

  foreach ($attachments as $attachment) {
    $meta = wp_get_attachment_metadata($attachment->ID);
    $url = wp_get_attachment_url($attachment->ID);

    $reg = "/(http|https):\/\/([^\/]+)/i";
    $qiniu_switcher = cs_get_option('i_qiniu_switcher');
    $qiniu_url = cs_get_option('i_qiniu_url');
    if ($qiniu_switcher && $qiniu_url) {
      $url = preg_replace($reg, $qiniu_url, $url);
    }
    array_push($output, array(
      'id' => $attachment->ID,
      'src' => $url,
      'caption' => $attachment->post_excerpt,
      'width' => $meta['width'],
      'height' => $meta['height']
    ));
  }
  return $output;
}

function cherry_get_the_content($tag, $count = null)
{
  $content = get_the_content();
  if ($tag == 'gallery') {
    $content = preg_replace("/(?:\[$tag)(.*)(?:\])/i", '', $content);
  }
  $content = apply_filters('the_content', $content);
//    $content = str_replace(']]>', ']]&gt;', $content);
//    if ($tag == 'video') {
//        $content = cherry_strip_certain_tags($content, array('iframe', 'video'), $count);
//    }
  return $content;
}

function get_carousel_posts($num = 3)
{
  $sticky = get_sticky_posts($num);
  $sticky_count = is_null($sticky) ? 0 : $sticky->post_count;
  if ($sticky_count == $num) {
    return $sticky;
  } elseif ($sticky_count < $num && $sticky_count > 0) {
    $posts = new WP_Query(
      array(
        'posts_per_page' => $num - $sticky_count,
        'ignore_sticky_posts' => 1,
        'post__not_in' => get_option('sticky_posts'),
        'tax_query' => array(
          array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array(
              'post-format-audio',
              'post-format-gallery',
              'post-format-video'
            ),
            'operator' => 'NOT IN'
          )
        )
      )
    );
    $carousel = new WP_Query();
    $carousel->posts = array_merge($sticky->posts, $posts->posts);
    $carousel->post_count = $sticky->post_count + $posts->post_count;
    return $carousel;
  } else {
    return new WP_Query(
      array(
        'posts_per_page' => $num,
        'tax_query' => array(
          array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array(
              'post-format-aside',
              'post-format-audio',
              'post-format-chat',
              'post-format-gallery',
              'post-format-image',
              'post-format-link',
              'post-format-quote',
              'post-format-status',
              'post-format-video'
            ),
            'operator' => 'NOT IN'
          )
        )
      )
    );
  }
}

function get_sticky_posts($num = 3)
{
  $sticky = get_option('sticky_posts');
  if (!empty($sticky)) {
    rsort($sticky);
    $sticky = array_slice($sticky, 0);
    return new WP_Query(
      $args = array(
        'post__in' => $sticky,
        'ignore_sticky_posts' => true,
        'posts_per_page' => $num
      )
    );
  }
  return null;
}

function cherry_replace_content_url($text)
{
  $qiniu_switcher = cs_get_option('i_qiniu_switcher');
  $qiniu_url = cs_get_option('i_qiniu_url');
  if ($qiniu_switcher && $qiniu_url) {
    $replace = array(
      get_home_url() => $qiniu_url,
    );
    $text = str_replace(array_keys($replace), $replace, $text);
  }
  return $text;
}

add_filter('the_content', 'cherry_replace_content_url');
function cherry_get_first_category_link($class)
{
  $category = get_the_category();
  if (!empty($category) && $category[0]) {
    $url = get_category_link($category[0]->term_id);
    $name = $category[0]->cat_name;
    return "<a class='$class' href='$url'>$name</a>";
  }
  return '';
}

function cherry_count_user_posts_by_status($post_status = 'publish', $user_id = 0)
{
  global $wpdb;
  $count = $wpdb->get_var(
    $wpdb->prepare(
      "
        SELECT COUNT(ID) FROM $wpdb->posts 
        WHERE post_status = %s 
        AND post_author = %d",
      $post_status,
      $user_id
    )
  );
  return ($count) ? $count : 0;
}

function cherry_count_user_all_posts($id)
{
  $publish = count_user_posts($id);
  $draft = cherry_count_user_posts_by_status('draft', $id);
  return (int)$publish + $draft;
}