<?php

namespace Wpify\Core;

use Wpify\Core\Component;
use Wpify\Core\Interfaces\PostTypeModelInterface;

abstract class PostTypeModel extends Component implements PostTypeModelInterface
{
  /** @var \WP_Post */
  private $post;

  /**
   * @return mixed
   */
  public function __construct($post, $filter = null)
  {
    $this->post = get_post($post, null, $filter);
  }

  public function get_post()
  {
    return $this->post;
  }

  /**
   * @param int $id
   */
  public function get_id()
  {
    $this->post->ID ?? null;
  }
}
