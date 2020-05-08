<?php

namespace Wpify\Core;

abstract class Controller extends Component
{
  private $assets = [];

  public function setup()
  {
    $this->add_assets($this->assets);
  }

  public function add_asset($asset)
  {
    $this->plugin->get_assets()->add_asset($asset);
  }

  public function add_assets($assets)
  {
    $this->plugin->get_assets()->add_assets($assets);
  }

  public function print_styles($handles)
  {
    $this->plugin->get_assets()->print_styles($handles);
  }

  /**
   * @return array
   */
  public function get_assets(): array
  {
    return $this->assets;
  }

  /**
   * @param array $assets
   */
  public function set_assets(array $assets): void
  {
    $this->assets = $assets;
  }

}
