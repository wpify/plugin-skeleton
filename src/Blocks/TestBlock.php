<?php

namespace WpifyPlugin\Blocks;

use Wpify\Core\AbstractComponent;
use WpifyPlugin\Plugin;

/**
 * Class TestBlock
 * @package WpifyPlugin\Blocks
 * @property Plugin $plugin
 */
class TestBlock extends AbstractComponent
{
  public function setup()
  {
    add_action('init', [$this, 'register']);
  }

  public function register()
  {
    register_block_type(
      'wpify/test-block',
      [
        'render_callback' => [$this, 'render'],
      ]
    );
  }

  public function render($block_attributes, $content)
  {
    return print_r(
      [
        'block_attributes' => $block_attributes,
        'content'          => $content,
      ],
      true
    );
  }
}
