<?php

namespace WpifyPlugin;

use Exception;
use WpifyPlugin\Managers\ApiManager;
use WpifyPlugin\Managers\BlocksManager;
use WpifyPlugin\Managers\PostTypesManager;
use WpifyPlugin\Managers\RepositoriesManager;
use WpifyPlugin\Managers\TaxonomiesManager;
use WpifyPlugin\Managers\ToolsManager;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractComponent;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractPlugin;
use WpifyPluginDeps\Wpify\Core\Exceptions\ContainerInvalidException;
use WpifyPluginDeps\Wpify\Core\Exceptions\ContainerNotExistsException;
use WpifyPluginDeps\Wpify\Core\Exceptions\PluginException;
use WpifyPluginDeps\Wpify\Core\Interfaces\RepositoryInterface;
use WpifyPluginDeps\Wpify\Core\WebpackManifest;
use WpifyPluginDeps\Wpify\Core\WordPressTemplate;
use WpifyPluginDeps\WpifyCustomFields\WpifyCustomFields;

/**
 * Class Plugin
 *
 * @package Wpify
 */
class Plugin extends AbstractPlugin {
	/** Plugin version */
	public const VERSION = '2.2.0';

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

	/** @var WordPressTemplate */
	private $template;

	/** @var WpifyCustomFields */
	private $wcf;

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
	 * @param WordPressTemplate $template
	 * @param WpifyCustomFields $wcf
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
		WordPressTemplate $template,
		WpifyCustomFields $wcf
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
		$this->template             = $template;
		$this->wcf                  = $wcf;

		parent::__construct();
	}

	/**
	 * @return bool|void
	 */
	public function setup() {
		register_theme_directory( $this->plugin_dir . '/themes' );
	}

	/**
	 * @return Frontend
	 */
	public function get_frontend(): Frontend {
		return $this->frontend;
	}

	/**
	 * @return RepositoriesManager
	 */
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

	/**
	 * @return ApiManager
	 */
	public function get_api_manager(): ApiManager {
		return $this->api_manager;
	}

	/**
	 * @param string $class
	 *
	 * @return bool|mixed|AbstractComponent
	 */
	public function get_api( string $class ) {
		return $this->api_manager->get_module( $class );
	}

	/**
	 * @return Settings
	 */
	public function get_settings(): Settings {
		return $this->settings;
	}

	/**
	 * @return PostTypesManager
	 */
	public function get_post_types_manager(): PostTypesManager {
		return $this->post_types_manager;
	}

	/**
	 * @param string $class
	 *
	 * @return bool|mixed|AbstractComponent
	 */
	public function get_post_type( string $class ) {
		return $this->post_types_manager->get_module( $class );
	}

	/**
	 * @return ToolsManager
	 */
	public function get_tools_manager() {
		return $this->tools_manager;
	}

	/**
	 * @return TaxonomiesManager
	 */
	public function get_taxonomies_manager(): TaxonomiesManager {
		return $this->taxonomies_manager;
	}

	/**
	 * @param string $class
	 *
	 * @return bool|mixed|AbstractComponent
	 */
	public function get_taxonomy( string $class ) {
		return $this->taxonomies_manager->get_module( $class );
	}

	/**
	 * @param string $class
	 *
	 * @return mixed
	 * @throws PluginException
	 */
	public function get_controller( string $class ) {
		return $this->plugin->create_component( $class );
	}

	/**
	 * @return BlocksManager
	 */
	public function get_blocks_manager() {
		return $this->blocks_manager;
	}

	/**
	 * @return Assets
	 */
	public function get_assets(): Assets {
		return $this->assets;
	}

	/**
	 * @return WebpackManifest
	 */
	public function get_webpack_manifest(): WebpackManifest {
		return $this->webpack_manifest;
	}

	/**
	 * @return WpifyCustomFields
	 */
	public function get_wcf(): WpifyCustomFields {
		return $this->wcf;
	}

	/**
	 * Print styles in theme
	 *
	 * @param $handles
	 */
	public function print_assets( string ...$handles ) {
		$this->assets->print_assets( $handles );
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
	 * @return WordPressTemplate
	 */
	public function get_template(): WordPressTemplate {
		return $this->template;
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
