<?php


namespace WpifyPlugin\Managers;

use WpifyPlugin\Blocks\TestBlock;
use Wpify\Core\AbstractManager;
use WpifyPlugin\Plugin;

/** @property Plugin $plugin */
class BlockManager extends AbstractManager
{
  protected $modules = [
    TestBlock::class
  ];

  public function setup()
  {
    add_action('admin_enqueue_scripts', [$this, 'gutenberg_script']);
    add_filter( 'block_categories', [$this, 'block_categories'], 10, 2 );
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
    $script = $this->plugin->get_assets()->asset('block-editor.js');
    $deps = [
      'wp-dom-ready',
      'wp-blocks',
      'wp-i18n',
      'wp-block-editor',
      'wp-element',
    ];

    wp_enqueue_script('wpify-blocks', $script, $deps, null);
  }
}
