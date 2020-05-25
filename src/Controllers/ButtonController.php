<?php

namespace Wpify\Controllers;

use Wpify\Controller;
use Wpify\Plugin;

/**
 * @property Plugin $plugin
 */
class ButtonController extends Controller
{
  public function __construct()
  {
    $this->set_template('button');
    $this->set_assets(['button.css']);
  }
}
