<?php
/**
 * Plugin Name: Translate Website with Google Translator
 * Plugin URI: https://kartechify.com/product/wordpress-google-translate/
 * Description: A simple light weight plugin to translate your WordPress website to some other language using the Google Translator widget or [wpgt_google_translate] shortcode.
 * Version: 1.5
 * Author: Kartik Parmar
 * Author URI: https://kartechify.com/
 * Requires PHP: 5.6
 * License: GPL2
 *
 * @package WPGT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'wgt_fs' ) ) {
	/**
	 * Create a helper function for easy SDK access.
	 */
	function wgt_fs() {
		global $wgt_fs;

		if ( ! isset( $wgt_fs ) ) {
			// Include Freemius SDK.
			require_once __DIR__ . '/freemius/start.php';

			$wgt_fs = fs_dynamic_init(
				array(
					'id'             => '6009',
					'slug'           => 'wpgt-google-translate',
					'type'           => 'plugin',
					'public_key'     => 'pk_c06834b674716e578699f14e9b44f',
					'is_premium'     => false,
					'has_addons'     => false,
					'has_paid_plans' => false,
					'menu'           => array(
						'first-path' => 'plugins.php',
						'account'    => false,
						'contact'    => false,
					),
				)
			);
		}

		return $wgt_fs;
	}

	// Init Freemius.
	wgt_fs();
	// Signal that SDK was initiated.
	do_action( 'wgt_fs_loaded' );
}

/**
 * Register and load the widget
 *
 * @since 1.0
 * @hook widgets_init
 */
if ( ! defined( 'WPGT_PATH' ) ) {
	define( 'WPGT_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'WPGT_VERSION' ) ) {
	define( 'WPGT_VERSION', '1.4' );
}
require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpgt-widget.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/wpgt-functions.php';

/**
 * Widget
 */
function wpgt_load_widget() {
	register_widget( 'Wpgt_Widget' );
}
add_action( 'widgets_init', 'wpgt_load_widget' );

/**
 * Shortcode
 */
function wpgt_google_translate_shortcode() {

	$html = wpgt_language_field( 'shortcode' );
	return $html;
}
add_shortcode( 'wpgt_google_translate', 'wpgt_google_translate_shortcode' );

/**
 * Translation.
 */
function wpgt_google_translate_load_textdomain() {
	load_plugin_textdomain( 'wpgt-google-translate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'wpgt_google_translate_load_textdomain' );
