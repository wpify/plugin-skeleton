<?php
namespace Wpify\Blocks;

use Wpify\Core\AbstractBlock;

class TestBlock extends AbstractBlock
{
  public function name(): string
  {
    return 'wpify/test-block';
  }

  public function register(): void
  {
    register_block_type($this->name(), [
      'render_callback' => [$this, 'render'],
      'editor_script'   => $this->plugin->get_assets()->register_manifest_asset('blocks-test-backend.js'),
      'editor_style'    => $this->plugin->get_assets()->register_manifest_asset('blocks-test-backend.css'),
    ]);
  }

  public function attributes(): array
  {
    return [
      'content' => [
        'type' => 'string',
      ],
    ];
  }

  public function render($block_attributes, $content)
  {
    return print_r([
      'block_attributes' => $block_attributes,
      'content' => $content,
    ], true);
  }
}
