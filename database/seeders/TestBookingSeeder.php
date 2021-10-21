<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestBookingSeeder extends Seeder
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
                'bay_id' => 1,
                'price_id' => 1,
                'carnumber' => 'B911JK',
                'startsession' => Carbon::now(),
                'endsession' => Carbon::now()
            ],
            [
                'bay_id' => 2,
                'price_id' => 1,
                'carnumber' => 'N414KI',
                'startsession' => Carbon::now(),
                'endsession' => Carbon::now()
            ]
        ];
        DB::table('bookings')->insert($posts);
    }
}
