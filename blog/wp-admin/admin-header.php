<?php
/**
 * WordPress Administration Template Header
 *
 * @package WordPress
 * @subpackage Administration
 */

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
if (!isset($_GET["page"])) require_once('admin.php');

get_admin_page_title();
$title = esc_html( strip_tags( $title ) );
wp_user_settings();
wp_menu_unfold();
?>

