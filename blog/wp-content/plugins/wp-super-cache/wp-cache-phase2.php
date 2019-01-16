<?php

function wp_cache_phase2() {
	global $cache_filename, $cache_acceptable_files, $wp_cache_meta_object, $wp_cache_gzip_encoding, $super_cache_enabled, $cache_rebuild_files;

	wp_cache_mutex_init();
	if(function_exists('add_action') && ( !defined( 'WPLOCKDOWN' ) || ( defined( 'WPLOCKDOWN' ) && constant( 'WPLOCKDOWN' ) == '0' ) ) ) {
		// Post ID is received
		add_action('publish_post', 'wp_cache_post_edit', 0);
		add_action('edit_post', 'wp_cache_post_change', 0); // leaving a comment called edit_post
		add_action('delete_post', 'wp_cache_post_edit', 0);
		add_action('publish_phone', 'wp_cache_post_edit', 0);
		// Coment ID is received
		add_action('trackback_post', 'wp_cache_get_postid_from_comment', 0);
		add_action('pingback_post', 'wp_cache_get_postid_from_comment', 0);
		add_action('comment_post', 'wp_cache_get_postid_from_comment', 0);
		add_action('edit_comment', 'wp_cache_get_postid_from_comment', 0);
		add_action('wp_set_comment_status', 'wp_cache_get_postid_from_comment', 0);
		// No post_id is available
		add_action('delete_comment', 'wp_cache_no_postid', 0);
		add_action('switch_theme', 'wp_cache_no_postid', 0); 

		add_action('wp_cache_gc','wp_cache_gc_cron');

		do_cacheaction( 'add_cacheaction' );
	}
	if( $_SERVER["REQUEST_METHOD"] == 'POST' || get_option('gzipcompression')) 
		return;
	$script = basename($_SERVER['PHP_SELF']);
	if (!in_array($script, $cache_acceptable_files) && wp_cache_is_rejected($_SERVER["REQUEST_URI"]))
		return;
	if (wp_cache_user_agent_is_rejected()) return;
	if( !is_object( $wp_cache_meta_object ) ) {
		$wp_cache_meta_object = new CacheMeta;
	}
	if($wp_cache_gzip_encoding)
		header('Vary: Accept-Encoding, Cookie');
	else
		header('Vary: Cookie');
	ob_start('wp_cache_ob_callback'); 

	// restore old supercache file temporarily
	if( $super_cache_enabled && $cache_rebuild_files ) {
		$user_info = wp_cache_get_cookies_values();
		$do_cache = apply_filters( 'do_createsupercache', $user_info );
		if( $user_info == '' || $do_cache === true ) {
			$dir = get_current_url_supercache_dir();
			$files_to_check = array( $dir . 'index.html', $dir . 'index.html.gz' );
			foreach( $files_to_check as $cache_file ) {
				if( !file_exists( $cache_file . '.needs-rebuild' ) )
					continue;
				$mtime = @filemtime($cache_file . '.needs-rebuild');
				if( $mtime && (time() - $mtime) < 30 ) {
					@rename( $cache_file . '.needs-rebuild', $cache_file );
				}
				// cleanup old files or if rename fails
				if( @file_exists( $cache_file . '.needs-rebuild' ) ) {
					@unlink( $cache_file . '.needs-rebuild' );
				}
			}
		}
	}
	register_shutdown_function('wp_cache_shutdown_callback');
}

function wp_cache_get_response_headers() {
	if(function_exists('apache_response_headers')) {
		flush();
		$headers = apache_response_headers();
	} else if(function_exists('headers_list')) {
		$headers = array();
		foreach(headers_list() as $hdr) {
			list($header_name, $header_value) = explode(': ', $hdr, 2);
			$headers[$header_name] = $header_value;
		}
	} else
		$headers = null;

	return $headers;
}

function wp_cache_is_rejected($uri) {
	global $cache_rejected_uri;

	if (strstr($uri, '/wp-admin/'))
		return true; // we don't allow caching of wp-admin for security reasons
	foreach ($cache_rejected_uri as $expr) {
		if( preg_match( "~$expr~", $uri ) )
			return true;
	}
	return false;
}

function wp_cache_user_agent_is_rejected() {
	global $cache_rejected_user_agent;

	if (!function_exists('apache_request_headers')) return false;
	$headers = apache_request_headers();
	if (!isset($headers["User-Agent"])) return false;
	foreach ($cache_rejected_user_agent as $expr) {
		if (strlen($expr) > 0 && stristr($headers["User-Agent"], $expr))
			return true;
	}
	return false;
}


function wp_cache_mutex_init() {
	global $use_flock, $mutex, $cache_path, $mutex_filename, $sem_id;

	if(!is_bool($use_flock)) {
		if(function_exists('sem_get')) 
			$use_flock = false;
		else
			$use_flock = true;
	}

	$mutex = false;
	if ($use_flock) 
		$mutex = @fopen($cache_path . $mutex_filename, 'w');
	else
		$mutex = @sem_get($sem_id, 1, 0644 | IPC_CREAT, 1);
}

function wp_cache_writers_entry() {
	global $use_flock, $mutex, $cache_path, $mutex_filename, $wp_cache_mutex_disabled;

	if( isset( $wp_cache_mutex_disabled ) && $wp_cache_mutex_disabled )
		return true;

	if( !$mutex )
		return false;

	if ($use_flock)
		flock($mutex,  LOCK_EX);
	else
		sem_acquire($mutex);

	return true;
}

