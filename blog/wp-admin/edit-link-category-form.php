<?php
/**
 * Edit link category form for inclusion in administration panels.
 *
 * @package WordPress
 * @subpackage Administration
 */

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( !current_user_can('manage_categories') )
	wp_die(__('You do not have sufficient permissions to edit link categories for this blog.'));

/**
 * @var object
 */
if ( ! isset( $category ) )
	$category = (object) array();

if ( ! empty($cat_ID) ) {
	/**
	 * @var string
	 */
	$heading = '<h2>' . __('Edit Link Category') . '</h2>';
	$submit_text = __('Update Category');
	$form = '<form name="editcat" id="editcat" method="post" action="link-category.php" class="validate">';
	$action = 'editedcat';
	$nonce_action = 'update-link-category_' . $cat_ID;
	do_action('edit_link_category_form_pre', $category);
} else {
	$heading = '<h2>' . __('Add Link Category') . '</h2>';
	$submit_text = __('Add Category');
	$form = '<form name="addcat" id="addcat" class="add:the-list: validate" method="post" action="link-category.php">';
	$action = 'addcat';
	$nonce_action = 'add-link-category';
	do_action('add_link_category_form_pre', $category);
}

/**
 * @ignore
 * @since 2.7
 * @internal Used to prevent errors in page when no category is being edited.
 *
 * @param object $category
 */
function _fill_empty_link_category(&$category) {
	if ( ! isset( $category->name ) )
		$category->name = '';

	if ( ! isset( $category->slug ) )
		$category->slug = '';

	if ( ! isset( $category->description ) )
		$category->description = '';
}

_fill_empty_link_category($category);
?>

