<?php

/**
 * CodeStar Framework
 * A Lightweight and easy-to-use WordPress Options Framework
 */
require_once dirname(__FILE__) . '/cs/cs-framework.php';

include('switcher.php');
include('thumbnail.php');
include('cherry-comment.php');
include('content.php');
include('cleanup.php');
include('smiley.php');
include('ajax.php');
include('user.php');
include('debug.php');
include('video.php');
include('page.php');
include('single.php');
include('helper.php');
include('taxonomy.php');

// auth system
include('auth/auth.php');


add_filter('use_default_gallery_style', '__return_false');

/**
 * only admin can visit the dashboard
 */
if (is('redirect_from_admin')) {
  add_action('admin_init', 'cherry_redirect_from_admin');
  function cherry_redirect_from_admin()
  {
    if ('/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF']
      && !current_user_can('manage_options')) {
      wp_redirect(site_url('/'));
    }
  }
}

function wpie_dump($var)
{
  echo '<pre>' . var_export($var, true) . '</pre>';
}

/**
 * disable admin bar in frontend page
 */
function wpie_disable_admin_bar()
{
  add_filter('show_admin_bar', '__return_false');
}
