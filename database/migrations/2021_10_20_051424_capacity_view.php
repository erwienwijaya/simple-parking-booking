<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CapacityView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW capacity_view
            AS
            WITH cte AS
            (
             SELECT
                distinct bay_id,
                count(bay_id) AS total
             FROM bookings
             WHERE occupied=true
             GROUP BY bay_id
             )

             SELECT
                a.bayname,
                (a.capacity - COALESCE(b.total,0)) AS balance
             FROM bays a
             LEFT JOIN cte b ON a.id=b.bay_id
             ORDER BY a.id ASC
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capacity_view');
    }
}
