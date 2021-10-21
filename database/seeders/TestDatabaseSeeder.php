<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BaySeeder::class,
            PriceSeeder::class,
            TestBookingSeeder::class
        ]);
    }
}
