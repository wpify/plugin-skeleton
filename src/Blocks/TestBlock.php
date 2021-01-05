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
    register_block_type( $this->name(), array(
      'render_callback' => array( $this, 'render' ),
      'attributes'      => $this->attributes(),
      'editor_script'   => $this->plugin->get_webpack_manifest()->register_asset( 'test-block-backend.js' ),
      'editor_style'    => $this->plugin->get_webpack_manifest()->register_asset( 'test-block-backend.css' ),
    ) );
  }

  public function name(): string {
    return 'wpify-plugin/test-block';
  }

  public function attributes(): array {
    return array(
      'title'   => array(
        'type' => 'string',
      ),
      'content' => array(
        'type' => 'string',
      ),
    );
  }

  public function enqueue_assets() {
    $this->plugin->get_webpack_manifest()->enqueue_asset( 'test-block-frontend.js' );
    $this->plugin->get_webpack_manifest()->enqueue_asset( 'test-block-frontend.css' );
  }

  public function render( $block_attributes, $content ) {
    return $this->plugin->get_template()->render( 'blocks/test-block', null, array(
      'attributes' => $this->parse_attributes( $block_attributes ),
      'content'    => $content,
    ) );
  }
}
