<?php

namespace Wpify\Controllers;

use Wpify\Core\Controller;
use Wpify\Repositories\MyPostTypeRepository;

class HomeController extends Controller
{
  public function setup()
  {
    $assets = ['handle' => 'home', 'preload' => true];
    $this->set_assets($assets);
    $this->add_assets($this->get_assets());
  }

  public function get_posts()
  {
    return $this->plugin->get_repository(MyPostTypeRepository::class)->all();
  }


}
