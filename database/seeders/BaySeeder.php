<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class BaySeeder extends Seeder
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
                'bayname' => "A",
                'capacity' => 1,
                'created_at' => now()
            ],
            [
                'bayname' => "B",
                'capacity' => 1,
                'created_at' => now()
            ],
            [
                'bayname' => "C",
                'capacity' => 1,
                'created_at' => now()
            ],
        ];
        DB::table('bays')->insert($posts);
    }
}
