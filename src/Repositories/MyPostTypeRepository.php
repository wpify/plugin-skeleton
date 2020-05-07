<?php


namespace Wpify\Repositories;


use Wpify\Cpt\MyPostType;
use Wpify\Models\MyPost;

class MyPostTypeRepository extends CptRepository
{
  public function __construct()
  {
    $this->set_post_type(MyPostType::NAME);
    $this->set_model(MyPost::class);
  }
}
