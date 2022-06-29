<?php

add_action('wp_ajax_follower', 'cherry_ajax_follower');

// userID <= followerID
function cherry_ajax_follower() {
    if (!is_user_logged_in()) {
        return cherry_ajax_result(false, 'You have not been logged in');
    }
    $userID = $_POST['userID'];
    $followerID = get_current_user_id();

    if (cherry_follower_had_follow($userID, $followerID)) {
        cherry_follower_del_follower($userID, $followerID);
    } else {
       cherry_follower_add_follower($userID, $followerID);
    }
    die();
}

