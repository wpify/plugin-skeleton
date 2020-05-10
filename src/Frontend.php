<?php

namespace Wpify;

use Wpify\Core\Component;
use Wpify\Repositories\MyPostTypeRepository;

class Frontend extends Component
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
