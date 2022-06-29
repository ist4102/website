<?php

$options[] = array(
  'id' => 'i_post_extend',
  'title' => '文章扩展',
  'post_type' => 'post',
  'context' => 'side',
  'priority' => 'high',
  'sections' => array(
    array(
      'name' => 'i_post_setting',
      'fields' => array(
        array(
          'id' => 'i_post_href',
          'type' => 'text',
          'title' => '导航链接',
        ),
      )
    ),
  ),
);

CSFramework_Metabox::instance($options);