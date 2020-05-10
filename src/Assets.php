<?php

namespace Wpify;

class Assets extends Core\Assets
{

  public function assets(): array
  {
    $assets = [
      [
        'handle'  => 'home.css',
        'preload' => true,
        'load'    => is_home(),
      ],
      [
        'handle'  => 'some-module.css',
        'enqueue' => false,
      ],
    ];

    $vendors      = $this->asset('vendors~plugin.js');
    $vendors_deps = [];

    $main      = $this->asset('plugin.js');
    $main_deps = ['react', 'react-dom', 'wp-i18n'];

    if ($vendors) {
      $assets[] = [
        'handle' => 'vendors~plugin.js',
        'deps'   => $vendors_deps,
      ];

      $main_deps[] = 'vendors~plugin.js';
    }

    if ($main) {
      $assets[] = [
        'handle'   => 'plugin.js',
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
