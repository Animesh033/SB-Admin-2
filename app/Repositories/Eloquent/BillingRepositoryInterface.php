<?php

namespace App\Repositories\Eloquent;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface BillingRepositoryInterface
{

   public function create(array $attributes): Model;

   public function find($id): ?Model;

   public function store(Request $request);

   public function getCategories(array $categoryIds=[]);
}
