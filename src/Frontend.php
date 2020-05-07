<?php


namespace Wpify;


use Wpify\Core\Component;

class Frontend extends Component
{
  public function setup()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
    add_action('wp_footer', [$this, 'print_react_root']);
  }

  public function enqueue_frontend_scripts()
  {
    $vendors = $this->plugin->asset('vendors~plugin.js');
    $vendors_deps = [];

    $main = $this->plugin->asset('plugin.js');
    $main_deps = ['react', 'react-dom', 'wp-i18n'];

    if ($vendors) {
      wp_enqueue_script('wpify-vendors', $vendors, $vendors_deps, null, true);
      $main_deps[] = 'wpify-vendors';
    }

    if ($main) {
      wp_enqueue_script('wpify', $main, $main_deps, null, true);

      wp_localize_script('wpify', 'wpify', [
        'publicPath' => $this->plugin->get_asset_url('build/'),
        'restUrl' => $this->plugin->get_api_manager()->get_rest_url(),
        'nonce' => wp_create_nonce($this->plugin->get_api_manager()->get_nonce_action()),
      ]);
    }
  }

  public function print_react_root()
  {
    echo '<div id="react-root"></div>';
  }
}
