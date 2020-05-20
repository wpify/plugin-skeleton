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
  private $assets = [];

  /**
   * Set the view to render
   *
   * @param $view
   */
  public function set_view($view)
  {
    $this->view = $view;
  }

  /**
   * Set assets
   *
   * @param $assets
   */
  public function set_assets($assets)
  {
    $this->assets = $assets;
  }

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
      $view = $this->view;
    }
    if (!empty($this->assets) && $render_assets) {
      $this->plugin->print_assets(...$this->assets);
    }
    $this->plugin->get_view()->render($view, $data, $return);
  }
}
