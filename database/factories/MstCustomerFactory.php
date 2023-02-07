<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MstCustomer>
 */
class MstCustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_name' => fake()->name,
            'email' => preg_replace('/@example\..*/', '@gmail.com', fake()->unique()->safeEmail),
            'tel_num' => fake()->numerify('##########'),
            'address' => fake()->text,
        ];
    }
}
