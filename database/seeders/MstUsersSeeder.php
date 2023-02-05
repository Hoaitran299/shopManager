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
            'password'=> Hash::make('123'), 
            'group_role'=>'Editor'
        ]);
    }
}
