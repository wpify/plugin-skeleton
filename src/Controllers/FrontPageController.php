<?php

namespace Wpify\Controllers;

use Wpify\Repositories\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Wpify\Controller;

/**
 * @property Plugin $plugin
 */
class FrontPageController extends Controller
{
  public function get_posts(): ArrayCollection
  {
    return $this->plugin->get_repository(BookRepository::class)->all();
  }
}
