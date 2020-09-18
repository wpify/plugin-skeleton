<?php

namespace WpifyPlugin;

use Wpify\Core\Abstracts\AbstractAssets;

/**
 * @property Plugin $plugin
 */
class Assets extends AbstractAssets
{

  public function assets(): array
  {
    $assets = array_merge(
      $this->get_manifest_asset('plugin.js', 'wpify-plugin', [
        'wpify' => [
          'publicPath' => $this->plugin->get_asset_url('build/'),
          'restUrl'    => $this->plugin->get_api_manager()->get_rest_url(),
          'nonce'      => wp_create_nonce($this->plugin->get_api_manager()->get_nonce_action()),
          'state'      => [
            'app' => [
              'name' => get_transient('wpify_app_name'),
            ],
          ],
        ],
      ]),
      $this->get_manifest_asset('home.css', 'wpify-home'),
      $this->get_manifest_asset('some-module.css', 'wpify-some-module'),
      $this->get_manifest_asset('button.js', 'wpify-button')
    );

    return $assets;
  }
}
