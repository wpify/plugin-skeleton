<?php

namespace Wpify\Repositories;

use Wpify\Core\PostTypeRepository;
use Wpify\Cpt\MyPostType;

class MyPostTypeRepository extends PostTypeRepository
{
  public function setup()
  {
    $this->set_post_type($this->plugin->get_cpt_manager()->get_module(MyPostType::class));
  }
}
