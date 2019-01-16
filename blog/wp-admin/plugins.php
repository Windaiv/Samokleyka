<?php
/**
 * Plugins administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

if ( ! current_user_can('activate_plugins') )
	wp_die(__('You do not have sufficient permissions to manage plugins for this blog.'));

if ( isset($_POST['clear-recent-list']) )
	$action = 'clear-recent-list';
elseif ( !empty($_REQUEST['action']) )
	$action = $_REQUEST['action'];
elseif ( !empty($_REQUEST['action2']) )
	$action = $_REQUEST['action2'];
else
	$action = false;

$plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';

$default_status = get_user_option('plugins_last_view');
if ( empty($default_status) )
	$default_status = 'all';
$status = isset($_REQUEST['plugin_status']) ? $_REQUEST['plugin_status'] : $default_status;
if ( !in_array($status, array('all', 'active', 'inactive', 'recent', 'upgrade', 'search')) )
	$status = 'all';
if ( $status != $default_status && 'search' != $status )
	update_usermeta($current_user->ID, 'plugins_last_view', $status);

$page = isset($_REQUEST['paged']) ? $_REQUEST['paged'] : 1;

//Clean up request URI from temporary args for screen options/paging uri's to work as expected.
$_SERVER['REQUEST_URI'] = remove_query_arg(array('error', 'deleted', 'activate', 'activate-multi', 'deactivate', 'deactivate-multi', '_error_nonce'), $_SERVER['REQUEST_URI']);

if ( !empty($action) ) {
	switch ( $action ) {
		case 'activate':
			if ( ! current_user_can('activate_plugins') )
				wp_die(__('You do not have sufficient permissions to activate plugins for this blog.'));

			check_admin_referer('activate-plugin_' . $plugin);

			$result = activate_plugin($plugin, 'plugins.php?error=true&plugin=' . $plugin);
			if ( is_wp_error( $result ) )
				wp_die($result);

			$recent = (array)get_option('recently_activated');
			if ( isset($recent[ $plugin ]) ) {
				unset($recent[ $plugin ]);
				update_option('recently_activated', $recent);
			}

			wp_redirect("plugins.php?activate=true&plugin_status=$status&paged=$page"); // overrides the ?error=true one above
			exit;
			break;
		case 'activate-selected':
			if ( ! current_user_can('activate_plugins') )
				wp_die(__('You do not have sufficient permissions to activate plugins for this blog.'));

			check_admin_referer('bulk-manage-plugins');

			$plugins = isset( $_POST['checked'] ) ? (array) $_POST['checked'] : array();
			$plugins = array_filter($plugins, create_function('$plugin', 'return !is_plugin_active($plugin);') ); //Only activate plugins which are not already active.
			if ( empty($plugins) ) {
				wp_redirect("plugins.php?plugin_status=$status&paged=$page");
				exit;
			}

			activate_plugins($plugins, 'plugins.php?error=true');

			$recent = (array)get_option('recently_activated');
			foreach ( $plugins as $plugin => $time)
				if ( isset($recent[ $plugin ]) )
					unset($recent[ $plugin ]);

			update_option('recently_activated', $recent);

			wp_redirect("plugins.php?activate-multi=true&plugin_status=$status&paged=$page");
			exit;
			break;
		case 'error_scrape':
			if ( ! current_user_can('activate_plugins') )
				wp_die(__('You do not have sufficient permissions to activate plugins for this blog.'));

			check_admin_referer('plugin-activation-error_' . $plugin);

			$valid = validate_plugin($plugin);
			if ( is_wp_error($valid) )
				wp_die($valid);

			if ( defined('E_RECOVERABLE_ERROR') )
				error_reporting(E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
			else
				error_reporting(E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING);

			@ini_set('display_errors', true); //Ensure that Fatal errors are displayed.
			include(WP_PLUGIN_DIR . '/' . $plugin);
			do_action('activate_' . $plugin);
			exit;
			break;
		case 'deactivate':
			if ( ! current_user_can('activate_plugins') )
				wp_die(__('You do not have sufficient permissions to deactivate plugins for this blog.'));

			check_admin_referer('deactivate-plugin_' . $plugin);
			deactivate_plugins($plugin);
			update_option('recently_activated', array($plugin => time()) + (array)get_option('recently_activated'));
			wp_redirect("plugins.php?deactivate=true&plugin_status=$status&paged=$page");
			exit;
			break;
		case 'deactivate-selected':
			if ( ! current_user_can('activate_plugins') )
				wp_die(__('You do not have sufficient permissions to deactivate plugins for this blog.'));

			check_admin_referer('bulk-manage-plugins');

			$plugins = isset( $_POST['checked'] ) ? (array) $_POST['checked'] : array();
			$plugins = array_filter($plugins, 'is_plugin_active'); //Do not deactivate plugins which are already deactivated.
			if ( empty($plugins) ) {
				wp_redirect("plugins.php?plugin_status=$status&paged=$page");
				exit;
			}

			deactivate_plugins($plugins);

			$deactivated = array();
			foreach ( $plugins as $plugin )
				$deactivated[ $plugin ] = time();

			update_option('recently_activated', $deactivated + (array)get_option('recently_activated'));
			wp_redirect("plugins.php?deactivate-multi=true&plugin_status=$status&paged=$page");
			exit;
			break;
		case 'delete-selected':
			if ( ! current_user_can('delete_plugins') )
				wp_die(__('You do not have sufficient permissions to delete plugins for this blog.'));

			check_admin_referer('bulk-manage-plugins');

			//$_POST = from the plugin form; $_GET = from the FTP details screen.
			$plugins = isset( $_REQUEST['checked'] ) ? (array) $_REQUEST['checked'] : array();
			$plugins = array_filter($plugins, create_function('$plugin', 'return !is_plugin_active($plugin);') ); //Do not allow to delete Activated plugins.
			if ( empty($plugins) ) {
				wp_redirect("plugins.php?plugin_status=$status&paged=$page");
				exit;
			}

			include(ABSPATH . 'wp-admin/update.php');

			$parent_file = 'plugins.php';

			if ( ! isset($_REQUEST['verify-delete']) ) {
				wp_enqueue_script('jquery');
				require_once('admin-header.php');
				?>

