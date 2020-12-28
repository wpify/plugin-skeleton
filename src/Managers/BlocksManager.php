<?php


namespace WpifyPlugin\Managers;

use Wpify\Core_3_0\Abstracts\AbstractManager;
use WpifyPlugin\Blocks\TestBlock;
use WpifyPlugin\Plugin;

/** @property Plugin $plugin */
class BlocksManager extends AbstractManager {
	protected $modules = array(
		TestBlock::class,
	);

	public function setup() {
		add_action( 'admin_enqueue_scripts', array( $this, 'gutenberg_script' ) );
		add_filter( 'block_categories', array( $this, 'block_categories' ), 10, 2 );
	}

	public function block_categories( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'wpify-plugin',
					'title' => __( 'wpify-plugin', 'wpify-plugin' ),
					'icon'  => 'wordpress',
				),
			)
		);
	}

	public function gutenberg_script() {
		$scripts = $this->plugin->get_webpack_manifest()->get_assets(
			'block-editor.js',
			'wpify-plugin-block-editor',
			array()
		);

		$this->plugin->get_assets()->enqueue_assets( $scripts );
	}
}
