<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'starttime' => 0,
                'endtime' => 60,
                'price' => 0,
                'created_at' => now()
            ],
            [
                'starttime' => 61,
                'endtime' => 120,
                'price' => 20,
                'created_at' => now()
            ],
            [
                'starttime' => 121,
                'endtime' => 180,
                'price' => 60,
                'created_at' => now()
            ],
            [
                'starttime' => 181,
                'endtime' => 240,
                'price' => 240,
                'created_at' => now()
            ],
            [
                'starttime' => 241,
                'endtime' => 0,
                'price' => 300,
                'created_at' => now()
            ]
        ];
        DB::table('price_hours')->insert($posts);
    }
}
