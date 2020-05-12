<?php

namespace Wpify\Core;

use WP_Error;
use WP_Term;
use Wpify\Core\Interfaces\TermModelInterface;

abstract class AbstractTermModel extends AbstractComponent implements TermModelInterface
{
  private $term;

  /**
   * @param int $term
   * @param string $taxonomy
   * @param null $filter
   */
  public function __construct($term, $taxonomy, $filter = null)
  {
    $this->term = get_term($term, $taxonomy, null, $filter);
  }

  /**
   * Get single term
   * @return array|WP_Error|WP_Term|null
   */
  public function get_term()
  {
    return $this->term;
  }

  /**
   * Get term ID
   * @return int|null
   */
  public function get_id()
  {
    return $this->term->term_id ?? null;
  }
}
