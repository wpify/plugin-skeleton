<?php

namespace Wpify\Controllers;

use Wpify\Core\AbstractController;
use Wpify\Repositories\MyPostTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;

class HomeController extends AbstractController
{
  public function get_posts(): ArrayCollection
  {
    return $this->plugin->get_repository(MyPostTypeRepository::class)->all();
  }
}
