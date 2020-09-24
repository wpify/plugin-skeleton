<?php


namespace WpifyPlugin\Managers;

use WpifyPlugin\Blocks\TestBlock;
use Wpify\Core_2_0\Abstracts\AbstractManager;
use WpifyPlugin\Plugin;

/** @property Plugin $plugin */
class BlocksManager extends AbstractManager
{
  protected $modules = [
    TestBlock::class
  ];

  public function setup()
  {
    add_action('admin_enqueue_scripts', [$this, 'gutenberg_script']);
    add_filter('block_categories', [$this, 'block_categories'], 10, 2);
  }

  public function block_categories($categories, $post)
  {
    return array_merge($categories, [
      [
        'slug' => 'wpify-plugin',
        'title' => __('wpify-plugin', 'wpify-plugin'),
        'icon' => 'wordpress',
      ],
    ]);
  }

  public function gutenberg_script()
  {
    $scripts = $this->plugin->get_assets()->get_manifest_asset(
      'block-editor.js',
      'wpify-plugin-block-editor',
      []
    );

    $this->plugin->get_assets()->enqueue_assets($scripts);
  }
}
