<?php
/*
 * Plugin Name: WPify
 * Version: 0.1.0
 * Text Domain: wpify
 * Domain Path: /languages
*/

use ComposePress\Dice\Dice;
use Wpify\Plugin;

/**
 * Singleton instance function. We will not use a global at all as that defeats the purpose of a singleton and is a bad design overall
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @return Wpify\Plugin
 */
function wpify()
{
  return wpify_container()->create(Plugin::class);
}

/**
 * This container singleton enables you to setup unit testing by passing an environment file to map classes in Dice
 *
 * @param string $env
 *
 * @return \ComposePress\Dice\Dice
 */
function wpify_container($env = 'prod')
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
function wpify_init()
{
  wpify()->init();
}

/**
 * Activate function shortcut
 */
function wpify_activate($network_wide)
{
  register_uninstall_hook(__FILE__, 'wpify_uninstall');
  wpify()->init();
  wpify()->activate($network_wide);
}

/**
 * Deactivate function shortcut
 */
function wpify_deactivate($network_wide)
{
  wpify()->deactivate($network_wide);
}

/**
 * Uninstall function shortcut
 */
function wpify_uninstall()
{
  wpify()->uninstall();
}

/**
 * Error for older php
 */
function wpify_php_upgrade_notice()
{
  $info = get_plugin_data(__FILE__);
  _e(
    sprintf(
      '
      <div class="error notice">
		    <p>Opps! %s requires a minimum PHP version of 5.4.0. Your current version is: %s. Please contact your host to upgrade.</p>
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
function wpify_php_vendor_missing()
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
if (version_compare(PHP_VERSION, '7.3.0') < 0) {
  add_action('admin_notices', 'wpify_php_upgrade_notice');
} else {
  if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    include_once __DIR__ . '/vendor/autoload.php';

    add_action('plugins_loaded', 'wpify_init', 11);
    register_activation_hook(__FILE__, 'wpify_activate');
    register_deactivation_hook(__FILE__, 'wpify_deactivate');
  } else {
    add_action('admin_notices', 'wpify_php_vendor_missing');
  }
}
