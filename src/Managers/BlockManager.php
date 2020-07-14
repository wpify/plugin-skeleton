<?php


namespace Wpify\Managers;

use Wpify\Blocks\TestBlock;
use Wpify\Core\AbstractManager;
use Wpify\Plugin;

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
        'slug' => 'wpify',
        'title' => __('WPify', 'wpify'),
        'icon' => 'wordpress',
      ],
    ]);
  }

  public function gutenberg_script()
  {
    $scripts = $this->plugin->get_assets()->get_manifest_asset(
      'block-editor.js',
      'mojamiska-block-editor',
      []
    );

    $this->plugin->get_assets()->enqueue_assets($scripts);
  }
}
