<?php
/*
 * Plugin Name:       Wpify Plugin Skeleton
 * Description:       Plugin skeleton with theme by WPify
 * Version:           1.0.0
 * Requires PHP:      7.3.0
 * Requires at least: 5.3.0
 * Author:            WPify
 * Author URI:        https://www.wpify.io/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpify-multilang
 * Domain Path:       /languages
*/

use WpifyMultilang\Plugin;
use WpifyMultilangDeps\DI\Container;
use WpifyMultilangDeps\DI\ContainerBuilder;

if ( ! defined( 'WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION' ) ) {
	define( 'WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION', '7.3.0' );
}

/**
 * @return Plugin
 * @throws Exception
 */
function wpify_multilang(): Plugin {
	return wpify_multilang_container()->get( Plugin::class );
}

/**
 * @return Container
 * @throws Exception
 */
function wpify_multilang_container(): Container {
	static $container;

	if ( empty( $container ) ) {
		$is_production    = ! WP_DEBUG;
		$file_data        = get_file_data( __FILE__, array( 'version' => 'Version' ) );
		$definition       = require_once __DIR__ . '/config.php';
		$containerBuilder = new ContainerBuilder();
		$containerBuilder->addDefinitions( $definition );

		if ( $is_production ) {
			$containerBuilder->enableCompilation( WP_CONTENT_DIR . '/cache/' . dirname( plugin_basename( __FILE__ ) ) . '/' . $file_data['version'], 'WpifyMultilangCompiledContainer' );
		}

		$container = $containerBuilder->build();
	}

	return $container;
}

function wpify_multilang_activate( $network_wide ) {
	wpify_multilang()->activate( $network_wide );
}

function wpify_multilang_deactivate( $network_wide ) {
	wpify_multilang()->deactivate( $network_wide );
}

function wpify_multilang_uninstall() {
	wpify_multilang()->uninstall();
}

function wpify_multilang_php_upgrade_notice() {
	$info = get_plugin_data( __FILE__ );

	echo sprintf(
		__( '<div class="error notice"><p>Opps! %s requires a minimum PHP version of %s. Your current version is: %s. Please contact your host to upgrade.</p></div>', 'wpify-multilang' ),
		$info['Name'],
		WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION,
		PHP_VERSION
	);
}

function wpify_multilang_php_vendor_missing() {
	$info = get_plugin_data( __FILE__ );

	echo sprintf(
		__( '<div class="error notice"><p>Opps! %s is corrupted it seems, please re-install the plugin.</p></div>', 'wpify-multilang' ),
		$info['Name']
	);
}

if ( version_compare( PHP_VERSION, WPIFY_PLUGIN_SKELETON_MIN_PHP_VERSION ) < 0 ) {
	add_action( 'admin_notices', 'wpify_multilang_php_upgrade_notice' );
} else {
	$deps_loaded   = false;
	$vendor_loaded = false;

	$deps = array_filter( array( __DIR__ . '/deps/scoper-autoload.php', __DIR__ . '/deps/autoload.php' ), function ( $path ) {
		return file_exists( $path );
	} );

	foreach ( $deps as $dep ) {
		include_once $dep;
		$deps_loaded = true;
	}

	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		include_once __DIR__ . '/vendor/autoload.php';
		$vendor_loaded = true;
	}

	if ( $deps_loaded && $vendor_loaded ) {
		add_action( 'plugins_loaded', 'wpify_multilang', 11 );
		register_activation_hook( __FILE__, 'wpify_multilang_activate' );
		register_deactivation_hook( __FILE__, 'wpify_multilang_deactivate' );
		register_uninstall_hook( __FILE__, 'wpify_multilang_uninstall' );
	} else {
		add_action( 'admin_notices', 'wpify_multilang_php_vendor_missing' );
	}
}
