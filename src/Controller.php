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
  /**
   * Render the assets and view
   *
   * @param array $data
   * @param string $view
   * @param bool $return
   * @param bool $render_assets
   *
   * @throws \Exception
   */
  public function render($data = [], $view = '', $return = false, $render_assets = true)
  {
    if (!$view) {
      $view = $this->get_view();
    }
    if (!empty($this->get_assets()) && $render_assets) {
      $this->plugin->print_assets(...$this->get_assets());
    }
    $this->plugin->get_view()->render($view, $data, $return);
  }
}
