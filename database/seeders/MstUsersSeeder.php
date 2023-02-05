<?php

namespace Database\Seeders;

use App\Models\MstUsers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MstUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MstUsers::create([
            'name' => 'test',
            'email' => 'test@gmail.com', 
            'password'=> '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'group_role'=>'manager'
        ]);
    }
}
