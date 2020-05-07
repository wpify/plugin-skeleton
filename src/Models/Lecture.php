<?php

namespace Wpify\Models;

use WP_Post;
use Wpify\Core\Component;

class Lecture extends Component
{
  private $id;

  public function __construct($id)
  {
    $this->id = $id;
  }

  public function setup()
  {
    if (is_numeric($this->id)) {
      //
    } elseif (is_a($this->id, WP_Post::class)) {
      //
    }
    if ($this->id) {
      //
    }
  }

  /**
   * @return mixed
   */
  public function get_id()
  {
    return $this->id;
  }
}
