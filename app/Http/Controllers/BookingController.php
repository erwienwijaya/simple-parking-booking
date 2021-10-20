<?php

namespace App\Http\Controllers;

use App\Models\Bay;
use App\Models\Booking;
use App\Models\PriceHour;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\isNull;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = DB::select('SELECT * FROM bookings_view');

        $response = [
            'message' => 'List booking successful',
            'data' => $booking
        ];

        return response()->json($response,Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Merge request from body*/
        $request->merge([
            'price_id' => 1,
            'startsession' => Carbon::now(),
            'endsession' => Carbon::now()
        ]);

        $validator = Validator::make($request->all(), [
            'bay_id' => ['required'],
            'carnumber' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*Validator: if car number is exists*/
        $checkNumber = DB::table('bookings')
                            ->where('carnumber','=',$request->carnumber)
                            ->where('occupied','=',true)
                            ->first();

        if ($checkNumber != null) {
            $resError = [
                'message' => 'The Car already on bay!'
            ];

            return response()->json($resError,
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*Count each bay*/
        $countBay = DB::table('bookings')
                            ->where('bay_id','=',$request->bay_id)
                            ->where('occupied','=',true)
                            ->count();

        /*Get capacity from bay*/
        $capacity = DB::table('bays')
                        ->select('capacity')
                        ->where('id','=',$request->bay_id)
                        ->get();

        foreach ($capacity as $r) {
            $countCapacity= $r->capacity;
        }

        /*Check capacity of bay*/
        if ($countBay >= $countCapacity) {
            $resError = [
                'message' => 'Sorry unavailable booking, please check another bay!'
            ];

            return response()->json($resError,
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            /*saving to storage*/
            $booking = Booking::create($request->all());

            $response = [
                'message' => 'Occupied',
                'data' => $booking
            ];

            return response()->json($response, Response::HTTP_CREATED);

        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Failed ' . $err->errorInfo
            ]);
        }
    }

    /**
     * Display booking-available
     * @return \Illuminate\Http\Response
     */
    public function availableBay()
    {
        $balance = DB::table('capacity_view')
                            ->get();

        if ($balance->sum('balance') == 0) {
            $resError = [
                'message' => 'Fully booked!'
            ];

            return response()->json($resError,
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $response = [
            'message' => 'Balance occupied',
            'data' => $balance
        ];

        return response()->json($response, Response::HTTP_OK);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $car_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $car_number)
    {
        /*Check by car number */
        $booking = Booking::where('carnumber','=',$car_number)
                            ->firstOrFail();

        /*Get integer difference in Minutes*/
        $start = new Carbon($booking->startsession);
        $end = Carbon::now();

        $diff_time = $start->diffInMinutes($end);

        /*Get price*/
        $price = DB::table('price_hours')
                        ->select('id')
                        ->where('starttime','<=',$diff_time)
                        ->where('endtime','>=',$diff_time)
                        ->first();

        /*if price not found on range then take a last/max from price_id */
        if ($price==null) {
            $price = PriceHour::all();
            $price = $price->max();
        }

        try {
            $request->merge(
                [
                    'price_id' => $price->id,
                    'occupied' => false,
                    'endsession' => Carbon::now()
                ]
            );
            /*update to storage*/
            $booking->update($request->all());

            $response = [
                'message' => 'Available for booking',
                'data' => $booking
            ];

            return response()->json($response, Response::HTTP_OK);

        } catch (QueryException $err) {
            return response()->json([
                'message' => 'Failed ' . $err->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
