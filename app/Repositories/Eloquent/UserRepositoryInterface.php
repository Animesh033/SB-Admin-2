<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
   public function all(): Collection;
}