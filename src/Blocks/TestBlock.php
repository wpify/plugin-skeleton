<?php
namespace Wpify\Blocks;

use Wpify\Core\AbstractComponent;

class TestBlock extends AbstractComponent
{
  public function name(): string
  {
    return 'wpify/test-block';
  }

  public function register(): void
  {
    register_block_type($this->name(), [
      'render_callback' => [$this, 'render'],
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
