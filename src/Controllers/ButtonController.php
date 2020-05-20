<?php

namespace Wpify\Controllers;

use Wpify\Controller;

/**
 * @property Plugin $plugin
 */
class ButtonController extends Controller
{
  private $view = 'button';

  public function __construct()
  {
    $this->set_view($this->view);
  }
}
