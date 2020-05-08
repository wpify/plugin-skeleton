<?php

namespace Wpify\Controllers;

use Wpify\Core\Controller;
use Wpify\Repositories\MyPostTypeRepository;

class HomeController extends Controller
{
  private $assets;

  public function setup()
  {
    $this->assets = [
      ['handle' => 'home', 'preload' => true],
    ];
    $this->add_assets($this->assets);
  }

  public function get_posts()
  {
    return $this->plugin->get_repository(MyPostTypeRepository::class)->all();
  }


}
