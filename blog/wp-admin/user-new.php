<?php
/**
 * New User Administration Panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

if ( !current_user_can('create_users') )
	wp_die(__('Cheatin&#8217; uh?'));

/** WordPress Registration API */
require_once( ABSPATH . WPINC . '/registration.php');

if ( isset($_REQUEST['action']) && 'adduser' == $_REQUEST['action'] ) {
	check_admin_referer('add-user');

	if ( ! current_user_can('create_users') )
		wp_die(__('You can&#8217;t create users.'));

	$user_id = add_user();

	if ( is_wp_error( $user_id ) ) {
		$add_user_errors = $user_id;
	} else {
		$new_user_login = apply_filters('pre_user_login', sanitize_user(stripslashes($_REQUEST['user_login']), true));
		$redirect = 'users.php?usersearch='. urlencode($new_user_login) . '&update=add';
		wp_redirect( $redirect . '#user-' . $user_id );
		die();
	}
}

$title = __('Add New User');
$parent_file = 'users.php';

wp_enqueue_script('wp-ajax-response');
wp_enqueue_script('user-profile');
wp_enqueue_script('password-strength-meter');

require_once ('admin-header.php');

?>