function wp_cache_writers_exit() {
	global $use_flock, $mutex, $cache_path, $mutex_filename, $wp_cache_mutex_disabled;

	if( isset( $wp_cache_mutex_disabled ) && $wp_cache_mutex_disabled )
		return true;

	if( !$mutex )
		return false;

	if ($use_flock)
		flock($mutex,  LOCK_UN);
	else
		sem_release($mutex);
}

function get_current_url_supercache_dir() {
	global $cached_direct_pages, $cache_path;
	$uri = preg_replace('/[ <>\'\"\r\n\t\(\)]/', '', str_replace( '/index.php', '/', str_replace( '..', '', preg_replace("/(\?.*)?$/", '', $_SERVER['REQUEST_URI'] ) ) ) );
	$uri = str_replace( '\\', '', $uri );
	$dir = strtolower(preg_replace('/:.*$/', '',  $_SERVER["HTTP_HOST"])) . $uri; // To avoid XSS attacs
	$dir = apply_filters( 'supercache_dir', $dir );
	$dir = trailingslashit( $cache_path . 'supercache/' . $dir );
	if( is_array( $cached_direct_pages ) && in_array( $_SERVER[ 'REQUEST_URI' ], $cached_direct_pages ) ) {
		$dir = trailingslashit( ABSPATH . $uri );
	}
	$dir = str_replace( '//', '/', $dir );
	return $dir;
}

function wp_cache_ob_callback($buffer) {
	global $cache_path, $cache_filename, $meta_file, $wp_start_time, $supercachedir;
	global $new_cache, $wp_cache_meta_object, $file_expired, $blog_id, $cache_compression;
	global $wp_cache_gzip_encoding, $super_cache_enabled, $cached_direct_pages;
	global $wp_cache_404, $gzsize, $supercacheonly, $wp_cache_gzip_first;

	$new_cache = true;

	/* Mode paranoic, check for closing tags 
	 * we avoid caching incomplete files */
	if( $wp_cache_404 ) {
		$new_cache = false;
		$buffer .= "\n<!-- Page not cached by WP Super Cache. 404. -->\n";
	}

	if (!preg_match('/(<\/html>|<\/rss>|<\/feed>)/i',$buffer) ) {
		$new_cache = false;
		$buffer .= "\n<!-- Page not cached by WP Super Cache. No closing HTML tag. Check your theme. -->\n";
	}
	
	if( !$new_cache )
		return $buffer;

	$duration = wp_cache_microtime_diff($wp_start_time, microtime());
	$duration = sprintf("%0.3f", $duration);
	$buffer .= "\n<!-- Dynamic Page Served (once) in $duration seconds -->\n";

	if( !wp_cache_writers_entry() ) {
		$buffer .= "\n<!-- Page not cached by WP Super Cache. Could not get mutex lock. -->\n";
		return $buffer;
	}

	$mtime = @filemtime($cache_path . $cache_filename);
	/* Return if:
		the file didn't exist before but it does exist now (another connection created)
		OR
		the file was expired and its mtime is less than 5 seconds
	*/
	if( !((!$file_expired && $mtime) || ($mtime && $file_expired && (time() - $mtime) < 5)) ) {
		$dir = get_current_url_supercache_dir();
		$supercachedir = $cache_path . 'supercache/' . preg_replace('/:.*$/', '',  $_SERVER["HTTP_HOST"]);
		if( !empty( $_GET ) || is_feed() || ( $super_cache_enabled == true && is_dir( substr( $supercachedir, 0, -1 ) . '.disabled' ) ) )
			$super_cache_enabled = false;

		$tmp_wpcache_filename = $cache_path . uniqid( mt_rand(), true ) . '.tmp';

		// Don't create wp-cache files for anon users
		$supercacheonly = false;
		if( $super_cache_enabled && wp_cache_get_cookies_values() == '' )
			$supercacheonly = true;

		if( !$supercacheonly ) {
			$fr = @fopen($tmp_wpcache_filename, 'w');
			if (!$fr) {
				$buffer .= "<!-- File not cached! Super Cache Couldn't write to: " . str_replace( ABSPATH, '', $cache_path ) . $cache_filename . " -->\n";
				return $buffer;
			}
		}
		if( $super_cache_enabled ) {
			if( @is_dir( $dir ) == false )
				@wp_mkdir_p( $dir );

			$user_info = wp_cache_get_cookies_values();
			$do_cache = apply_filters( 'do_createsupercache', $user_info );
			if( $user_info == '' || $do_cache === true ) {
				$cache_fname = "{$dir}index.html";
				$tmp_cache_filename = $dir . uniqid( mt_rand(), true ) . '.tmp';
				$fr2 = @fopen( $tmp_cache_filename, 'w' );
				if (!$fr2) {
					$buffer .= "<!-- File not cached! Super Cache Couldn't write to: " . str_replace( ABSPATH, '', $tmp_cache_filename ) . " -->\n";
					@fclose( $fr );
					@nlink( $tmp_wpcache_filename );
					return $buffer;
				}
				if( $cache_compression ) {
					$gz = @fopen( $tmp_cache_filename . ".gz", 'w');
					if (!$gz) {
						$buffer .= "<!-- File not cached! Super Cache Couldn't write to: " . str_replace( ABSPATH, '', $tmp_cache_filename ) . ".gz -->\n";
						@close( $fr );
						@nlink( $tmp_wpcache_filename );
						@close( $fr2 );
						@nlink( $tmp_cache_filename );
						return $buffer;
					}
				}
			}
		}

		if (preg_match('/<!--mclude|<!--mfunc/', $buffer)) { //Dynamic content
			$store = preg_replace('|<!--mclude (.*?)-->(.*?)<!--/mclude-->|is', 
					"<!--mclude-->\n<?php include_once('" . ABSPATH . "$1'); ?>

