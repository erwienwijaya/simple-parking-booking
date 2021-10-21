<?php

namespace Tests\Unit;

use Tests\TestCase;

class BookingUnitTest extends TestCase
{

    public function test_post_booking_unavailable()
    {

        $expected = 'Sorry unavailable booking, please check another bay!';

        $data = [
            'bay_id' => 1,
            'carnumber' => 'L701K'
        ];

        $actual = $this->post('api/booking',$data)
                        ->getOriginalContent();

        $this->assertEquals($expected,$actual['message']);

    }

    public function test_post_booking_car_already_on_bay()
    {
        $expected = 'The Car already on bay!';

        $data = [
            'bay_id' => 1,
            'carnumber' => 'B911JK'
        ];

        $actual = $this->post('api/booking',$data)
            ->getOriginalContent();

        $this->assertEquals($expected,$actual['message']);
    }

    public function test_put_payment_success()
    {
        $expected = 'Available for booking';
        $actual = $this->put('api/booking/N414KI')
            ->getOriginalContent();

        $this->assertEquals($expected,$actual['message']);
    }

}
