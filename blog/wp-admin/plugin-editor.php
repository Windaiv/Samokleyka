<?php
/**
 * Edit plugin editor administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once('admin.php');

if ( !current_user_can('edit_plugins') )
	wp_die('<p>'.__('You do not have sufficient permissions to edit plugins for this blog.').'</p>');

$title = __("Edit Plugins");
$parent_file = 'plugins.php';

wp_reset_vars(array('action', 'redirect', 'profile', 'error', 'warning', 'a', 'file', 'plugin'));

wp_admin_css( 'theme-editor' );

$plugins = get_plugins();

if ( isset($_REQUEST['file']) )
	$plugin = stripslashes($_REQUEST['file']);

if ( empty($plugin) ) {
	$plugin = array_keys($plugins);
	$plugin = $plugin[0];
}

$plugin_files = get_plugin_files($plugin);

if ( empty($file) )
	$file = $plugin_files[0];
else
	$file = stripslashes($file);

$file = validate_file_to_edit($file, $plugin_files);
$real_file = WP_PLUGIN_DIR . '/' . $file;
$scrollto = isset($_REQUEST['scrollto']) ? (int) $_REQUEST['scrollto'] : 0;

switch ( $action ) {

case 'update':

	check_admin_referer('edit-plugin_' . $file);

	$newcontent = stripslashes($_POST['newcontent']);
	if ( is_writeable($real_file) ) {
		$f = fopen($real_file, 'w+');
		fwrite($f, $newcontent);
		fclose($f);

		// Deactivate so we can test it.
		if ( is_plugin_active($file) || isset($_POST['phperror']) ) {
			if ( is_plugin_active($file) )
				deactivate_plugins($file, true);
			wp_redirect(add_query_arg('_wpnonce', wp_create_nonce('edit-plugin-test_' . $file), "plugin-editor.php?file=$file&liveupdate=1&scrollto=$scrollto"));
			exit;
		}
		wp_redirect("plugin-editor.php?file=$file&a=te&scrollto=$scrollto");
	} else {
		wp_redirect("plugin-editor.php?file=$file&scrollto=$scrollto");
	}
	exit;

break;

default:

	if ( isset($_GET['liveupdate']) ) {
		check_admin_referer('edit-plugin-test_' . $file);

		$error = validate_plugin($file);
		if ( is_wp_error($error) )
			wp_die( $error );

		if ( ! is_plugin_active($file) )
			activate_plugin($file, "plugin-editor.php?file=$file&phperror=1"); // we'll override this later if the plugin can be included without fatal error

		wp_redirect("plugin-editor.php?file=$file&a=te&scrollto=$scrollto");
		exit;
	}

	// List of allowable extensions
	$editable_extensions = array('php', 'txt', 'text', 'js', 'css', 'html', 'htm', 'xml', 'inc', 'include');
	$editable_extensions = (array) apply_filters('editable_extensions', $editable_extensions);

	if ( ! is_file($real_file) ) {
		wp_die(sprintf('<p>%s</p>', __('No such file exists! Double check the name and try again.')));
	} else {
		// Get the extension of the file
		if ( preg_match('/\.([^.]+)$/', $real_file, $matches) ) {
			$ext = strtolower($matches[1]);
			// If extension is not in the acceptable list, skip it
			if ( !in_array( $ext, $editable_extensions) )
				wp_die(sprintf('<p>%s</p>', __('Files of this type are not editable.')));
		}
	}

	require_once('admin-header.php');

	update_recently_edited(WP_PLUGIN_DIR . '/' . $file);

	$content = file_get_contents( $real_file );

	if ( '.php' == substr( $real_file, strrpos( $real_file, '.' ) ) ) {
		$functions = wp_doc_link_parse( $content );

		if ( !empty($functions) ) {
			$docs_select = '<select name="docs-list" id="docs-list">';
			$docs_select .= '<option value="">' . __( 'Function Name...' ) . '</option>';
			foreach ( $functions as $function) {
				$docs_select .= '<option value="' . esc_attr( $function ) . '">' . htmlspecialchars( $function ) . '()</option>';
			}
			$docs_select .= '</select>';
		}
	}

	$content = htmlspecialchars( $content );
	$codepress_lang = codepress_get_lang($real_file);

	?>

