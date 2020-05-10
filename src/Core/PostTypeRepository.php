<?php

namespace Wpify\Core;

use Wpify\Core\Component;
use ComposePress\Core\Exception\Plugin;
use Doctrine\Common\Collections\ArrayCollection;
use Wpify\Core\Interfaces\PostTypeModelInterface;
use Wpify\Core\Interfaces\RepositoryInterface;
use Wpify\Core\PostType;

abstract class PostTypeRepository extends Component implements RepositoryInterface
{
  /** @var \WPify\Core\PostType */
  private $post_type;

  private $query;

  public function setup()
  {
    $this->post_type = $this->post_type();
  }

  public function find($args)
  {
  }

  /**
   * @return ArrayCollection
   * @throws Plugin
   */
  public function all(): ArrayCollection
  {
    $collection = new ArrayCollection();
    $args       = [
      'post_type'      => $this->post_type->get_name(),
      'posts_per_page' => -1,
    ];

    $this->query = new \WP_Query($args);

    // The Loop
    while ($this->query->have_posts()) {
      $this->query->the_post();
      global $post;
      $collection->add($this->get($post));
    }
    wp_reset_postdata();

    return $collection;
  }

  /**
   * @param $id
   *
   * @return PostTypeModel
   */
  public function get($id): PostTypeModelInterface
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

  /**
   * @return mixed
   */
  public function get_query()
  {
    return $this->query;
  }

  abstract public function post_type();
}
