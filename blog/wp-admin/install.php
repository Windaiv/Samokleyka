<?php
/**
 * WordPress Installer
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * We are installing WordPress.
 *
 * @since unknown
 * @var bool
 */
define('WP_INSTALLING', true);

/** Load WordPress Bootstrap */
require_once(dirname(dirname(__FILE__)) . '/wp-load.php');

/** Load WordPress Administration Upgrade API */
require_once(dirname(__FILE__) . '/includes/upgrade.php');

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;

/**
 * Display install header.
 *
 * @since unknown
 * @package WordPress
 * @subpackage Installer
 */
function display_header() {
header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php _e('WordPress &rsaquo; Installation'); ?></title>
	<?php wp_admin_css( 'install', true ); ?>
</head>
<body>
<h1 id="logo"><img alt="WordPress" src="images/wordpress-logo.png" /></h1>

<?php
}//end function display_header();

function display_setup_form( $error = null ) {
	// Ensure that Blogs appear in search engines by default
	$blog_public = 1;
	if ( isset($_POST) && !empty($_POST) ) {
		$blog_public = isset($_POST['blog_public']);
	}

	if ( ! is_null( $error ) ) {
?>
<p><?php printf( __('<strong>ERROR</strong>: %s'), $error); ?></p>
<?php } ?>
<form id="setup" method="post" action="install.php?step=2">
	<table class="form-table">
		<tr>
			<th scope="row"><label for="weblog_title"><?php _e('Blog Title'); ?></label></th>
			<td><input name="weblog_title" type="text" id="weblog_title" size="25" value="<?php echo ( isset($_POST['weblog_title']) ? esc_attr($_POST['weblog_title']) : '' ); ?>" /></td>
		</tr>
		<tr>
			<th scope="row"><label for="admin_email"><?php _e('Your E-mail'); ?></label></th>
			<td><input name="admin_email" type="text" id="admin_email" size="25" value="<?php echo ( isset($_POST['admin_email']) ? esc_attr($_POST['admin_email']) : '' ); ?>" /><br />
			<?php _e('Double-check your email address before continuing.'); ?></td>
		</tr>
		<tr>
			<td colspan="2"><label><input type="checkbox" name="blog_public" value="1" <?php checked($blog_public); ?> /> <?php _e('Allow my blog to appear in search engines like Google and Technorati.'); ?></label></td>
		</tr>
	</table>
	<p class="step"><input type="submit" name="Submit" value="<?php esc_attr_e('Install WordPress'); ?>" class="button" /></p>
</form>
<?php
}

// Let's check to make sure WP isn't already installed.
if ( is_blog_installed() ) {display_header(); die('<h1>'.__('Already Installed').'</h1><p>'.__('You appear to have already installed WordPress. To reinstall please clear your old database tables first.').'</p></body></html>

