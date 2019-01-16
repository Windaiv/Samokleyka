<?php
/**
 * WordPress Categories to Tags Converter.
 *
 * @package WordPress
 * @subpackage Importer
 */

/**
 * WordPress categories to tags converter class.
 *
 * Will convert WordPress categories to tags, removing the category after the
 * process is complete and updating all posts to switch to the tag.
 *
 * @since unknown
 */
class WP_Categories_to_Tags {
	var $categories_to_convert = array();
	var $all_categories = array();
	var $tags_to_convert = array();
	var $all_tags = array();
	var $hybrids_ids = array();

	function header() {
		echo '<div class="wrap">';
		if ( ! current_user_can('manage_categories') ) {
			echo '<div class="narrow">';
			echo '<p>' . __('Cheatin&#8217; uh?') . '</p>';
			echo '</div>';
		} else { ?>

