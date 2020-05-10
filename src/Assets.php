<?php

namespace Wpify;

class Assets extends Core\Assets
{

  public function assets(): array
  {
    $assets       = [
      [
        'handle'  => 'home',
        'file'    => $this->plugin->get_asset_url('assets/home.css'),
        'preload' => true,
        'enqueue' => is_home(),
      ],
    ];
    $vendors      = $this->asset('vendors~plugin.js');
    $vendors_deps = [];

    $main      = $this->asset('plugin.js');
    $main_deps = ['react', 'react-dom', 'wp-i18n'];

    if ($vendors) {
      $assets[] = [
        'handle' => 'wpify-vendors',
        'file'   => $vendors,
        'deps'   => $vendors_deps,
      ];

      $main_deps[] = 'wpify-vendors';
    }

    if ($main) {
      $assets[] = [
        'handle'   => 'wpify',
        'file'     => $main,
        'deps'     => $main_deps,
        'localize' => [
          'wpify' => [
            'publicPath' => $this->plugin->get_asset_url('build/'),
            'restUrl'    => $this->plugin->get_api_manager()->get_rest_url(),
            'nonce'      => wp_create_nonce($this->plugin->get_api_manager()->get_nonce_action()),
          ],
        ],
      ];
    }

    return $assets;
  }
}
