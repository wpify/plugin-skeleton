<?php

namespace Wpify\Models;

use Wpify\Repositories\CptModel;

class MyPost extends CptModel
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
    } elseif (is_a($this->id, '\WP_Post')) {
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