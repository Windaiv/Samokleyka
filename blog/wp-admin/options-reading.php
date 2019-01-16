<?php
/**
 * Reading settings administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

if ( ! current_user_can('manage_options') )
	wp_die(__('You do not have sufficient permissions to manage options for this blog.'));

$title = __('Reading Settings');
$parent_file = 'options-general.php';

include('admin-header.php');
?>

