<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MstProduct>
 */
class MstProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arr = array(0,1);
        return [
            'product_id' => 'S' . fake()->numerify('#########'),
            'product_name' => fake()->name,
            'product_price' => fake()->numerify('###'),
            'is_sales' => $arr[array_rand($arr)],
            'description' => fake()->text,
        ];
    }
}
