<?php
/*
 * Plugin Name:       WPify Plugin Skeleton
 * Description:       Plugin skeleton with theme by WPify
 * Version:           1.0.0
 * Requires PHP:      7.3.0
 * Requires at least: 5.3.0
 * Author:            WPify
 * Author URI:        https://www.wpify.io/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpify-plugin-skeleton
 * Domain Path:       /languages
*/

use WpifyPluginSkeleton\Plugin;
use WpifyPluginSkeletonDeps\DI\Container;
use WpifyPluginSkeletonDeps\DI\ContainerBuilder;

if ( ! defined( 'WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION' ) ) {
	define( 'WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION', '7.3.0' );
}

/**
 * @return Plugin
 * @throws Exception
 */
function wpify_plugin_skeleton(): Plugin {
	return wpify_plugin_skeleton_container()->get( Plugin::class );
}

/**
 * @return Container
 * @throws Exception
 */
function wpify_plugin_skeleton_container(): Container {
	static $container;

	if ( empty( $container ) ) {
		$definition       = require_once __DIR__ . '/config.php';
		$containerBuilder = new ContainerBuilder();
		$containerBuilder->addDefinitions( $definition );
		$container = $containerBuilder->build();
	}

	return $container;
}

function wpify_plugin_skeleton_activate( $network_wide ) {
	wpify_plugin_skeleton()->activate( $network_wide );
}

function wpify_plugin_skeleton_deactivate( $network_wide ) {
	wpify_plugin_skeleton()->deactivate( $network_wide );
}

function wpify_plugin_skeleton_uninstall() {
	wpify_plugin_skeleton()->uninstall();
}

function wpify_plugin_skeleton_php_upgrade_notice() {
	$info = get_plugin_data( __FILE__ );

	echo sprintf(
		__( '<div class="error notice"><p>Opps! %s requires a minimum PHP version of %s. Your current version is: %s. Please contact your host to upgrade.</p></div>', 'wpify-plugin-skeleton' ),
		$info['Name'],
		WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION,
		PHP_VERSION
	);
}

function wpify_plugin_skeleton_php_vendor_missing() {
	$info = get_plugin_data( __FILE__ );

	echo sprintf(
		__( '<div class="error notice"><p>Opps! %s is corrupted it seems, please re-install the plugin.</p></div>', 'wpify-plugin-skeleton' ),
		$info['Name']
	);
}

if ( version_compare( PHP_VERSION, WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION ) < 0 ) {
	add_action( 'admin_notices', 'wpify_plugin_skeleton_php_upgrade_notice' );
} else {
	if ( file_exists( __DIR__ . '/deps/scoper-autoload.php' ) ) {
		include_once __DIR__ . '/deps/scoper-autoload.php';
		include_once __DIR__ . '/vendor/autoload.php';

		add_action( 'plugins_loaded', 'wpify_plugin_skeleton', 11 );
		register_activation_hook( __FILE__, 'wpify_plugin_skeleton_activate' );
		register_deactivation_hook( __FILE__, 'wpify_plugin_skeleton_deactivate' );
		register_uninstall_hook( __FILE__, 'wpify_plugin_skeleton_uninstall' );
	} else {
		add_action( 'admin_notices', 'wpify_plugin_skeleton_php_vendor_missing' );
	}
}
