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
	if ( is_category() || is_tag() ) {
		$title = single_term_title('', false);
	} elseif ( is_author() ) {
		$title = get_the_author_meta( 'display_name' );
	} elseif ( is_year() ) {
		$title = get_the_date( _x( 'Y', 'yearly archives date format', 'twentynineteen' ) );
	} elseif ( is_month() ) {
		$title = get_the_date( _x( 'F Y', 'monthly archives date format', 'twentynineteen' ) );
	} elseif ( is_day() ) {
		$title = get_the_date();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy(get_queried_object()->taxonomy);
		$title = $tax->labels->singular_name;
    	} 
	
	return '<span class="page-description">'.$title.'</span> <blockquote class="wp-block-quote">'.get_the_archive_description().'</blockquote>';
}

/**
 * Functions that run on INIT of website
 */
function nilcus_init(){
	add_filter('get_the_archive_title', 'nilcus_get_the_archive_title');
}

// Add Actions
add_action('init', 'nilcus_init', 99);
