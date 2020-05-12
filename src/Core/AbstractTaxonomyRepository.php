<?php

namespace Wpify\Core;

use Doctrine\Common\Collections\ArrayCollection;
use Wpify\Core\AbstractComponent;
use Wpify\Core\Interfaces\RepositoryInterface;

abstract class AbstractTaxonomyRepository extends AbstractComponent implements RepositoryInterface
{
  /** @var \WPify\Core\Taxonomy */
  private $taxonomy;

  abstract public function taxonomy();

  public function setup()
  {
    $this->taxonomy = $this->taxonomy();
  }

  /**
   * @param Taxonomy $taxonomy
   */
  public function set_taxonomy(AbstractTaxonomy $taxonomy): void
  {
    $this->taxonomy = $taxonomy;
  }

  /**
   * @return Taxonomy
   */
  public function get_taxonomy()
  {
    return $this->taxonomy;
  }

  /**
   * @return string
   */
  public function get_model()
  {
    return $this->taxonomy->get_model();
  }

  public function get($term): AbstractTermModel
  {
    $model = $this->plugin->create_component($this->taxonomy->model, $term, $this->taxonomy->get_name());
    $model->init();

    return $model;
  }

  /**
   * @return ArrayCollection&AbstractTermModel[]
   */
  public function all(): ArrayCollection
  {
    $collection = new ArrayCollection();
    $args       = [
      'taxonomy'   => $this->taxonomy->get_name(),
      'hide_empty' => -1,
    ];

    $terms = get_terms($args);

    foreach ($terms as $term) {
      $collection->add($this->get($term));
    }

    return $collection;
  }
}
