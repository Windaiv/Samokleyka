<?php
/**
 * Edit Link Categories Administration Panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

// Handle bulk actions
if ( isset($_GET['action']) && isset($_GET['delete']) ) {
	check_admin_referer('bulk-link-categories');
	$doaction = $_GET['action'] ? $_GET['action'] : $_GET['action2'];

	if ( !current_user_can('manage_categories') )
		wp_die(__('Cheatin&#8217; uh?'));

	if ( 'delete' == $doaction ) {
		$cats = (array) $_GET['delete'];
		$default_cat_id = get_option('default_link_category');

		foreach( $cats as $cat_ID ) {
			$cat_ID = (int) $cat_ID;
			// Don't delete the default cats.
			if ( $cat_ID == $default_cat_id )
				wp_die( sprintf( __("Can&#8217;t delete the <strong>%s</strong> category: this is the default one"), get_term_field('name', $cat_ID, 'link_category') ) );

			wp_delete_term($cat_ID, 'link_category', array('default' => $default_cat_id));
		}

		$location = 'edit-link-categories.php';
		if ( $referer = wp_get_referer() ) {
			if ( false !== strpos($referer, 'edit-link-categories.php') )
				$location = $referer;
		}

		$location = add_query_arg('message', 6, $location);
		wp_redirect($location);
		exit();
	}
} elseif ( isset($_GET['_wp_http_referer']) && ! empty($_GET['_wp_http_referer']) ) {
	 wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	 exit;
}

$title = __('Link Categories');

wp_enqueue_script('admin-categories');
if ( current_user_can('manage_categories') )
	wp_enqueue_script('inline-edit-tax');

require_once ('admin-header.php');

$messages[1] = __('Category added.');
$messages[2] = __('Category deleted.');
$messages[3] = __('Category updated.');
$messages[4] = __('Category not added.');
$messages[5] = __('Category not updated.');
$messages[6] = __('Categories deleted.'); ?>

