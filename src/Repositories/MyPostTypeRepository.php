<?php

namespace Wpify\Repositories;

use Wpify\Core\PostType;
use Wpify\Core\PostTypeRepository;
use Wpify\Cpt\MyPostType;

class MyPostTypeRepository extends PostTypeRepository
{
  function post_type(): PostType
  {
    return $this->plugin->get_cpt(MyPostType::class);
  }
}
