<?php
/**
 * Edit user administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

if ( !defined('IS_PROFILE_PAGE') )
	define('IS_PROFILE_PAGE', false);

wp_enqueue_script('user-profile');
wp_enqueue_script('password-strength-meter');

$title = IS_PROFILE_PAGE ? __('Profile') : __('Edit User');
if ( current_user_can('edit_users') && !IS_PROFILE_PAGE )
	$submenu_file = 'users.php';
else
	$submenu_file = 'profile.php';
$parent_file = 'users.php';

wp_reset_vars(array('action', 'redirect', 'profile', 'user_id', 'wp_http_referer'));

$wp_http_referer = remove_query_arg(array('update', 'delete_count'), stripslashes($wp_http_referer));

$user_id = (int) $user_id;

if ( !$user_id ) {
	if ( IS_PROFILE_PAGE ) {
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
	} else {
		wp_die(__('Invalid user ID.'));
	}
} elseif ( !get_userdata($user_id) ) {
	wp_die( __('Invalid user ID.') );
}

$all_post_caps = array('posts', 'pages');
$user_can_edit = false;
foreach ( $all_post_caps as $post_cap )
	$user_can_edit |= current_user_can("edit_$post_cap");

/**
 * Optional SSL preference that can be turned on by hooking to the 'personal_options' action.
 *
 * @since 2.7.0
 *
 * @param object $user User data object
 */
function use_ssl_preference($user) {
?>

