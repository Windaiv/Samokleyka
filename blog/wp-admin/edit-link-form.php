<?php
/**
 * Edit links form for inclusion in administration panels.
 *
 * @package WordPress
 * @subpackage Administration
 */

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( ! empty($link_id) ) {
	$heading = sprintf( __( '<a href="%s">Links</a> / Edit Link' ), 'link-manager.php' );
	$submit_text = __('Update Link');
	$form = '<form name="editlink" id="editlink" method="post" action="link.php">';
	$nonce_action = 'update-bookmark_' . $link_id;
} else {
	$heading = sprintf( __( '<a href="%s">Links</a> / Add New Link' ), 'link-manager.php' );
	$submit_text = __('Add Link');
	$form = '<form name="addlink" id="addlink" method="post" action="link.php">';
	$nonce_action = 'add-bookmark';
}

require_once('includes/meta-boxes.php');

add_meta_box('linksubmitdiv', __('Save'), 'link_submit_meta_box', 'link', 'side', 'core');
add_meta_box('linkcategorydiv', __('Categories'), 'link_categories_meta_box', 'link', 'normal', 'core');
add_meta_box('linktargetdiv', __('Target'), 'link_target_meta_box', 'link', 'normal', 'core');
add_meta_box('linkxfndiv', __('Link Relationship (XFN)'), 'link_xfn_meta_box', 'link', 'normal', 'core');
add_meta_box('linkadvanceddiv', __('Advanced'), 'link_advanced_meta_box', 'link', 'normal', 'core');

do_action('do_meta_boxes', 'link', 'normal', $link);
do_action('do_meta_boxes', 'link', 'advanced', $link);
do_action('do_meta_boxes', 'link', 'side', $link);

require_once ('admin-header.php');

?>

