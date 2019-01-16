<?php
/**
 * Categories Management Panel
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once('admin.php');

$title = __('Categories');

wp_reset_vars( array('action', 'cat') );

if ( isset( $_GET['action'] ) && isset($_GET['delete']) && ( 'delete' == $_GET['action'] || 'delete' == $_GET['action2'] ) )
	$action = 'bulk-delete';

switch($action) {

case 'addcat':

	check_admin_referer('add-category');

	if ( !current_user_can('manage_categories') )
		wp_die(__('Cheatin&#8217; uh?'));

	if ( wp_insert_category($_POST ) )
		wp_safe_redirect( add_query_arg( 'message', 1, wp_get_referer() ) . '#addcat' );
	else
		wp_safe_redirect( add_query_arg( 'message', 4, wp_get_referer() ) . '#addcat' );

	exit;
break;

case 'delete':
	if ( !isset( $_GET['cat_ID'] ) ) {
		wp_redirect('categories.php');
		exit;
	}

	$cat_ID = (int) $_GET['cat_ID'];
	check_admin_referer('delete-category_' .  $cat_ID);

	if ( !current_user_can('manage_categories') )
		wp_die(__('Cheatin&#8217; uh?'));

	// Don't delete the default cats.
	if ( $cat_ID == get_option('default_category') )
		wp_die( sprintf( __("Can&#8217;t delete the <strong>%s</strong> category: this is the default one"), get_cat_name($cat_ID) ) );

	wp_delete_category($cat_ID);

	wp_safe_redirect( add_query_arg( 'message', 2, wp_get_referer() ) );
	exit;

break;

case 'bulk-delete':
	check_admin_referer('bulk-categories');

	if ( !current_user_can('manage_categories') )
		wp_die( __('You are not allowed to delete categories.') );

	$cats = (array) $_GET['delete'];
	$default_cat = get_option('default_category');
	foreach ( $cats as $cat_ID ) {
		$cat_ID = (int) $cat_ID;

		// Don't delete the default cat.
		if ( $cat_ID == $default_cat )
			wp_die( sprintf( __("Can&#8217;t delete the <strong>%s</strong> category: this is the default one"), get_cat_name($cat_ID) ) );

		wp_delete_category($cat_ID);
	}

	wp_safe_redirect( wp_get_referer() );
	exit;

break;
case 'edit':

	$title = __('Edit Category');

	require_once ('admin-header.php');
	$cat_ID = (int) $_GET['cat_ID'];
	$category = get_category_to_edit($cat_ID);
	include('edit-category-form.php');

break;

case 'editedcat':
	$cat_ID = (int) $_POST['cat_ID'];
	check_admin_referer('update-category_' . $cat_ID);

	if ( !current_user_can('manage_categories') )
		wp_die(__('Cheatin&#8217; uh?'));

	$location = 'categories.php';
	if ( $referer = wp_get_original_referer() ) {
		if ( false !== strpos($referer, 'categories.php') )
			$location = $referer;
	}

	if ( wp_update_category($_POST) )
		$location = add_query_arg('message', 3, $location);
	else
		$location = add_query_arg('message', 5, $location);

	wp_redirect($location);

	exit;
break;

default:

if ( isset($_GET['_wp_http_referer']) && ! empty($_GET['_wp_http_referer']) ) {
	 wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	 exit;
}

wp_enqueue_script('admin-categories');
if ( current_user_can('manage_categories') )
	wp_enqueue_script('inline-edit-tax');

require_once ('admin-header.php');

$messages[1] = __('Category added.');
$messages[2] = __('Category deleted.');
$messages[3] = __('Category updated.');
$messages[4] = __('Category not added.');
$messages[5] = __('Category not updated.');
?>

