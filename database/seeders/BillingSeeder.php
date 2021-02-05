<?php

namespace Database\Seeders;

use App\Models\Billings\Billing;
use Illuminate\Database\Seeder;

class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Billing::factory()->create();
    }
}
