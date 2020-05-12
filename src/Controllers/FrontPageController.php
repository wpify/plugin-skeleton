<?php

namespace Wpify\Controllers;

use Wpify\Core\AbstractController;
use Wpify\Repositories\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @property Plugin $plugin
 */
class FrontPageController extends AbstractController
{
  public function get_posts(): ArrayCollection
  {
    return $this->plugin->get_repository(BookRepository::class)->all();
  }
}
