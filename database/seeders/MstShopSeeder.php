<?php

namespace Database\Seeders;

use App\Models\MstShop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'shop_id' => '1',
                'shop_name' => 'Amazon',
            ], [
                'shop_id' => '2',
                'shop_name' => 'Yahoo',
            ],
            [
                'shop_id' => '3',
                'shop_name' => 'Rakuten',
            ]
        ];
        collect($data)->each(function ($item)
        {
            MstShop::create($item);
        });
    }
}
