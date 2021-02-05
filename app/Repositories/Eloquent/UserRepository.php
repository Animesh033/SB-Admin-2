<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Collection;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\Eloquent\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();
   }
}
