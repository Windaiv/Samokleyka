<?php
/**
 * WordPress Plugin Install Administration API
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * Retrieve plugin installer pages from WordPress Plugins API.
 *
 * It is possible for a plugin to override the Plugin API result with three
 * filters. Assume this is for plugins, which can extend on the Plugin Info to
 * offer more choices. This is very powerful and must be used with care, when
 * overridding the filters.
 *
 * The first filter, 'plugins_api_args', is for the args and gives the action as
 * the second parameter. The hook for 'plugins_api_args' must ensure that an
 * object is returned.
 *
 * The second filter, 'plugins_api', is the result that would be returned.
 *
 * @since 2.7.0
 *
 * @param string $action
 * @param array|object $args Optional. Arguments to serialize for the Plugin Info API.
 * @return mixed
 */
function plugins_api($action, $args = null) {

	if( is_array($args) )
		$args = (object)$args;

	if ( !isset($args->per_page) )
		$args->per_page = 24;

	$args = apply_filters('plugins_api_args', $args, $action); //NOTE: Ensure that an object is returned via this filter.
	$res = apply_filters('plugins_api', false, $action, $args); //NOTE: Allows a plugin to completely override the builtin WordPress.org API.

	if ( ! $res ) {
		$request = wp_remote_post('http://api.wordpress.org/plugins/info/1.0/', array( 'body' => array('action' => $action, 'request' => serialize($args))) );
		if ( is_wp_error($request) ) {
			$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message() );
		} else {
			$res = unserialize($request['body']);
			if ( ! $res )
				$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
		}
	} elseif ( !is_wp_error($res) ) {
		$res->external = true;
	}

	return apply_filters('plugins_api_result', $res, $action, $args);
}

/**
 * Retrieve popular WordPress plugin tags.
 *
 * @since 2.7.0
 *
 * @param array $args
 * @return array
 */
function install_popular_tags( $args = array() ) {
	if ( ! ($cache = wp_cache_get('popular_tags', 'api')) && ! ($cache = get_option('wporg_popular_tags')) )
		add_option('wporg_popular_tags', array(), '', 'no'); ///No autoload.

	if ( $cache && $cache->timeout + 3 * 60 * 60 > time() )
		return $cache->cached;

	$tags = plugins_api('hot_tags', $args);

	if ( is_wp_error($tags) )
		return $tags;

	$cache = (object) array('timeout' => time(), 'cached' => $tags);

	update_option('wporg_popular_tags', $cache);
	wp_cache_set('popular_tags', $cache, 'api');

	return $tags;
}
add_action('install_plugins_search', 'install_search', 10, 1);

/**
 * Display search results and display as tag cloud.
 *
 * @since 2.7.0
 *
 * @param string $page
 */
function install_search($page) {
	$type = isset($_REQUEST['type']) ? stripslashes( $_REQUEST['type'] ) : '';
	$term = isset($_REQUEST['s']) ? stripslashes( $_REQUEST['s'] ) : '';

	$args = array();

	switch( $type ){
		case 'tag':
			$args['tag'] = sanitize_title_with_dashes($term);
			break;
		case 'term':
			$args['search'] = $term;
			break;
		case 'author':
			$args['author'] = $term;
			break;
	}

	$args['page'] = $page;

	$api = plugins_api('query_plugins', $args);

	if ( is_wp_error($api) )
		wp_die($api);

	add_action('install_plugins_table_header', 'install_search_form');

	display_plugins_table($api->plugins, $api->info['page'], $api->info['pages']);

	return;
}

add_action('install_plugins_dashboard', 'install_dashboard');
function install_dashboard() {
	?>

