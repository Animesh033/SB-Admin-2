<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Billings\Billing;
use App\Models\Billings\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->count(3)
            ->hasAttached(
                Billing::factory()->count(1),
                ['billing_no' => now()->format('YmdHis')]
            )
            ->create();
    }
}