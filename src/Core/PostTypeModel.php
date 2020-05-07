<?php

namespace Wpify\Core;

use Wpify\Core\Component;

abstract class PostTypeModel extends Component
{
  private $id;

  /**
   * @return mixed
   */
  public function get_id()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function set_id($id)
  {
    $this->id = $id;
  }
}
