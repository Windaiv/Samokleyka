<?php
/**
 * Link Management Administration Panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Administration Bootstrap */
require_once ('admin.php');

// Handle bulk deletes
if ( isset($_GET['action']) && isset($_GET['linkcheck']) ) {
	check_admin_referer('bulk-bookmarks');
	$doaction = $_GET['action'] ? $_GET['action'] : $_GET['action2'];

	if ( ! current_user_can('manage_links') )
		wp_die( __('You do not have sufficient permissions to edit the links for this blog.') );

	if ( 'delete' == $doaction ) {
		$bulklinks = (array) $_GET['linkcheck'];
		foreach ( $bulklinks as $link_id ) {
			$link_id = (int) $link_id;

			wp_delete_link($link_id);
		}

		wp_safe_redirect( wp_get_referer() );
		exit;
	}
} elseif ( isset($_GET['_wp_http_referer']) && ! empty($_GET['_wp_http_referer']) ) {
	 wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	 exit;
}

wp_reset_vars(array('action', 'cat_id', 'linkurl', 'name', 'image', 'description', 'visible', 'target', 'category', 'link_id', 'submit', 'order_by', 'links_show_cat_id', 'rating', 'rel', 'notes', 'linkcheck[]'));

if ( empty($cat_id) )
	$cat_id = 'all';

if ( empty($order_by) )
	$order_by = 'order_name';

$title = __('Edit Links');
$this_file = $parent_file = 'link-manager.php';
include_once ("./admin-header.php");

if (!current_user_can('manage_links'))
	wp_die(__("You do not have sufficient permissions to edit the links for this blog."));

switch ($order_by) {
	case 'order_id' :
		$sqlorderby = 'id';
		break;
	case 'order_url' :
		$sqlorderby = 'url';
		break;
	case 'order_desc' :
		$sqlorderby = 'description';
		break;
	case 'order_owner' :
		$sqlorderby = 'owner';
		break;
	case 'order_rating' :
		$sqlorderby = 'rating';
		break;
	case 'order_name' :
	default :
		$sqlorderby = 'name';
		break;
} ?>

