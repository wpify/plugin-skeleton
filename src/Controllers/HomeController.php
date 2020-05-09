<?php

namespace Wpify\Controllers;

use Wpify\Core\Controller;
use Wpify\Repositories\MyPostTypeRepository;

class HomeController extends Controller
{
  public function get_posts()
  {
    return $this->plugin->get_repository(MyPostTypeRepository::class)->all();
  }
}
