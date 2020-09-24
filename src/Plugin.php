<?php

namespace WpifyPlugin;

use ComposePress\Core\Exception\ContainerInvalid;
use ComposePress\Core\Exception\ContainerNotExists;
use Exception;
use WpifyPlugin\Assets;
use Wpify\Core_2_0\Interfaces\RepositoryInterface;
use Wpify\Core_2_0\Abstracts\AbstractPlugin as PluginBase;
use Wpify\Core_2_0\View;
use WpifyPlugin\Managers\ApiManager;
use WpifyPlugin\Managers\BlocksManager;
use WpifyPlugin\Managers\CptManager;
use WpifyPlugin\Managers\RepositoriesManager;
use WpifyPlugin\Managers\TaxonomiesManager;
use WpifyPlugin\Managers\ToolsManager;

/**
 * Class Plugin
 * @package Wpify
 */
class Plugin extends PluginBase
{
  /** Plugin version */
  public const VERSION = '0.1.0';

  /** Plugin slug name */
  public const PLUGIN_SLUG = 'wpify-plugin';

  /** Plugin namespace */
  public const PLUGIN_NAMESPACE = '\\' . __NAMESPACE__;

  /** @var Frontend */
  private $frontend;

  /** @var CptManager */
  private $cpt_manager;

  /** @var TaxonomiesManager */
  private $taxonomies_manager;

  /** @var RepositoriesManager */
  private $repositories_manager;

  /** @var ToolsManager */
  private $tools_manager;

  /** @var ApiManager */
  private $api_manager;

  /** @var BlocksManager */
  private $blocks_manager;

  /** @var Settings */
  private $settings;

  /** @var Assets */
  private $assets;

  /** @var View */
  private $view;

  /**
   * Plugin constructor.
   *
   * @param Frontend $frontend
   * @param RepositoriesManager $repositories_manager
   * @param ApiManager $api_manager
   * @param Settings $settings
   * @param CptManager $cpt_manager
   * @param TaxonomiesManager $taxonomies_manager
   * @param ToolsManager $tools_manager
   * @param BlocksManager $blocks_manager
   * @param Assets $assets
   * @param View $view
   *
   * @throws ContainerInvalid
   * @throws ContainerNotExists
   */
  public function __construct(
    Frontend $frontend,
    RepositoriesManager $repositories_manager,
    ApiManager $api_manager,
    Settings $settings,
    CptManager $cpt_manager,
    TaxonomiesManager $taxonomies_manager,
    ToolsManager $tools_manager,
    BlocksManager $blocks_manager,
    Assets $assets,
    View $view
  ) {
    $this->frontend             = $frontend;
    $this->cpt_manager          = $cpt_manager;
    $this->taxonomies_manager   = $taxonomies_manager;
    $this->repositories_manager = $repositories_manager;
    $this->api_manager          = $api_manager;
    $this->settings             = $settings;
    $this->tools_manager        = $tools_manager;
    $this->blocks_manager       = $blocks_manager;
    $this->assets               = $assets;
    $this->view                 = $view;

    parent::__construct();
  }

  public function setup()
  {
    register_theme_directory($this->plugin_dir . '/themes');
  }

  public function get_frontend(): Frontend
  {
    return $this->frontend;
  }

  public function get_repositories_manager(): RepositoriesManager
  {
    return $this->repositories_manager;
  }

  /**
   * @param string $class
   *
   * @return RepositoryInterface
   */
  public function get_repository(string $class)
  {
    return $this->repositories_manager->get_module($class);
  }

  public function get_api_manager(): ApiManager
  {
    return $this->api_manager;
  }

  public function get_api(string $class)
  {
    return $this->api_manager->get_module($class);
  }

  public function get_settings(): Settings
  {
    return $this->settings;
  }

  public function get_cpt_manager(): CptManager
  {
    return $this->cpt_manager;
  }

  public function get_cpt(string $class)
  {
    return $this->cpt_manager->get_module($class);
  }

  public function get_tools_manager()
  {
    return $this->tools_manager;
  }

  public function get_taxonomies_manager(): TaxonomiesManager
  {
    return $this->taxonomies_manager;
  }

  public function get_taxonomy(string $class)
  {
    return $this->taxonomies_manager->get_module($class);
  }

  public function get_controller(string $class)
  {
    return $this->plugin->create_component($class);
  }

  public function get_blocks_manager()
  {
    return $this->blocks_manager;
  }

  public function get_assets(): Assets
  {
    return $this->assets;
  }

  /**
   * Print styles in theme
   *
   * @param $handles
   */
  public function print_assets(string ...$handles)
  {
    $this->assets->print_assets($handles);
  }

  public function get_view(): View
  {
    return $this->view;
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
   * @throws Exception
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
}
