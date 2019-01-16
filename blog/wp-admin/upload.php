<?php
/**
 * Media Library administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');
wp_enqueue_script( 'wp-ajax-response' );
wp_enqueue_script( 'jquery-ui-draggable' );

if ( !current_user_can('upload_files') )
	wp_die(__('You do not have permission to upload files.'));

if ( isset($_GET['find_detached']) ) {
	check_admin_referer('bulk-media');

	if ( !current_user_can('edit_posts') )
		wp_die( __('You are not allowed to scan for lost attachments.') );

	$all_posts = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'post' OR post_type = 'page'");
	$all_att = $wpdb->get_results("SELECT ID, post_parent FROM $wpdb->posts WHERE post_type = 'attachment'");

	$lost = array();
	foreach ( (array) $all_att as $att ) {
		if ( $att->post_parent > 0 && ! in_array($att->post_parent, $all_posts) )
			$lost[] = $att->ID;
	}
	$_GET['detached'] = 1;

} elseif ( isset($_GET['found_post_id']) && isset($_GET['media']) ) {
	check_admin_referer('bulk-media');

	if ( ! ( $parent_id = (int) $_GET['found_post_id'] ) )
		return;

	$parent = &get_post($parent_id);
	if ( !current_user_can('edit_post', $parent_id) )
		wp_die( __('You are not allowed to edit this post.') );

	$attach = array();
	foreach( (array) $_GET['media'] as $att_id ) {
		$att_id = (int) $att_id;

		if ( !current_user_can('edit_post', $att_id) )
			continue;

		$attach[] = $att_id;
	}

	if ( ! empty($attach) ) {
		$attach = implode(',', $attach);
		$attached = $wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET post_parent = %d WHERE post_type = 'attachment' AND ID IN ($attach)", $parent_id) );
	}

	if ( isset($attached) ) {
		$location = 'upload.php';
		if ( $referer = wp_get_referer() ) {
			if ( false !== strpos($referer, 'upload.php') )
				$location = $referer;
		}

		$location = add_query_arg( array( 'attached' => $attached ) , $location );
		wp_redirect($location);
		exit;
	}

} elseif ( isset($_GET['doaction']) || isset($_GET['doaction2']) || isset($_GET['delete_all']) || isset($_GET['delete_all2']) ) {
	check_admin_referer('bulk-media');

	if ( isset($_GET['delete_all']) || isset($_GET['delete_all2']) ) {
		$post_ids = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND post_status = 'trash'" );
		$doaction = 'delete';
	} elseif ( ( $_GET['action'] != -1 || $_GET['action2'] != -1 ) && ( isset($_GET['media']) || isset($_GET['ids']) ) ) {
		$post_ids = isset($_GET['media']) ? $_GET['media'] : explode(',', $_GET['ids']);
		$doaction = ($_GET['action'] != -1) ? $_GET['action'] : $_GET['action2'];
	} else {
		wp_redirect($_SERVER['HTTP_REFERER']);
	}

	$location = 'upload.php';
	if ( $referer = wp_get_referer() ) {
		if ( false !== strpos($referer, 'upload.php') )
			$location = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'message', 'ids', 'posted'), $referer );
	}

	switch ( $doaction ) {
		case 'trash':
			foreach( (array) $post_ids as $post_id ) {
				if ( !current_user_can('delete_post', $post_id) )
					wp_die( __('You are not allowed to move this post to the trash.') );

				if ( !wp_trash_post($post_id) )
					wp_die( __('Error in moving to trash...') );
			}
			$location = add_query_arg( array( 'message' => 4, 'ids' => join(',', $post_ids) ), $location );
			break;
		case 'untrash':
			foreach( (array) $post_ids as $post_id ) {
				if ( !current_user_can('delete_post', $post_id) )
					wp_die( __('You are not allowed to move this post out of the trash.') );

				if ( !wp_untrash_post($post_id) )
					wp_die( __('Error in restoring from trash...') );
			}
			$location = add_query_arg('message', 5, $location);
			break;
		case 'delete':
			foreach( (array) $post_ids as $post_id_del ) {
				if ( !current_user_can('delete_post', $post_id_del) )
					wp_die( __('You are not allowed to delete this post.') );

				if ( !wp_delete_attachment($post_id_del) )
					wp_die( __('Error in deleting...') );
			}
			$location = add_query_arg('message', 2, $location);
			break;
	}

	wp_redirect($location);
	exit;
} elseif ( isset($_GET['_wp_http_referer']) && ! empty($_GET['_wp_http_referer']) ) {
	 wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	 exit;
}

$title = __('Media Library');
$parent_file = 'upload.php';

if ( ! isset( $_GET['paged'] ) || $_GET['paged'] < 1 )
	$_GET['paged'] = 1;

if ( isset($_GET['detached']) ) {

	$media_per_page = (int) get_user_option( 'upload_per_page', 0, false );
	if ( empty($media_per_page) || $media_per_page < 1 )
		$media_per_page = 20;
	$media_per_page = apply_filters( 'upload_per_page', $media_per_page );

	if ( !empty($lost) ) {
		$start = ( (int) $_GET['paged'] - 1 ) * $media_per_page;
		$page_links_total = ceil(count($lost) / $media_per_page);
		$lost = implode(',', $lost);

		$orphans = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_type = 'attachment' AND ID IN (%s) LIMIT %d, %d", $lost, $start, $media_per_page ) );
	} else {
		$start = ( (int) $_GET['paged'] - 1 ) * $media_per_page;
		$orphans = $wpdb->get_results( $wpdb->prepare( "SELECT SQL_CALC_FOUND_ROWS * FROM $wpdb->posts WHERE post_type = 'attachment' AND post_status != 'trash' AND post_parent < 1 LIMIT %d, %d", $start, $media_per_page ) );
		$page_links_total = ceil($wpdb->get_var( "SELECT FOUND_ROWS()" ) / $media_per_page);
	}

	$post_mime_types = get_post_mime_types();
	$avail_post_mime_types = get_available_post_mime_types('attachment');

	if ( isset($_GET['post_mime_type']) && !array_intersect( (array) $_GET['post_mime_type'], array_keys($post_mime_types) ) )
		unset($_GET['post_mime_type']);

} else {
	list($post_mime_types, $avail_post_mime_types) = wp_edit_attachments_query();
}

$is_trash = ( isset($_GET['status']) && $_GET['status'] == 'trash' );

wp_enqueue_script('media');
require_once('admin-header.php');

do_action('restrict_manage_posts');
?>

