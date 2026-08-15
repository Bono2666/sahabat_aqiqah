<?php
/**
 * Plugin Name
 *
 * @package           COPYRIGHT_DATE
 * @author            InstallActivateGo.com
 * @copyright         Copyright (C) 2013-2023, InstallActivateGo.com
 *
 * @wordpress-plugin
 * Plugin Name:       InstallActivateGo.com Copyright Current Date Shortcodes
 * Plugin URI:        https://installactivatego.com/copyright-shortcodes
 * Description:       Provides Shortcodes to display the Copyright symbol and Current Year, Month and Day.
 * Version:           2.0.0
 * Requires at least: 6.0
 * Requires PHP:      5.6
 * Author:            InstallActivateGo.com
 * Author URI:        https://installactivatego.com
 * Text Domain:       jonradio-current-year-and-copyright-shortcodes
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Update URI:        https://downloads.wordpress.org/plugin/https://wordpress.org/plugins/jonradio-current-year-and-copyright-shortcodes.2.0.0.zip
 */

defined( 'ABSPATH' ) || exit;

/*	Using a define() for a (global) Constant instead of a global variable would be better
	but a define() set to an array is not supported by PHP prior to Version 7.0.
*/
global $iag_cd_shortcodes;
$iag_cd_shortcodes = array( 'c', 'y', 'cy', 'm', 'd' );

if ( ( !is_admin() ) || wp_doing_ajax() ) {
	/*	Run at standard time recommended by WordPress.
	*/
	add_action( 'init', 'iag_cd_new_shortcodes' );
	/*	Run as late as possible.
	*/
	add_action( 'wp', 'iag_cd_legacy_shortcodes', 32767 );
}

/*	New "iag"-prefixed, non-colliding (i.e. - unique)
	Shortcode Names.
	
	Runs as per WordPress Standards, at 'init' Action hook.
*/
function iag_cd_new_shortcodes() {
	global $iag_cd_shortcodes;
	foreach ( $iag_cd_shortcodes as $shortcode ) {
		add_shortcode( "iag$shortcode", "iag_cd_$shortcode" );
	}
}

/*	Legacy, potentially colliding (i.e. - not unique)
	Shortcode Names.
	
	Runs as late as possible, after all other 'wp' Actions,
	to detect all other defined Shortcodes.
	If already defined, don't Collide.
*/
function iag_cd_legacy_shortcodes() {
	global $iag_cd_shortcodes;
	foreach ( $iag_cd_shortcodes as $shortcode ) {
		if ( !shortcode_exists( $shortcode ) ) {
			add_shortcode( $shortcode, "iag_cd_$shortcode" );
		}
	}
}

/**
 * [c] Shortcode
 * 
 * Returns the Copyright Symbol.
 *
 * @return   string              HTML for a Copyright symbol
 */
function iag_cd_c() {
	return '&copy;';
}

/**
 * [y] Shortcode
 * 
 * Returns the Current Year as a string in four digits.
 *
 * @return   string              Current Year
 */
function iag_cd_y() {
	$date = getdate( current_time( 'timestamp' ) );
	return $date['year'];
}

/**
 * [cy] Shortcode
 * 
 * Returns the Copyright Symbol followed by the current year, with a blank between.
 *
 * @return   string              HTML for a Copyright symbol, blank, current year
 */
function iag_cd_cy() {
	return iag_cd_c() . ' ' . iag_cd_y();
}

/**
 * [m] Shortcode
 * 
 * Returns the Current Month as a text string containing the month name.
 *
 * @return   string              Current Month
 */
function iag_cd_m() {
	$date = getdate( current_time( 'timestamp' ) );
	return $date['month'];
}

/**
 * [d] Shortcode
 * 
 * Returns the Current Day as a text string containing the day of the month.
 *
 * @return   string              Current Day
 */
function iag_cd_d() {
	$date = getdate( current_time( 'timestamp' ) );
	return $date['mday'];
}

?>