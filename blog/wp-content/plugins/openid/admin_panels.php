<?php
/**
 * All the code required for handling OpenID administration.  These functions should not be considered public, 
 * and may change without notice.
 */


// -- WordPress Hooks
add_action( 'admin_init', 'openid_admin_register_settings' );
add_action( 'admin_menu', 'openid_admin_panels' );
add_action( 'personal_options_update', 'openid_personal_options_update' );
add_action( 'openid_finish_auth', 'openid_finish_verify', 10, 2 );
add_filter( 'pre_update_option_openid_cap', 'openid_set_cap', 10, 2);


/**
 * Setup admin menus for OpenID options and ID management.
 *
 * @action: admin_menu
 **/
function openid_admin_panels() {
	add_filter('plugin_action_links', 'openid_plugin_action_links', 10, 2);

	// global options page
	$hookname = add_options_page(__('OpenID options', 'openid'), __('OpenID', 'openid'), 8, 'openid', 'openid_options_page' );
	add_action("load-$hookname", create_function('', 'add_thickbox();'));
	add_action("load-$hookname", 'openid_style');
	
	// all users can setup external OpenIDs
	$hookname =	add_users_page(__('Your OpenIDs', 'openid'), __('Your OpenIDs', 'openid'), 'read', 'your_openids', 'openid_profile_panel' );
	add_action("load-$hookname", create_function('', 'wp_enqueue_script("admin-forms");'));
	add_action("load-$hookname", 'openid_profile_management' );
	add_action("load-$hookname", 'openid_style' );

	// additional options for users authorized to use OpenID provider
	$user = wp_get_current_user();
	if ($user->has_cap('use_openid_provider')) {
		add_action('show_user_profile', 'openid_extend_profile', 5);
		add_action('profile_update', 'openid_profile_update');
		add_action('user_profile_update_errors', 'openid_profile_update_errors', 10, 3);
		add_action('load-profile.php', 'openid_style');

		if (!get_usermeta($user->ID, 'openid_delegate')) {
			$hookname =	add_submenu_page('profile.php', __('Your Trusted Sites', 'openid'), 
				__('Your Trusted Sites', 'openid'), 'read', 'openid_trusted_sites', 'openid_manage_trusted_sites' );
			add_action("load-$hookname", 'openid_style' );
			add_action("load-$hookname", create_function('', 'wp_enqueue_script("admin-forms");'));
		}
	}

	if ( function_exists('is_site_admin') ) {
		// add OpenID options to WPMU Site Admin page
		add_action('wpmu_options', 'openid_wpmu_options');
		add_action('update_wpmu_options', 'openid_update_wpmu_options');
	} else {
		// add OpenID options to General Settings page.  For now, the only option on this page is dependent on the
		// 'users_can_register' option, so only add the OpenID Settings if that is set.  If additional OpenID settings
		// are added to the General Settings page, this check may no longer be necessary
		if ( get_option('users_can_register') ) {
			add_settings_field('openid_general_settings', __('OpenID Settings', 'openid'), 'openid_general_settings', 
				'general', 'default');
		}
	}

	// add OpenID options to Discussion Settings page
	add_settings_field('openid_disucssion_settings', __('OpenID Settings', 'openid'), 'openid_discussion_settings', 'discussion', 'default');
}


/**
 * Register OpenID admin settings.
 */
function openid_admin_register_settings() {
	register_setting('general', 'openid_required_for_registration');

	register_setting('discussion', 'openid_no_require_name');
	register_setting('discussion', 'openid_enable_approval');
	register_setting('discussion', 'openid_enable_commentform');

	register_setting('openid', 'openid_blog_owner');
	register_setting('openid', 'openid_cap');
}


/**
 * Intercept the call to set the openid_cap option.  Instead of storing 
 * this in the options table, set the capability on the appropriate roles.
 */
function openid_set_cap($newvalue, $oldvalue) {
	global $wp_roles;

	$newvalue = (array) $newvalue;

	foreach ($wp_roles->role_names as $key => $name) {
		$role = $wp_roles->get_role($key);
		if (array_key_exists($key, $newvalue) && $newvalue[$key] == 'on') {
			$option_set = true;
		} else {
			$option_set = false;
		}
		if ($role->has_cap('use_openid_provider')) {
			if (!$option_set) $role->remove_cap('use_openid_provider');
		} else {
			if ($option_set) $role->add_cap('use_openid_provider');
		}
	}

	return $oldvalue;
}


/**
 * Add settings link to plugin page.
 */
function openid_plugin_action_links($links, $file) {
	$this_plugin = openid_plugin_file();

	if($file == $this_plugin) {
		$links[] = '<a href="options-general.php?page=openid">' . __('Settings') . '</a>';
	}

	return $links;
}


/*
 * Display and handle updates from the Admin screen options page.
 *
 * @options_page
 */
function openid_options_page() {
	global $wpdb, $wp_roles;

	if ( isset($_REQUEST['action']) ) {
		switch($_REQUEST['action']) {
			case 'rebuild_tables' :
				check_admin_referer('rebuild_tables');
				$store = openid_getStore();
				$store->reset();
				echo '<div class="updated"><p><strong>'.__('OpenID cache refreshed.', 'openid').'</strong></p></div>';
				break;
		}
	}

	// Display the options page form

	screen_icon('openid');
	?>

