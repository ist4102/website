<?php

if (!is_admin()) {
  add_action('wp_loaded', 'cherry_ob_start');
}

function cherry_ob_start()
{
  ob_start('cherry_qiniu_cdn_replace');
}


function cherry_qiniu_cdn_replace($html)
{
  $local_host = 'http://c7sky.com'; //博客域名
  $qiniu_host = 'http://c7sky.u.qiniudn.com'; //七牛域名
  $cdn_exts = 'js|css|png|jpg|jpeg|gif|ico'; //扩展名（使用|分隔）
  $cdn_dirs = 'wp-content|wp-includes'; //目录（使用|分隔）

  $cdn_dirs = str_replace('-', '\-', $cdn_dirs);

  if ($cdn_dirs) {
    $regex = '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
    $html = preg_replace($regex, $qiniu_host . '/$1$4', $html);
  } else {
    $regex = '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
    $html = preg_replace($regex, $qiniu_host . '/$1$3', $html);
  }
  return $html;
}
