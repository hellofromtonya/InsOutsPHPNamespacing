<?php
/**
 * PHP Namespace Lab Plugin
 *
 * @package     KnowTheCode\InsOutsPHPNamespacing
 * @author      hellofromTonya
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: PHP Namespace Lab Plugin
 * Plugin URI:  https://github.com/KnowTheCode/SandboxPlugin
 * Description: Lab coding plugin for the Ins and Out of PHP Namespacing for WordPress.
 * Version:     1.0.0
 * Author:      hellofromTonya
 * Author URI:  https://KnowTheCode.io
 * Text Domain: php-namespacing
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/**
 * Setup the plugin's constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function phpnamespacing_init_constants() {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}

	define( 'PHPNAMESPACING_URL', $plugin_url );
	define( 'PHPNAMESPACING_DIR', plugin_dir_path( __DIR__ ) );
}

/**
 * Initialize the plugin hooks
 *
 * @since 1.0.0
 *
 * @return void
 */
function phpnamespacing_init_hooks() {
	register_activation_hook( __FILE__, 'phpnamespacing_activate_plugin' );
	register_deactivation_hook( __FILE__, 'phpnamespacing_deactivate_plugin' );
	register_uninstall_hook( __FILE__, 'phpnamespacing_uninstall_plugin' );
}

/**
 * Plugin activation handler
 *
 * @since 1.0.0
 *
 * @return void
 */
function phpnamespacing_activate_plugin() {
	phpnamespacing_init_autoloader();

	phpnamespacing_register_custom_post_type();

	flush_rewrite_rules();
}

/**
 * The plugin is deactivating.  Delete out the rewrite rules option.
 *
 * @since 1.0.1
 *
 * @return void
 */
function phpnamespacing_deactivate_plugin() {
	delete_option( 'rewrite_rules' );
}

/**
 * Uninstall plugin handler
 *
 * @since 1.0.1
 *
 * @return void
 */
function phpnamespacing_uninstall_plugin() {
	delete_option( 'rewrite_rules' );
}

/**
 * Kick off the plugin by initializing the plugin files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function phpnamespacing_init_autoloader() {
	require_once( 'src/custom/post-type.php' );
}

/**
 * Launch the plugin
 *
 * @since 1.0.0
 *
 * @return void
 */
function phpnamespacing_launch() {
	phpnamespacing_init_autoloader();
}

phpnamespacing_init_constants();
phpnamespacing_init_hooks();
phpnamespacing_launch();
