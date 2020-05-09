<?php

namespace Wpify;

use Wpify\Core\Component;
use Wpify\Repositories\MyPostTypeRepository;

class Frontend extends Component
{
  public function setup()
  {
    add_action('wp_footer', [$this, 'print_react_root']);
    add_action('wp_footer', [$this, 'test']);
  }


  /**
   * Render React root div
   */
  public function print_react_root()
  {
    echo '<div id="react-root"></div>';
  }

  public function test()
  {
    $repository = $this->plugin->get_repository(MyPostTypeRepository::class);
    $myposts    = $repository->all();

    echo '<pre>';
    var_dump($myposts);
    echo '</pre>';
  }
}
