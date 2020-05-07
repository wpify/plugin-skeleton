<?php

namespace Wpify\Core;

use Wpify\Core\Component;
use ComposePress\Core\Exception\Plugin;
use Doctrine\Common\Collections\ArrayCollection;
use Wpify\Core\PostType;

abstract class PostTypeRepository extends Component
{
  /** @var \WPify\Core\PostType */
  private $post_type;

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
      'post_type'      => $this->post_type->name,
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
   * @return PostTypeModel
   */
  public function get($id)
  {
    $model = $this->plugin->create_component($this->post_type->model, $id);
    $model->init();

    return $model;
  }

  /**
   * @param PostType $post_type
   */
  public function set_post_type(PostType $post_type): void
  {
    $this->post_type = $post_type;
  }

  /**
   * @return PostType
   */
  public function get_post_type()
  {
    return $this->post_type;
  }

  /**
   * @return string
   */
  public function get_model()
  {
    return $this->post_type->get_model();
  }
}
