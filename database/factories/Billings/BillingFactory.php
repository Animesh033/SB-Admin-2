<?php

namespace Database\Factories\Billings;

use App\Models\Billings\Billing;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Billing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'width' =>  random_int(10,100),
            'height' =>  random_int(40,100),
            'shutter' =>  random_int(1,10),
            'sq_feet' =>  random_int(15,50),
            'net' =>  random_int(1,5),
            'rate' =>  random_int(180,300),
            'amount' =>  random_int(100,1000),
            // 'billing_no' =>  random_int(100000,999999),
        ];
    }
}
