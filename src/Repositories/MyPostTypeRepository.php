<?php

namespace Wpify\Repositories;

use Wpify\Core\PostTypeRepository;
use Wpify\Cpt\MyPostType;

class MyPostTypeRepository extends PostTypeRepository
{
  public function __construct(MyPostType $post_type)
  {
    $this->set_post_type($post_type);
  }
}
