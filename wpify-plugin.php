<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

/*
 * Plugin Name: WPify Plugin
 * Version: 0.1.0
 * Text Domain: wpify-plugin
 * Domain Path: /languages
*/

use ComposePress\Dice\Dice;
use WpifyPlugin\Plugin;

if (!defined('WPIFY_MIN_PHP_VERSION')) {
  define('WPIFY_MIN_PHP_VERSION', '7.2.0');
}

/**
 * Singleton instance function. We will not use a global at all as that defeats the purpose of a singleton
 * and is a bad design overall
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @return WpifyPlugin\Plugin
 */
function wpify_plugin(): Plugin
{
  return wpify_plugin_container()->create(Plugin::class);
}

/**
 * This container singleton enables you to setup unit testing by passing an environment file to map classes in Dice
 *
 * @param string $env
 *
 * @return Dice
 */
function wpify_plugin_container($env = 'production'): Dice
{
  static $container;
  if (empty($container)) {
    $container = new Dice();
    include __DIR__ . "/config-{$env}.php";
  }

  return $container;
}

/**
 * Init function shortcut
 */
function wpify_plugin_init()
{
  wpify_plugin()->init();
}

/**
 * Activate function shortcut
 */
function wpify_plugin_activate($network_wide)
{
  register_uninstall_hook(__FILE__, 'wpify_plugin_uninstall');
  wpify_plugin()->init();
  wpify_plugin()->activate($network_wide);
}

/**
 * Deactivate function shortcut
 */
function wpify_plugin_deactivate($network_wide)
{
  wpify_plugin()->deactivate($network_wide);
}

/**
 * Uninstall function shortcut
 */
function wpify_plugin_uninstall()
{
  wpify_plugin()->uninstall();
}

/**
 * Error for older php
 */
function wpify_plugin_php_upgrade_notice()
{
  $info = get_plugin_data(__FILE__);
  _e(
    sprintf(
      '
      <div class="error notice">
        <p>
          Opps! %s requires a minimum PHP version of 7.2.0. Your current version is: %s.
          Please contact your host to upgrade.
        </p>
      </div>
      ',
      $info['Name'],
      PHP_VERSION
    )
  );
}

/**
 * Error if vendors autoload is missing
 */
function wpify_plugin_php_vendor_missing()
{
  $info = get_plugin_data(__FILE__);
  _e(
    sprintf(
      '
      <div class="error notice">
        <p>Opps! %s is corrupted it seems, please re-install the plugin.</p>
      </div>
      ',
      $info['Name']
    )
  );
}

/*
 * We want to use a fairly modern php version, feel free to increase the minimum requirement
 */
if (version_compare(PHP_VERSION, WPIFY_MIN_PHP_VERSION) < 0) {
  add_action('admin_notices', 'wpify_plugin_php_upgrade_notice');
} else {
  if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    include_once __DIR__ . '/vendor/autoload.php';

    add_action('plugins_loaded', 'wpify_plugin_init', 11);
    register_activation_hook(__FILE__, 'wpify_plugin_activate');
    register_deactivation_hook(__FILE__, 'wpify_plugin_deactivate');
  } else {
    add_action('admin_notices', 'wpify_plugin_php_vendor_missing');
  }
}
