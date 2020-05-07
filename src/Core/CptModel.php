<?php

namespace Wpify\Repositories;

use Wpify\Core\Component;

abstract class CptModel extends Component
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
