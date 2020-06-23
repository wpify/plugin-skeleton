<?php

namespace Wpify;

use Wpify\Core\AbstractComponent;

class Frontend extends AbstractComponent
{
  public function setup()
  {
    add_action('wp_footer', [$this, 'print_react_root']);

    register_block_type('core/paragraph', [
      'render_callback' => [$this, 'render_paragraph'],
    ]);
  }

  /**
   * Prints React root div
   */
  public function print_react_root()
  {
    echo '<div id="react-root"></div>';
  }

  public function render_paragraph($attributes, $inner_blocks)
  {
    return '<div style="color:red">' . $inner_blocks . '</div>';
  }
}
