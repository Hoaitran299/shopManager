<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MstUser>
 */
class MstUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arr = array('Admin', 'Editor', 'Reviewer');
        $arrNum = array(0,1);
        return [
            'name' => fake()->name,
            'group_role' => $arr[array_rand($arr)],
            'email' => preg_replace('/@example\..*/', '@gmail.com', fake()->unique()->safeEmail),
            'is_active' => $arrNum[array_rand($arrNum)],
            'is_delete' => $arrNum[array_rand($arrNum)],
            'password' => '$2y$10$l2Wtf8cin4haMqApAxh9X.Cxbg8svJWfQIKSBZ78DGHRu5Z2I2fti', // Admin123
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }
}
