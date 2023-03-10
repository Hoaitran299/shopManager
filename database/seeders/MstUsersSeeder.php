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
            'name' => 'Admin',
            'email' => 'admin@gmail.com', 
            'password'=> Hash::make('Admin123'), 
            'group_role'=>'Admin'
        ]);
    }
}
