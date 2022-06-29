<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 2018-12-23
 * Time: 00:40
 */

if (is('debug')) {
  add_action('wp_footer', 'debug', 20);
}

function debug()
{
  $stat = sprintf('%d queries in %.3f seconds, using %.2fMB memory',
    get_num_queries(),
    timer_stop(0, 3),
    memory_get_peak_usage() / 1024 / 1024
  );
  echo "<div class='container'><p class='col-12 text-center'>$stat</p></div>";
}
