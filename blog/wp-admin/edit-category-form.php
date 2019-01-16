<?php
/**
 * Edit category form for inclusion in administration panels.
 *
 * @package WordPress
 * @subpackage Administration
 */

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( !current_user_can('manage_categories') )
	wp_die(__('You do not have sufficient permissions to edit categories for this blog.'));

/**
 * @var object
 */
if ( ! isset( $category ) )
	$category = (object) array();

/**
 * @ignore
 * @since 2.7
 * @internal Used to prevent errors in page when no category is being edited.
 *
 * @param object $category
 */
function _fill_empty_category(&$category) {
	if ( ! isset( $category->name ) )
		$category->name = '';

	if ( ! isset( $category->slug ) )
		$category->slug = '';

	if ( ! isset( $category->parent ) )
		$category->parent = '';

	if ( ! isset( $category->description ) )
		$category->description = '';
}

do_action('edit_category_form_pre', $category);

_fill_empty_category($category);
?>

