<?php
/**
 * Used to setup and fix common variables and include
 * the WordPress procedural and class library.
 *
 * You should not have to change this file and allows
 * for some configuration in wp-config.php.
 *
 * @package WordPress
 */

if ( !defined('WP_MEMORY_LIMIT') )
	define('WP_MEMORY_LIMIT', '32M');

if ( function_exists('memory_get_usage') && ( (int) @ini_get('memory_limit') < abs(intval(WP_MEMORY_LIMIT)) ) )
	@ini_set('memory_limit', WP_MEMORY_LIMIT);

set_magic_quotes_runtime(0);
@ini_set('magic_quotes_sybase', 0);

if ( function_exists('date_default_timezone_set') )
	date_default_timezone_set('UTC');

/**
 * Turn register globals off.
 *
 * @access private
 * @since 2.1.0
 * @return null Will return null if register_globals PHP directive was disabled
 */
function wp_unregister_GLOBALS() {
	if ( !ini_get('register_globals') )
		return;

	if ( isset($_REQUEST['GLOBALS']) )
		die('GLOBALS overwrite attempt detected');

	// Variables that shouldn't be unset
	$noUnset = array('GLOBALS', '_GET', '_POST', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES', 'table_prefix');

	$input = array_merge($_GET, $_POST, $_COOKIE, $_SERVER, $_ENV, $_FILES, isset($_SESSION) && is_array($_SESSION) ? $_SESSION : array());
	foreach ( $input as $k => $v )
		if ( !in_array($k, $noUnset) && isset($GLOBALS[$k]) ) {
			$GLOBALS[$k] = NULL;
			unset($GLOBALS[$k]);
		}
}

wp_unregister_GLOBALS();

unset( $wp_filter, $cache_lastcommentmodified, $cache_lastpostdate );

/**
 * The $blog_id global, which you can change in the config allows you to create a simple
 * multiple blog installation using just one WordPress and changing $blog_id around.
 *
 * @global int $blog_id
 * @since 2.0.0
 */
if ( ! isset($blog_id) )
	$blog_id = 1;

// Fix for IIS when running with PHP ISAPI
if ( empty( $_SERVER['REQUEST_URI'] ) || ( php_sapi_name() != 'cgi-fcgi' && preg_match( '/^Microsoft-IIS\//', $_SERVER['SERVER_SOFTWARE'] ) ) ) {

	// IIS Mod-Rewrite
	if (isset($_SERVER['HTTP_X_ORIGINAL_URL'])) {
		$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
	}
	// IIS Isapi_Rewrite
	else if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
		$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
	}
	else
	{
		// Use ORIG_PATH_INFO if there is no PATH_INFO
		if ( !isset($_SERVER['PATH_INFO']) && isset($_SERVER['ORIG_PATH_INFO']) )
			$_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];

		// Some IIS + PHP configurations puts the script-name in the path-info (No need to append it twice)
		if ( isset($_SERVER['PATH_INFO']) ) {
			if ( $_SERVER['PATH_INFO'] == $_SERVER['SCRIPT_NAME'] )
				$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];
			else
				$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];
		}

		// Append the query string if it exists and isn't null
		if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
			$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
		}
	}
}

// Fix for PHP as CGI hosts that set SCRIPT_FILENAME to something ending in php.cgi for all requests
if ( isset($_SERVER['SCRIPT_FILENAME']) && ( strpos($_SERVER['SCRIPT_FILENAME'], 'php.cgi') == strlen($_SERVER['SCRIPT_FILENAME']) - 7 ) )
	$_SERVER['SCRIPT_FILENAME'] = $_SERVER['PATH_TRANSLATED'];

// Fix for Dreamhost and other PHP as CGI hosts
if (strpos($_SERVER['SCRIPT_NAME'], 'php.cgi') !== false)
	unset($_SERVER['PATH_INFO']);

// Fix empty PHP_SELF
$PHP_SELF = $_SERVER['PHP_SELF'];
if ( empty($PHP_SELF) )
	$_SERVER['PHP_SELF'] = $PHP_SELF = preg_replace("/(\?.*)?$/",'',$_SERVER["REQUEST_URI"]);

if ( version_compare( '4.3', phpversion(), '>' ) ) {
	die( sprintf( /*WP_I18N_OLD_PHP*/'Your server is running PHP version %s but WordPress requires at least 4.3.'/*/WP_I18N_OLD_PHP*/, phpversion() ) );
}

if ( !defined('WP_CONTENT_DIR') )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' ); // no trailing slash, full paths only - WP_CONTENT_URL is defined further down

if ( file_exists(ABSPATH . '.maintenance') && !defined('WP_INSTALLING') ) {
	include(ABSPATH . '.maintenance');
	// If the $upgrading timestamp is older than 10 minutes, don't die.
	if ( ( time() - $upgrading ) < 600 ) {
		if ( file_exists( WP_CONTENT_DIR . '/maintenance.php' ) ) {
			require_once( WP_CONTENT_DIR . '/maintenance.php' );
			die();
		}

		$protocol = $_SERVER["SERVER_PROTOCOL"];
		if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
			$protocol = 'HTTP/1.0';
		header( "$protocol 503 Service Unavailable", true, 503 );
		header( 'Content-Type: text/html; charset=utf-8' );
		header( 'Retry-After: 600' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Maintenance</title>

</head>
<body>
	<h1>Briefly unavailable for scheduled maintenance. Check back in a minute.</h1>
</body>
</html>

