<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-04-12
 * Time: 23:17
 */

/**
 * @param $id
 * @return array|int|WP_Error
 */
function wpie_get_child_categories($id)
{
  $taxonomies = array(
    'category',
  );

  $args = array(
    'parent' => $id,
  );
  return get_terms($taxonomies, $args);
}