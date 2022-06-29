<?php

function cherry_count_user_comments($id)
{
  global $wpdb;
  $count = $wpdb->get_var(
    'SELECT COUNT(comment_ID) FROM ' . $wpdb->comments . ' 
    WHERE user_id = "' . $id . '" 
    AND comment_approved = "1" '
  );
  return $count;
}
