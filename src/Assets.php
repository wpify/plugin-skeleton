<?php

namespace WpifyPlugin;

use Wpify\Core_4_0\Abstracts\AbstractAssets;

/**
 * @property Plugin $plugin
 */
class Assets extends AbstractAssets {

  public function assets(): array {
    $assets = array_merge(
      $this->plugin->get_webpack_manifest()->get_assets( 'plugin.js', 'wpify-plugin', array(
        'wpify' => array(
          'publicPath' => $this->plugin->get_asset_url( 'build/' ),
          'restUrl'    => $this->plugin->get_api_manager()->get_rest_url(),
          'nonce'      => wp_create_nonce( $this->plugin->get_api_manager()->get_nonce_action() ),
          'state'      => array(
            'app' => array(
              'name' => get_transient( 'wpify_app_name' ),
            ),
          ),
        ),
      ) ),
      $this->plugin->get_webpack_manifest()->get_assets( 'plugin.css' ),
      $this->plugin->get_webpack_manifest()->get_assets( 'home.css' ),
      $this->plugin->get_webpack_manifest()->get_assets( 'some-module.css' ),
      $this->plugin->get_webpack_manifest()->get_assets( 'button.js' )
    );

    return $assets;
  }
}
