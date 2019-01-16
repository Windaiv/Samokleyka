<?php
/**
 * Outputs the OPML XML format for getting the links defined in the link
 * administration. This can be used to export links from one blog over to
 * another. Links aren't exported by the WordPress export, so this file handles
 * that.
 *
 * This file is not added by default to WordPress theme pages when outputting
 * feed links. It will have to be added manually for browsers and users to pick
 * up that this file exists.
 *
 * @package WordPress
 */

if (empty($wp)) {
	require_once('./wp-load.php');
	wp();
}

header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);
$link_cat = $_GET['link_cat'];
if ((empty ($link_cat)) || ($link_cat == 'all') || ($link_cat == '0')) {
	$link_cat = '';
} else { // be safe
	$link_cat = '' . urldecode($link_cat) . '';
	$link_cat = intval($link_cat);
}
?>

