<?php

namespace Wpify;

use Wpify\Core\AbstractController;

/**
 * Class Controller
 * @package Wpify
 * @property Plugin $plugin
 */
class Controller extends AbstractController
{
  private $view;
  public function set_view($view)
  {
    $this->view = $view;
  }
  public function render($data = [])
  {
    $this->plugin->get_view()->render($this->view, $data);
  }
}
