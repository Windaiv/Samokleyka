<?php
/**
 * The custom header image script.
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * The custom header image class.
 *
 * @since unknown
 * @package WordPress
 * @subpackage Administration
 */
class Custom_Image_Header {

	/**
	 * Callback for administration header.
	 *
	 * @var callback
	 * @since unknown
	 * @access private
	 */
	var $admin_header_callback;

	/**
	 * PHP4 Constructor - Register administration header callback.
	 *
	 * @since unknown
	 * @param callback $admin_header_callback
	 * @return Custom_Image_Header
	 */
	function Custom_Image_Header($admin_header_callback) {
		$this->admin_header_callback = $admin_header_callback;
	}

	/**
	 * Setup the hooks for the Custom Header admin page.
	 *
	 * @since unknown
	 */
	function init() {
		$page = add_theme_page(__('Custom Header'), __('Custom Header'), 'edit_themes', 'custom-header', array(&$this, 'admin_page'));

		add_action("admin_print_scripts-$page", array(&$this, 'js_includes'));
		add_action("admin_print_styles-$page", array(&$this, 'css_includes'));
		add_action("admin_head-$page", array(&$this, 'take_action'), 50);
		add_action("admin_head-$page", array(&$this, 'js'), 50);
		add_action("admin_head-$page", $this->admin_header_callback, 51);
	}

	/**
	 * Get the current step.
	 *
	 * @since unknown
	 *
	 * @return int Current step
	 */
	function step() {
		if ( ! isset( $_GET['step'] ) )
			return 1;

		$step = (int) $_GET['step'];
		if ( $step < 1 || 3 < $step )
			$step = 1;

		return $step;
	}

	/**
	 * Setup the enqueue for the JavaScript files.
	 *
	 * @since unknown
	 */
	function js_includes() {
		$step = $this->step();

		if ( 1 == $step )
			wp_enqueue_script('farbtastic');
		elseif ( 2 == $step )
			wp_enqueue_script('jcrop');
	}

	/**
	 * Setup the enqueue for the CSS files
	 *
	 * @since 2.7
	 */
	function css_includes() {
		$step = $this->step();

		if ( 1 == $step )
			wp_enqueue_style('farbtastic');
		elseif ( 2 == $step )
			wp_enqueue_style('jcrop');
	}

	/**
	 * Execute custom header modification.
	 *
	 * @since unknown
	 */
	function take_action() {
		if ( isset( $_POST['textcolor'] ) ) {
			check_admin_referer('custom-header');
			if ( 'blank' == $_POST['textcolor'] ) {
				set_theme_mod('header_textcolor', 'blank');
			} else {
				$color = preg_replace('/[^0-9a-fA-F]/', '', $_POST['textcolor']);
				if ( strlen($color) == 6 || strlen($color) == 3 )
					set_theme_mod('header_textcolor', $color);
			}
		}
		if ( isset($_POST['resetheader']) ) {
			check_admin_referer('custom-header');
			remove_theme_mods();
		}
	}

	/**
	 * Execute Javascript depending on step.
	 *
	 * @since unknown
	 */
	function js() {
		$step = $this->step();
		if ( 1 == $step )
			$this->js_1();
		elseif ( 2 == $step )
			$this->js_2();
	}

	/**
	 * Display Javascript based on Step 1.
	 *
	 * @since unknown
	 */
	function js_1() { ?>

