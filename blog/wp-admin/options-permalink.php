<?php
/**
 * Permalink settings administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

if ( ! current_user_can('manage_options') )
	wp_die(__('You do not have sufficient permissions to manage options for this blog.'));

$title = __('Permalink Settings');
$parent_file = 'options-general.php';

/**
 * Display JavaScript on the page.
 *
 * @package WordPress
 * @subpackage Permalink_Settings_Panel
 */
function add_js() {
?>

