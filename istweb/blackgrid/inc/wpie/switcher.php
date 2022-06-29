<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-01-05
 * Time: 00:49
 */

$cherry_switcher = array(
  'debug' => get(cs_get_option('i_debug_switcher'), false),
  'auth' => get(cs_get_option('i_auth_switcher'), true),
  'qiniu' => get(cs_get_option('i_qiniu_switcher'), false),
  'redirect_from_admin' => get(cs_get_option('i_redirect_from_admin'), false),
);

function is($option)
{
  return $GLOBALS['cherry_switcher'][$option];
}

function get($var, $default = null)
{
  return isset($var) ? $var : $default;
}