<?php

namespace WpifyPlugin;

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
   * @param string $template
   * @param bool $return
   * @param bool $render_assets
   *
   * @throws \Exception
   */
  public function render($data = [], $template = '', $return = false, $render_assets = true)
  {
    if (!$template) {
      $template = $this->get_template();
    }
    if (!empty($this->get_assets()) && $render_assets) {
      $this->plugin->print_assets(...$this->get_assets());
    }
    $this->plugin->get_view()->render($template, $data, $return);
  }
}
