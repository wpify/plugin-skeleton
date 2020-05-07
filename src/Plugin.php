<?php


namespace Wpify;

use Wpify\Core\Plugin as PluginBase;
use Wpify\Managers\ApiManager;
use Wpify\Managers\RepositoriesManager;

/**
 * Class Plugin
 * @package Wpify
 */
class Plugin extends PluginBase
{
  /**
   * Plugin version
   */
  const VERSION = '0.1.0';

  /**
   * Plugin slug name
   */
  const PLUGIN_SLUG = 'wpify';

  /**
   * Plugin namespace
   */
  const PLUGIN_NAMESPACE = '\Wpify';

  private $assets;

  /**
   * @var Frontend
   */
  private $frontend;

  /**
   * @var RepositoriesManager
   */
  private $repositories_manager;

  /**
   * @var ApiManager
   */
  private $api_manager;

  /**
   * @var Settings
   */
  private $settings;

  /**
   * Plugin constructor.
   *
   * @param Frontend $frontend
   * @param RepositoriesManager $repositories_manager
   * @param ApiManager $api_manager
   * @param Settings $settings
   *
   * @throws \ComposePress\Core\Exception\ContainerInvalid
   * @throws \ComposePress\Core\Exception\ContainerNotExists
   */
  public function __construct(Frontend $frontend, RepositoriesManager $repositories_manager, ApiManager $api_manager, Settings $settings)
  {
    $this->frontend             = $frontend;
    $this->repositories_manager = $repositories_manager;
    $this->api_manager          = $api_manager;
    $this->settings             = $settings;

    parent::__construct();
  }

  /**
   * @return void
   */
  public function setup()
  {
    register_theme_directory($this->plugin_dir . '/themes');
  }

  /**
   * @return Frontend
   */
  public function get_frontend(): Frontend
  {
    return $this->frontend;
  }

  /**
   * @return RepositoriesManager
   */
  public function get_repositories_manager(): RepositoriesManager
  {
    return $this->repositories_manager;
  }

  /**
   * @return ApiManager
   */
  public function get_api_manager(): ApiManager
  {
    return $this->api_manager;
  }

  /**
   * @return Settings
   */
  public function get_settings(): Settings
  {
    return $this->settings;
  }

  /**
   * Method to check if plugin has its dependencies. If not, it silently aborts
   * @return bool
   */
  protected function get_dependencies_exist()
  {
    return true;
  }

  /**
   * @return bool
   * @throws \Exception
   */
  protected function load_components()
  {
    // Conditionally lazy load components with $this->load()
  }

  /**
   * Plugin activation and upgrade
   *
   * @param $network_wide
   *
   * @return void
   */
  public function activate($network_wide)
  {
  }

  /**
   * Plugin de-activation
   *
   * @param $network_wide
   *
   * @return void
   */
  public function deactivate($network_wide)
  {
  }

  /**
   * Plugin uninstall
   * @return void
   */
  public function uninstall()
  {
  }

  /**
   * Gets asset URL from assets-manifest.json
   *
   * @param $file
   *
   * @return string
   * @throws \Exception
   */
  public function asset($file): string
  {
    $manifest = $this->get_asset_path('build/assets-manifest.json');

    if (!$this->assets && file_exists($manifest)) {
      $this->assets = json_decode(file_get_contents($manifest), true);
    }

    if (isset($this->assets[$file])) {
      return $this->get_asset_url("build/{$this->assets[$file]}");
    }

    throw new \Exception("Asset $file doesn't exists.");
  }
}
