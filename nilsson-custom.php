<?php
/** 
 * Plugin Name: Nilsson Custom
 * Plugin URI: *
 * Description: Custom global functions used across multiple websites hosted by Jan Nilsson
 * Version: 1.0.0
 * Author: Damir Calusic
 * Author URI: https://www.damircalusic.com/
 * Text Domain: nilcus
 * Domain Path: /languages/
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if(!defined('ABSPATH')) exit;

/**
 * Filters the default archive titles.
 */
function nilcus_get_the_archive_title() {
	if ( is_category() ) {
		$title = '<span class="page-description">' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = '<span class="page-description">' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = '<span class="page-description">' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = '<span class="page-description">' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentynineteen' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = '<span class="page-description">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentynineteen' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = '<span class="page-description">' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = '<span class="page-description">' . post_type_archive_title( '', false ) . '</span>';
	} elseif ( is_tax() ) {
		$tax = get_taxonomy(get_queried_object()->taxonomy);
		$title = $tax->labels->singular_name;
    } 
	
	return $title.'<blockquote class="wp-block-quote">'.get_the_archive_description().'</blockquote>';
}

function nilcus_init(){
	add_filter('get_the_archive_title', 'nilcus_get_the_archive_title');
}

add_action('init', 'nilcus_init', 99);