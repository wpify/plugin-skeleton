<?php

namespace WpifyPlugin;

use WpifyPluginDeps\Wpify\Core\Abstracts\AbstractComponent;

class Frontend extends AbstractComponent {

  public function setup() {
    add_action( 'wp_footer', array( $this, 'print_react_root' ) );
  }

  /**
   * Prints React root div
   */
  public function print_react_root() {
    echo '<div id="react-root"></div>';
  }
}
