<?php

namespace Wpify\Repositories;

use Wpify\Core\AbstractPostTypeRepository;
use Wpify\Cpt\MyPostType;

class MyPostTypeRepository extends AbstractPostTypeRepository
{
  public function post_type(): MyPostType
  {
    return $this->plugin->get_cpt(MyPostType::class);
  }
}
