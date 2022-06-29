<?php

add_action( 'init', 'cherry_init' );
function cherry_init() {
	wp_register_script( 'cherry-script',
		get_template_directory_uri() . '/inc/wpie/assets/js/cherry.min.js',
		false,
		null,
		true );
	wp_enqueue_script( 'cherry-script' );
}

add_action( 'init', 'cherry_ajax_init' );
function cherry_ajax_init() {
	if ( ! is_admin() && ! cherry_is_wp_login() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js', false, '3.3.1', true );
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'cherry-ajax-script',
			'https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js',
			false,
			null,
			false );
		wp_enqueue_script( 'cherry-ajax-script' );
		wp_localize_script( 'cherry-ajax-script', 'wpieAjax', array(
			'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
			'themeUrl' => get_template_directory_uri(),
			'homeUrl'  => home_url(),
		) );
	}
}

if ( current_user_can( 'contributor' ) && ! current_user_can( 'upload_files' ) ) {
	add_action( 'admin_init', 'allow_contributor_uploads' );
}

function allow_contributor_uploads() {
	$contributor = get_role( 'contributor' );
	$contributor->add_cap( 'upload_files' );
}

/**
 * @param $code : true|false
 * @param $msg
 * @param $extra
 *
 * @return string
 */
function cherry_ajax_result( $code, $msg, $extra = '' ) {
	return json_encode( array(
		'code'  => $code,
		'msg'   => $msg,
		'extra' => $extra
	) );
}


