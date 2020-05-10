<?php

namespace Wpify\Core\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;

interface RepositoryInterface
{
  public function all(): ArrayCollection;

  public function get($id);
}
