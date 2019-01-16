<?php
/**
 * WordPress Theme Install Administration API
 *
 * @package WordPress
 * @subpackage Administration
 */

$themes_allowedtags = array('a' => array('href' => array(), 'title' => array(), 'target' => array()),
	'abbr' => array('title' => array()), 'acronym' => array('title' => array()),
	'code' => array(), 'pre' => array(), 'em' => array(), 'strong' => array(),
	'div' => array(), 'p' => array(), 'ul' => array(), 'ol' => array(), 'li' => array(),
	'h1' => array(), 'h2' => array(), 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(),
	'img' => array('src' => array(), 'class' => array(), 'alt' => array())
);

$theme_field_defaults = array( 'description' => true, 'sections' => false, 'tested' => true, 'requires' => true,
	'rating' => true, 'downloaded' => true, 'downloadlink' => true, 'last_updated' => true, 'homepage' => true,
	'tags' => true, 'num_ratings' => true
);


/**
 * Retrieve theme installer pages from WordPress Themes API.
 *
 * It is possible for a theme to override the Themes API result with three
 * filters. Assume this is for themes, which can extend on the Theme Info to
 * offer more choices. This is very powerful and must be used with care, when
 * overridding the filters.
 *
 * The first filter, 'themes_api_args', is for the args and gives the action as
 * the second parameter. The hook for 'themes_api_args' must ensure that an
 * object is returned.
 *
 * The second filter, 'themes_api', is the result that would be returned.
 *
 * @since 2.8.0
 *
 * @param string $action
 * @param array|object $args Optional. Arguments to serialize for the Theme Info API.
 * @return mixed
 */
function themes_api($action, $args = null) {

	if ( is_array($args) )
		$args = (object)$args;

	if ( !isset($args->per_page) )
		$args->per_page = 24;

	$args = apply_filters('themes_api_args', $args, $action); //NOTE: Ensure that an object is returned via this filter.
	$res = apply_filters('themes_api', false, $action, $args); //NOTE: Allows a theme to completely override the builtin WordPress.org API.

	if ( ! $res ) {
		$request = wp_remote_post('http://api.wordpress.org/themes/info/1.0/', array( 'body' => array('action' => $action, 'request' => serialize($args))) );
		if ( is_wp_error($request) ) {
			$res = new WP_Error('themes_api_failed', __('An Unexpected HTTP Error occured during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message() );
		} else {
			$res = unserialize($request['body']);
			if ( ! $res )
			$res = new WP_Error('themes_api_failed', __('An unknown error occured'), $request['body']);
		}
	}
	//var_dump(array($args, $res));
	return apply_filters('themes_api_result', $res, $action, $args);
}

/**
 * Retrieve list of WordPress theme features (aka theme tags)
 *
 * @since 2.8.0
 *
 * @return array
 */
function install_themes_feature_list( ) {
	if ( !$cache = get_transient( 'wporg_theme_feature_list' ) )
		set_transient( 'wporg_theme_feature_list', array( ),  10800);

	if ( $cache  )
		return $cache;

	$feature_list = themes_api( 'feature_list', array( ) );
	if ( is_wp_error( $feature_list ) )
		return $features;

	set_transient( 'wporg_theme_feature_list', $feature_list, 10800 );

	return $feature_list;
}

add_action('install_themes_search', 'install_theme_search', 10, 1);
/**
 * Display theme search results
 *
 * @since 2.8.0
 *
 * @param string $page
 */
function install_theme_search($page) {
	global $theme_field_defaults;

	$type = isset($_REQUEST['type']) ? stripslashes( $_REQUEST['type'] ) : '';
	$term = isset($_REQUEST['s']) ? stripslashes( $_REQUEST['s'] ) : '';

	$args = array();

	switch( $type ){
		case 'tag':
			$terms = explode(',', $term);
			$terms = array_map('trim', $terms);
			$terms = array_map('sanitize_title_with_dashes', $terms);
			$args['tag'] = $terms;
			break;
		case 'term':
			$args['search'] = $term;
			break;
		case 'author':
			$args['author'] = $term;
			break;
	}

	$args['page'] = $page;
	$args['fields'] = $theme_field_defaults;

	if ( !empty( $_POST['features'] ) ) {
		$terms = $_POST['features'];
		$terms = array_map( 'trim', $terms );
		$terms = array_map( 'sanitize_title_with_dashes', $terms );
		$args['tag'] = $terms;
		$_REQUEST['s'] = implode( ',', $terms );
		$_REQUEST['type'] = 'tag';
	}

	$api = themes_api('query_themes', $args);

	if ( is_wp_error($api) )
		wp_die($api);

	add_action('install_themes_table_header', 'install_theme_search_form');

	display_themes($api->themes, $api->info['page'], $api->info['pages']);
}

/**
 * Display search form for searching themes.
 *
 * @since 2.8.0
 */
function install_theme_search_form() {
	$type = isset( $_REQUEST['type'] ) ? stripslashes( $_REQUEST['type'] ) : '';
	$term = isset( $_REQUEST['s'] ) ? stripslashes( $_REQUEST['s'] ) : '';
	?>

