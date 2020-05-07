<?php

namespace Wpify\Repositories;

use Wpify\Core\Component;
use ComposePress\Core\Exception\Plugin;
use Doctrine\Common\Collections\ArrayCollection;

abstract class CptRepository extends Component
{
  private $post_type;
  private $model;

  public function find($args)
  {
  }

  /**
   * @return ArrayCollection
   * @throws Plugin
   */
  public function all()
  {
    $collection = new ArrayCollection();
    $args       = [
      'post_type'      => $this->post_type,
      'posts_per_page' => -1,
    ];
    foreach (get_posts($args) as $item) {
      $collection->add($this->get($item));
    }

    return $collection;
  }

  /**
   * @param $id
   *
   * @return Lecture
   * @throws Plugin
   */
  public function get($id)
  {
    $prod = $this->plugin->create_component($this->model, $id);
    $prod->init();

    return $prod;
  }

  /**
   * @param mixed $post_type
   */
  public function set_post_type($post_type): void
  {
    $this->post_type = $post_type;
  }

  /**
   * @param mixed $model
   */
  public function set_model($model): void
  {
    $this->model = $model;
  }

  /**
   * @return mixed
   */
  public function get_post_type()
  {
    return $this->post_type;
  }

  /**
   * @return mixed
   */
  public function get_model()
  {
    return $this->model;
  }
}
