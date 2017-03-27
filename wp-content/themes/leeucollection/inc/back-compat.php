<?php
/**
 * Leeu Collection back compat functionality
 *
 * Prevents Leeu Collection from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package WordPress
 * @subpackage Leeu_Collection
 * @since Leeu Collection 1.0
 */

/**
 * Prevent switching to Leeu Collection on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Leeu Collection 1.0
 */
function leeucollection_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'leeucollection_upgrade_notice' );
}
add_action( 'after_switch_theme', 'leeucollection_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Leeu Collection on WordPress versions prior to 4.4.
 *
 * @since Leeu Collection 1.0
 *
 * @global string $wp_version WordPress version.
 */
function leeucollection_upgrade_notice() {
	$message = sprintf( __( 'Leeu Collection requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'leeucollection' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Leeu Collection 1.0
 *
 * @global string $wp_version WordPress version.
 */
function leeucollection_customize() {
	wp_die( sprintf( __( 'Leeu Collection requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'leeucollection' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'leeucollection_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Leeu Collection 1.0
 *
 * @global string $wp_version WordPress version.
 */
function leeucollection_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Leeu Collection requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'leeucollection' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'leeucollection_preview' );
