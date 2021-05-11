<?php

namespace WpifyPlugin\Blocks;

use WpifyPlugin\Plugin;
use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractComponent;

/**
 * Class TestBlock
 *
 * @package WpifyPlugin\Blocks
 * @property Plugin $plugin
 */
class TestBlock extends AbstractComponent {
	/** @var \WpifyPluginDeps\WpifyCustomFields\Implementations\GutenbergBlock */
	private $block;

	public function setup() {
		$this->block = $this->plugin->get_wcf()->add_gutenberg_block( array(
			'name'  => 'wpify-plugin/test-block',
			'title' => __( 'Test block', 'wpify-plugin' ),
			'render_callback' => array( $this, 'render' ),
			'items' => array(
				array(
					'type'  => 'text',
					'id'    => 'title',
					'title' => __( 'Title', 'wpify-plugin' ),
				),
				array(
					'type'  => 'textarea',
					'id'    => 'content',
					'title' => __( 'Content', 'wpify-plugin' ),
				),
			),
		) );
	}

	public function render( $block_attributes, $content ) {
		return $this->plugin->get_template()->render( 'blocks/test-block', null, array(
			'attributes' => $block_attributes,
			'content'    => $content,
		) );
	}
}
