<?php

namespace Wpify\Repositories;

use Wpify\Core\Component;
use Wpify\Models\Lecture;
use ComposePress\Core\Exception\Plugin;
use Doctrine\Common\Collections\ArrayCollection;

class LectureRepository extends Component
{
  public function find($args)
  {
  }

  /**
   * @return ArrayCollection|Lecture[]
   * @throws Plugin
   */
  public function all()
  {
    $collection = new ArrayCollection();
    $args = [
      'post_type'      => 'lecture',
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
    $prod = $this->plugin->create_component(Lecture::class, $id);
    $prod->init();

    return $prod;
  }
}
