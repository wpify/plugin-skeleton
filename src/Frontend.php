<?php


namespace Wpify;


use Wpify\Core\Component;

class Frontend extends Component
{
  public function setup()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
  }

  public function enqueue_frontend_scripts()
  {
    wp_enqueue_style('wpify', $this->plugin->asset('plugin.css'), [], '');
    wp_enqueue_script('wpify', $this->plugin->asset('plugin.js'), ['react', 'react-dom'], '', true);
  }
}
