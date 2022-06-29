<?php

$options[] = array(
  'id' => 'i_category_extend',
  'taxonomy' => 'category', // category, post_tag or your custom taxonomy name
  'fields' => array(
    array(
      'id' => 'i_category_icon',
      'type' => 'icon',
      'title' => '分类图标',
    ),
    array(
      'id' => 'i_category_tag',
      'type' => 'text',
      'title' => '分类标签',
    ),
    array(
      'id' => 'i_category_tag_color',
      'type' => 'color_picker',
      'title' => '分类标签颜色',
    ),
  ),
);

CSFramework_Taxonomy::instance($options);
