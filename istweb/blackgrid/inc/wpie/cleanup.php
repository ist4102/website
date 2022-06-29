<?php

remove_action('wp_head', 'wp_generator');
add_filter('script_loader_src', 'cherry_confuse_wp_version');
add_filter('style_loader_src', 'cherry_confuse_wp_version');
add_action('init', 'disableEmojis');

/**
 * remove js/css optional wordpress version
 * @param $src
 * @return mixed
 */
function cherry_confuse_wp_version($src)
{
  global $wp_version;
  parse_str(parse_url($src, PHP_URL_QUERY), $query);
  if (!empty($query['ver']) && $query['ver'] === $wp_version) {
    $src = str_replace($wp_version, "12.8.8", $src);
  }
  return $src;
}

/**
 * forbid/remove autoload emoji scripts in the frontend
 */
function disableEmojis()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'disableEmojisTinymce');
}

function disableEmojisTinymce($plugins)
{
  return array_diff($plugins, array('wpemoji'));
}

/**
 * remove redundant meta code in the html head
 */
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/**
 * remove wp-json
 */
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

function disable_embeds_init()
{
  global $wp;
  $wp->public_query_vars = array_diff($wp->public_query_vars, array('embed',));
  remove_action('rest_api_init', 'wp_oembed_register_route');
  add_filter('embed_oembed_discover', '__return_false');
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');
  add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');
  add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
}

//add_action('init', 'disable_embeds_init', 9999);
function disable_embeds_tiny_mce_plugin($plugins)
{
  return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules)
{
  foreach ($rules as $rule => $rewrite) {
    if (false !== strpos($rewrite, 'embed=true')) {
      unset($rules[$rule]);
    }
  }
  return $rules;
}

function disable_embeds_remove_rewrite_rules()
{
  add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
  flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'disable_embeds_remove_rewrite_rules');
function disable_embeds_flush_rewrite_rules()
{
  remove_filter('rewrite_rules_array', 'disable_embeds_rewrites');
  flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'disable_embeds_flush_rewrite_rules');

//add_action('wp_print_scripts', 'cherry_remove_media_element_scripts', 100);
//add_filter('wp_video_shortcode_library', 'cherry_remove_media_element');

function cherry_remove_media_element_scripts()
{
  wp_dequeue_script('wp-mediaelement');
  wp_deregister_script('wp-mediaelement');
}

function cherry_remove_media_element()
{
  return '';
}
