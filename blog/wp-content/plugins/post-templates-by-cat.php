<?php
/*
Plugin Name:  Post Templates by Category
Plugin URI: http://guff.szub.net/post-templates-by-category/
Description: Use custom single post templates for specified categories.
Author: Kaf Oseo
Version: R1.3
Author URI: http://szub.net

	Copyright (c) 2005, 2006 Kaf Oseo (http://szub.net)
	Post Templates by Category is released under the GNU General
	Public License (GPL) http://www.gnu.org/licenses/gpl.txt

	This is a WordPress plugin (http://wordpress.org).

	Inspired by Ryan Boren's Custom Post Templates plugin:
	http://boren.nu/archives/2005/03/13/custom-post-templates-plugin/

SETTINGS INSTRUCTIONS
Change the value for SZUB_TEMPLATENAME_PREFIX constant to reflect the
filename used for your template(s). Example:

define('SZUB_TEMPLATENAME_PREFIX', 'single-cat-115');

If changed to 'category' the plugin will use the same template for a
category (i.e. category-10.php). The default is 'single-cat' -- name
templates accordingly (ex: single-cat-5.php if posts are in category
#5).

~Changelog:
R1.3 (Oct-24-2005)
Added functionality for templating attachments, so the same template
is used on attachments to a post. To disable this feature, remove or
comment out this line at the end of the plugin:

add_filter('attachment_template', 'szub_post_attachment_template');

R1.2 (Feb-26-2005)
Verifies that my Category Template Inheritor plugin is active, and if
it is it attempts to find a {$template_name}-{category parent ID}.php
template (template for the parent category of the post's category).

R1.1 (Aug-21-2005)
Returns single.php (if exists) as post template when no "single-cat"
template is found. To avoid a conflict with Ryan Boren's Custom Post
Templates plugin, it passes off to it (if active) when a single post
template is discovered.
*/

/* >> Begin user-configurable variable >> */
define('SZUB_TEMPLATENAME_PREFIX', 'single-cat'); // change value ('single-cat') to reflect template filenames
/* << End user-configurable variable << */

function szub_post_template_by_cat($template) {
	if( is_single() ) {
		global $wp_query, $wp_object_cache;
		$cats = get_the_category($wp_query->post->ID);

		if( function_exists(cpt_custom_post_template ) && file_exists(TEMPLATEPATH . '/single-' . $wp_query->post->ID . '.php') )
			return cpt_custom_post_template('');

		foreach( $cats as $cat ) {
			if( file_exists(TEMPLATEPATH . '/' . SZUB_TEMPLATENAME_PREFIX . '-' . $cat->cat_ID . '.php') ) {
				return TEMPLATEPATH . '/' . SZUB_TEMPLATENAME_PREFIX . '-' . $cat->cat_ID . '.php';
			}
		    if( function_exists(szub_cat_template_inherit) ) {
				$cat_parent = $wp_object_cache->cache['category'][$cat->cat_ID]->category_parent;
				if( file_exists(TEMPLATEPATH . '/' . SZUB_TEMPLATENAME_PREFIX . '-' . $cat_parent . '.php') ) {
 					return TEMPLATEPATH . '/' . SZUB_TEMPLATENAME_PREFIX . '-' . $cat_parent . '.php';
				}
			}
		}
	}

	return $template;
}

function szub_post_attachment_template($template) {
	if( is_attachment() ) {
		global $wp_query, $wpdb;
		$parent = $wp_query->post->post_parent;
		$cats = $wpdb->get_results("SELECT category_id FROM $wpdb->post2cat WHERE post_id = $parent");

		foreach( $cats as $cat ) {
			if(file_exists(TEMPLATEPATH . '/' . SZUB_TEMPLATENAME_PREFIX . '-' . $cat->category_id . '.php')) {
				return TEMPLATEPATH . '/' . SZUB_TEMPLATENAME_PREFIX . '-' . $cat->category_id . '.php';
			}
		}
	}

	return $template;
}

add_filter('single_template', 'szub_post_template_by_cat');
add_filter('attachment_template', 'szub_post_attachment_template');
?>