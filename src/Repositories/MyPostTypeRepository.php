<?php

namespace Wpify\Repositories;

use Wpify\Core\PostTypeRepository;
use Wpify\Cpt\MyPostType;

class MyPostTypeRepository extends PostTypeRepository
{
  public function __construct(MyPostType $my_post_type)
  {
    $this->set_post_type($my_post_type);
  }

}
