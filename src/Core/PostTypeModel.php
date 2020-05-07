<?php

namespace Wpify\Core;

use Wpify\Core\Component;
use Wpify\Core\Interfaces\PostTypeModelInterface;

abstract class PostTypeModel extends Component implements PostTypeModelInterface
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
