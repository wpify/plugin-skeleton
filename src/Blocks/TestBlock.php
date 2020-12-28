<?php

namespace WpifyPlugin\Blocks;

use Wpify\Core_3_0\Abstracts\AbstractBlock;
use WpifyPlugin\Plugin;

/**
 * Class TestBlock
 *
 * @package WpifyPlugin\Blocks
 * @property Plugin $plugin
 */
class TestBlock extends AbstractBlock {
	public function register(): void {
		register_block_type(
			$this->name(),
			array(
				'render_callback' => array( $this, 'render' ),
				'editor_script'   => $this->plugin->get_webpack_manifest()->register_asset( 'blocks-test-backend.js' ),
				'editor_style'    => $this->plugin->get_webpack_manifest()->register_asset( 'blocks-test-backend.css' ),
			)
		);
	}

	public function name(): string {
		return 'wpify-plugin/test-block';
	}

	public function attributes(): array {
		return array(
			'content' => array(
				'type' => 'string',
			),
		);
	}

	public function render( $block_attributes, $content ) {
		return print_r(
			array(
				'block_attributes' => $block_attributes,
				'content'          => $content,
			),
			true
		);
	}
}
