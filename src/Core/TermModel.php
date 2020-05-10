<?php

namespace Wpify\Core;

use Wpify\Core\Component;
use Wpify\Core\Interfaces\PostTypeModelInterface;

abstract class TermModel extends Component implements PostTypeModelInterface
{
  private $term;

  /**
   * @return mixed
   */
  public function __construct($term, $taxonomy, $filter = null)
  {
    $this->post = get_term($term, $taxonomy, null, $filter);
  }

  public function get_term()
  {
    return $this->term;
  }

  /**
   * @param int $id
   */
  public function get_id()
  {
    $this->term->term_id ?? null;
  }
}
