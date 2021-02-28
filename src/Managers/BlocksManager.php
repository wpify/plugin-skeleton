<?php

namespace WpifyPlugin\Managers;

use WpifyPlugin\Blocks\TestBlock;
use WpifyPlugin\Plugin;
use Wpify\Core\Abstracts\AbstractManager;

/** @property Plugin $plugin */
class BlocksManager extends AbstractManager {
  protected $modules = array(
    TestBlock::class,
  );

  public function setup() {
    add_action( 'after_setup_theme', array( $this, 'editor_styles' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'gutenberg_script' ) );
    add_filter( 'block_categories', array( $this, 'block_categories' ), 10, 2 );
  }

  public function editor_styles() {
    add_theme_support( 'editor-styles' );
    add_theme_support( 'dark-editor-style' );

    /**
     * The file must be present in there directory. The SCSS for this file is in assets/editor-style.scss
     * and it's copied into theme directory by `copy` rule specified in `wpify.config.js`.
     */
    add_editor_style( 'editor-style.css' );
  }

  public function block_categories( $categories, $post ) {
    return array_merge(
      $categories,
      array(
        array(
          'slug'  => 'wpify-plugin',
          'title' => __( 'wpify-plugin', 'wpify-plugin' ),
          'icon'  => 'wordpress',
        ),
      )
    );
  }

  public function gutenberg_script() {
    $scripts = $this->plugin->get_webpack_manifest()->get_assets(
      'block-editor.js',
      'wpify-plugin-block-editor',
      array()
    );

    $this->plugin->get_assets()->enqueue_assets( $scripts );
  }
}
