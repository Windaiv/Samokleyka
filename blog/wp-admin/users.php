<?php
/**
 * Users administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

/** WordPress Registration API */
require_once( ABSPATH . WPINC . '/registration.php');

if ( !current_user_can('edit_users') )
	wp_die(__('Cheatin&#8217; uh?'));

$title = __('Users');
$parent_file = 'users.php';

$update = $doaction = '';
if ( isset($_REQUEST['action']) )
	$doaction = $_REQUEST['action'] ? $_REQUEST['action'] : $_REQUEST['action2'];

if ( empty($doaction) ) {
	if ( isset($_GET['changeit']) && !empty($_GET['new_role']) )
		$doaction = 'promote';
}

if ( empty($_REQUEST) ) {
	$referer = '<input type="hidden" name="wp_http_referer" value="'. esc_attr(stripslashes($_SERVER['REQUEST_URI'])) . '" />';
} elseif ( isset($_REQUEST['wp_http_referer']) ) {
	$redirect = remove_query_arg(array('wp_http_referer', 'updated', 'delete_count'), stripslashes($_REQUEST['wp_http_referer']));
	$referer = '<input type="hidden" name="wp_http_referer" value="' . esc_attr($redirect) . '" />';
} else {
	$redirect = 'users.php';
	$referer = '';
}

switch ($doaction) {

/* Bulk Dropdown menu Role changes */
case 'promote':
	check_admin_referer('bulk-users');

	if (empty($_REQUEST['users'])) {
		wp_redirect($redirect);
		exit();
	}

	$editable_roles = get_editable_roles();
	if (!$editable_roles[$_REQUEST['new_role']])
		wp_die(__('You can&#8217;t give users that role.'));

	$userids = $_REQUEST['users'];
	$update = 'promote';
	foreach($userids as $id) {
		if ( ! current_user_can('edit_user', $id) )
			wp_die(__('You can&#8217;t edit that user.'));
		// The new role of the current user must also have edit_users caps
		if($id == $current_user->ID && !$wp_roles->role_objects[$_REQUEST['new_role']]->has_cap('edit_users')) {
			$update = 'err_admin_role';
			continue;
		}

		$user = new WP_User($id);
		$user->set_role($_REQUEST['new_role']);
	}

	wp_redirect(add_query_arg('update', $update, $redirect));
	exit();

break;

case 'dodelete':

	check_admin_referer('delete-users');

	if ( empty($_REQUEST['users']) ) {
		wp_redirect($redirect);
		exit();
	}

	if ( !current_user_can('delete_users') )
		wp_die(__('You can&#8217;t delete users.'));

	$userids = $_REQUEST['users'];
	$update = 'del';
	$delete_count = 0;

	foreach ( (array) $userids as $id) {
		if ( ! current_user_can('delete_user', $id) )
			wp_die(__('You can&#8217;t delete that user.'));

		if($id == $current_user->ID) {
			$update = 'err_admin_del';
			continue;
		}
		switch($_REQUEST['delete_option']) {
		case 'delete':
			wp_delete_user($id);
			break;
		case 'reassign':
			wp_delete_user($id, $_REQUEST['reassign_user']);
			break;
		}
		++$delete_count;
	}

	$redirect = add_query_arg( array('delete_count' => $delete_count, 'update' => $update), $redirect);
	wp_redirect($redirect);
	exit();

break;

case 'delete':

	check_admin_referer('bulk-users');

	if ( empty($_REQUEST['users']) && empty($_REQUEST['user']) ) {
		wp_redirect($redirect);
		exit();
	}

	if ( !current_user_can('delete_users') )
		$errors = new WP_Error('edit_users', __('You can&#8217;t delete users.'));

	if ( empty($_REQUEST['users']) )
		$userids = array(intval($_REQUEST['user']));
	else
		$userids = $_REQUEST['users'];

	include ('admin-header.php');
?>

