<?php

/**
 * generate rewrite url for user system
 */
add_action('generate_rewrite_rules', 'cherry_user_rewrite_rules');
function cherry_user_rewrite_rules($wp_rewrite)
{
  $rules = array(
    'user/([A-Za-z0-9]{1,})/?$' => 'index.php?cherry_user_url=user&username=$matches[1]',
    'user/([A-Za-z0-9]{1,})/page/([0-9]{1,})/?$' => 'index.php?cherry_user_url=user&username=$matches[1]&paged=$matches[2]',
  );
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}

/**
 * add custom query var into public query vars array
 */
add_action('query_vars', 'cherry_user_add_query_vars');
function cherry_user_add_query_vars($public_query_vars)
{
  array_push($public_query_vars, 'cherry_user_url', 'username', 'paged');
  return $public_query_vars;
}

/**
 *
 */
add_action('template_redirect', 'cherry_user_template_redirect');
function cherry_user_template_redirect()
{
  global $wp_query;
  if (!empty($wp_query->query_vars['cherry_user_url'])) {
    $redirect = $wp_query->query_vars['cherry_user_url'];
    if ($redirect == 'user') {
      $wp_query->is_home = false;
      include(TEMPLATEPATH . '/inc/cherry/auth/templates/user.php');
      die();
    }
  }
}

add_action('load-themes.php', 'cherry_user_flush_rewrite_rules');
function cherry_user_flush_rewrite_rules()
{
  global $pagenow, $wp_rewrite;
  if ('themes.php' == $pagenow && isset($_GET['activated']))
    $wp_rewrite->flush_rules();
}
