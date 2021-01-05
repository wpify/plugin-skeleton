<?php

namespace WpifyPlugin;

use Exception;
use Wpify\Core_3_0\Abstracts\AbstractPlugin as PluginBase;
use Wpify\Core_3_0\Exceptions\ContainerInvalidException;
use Wpify\Core_3_0\Exceptions\ContainerNotExistsException;
use Wpify\Core_3_0\Interfaces\RepositoryInterface;
use Wpify\Core_3_0\View;
use Wpify\Core_3_0\WebpackManifest;
use WpifyPlugin\Managers\ApiManager;
use WpifyPlugin\Managers\BlocksManager;
use WpifyPlugin\Managers\PostTypesManager;
use WpifyPlugin\Managers\RepositoriesManager;
use WpifyPlugin\Managers\TaxonomiesManager;
use WpifyPlugin\Managers\ToolsManager;

/**
 * Class Plugin
 *
 * @package Wpify
 */
class Plugin extends PluginBase {
  /** Plugin version */
  public const VERSION = '2.1.3';

  /** Plugin slug name */
  public const PLUGIN_SLUG = 'wpify-plugin';

  /** Plugin namespace */
  public const PLUGIN_NAMESPACE = '\\' . __NAMESPACE__;

  /** @var Frontend */
  private $frontend;

  /** @var PostTypesManager */
  private $post_types_manager;

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

  /** @var WebpackManifest */
  private $webpack_manifest;

  /** @var View */
  private $view;

  /**
   * Plugin constructor.
   *
   * @param Frontend $frontend
   * @param RepositoriesManager $repositories_manager
   * @param ApiManager $api_manager
   * @param Settings $settings
   * @param PostTypesManager $post_types_manager
   * @param TaxonomiesManager $taxonomies_manager
   * @param ToolsManager $tools_manager
   * @param BlocksManager $blocks_manager
   * @param Assets $assets
   * @param WebpackManifest $webpack_manifest
   * @param View $view
   *
   * @throws ContainerInvalidException
   * @throws ContainerNotExistsException
   */
  public function __construct(
    Frontend $frontend,
    RepositoriesManager $repositories_manager,
    ApiManager $api_manager,
    Settings $settings,
    PostTypesManager $post_types_manager,
    TaxonomiesManager $taxonomies_manager,
    ToolsManager $tools_manager,
    BlocksManager $blocks_manager,
    Assets $assets,
    WebpackManifest $webpack_manifest,
    View $view
  ) {
    $this->frontend             = $frontend;
    $this->post_types_manager   = $post_types_manager;
    $this->taxonomies_manager   = $taxonomies_manager;
    $this->repositories_manager = $repositories_manager;
    $this->api_manager          = $api_manager;
    $this->settings             = $settings;
    $this->tools_manager        = $tools_manager;
    $this->blocks_manager       = $blocks_manager;
    $this->assets               = $assets;
    $this->webpack_manifest     = $webpack_manifest;
    $this->view                 = $view;

    parent::__construct();
  }

  public function setup() {
    register_theme_directory( $this->plugin_dir . '/themes' );
  }

  public function get_frontend(): Frontend {
    return $this->frontend;
  }

  public function get_repositories_manager(): RepositoriesManager {
    return $this->repositories_manager;
  }

  /**
   * @param string $class
   *
   * @return RepositoryInterface
   */
  public function get_repository( string $class ) {
    return $this->repositories_manager->get_module( $class );
  }

  public function get_api_manager(): ApiManager {
    return $this->api_manager;
  }

  public function get_api( string $class ) {
    return $this->api_manager->get_module( $class );
  }

  public function get_settings(): Settings {
    return $this->settings;
  }

  public function get_post_types_manager(): PostTypesManager {
    return $this->post_types_manager;
  }

  public function get_post_type( string $class ) {
    return $this->post_types_manager->get_module( $class );
  }

  public function get_tools_manager() {
    return $this->tools_manager;
  }

  public function get_taxonomies_manager(): TaxonomiesManager {
    return $this->taxonomies_manager;
  }

  public function get_taxonomy( string $class ) {
    return $this->taxonomies_manager->get_module( $class );
  }

  public function get_controller( string $class ) {
    return $this->plugin->create_component( $class );
  }

  public function get_blocks_manager() {
    return $this->blocks_manager;
  }

  public function get_assets(): Assets {
    return $this->assets;
  }

  /** @return WebpackManifest */
  public function get_webpack_manifest(): WebpackManifest {
    return $this->webpack_manifest;
  }

  /**
   * Print styles in theme
   *
   * @param $handles
   */
  public function print_assets( string ...$handles ) {
    $this->assets->print_assets( $handles );
  }

  public function get_view(): View {
    return $this->view;
  }

  /**
   * Renders the template from plugin templates folder or theme folder and returns the result.
   *
   * @param string $slug The slug name for the generic template.
   * @param null $name The name of the specialised template.
   * @param array $args Additional arguments passed to the template.
   *
   * @return string
   */
  public function render_template( string $slug, $name = null, $args = array() ) {
    $templates_folder = $this->get_plugin_dir() . '/templates/';
    $templates        = array();

    if ( ! empty( $name ) ) {
      $templates[] = $templates_folder . $slug . '-' . $name . '.php';
    }

    $templates[] = $templates_folder . $slug . '.php';

    foreach ( $templates as $template ) {
      if ( file_exists( $template ) ) {
        ob_start();
        load_template( $template, false, $args );

        return ob_get_clean();
      }
    }

    ob_start();
    get_template_part( $slug, $name, $args );

    return ob_get_clean();
  }

  /**
   * Plugin activation and upgrade
   *
   * @param $network_wide
   *
   * @return void
   */
  public function activate( $network_wide ) {
  }

  /**
   * Plugin de-activation
   *
   * @param $network_wide
   *
   * @return void
   */
  public function deactivate( $network_wide ) {
  }

  /**
   * Plugin uninstall
   *
   * @return void
   */
  public function uninstall() {
  }

  /**
   * Method to check if plugin has its dependencies. If not, it silently aborts
   *
   * @return bool
   */
  protected function get_dependencies_exist() {
    return true;
  }

  /**
   * @return bool
   * @throws Exception
   */
  protected function load_components() {
    // Conditionally lazy load components with $this->load()
  }
}
