<?php
/**
 * Atom Feed Template for displaying Atom Comments feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('atom') . '; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '" ?' . '>';
?>

