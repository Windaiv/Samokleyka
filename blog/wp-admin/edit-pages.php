<?php
/**
 * Edit Pages Administration Panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

if ( !current_user_can('edit_pages') )
	wp_die(__('Cheatin&#8217; uh?'));

// Handle bulk actions
if ( isset($_GET['doaction']) || isset($_GET['doaction2']) || isset($_GET['delete_all']) || isset($_GET['delete_all2']) || isset($_GET['bulk_edit']) ) {
	check_admin_referer('bulk-pages');
	$sendback = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'ids'), wp_get_referer() );

	if ( strpos($sendback, 'page.php') !== false )
		$sendback = admin_url('page-new.php');

	if ( isset($_GET['delete_all']) || isset($_GET['delete_all2']) ) {
		$post_status = preg_replace('/[^a-z0-9_-]+/i', '', $_GET['post_status']);
		$post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type='page' AND post_status = %s", $post_status ) );
		$doaction = 'delete';
	} elseif ( ( $_GET['action'] != -1 || $_GET['action2'] != -1 ) && ( isset($_GET['post']) || isset($_GET['ids']) ) ) {
		$post_ids = isset($_GET['post']) ? array_map( 'intval', (array) $_GET['post'] ) : explode(',', $_GET['ids']);
		$doaction = ($_GET['action'] != -1) ? $_GET['action'] : $_GET['action2'];
	} else {
		wp_redirect( admin_url('edit-pages.php') );
	}

	switch ( $doaction ) {
		case 'trash':
			$trashed = 0;
			foreach( (array) $post_ids as $post_id ) {
				if ( !current_user_can('delete_page', $post_id) )
					wp_die( __('You are not allowed to move this page to the trash.') );

				if ( !wp_trash_post($post_id) )
					wp_die( __('Error in moving to trash...') );

				$trashed++;
			}
			$sendback = add_query_arg( array('trashed' => $trashed, 'ids' => join(',', $post_ids)), $sendback );
			break;
		case 'untrash':
			$untrashed = 0;
			foreach( (array) $post_ids as $post_id ) {
				if ( !current_user_can('delete_page', $post_id) )
					wp_die( __('You are not allowed to restore this page from the trash.') );

				if ( !wp_untrash_post($post_id) )
					wp_die( __('Error in restoring from trash...') );

				$untrashed++;
			}
			$sendback = add_query_arg('untrashed', $untrashed, $sendback);
			break;
		case 'delete':
			$deleted = 0;
			foreach( (array) $post_ids as $post_id ) {
				$post_del = & get_post($post_id);

				if ( !current_user_can('delete_page', $post_id) )
					wp_die( __('You are not allowed to delete this page.') );

				if ( $post_del->post_type == 'attachment' ) {
					if ( ! wp_delete_attachment($post_id) )
						wp_die( __('Error in deleting...') );
				} else {
					if ( !wp_delete_post($post_id) )
						wp_die( __('Error in deleting...') );
				}
				$deleted++;
			}
			$sendback = add_query_arg('deleted', $deleted, $sendback);
			break;
		case 'edit':
			$_GET['post_type'] = 'page';
			$done = bulk_edit_posts($_GET);

			if ( is_array($done) ) {
				$done['updated'] = count( $done['updated'] );
				$done['skipped'] = count( $done['skipped'] );
				$done['locked'] = count( $done['locked'] );
				$sendback = add_query_arg( $done, $sendback );
			}
			break;
	}

	if ( isset($_GET['action']) )
		$sendback = remove_query_arg( array('action', 'action2', 'post_parent', 'page_template', 'post_author', 'comment_status', 'ping_status', '_status',  'post', 'bulk_edit', 'post_view', 'post_type'), $sendback );

	wp_redirect($sendback);
	exit();
} elseif ( isset($_GET['_wp_http_referer']) && ! empty($_GET['_wp_http_referer']) ) {
	 wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	 exit;
}

if ( empty($title) )
	$title = __('Edit Pages');
$parent_file = 'edit-pages.php';
wp_enqueue_script('inline-edit-post');

$post_stati  = array(	//	array( adj, noun )
		'publish' => array(_x('Published', 'page'), __('Published pages'), _nx_noop('Published <span class="count">(%s)</span>', 'Published <span class="count">(%s)</span>', 'page')),
		'future' => array(_x('Scheduled', 'page'), __('Scheduled pages'), _nx_noop('Scheduled <span class="count">(%s)</span>', 'Scheduled <span class="count">(%s)</span>', 'page')),
		'pending' => array(_x('Pending Review', 'page'), __('Pending pages'), _nx_noop('Pending Review <span class="count">(%s)</span>', 'Pending Review <span class="count">(%s)</span>', 'page')),
		'draft' => array(_x('Draft', 'page'), _x('Drafts', 'manage posts header'), _nx_noop('Draft <span class="count">(%s)</span>', 'Drafts <span class="count">(%s)</span>', 'page')),
		'private' => array(_x('Private', 'page'), __('Private pages'), _nx_noop('Private <span class="count">(%s)</span>', 'Private <span class="count">(%s)</span>', 'page')),
		'trash' => array(_x('Trash', 'page'), __('Trash pages'), _nx_noop('Trash <span class="count">(%s)</span>', 'Trash <span class="count">(%s)</span>', 'page'))
	);

if ( !EMPTY_TRASH_DAYS )
	unset($post_stati['trash']);

$post_stati = apply_filters('page_stati', $post_stati);

$query = array('post_type' => 'page', 'orderby' => 'menu_order title',
	'posts_per_page' => -1, 'posts_per_archive_page' => -1, 'order' => 'asc');

$post_status_label = __('Pages');
if ( isset($_GET['post_status']) && in_array( $_GET['post_status'], array_keys($post_stati) ) ) {
	$post_status_label = $post_stati[$_GET['post_status']][1];
	$query['post_status'] = $_GET['post_status'];
	$query['perm'] = 'readable';
}

$query = apply_filters('manage_pages_query', $query);
wp($query);

if ( is_singular() ) {
	wp_enqueue_script( 'admin-comments' );
	enqueue_comment_hotkeys_js();
}

require_once('admin-header.php'); ?>

