<?php

namespace Database\Factories\Billings;

use App\Models\Billings\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'address' => $this->faker->name,
            'contact_no' => random_int(1000000000,9999999999)
        ];
    }
}
