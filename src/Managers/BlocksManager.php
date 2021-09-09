<?php

namespace WpifyPluginSkeleton\Managers;

use WpifyPluginSkeleton\Blocks\TestBlock;
use WpifyPluginSkeletonDeps\Wpify\Asset\AssetFactory;
use WpifyPluginSkeletonDeps\Wpify\PluginUtils\PluginUtils;

final class BlocksManager {
	private $utils;
	private $asset_factory;

	public function __construct(
		PluginUtils $utils,
		AssetFactory $asset_factory,
		TestBlock $test_block
	) {
		$this->utils         = $utils;
		$this->asset_factory = $asset_factory;

		$this->setup();
	}

	public function setup() {
		add_action( 'after_setup_theme', array( $this, 'editor_styles' ) );
		add_filter( 'block_categories', array( $this, 'block_categories' ), 10, 2 );

		$this->asset_factory->wp_script(
			$this->utils->get_plugin_path( 'block-editor.js' ),
			array( 'is_admin' => true )
		);
	}

	public function editor_styles() {
		add_theme_support( 'editor-styles' );
		add_theme_support( 'dark-editor-style' );
		add_editor_style( 'editor-style.css' );
	}

	public function block_categories( $categories, $post ) {
		$categories[] = array(
			'slug'  => 'wpify-plugin-skeleton',
			'title' => __( 'Wpify Plugin Skeleton', 'wpify-plugin-skeleton' ),
			'icon'  => 'wordpress',
		);

		return $categories;
	}
}
