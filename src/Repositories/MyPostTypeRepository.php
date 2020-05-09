<?php

namespace Wpify\Repositories;

use Wpify\Core\PostType;
use Wpify\Core\PostTypeRepository;
use Wpify\Cpt\MyPostType;

class MyPostTypeRepository extends PostTypeRepository
{
  public function post_type()
  {
    return $this->plugin->get_cpt(MyPostType::class);
  }
}
