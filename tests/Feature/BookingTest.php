<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function add_seed_created()
    {
        $this->seed(TestDatabaseSeeder::class);
    }

    public function test_get_booking_list()
    {
        $this->get('api/booking')
            ->assertStatus(200);
    }

    public function test_post_new_booking()
    {
        $data = [
            'bay_id' => 3,
            'carnumber' => 'B991K'
        ];

        $this->post('api/booking',$data)
            ->assertStatus(201);
    }

    public function test_post_new_booking_unavailable()
    {
        $data = [
            'bay_id' => 1,
            'carnumber' => 'L701K'
        ];

        $this->post('api/booking',$data)
            ->assertStatus(422);
    }

    public function test_post_new_booking_car_already_on_bay()
    {
        $data = [
            'bay_id' => 1,
            'carnumber' => 'B911JK'
        ];

        $this->post('api/booking',$data)
            ->assertStatus(422);
    }

    public function test_new_booking_error_validating()
    {
        $data = [
            'carnumber' => 'H8270FP'
        ];

        $this->post('api/booking',$data)
            ->assertStatus(422);
    }

    public function test_put_payment()
    {
        $this->put('api/booking/N414KI')
            ->assertStatus(200);
    }

    public function test_put_paymentcar_number_not_found()
    {
        $this->put('api/booking/L902RT')
            ->assertStatus(404);
    }

    public function test_get_booking_available_list()
    {
        $this->get('api/booking-available')
            ->assertStatus(200);
    }

}
