<?php

namespace Wpify;

use Wpify\Core\AbstractComponent;

class Frontend extends AbstractComponent
{
  public function setup()
  {
    add_action('wp_footer', [$this, 'print_react_root']);
  }


  /**
   * Render React root div
   */
  public function print_react_root()
  {
    echo '<div id="react-root"></div>';
  }
}
