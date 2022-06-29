<?php
/**
 * Created by PhpStorm.
 * User: Overbool
 * Date: 2019-03-21
 * Time: 23:00
 */

include "inc/wpie/wpie.php";

/**
 * load css and js resources
 */
function cherry_load_resources() {
	// load css
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/assets/style.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'switchery', 'https://cdn.bootcss.com/switchery/0.8.2/switchery.min.css', array(), '1.0.0', 'all' );

	wp_enqueue_script( 'smooth-scroll', 'https://cdn.bootcss.com/smooth-scroll/16.0.3/smooth-scroll.min.js', array(), '16.0.3', true );
	wp_enqueue_script( 'cookie', 'https://cdn.bootcss.com/js-cookie/latest/js.cookie.min.js', array(), '0.1.0', true );
	wp_enqueue_script( 'switchery', 'https://cdn.bootcss.com/switchery/0.8.2/switchery.min.js', array(), '0.1.0', true );
	wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/js/app.min.js', array(), '0.1.0', true );
}

add_action( 'wp_enqueue_scripts', 'cherry_load_resources' );

function remove_admin_login_header() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

add_action( 'get_header', 'remove_admin_login_header' );

wpie_disable_admin_bar();

function cherry_get_site_date() {
	if ( cs_get_option( 'i_site_date' ) == date( "Y" ) ) {
		return date( "Y" );
	} else {
		return cs_get_option( 'i_site_date' ) . "-" . date( "Y" );
	}
}

wpie_add_page( '我的书签', 'bookmark', 'page/bookmark.php' );
wpie_add_page( '关于我们', 'about', 'page/about.php' );

// Enable the user with no privileges
add_action( 'wp_ajax_nopriv_ajaxLoveBookmark', 'wpie_love_bookmark' );
add_action( 'wp_ajax_ajaxLoveBookmark', 'wpie_love_bookmark' );
add_action( 'wp_ajax_nopriv_ajaxVisitBookmark', 'wpie_visit_bookmark' );
add_action( 'wp_ajax_ajaxVisitBookmark', 'wpie_visit_bookmark' );
add_action( 'wp_ajax_ajaxSubmitNavigation', 'wpie_submit_navigation' );
add_action( 'wp_ajax_ajaxDeleteNavigation', 'wpie_delete_navigation' );

function wpie_love_bookmark() {
	$pid = $_POST['pid'];
	if ( $pid == '' ) {
		echo cherry_ajax_result( false, 'the invalid post id' );
		die();
	}

	$love_key = 'love_count';
	$count    = get_post_meta( $pid, $love_key, true );
	$count    = $count ? $count + 1 : 1;
	update_post_meta( $pid, $love_key, $count );

	$expire = time() + 99999999;
	$domain = ( $_SERVER['HTTP_HOST'] != 'localhost' ) ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
	setcookie( 'love_' . $pid, $pid, $expire, '/', $domain, false );

	echo cherry_ajax_result( true, 'update bookmark love successfully', $count );
	die();
}

function wpie_visit_bookmark() {
	$pid = $_POST['pid'];
	if ( $pid == '' ) {
		echo cherry_ajax_result( false, 'the invalid post id' );
		die();
	}

	$visit_key = 'visit_count';
	$count     = get_post_meta( $pid, $visit_key, true );
	$count     = $count ? $count + 1 : 1;

	update_post_meta( $pid, $visit_key, $count );
	echo cherry_ajax_result( true, 'update bookmark visit count successfully', $count );
	die();
}


function wpie_submit_navigation() {
	$id  = get_current_user_id();
	$ret = get_user_meta( $id, 'navigation', true );
	$num = sizeof( $ret );
	$nav = array(
		'name'  => $_POST['name'],
		'url'   => $_POST['url'],
		'desc'  => $_POST['desc'],
		'image' => $_POST['image']
	);

	if ( empty( $ret ) ) {
		$ret = array( $nav );
	} else {
		array_push( $ret, $nav );
	}

	update_user_meta( $id, 'navigation', $ret );
	echo cherry_ajax_result( true, wpie_get_card( $_POST['name'], $_POST['url'], $_POST['desc'], $_POST['image'], $num ) );
	die();
}

function wpie_delete_navigation() {
	$id  = get_current_user_id();
	$ret = get_user_meta( $id, 'navigation', true );

	$nid = $_POST['id'];

	array_splice( $ret, $nid, 1 );

	update_user_meta( $id, 'navigation', $ret );
	echo cherry_ajax_result( true, "delete navigation successfully" );
	die();
}

function wpie_get_card( $name, $url, $desc, $image, $id ) {
	$img = "<figure class='image'><img src='$image' alt=''></figure>";

	return "<div class='col-xl-3 col-lg-4 col-sm-6'>
            <a class='card tooltip tooltip-bottom' href='$url'
               data-tooltip='$desc'>
              <div class='media'>
                <div class='media-left'>
                  <div class='navigation-img'>
                    $img
                  </div>
                </div>
                <div class='media-content'>
                  <div class='card-title text-truncate'>
                    $name
                  </div>
                  <div class='card-desc'>
                    $desc
                  </div>
                </div>
              </div>
               <div class='card-tools'>
                <i class='icon czs-trash-l card-delete'  data-id='$id'></i>
              </div>
            </a>
          </div>";
}

function wpie_redirect_to_homepage() {
	if ( ! current_user_can( 'administrator' ) ) {
		wp_redirect( home_url() );
		exit();
	}
}

add_action( 'wp_login', 'wpie_redirect_to_homepage' );

add_filter( 'pre_option_link_manager_enabled', '__return_true' );