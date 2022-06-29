<?php

function cherry_follower_load_theme() {
    global $pagenow;
    if (is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'])){
        cherry_follower_install();
    }
}
add_action('load-themes.php', 'cherry_follower_load_theme');

function cherry_follower_install(){
    global $wpdb;
    $tableName = $wpdb->prefix . 'followers';
    $charsetCollate = $wpdb->get_charset_collate();
    if ($wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName) {
        $sql = "CREATE TABLE `".$tableName."`(
            `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` BIGINT(40),
            `follower_id` BIGINT(40),
            `date` DATETIME NOT NULL
        ) $charsetCollate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

function cherry_follower_insert_follower($userID, $followerID) {
    global $wpdb;
    $tableName = $wpdb->prefix . 'followers';
    $date = date("Y-m-d H:i:s");
    $sql = "insert into {$tableName} (user_id, follower_id, date) 
      values('{$userID}', '{$followerID}', '{$date}' )";
    $result = $wpdb->query($sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

function cherry_follower_delete_follower($userID, $followerID) {
    global $wpdb;
    $tableName = $wpdb->prefix . 'followers';
    $sql = "delete from {$tableName} where user_id={$userID} and follower_id={$followerID}";
    $result = $wpdb->query($sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

function cherry_follower_had_follow($userID, $followerID) {
    global $wpdb;
    $tableName = $wpdb->prefix . 'followers';
    $sql = "select * from ".$tableName." where user_id={$userID} and follower_id={$followerID}";
    $result = $wpdb->get_results($sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

function cherry_follower_get_followers($userID) {
    global $wpdb;
    $user = get_user_by('ID', $userID);
    if(!$user){
        return 0;
    }
    $tableName = $wpdb->prefix . 'followers';
    $sql = "select follower_id from ".$tableName." where user_id={$userID}";
    $result = $wpdb->get_results($sql);
    if(!$result){
        return 0;
    }else{
        return $result;
    }
}

function cherry_follower_get_followers_count($userID) {
    $res = get_user_meta($userID, "followers_count", true);
    if (!$res) {
        return 0;
    } else {
        return $res;
    }
}

function cherry_follower_get_following_count($userID) {
    $res = get_user_meta($userID, "following_count", true);
    if (!$res) {
        return 0;
    } else {
        return $res;
    }
}

// logic operation for follower
function cherry_follower_add_follower($userID, $followerID) {
    // add followers log
    $result = cherry_follower_insert_follower($userID, $followerID);
    if (!$result) {
        return cherry_ajax_result(false, "follow failed");
    }
    // update follower
    $num = cherry_follower_get_followers_count($userID);
    $ret = update_user_meta($userID, "followers_count", $num + 1, false);
    if (!$ret){
        cherry_follower_delete_follower($userID, $followerID);
        echo cherry_ajax_result(false, __('Update followers_count error'));
        die;
    }
    // update following
    $count = cherry_follower_get_following_count($followerID);
    $res = update_user_meta($followerID, "following_count", $count + 1, false);
    if (!$res){
        // rollback
        cherry_follower_delete_follower($userID, $followerID);
        update_user_meta($userID, "followers_count", $num, false);
        echo cherry_ajax_result(false, __('Update following_count error'));
    } else {
        echo cherry_ajax_result(true, __('Follower successfully'));
    }
    die;
}

function cherry_follower_del_follower($userID, $followerID) {
    // delete followers log
    $result = cherry_follower_delete_follower($userID, $followerID);
    if (!$result) {
        return cherry_ajax_result(false, "unFollow failed");
    }
    // update follower
    $num = cherry_follower_get_followers_count($userID);
    $ret = update_user_meta($userID, "followers_count", $num - 1, false);
    if (!$ret){
        cherry_follower_insert_follower($userID, $followerID);
        echo cherry_ajax_result(false, __('Update followers_count error'));
        die;
    }
    // update following
    $count = cherry_follower_get_following_count($followerID);
    $res = update_user_meta($followerID, "following_count", $count - 1, false);
    if (!$res){
        // rollback
        cherry_follower_insert_follower($userID, $followerID);
        update_user_meta($userID, "followers_count", $num, false);
        echo cherry_ajax_result(false, __('Update following_count error'));
    } else {
        echo cherry_ajax_result(true, __('Follower successfully'));
    }
    die;
}
