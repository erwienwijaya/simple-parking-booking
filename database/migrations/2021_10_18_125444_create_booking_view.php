<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBookingView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW bookings_view
            AS
            SELECT
                b.bayname,
                b.capacity,
                bookings.carnumber,
                bookings.startsession,
                bookings.endsession,
                bookings.occupied,
                ph.price
            FROM
                bookings
                LEFT JOIN bays b on bookings.bay_id = b.id
                LEFT JOIN price_hours ph on bookings.price_id = ph.id
            ORDER BY bookings.created_at DESC;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_view');
    }
}
