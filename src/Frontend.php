<?php

namespace Wpify;

use Wpify\Core\Assets;
use Wpify\Core\Component;
use Wpify\Repositories\MyPostTypeRepository;

class Frontend extends Component
{
  /**
   * @var Assets
   */
  private $assets;

  public function __construct(Assets $assets)
  {
    $this->assets = $assets;
  }
  public function setup()
  {
    $this->register_frontend_scripts();
    add_action('wp_footer', [$this, 'print_react_root']);
    add_action('wp_footer', [$this, 'test']);
  }

  public function register_frontend_scripts()
  {
    $vendors      = $this->assets->asset('vendors~plugin.js');
    $vendors_deps = [];

    $main      = $this->assets->asset('plugin.js');
    $main_deps = ['react', 'react-dom', 'wp-i18n'];

    if ($vendors) {
      $this->assets->add_asset(
        [
          'handle' => 'wpify-vendors',
          'file' => $vendors,
          'deps' => $vendors_deps
        ]
      );
      $main_deps[] = 'wpify-vendors';
    }

    if ($main) {
      $this->assets->add_asset(
        [
          'handle' => 'wpify',
          'file' => $main,
          'deps' => $main_deps,
          'localize' => [
            'wpify' => [
              'publicPath' => $this->plugin->get_asset_url('build/'),
              'restUrl' => $this->plugin->get_api_manager()->get_rest_url(),
              'nonce' => wp_create_nonce($this->plugin->get_api_manager()->get_nonce_action()),
            ]
          ]
        ]
      );
    }
  }

  public function print_react_root()
  {
    echo '<div id="react-root"></div>';
  }

  public function test()
  {
    $repository = $this->plugin->get_repository(MyPostTypeRepository::class);
    $myposts    = $repository->all();

    echo '<pre>';
    var_dump($myposts);
    echo '</pre>';
  }
}
