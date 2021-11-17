<?php

namespace App\Http\Controllers;

use App\Models\Bay;
use App\Models\Booking;
use App\Models\PriceHour;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\isNull;
use App\Http\Resources\BookingResource;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/booking",
     *      operationId="bookingList",
     *      summary="Get Booking List",
     *      tags={"Booking"},
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/BookingViewResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiRequestException")
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Internal server error"
     *              )
     *          )
     *      )
     * )
     */

    public function index()
    {
        $booking = DB::select('SELECT * FROM booking_view');

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


    /**
     * @OA\Post(
     *      path="/booking",
     *      operationId="bookingCreated",
     *      summary="Booking Created",
     *      tags={"Booking"},
     *      security={{ "Bearer":{} }},
     *
     *      @OA\Parameter(
     *          name="bay_id",
     *          description="bay id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="carnumber",
     *          description="car number",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(ref="#/components/schemas/BookingResource")
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message-1",
     *                  type="string",
     *                  example="Sorry unavailable booking, please check another bay!"
     *              ),
     *              @OA\Property(
     *                  property="message-2",
     *                  type="string",
     *                  example="The Car already on bay!"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiRequestException")
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Internal server error"
     *              )
     *          )
     *      )
     * )
     *
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

    /**
     * @OA\Get(
     *      path="/booking-available",
     *      operationId="bookingAvailable",
     *      summary="Get Booking Available List",
     *      tags={"Booking"},
     *      security={{ "Bearer":{} }},
     *
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   format="string",
     *                   title="message",
     *                   default="Fully booked!",
     *                   description="message",
     *                   property="message"
     *               ),

     *         )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiRequestException")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Balance occupied"
     *              ),
     *             @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  example={
     *                      {
     *                           "bayname": "A",
     *                           "balance": 1
     *                      },
     *                      {
     *                          "bayname": "B",
     *                          "balance": 1
     *                      },
     *                      {
     *                          "bayname": "C",
     *                          "balance": 1
     *                      }
     *                  },
     *                  @OA\Items(
     *                      @OA\Property(
     *                         property="bayname",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="balance",
     *                         type="integer",
     *                         example=""
     *                      ),
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Internal server error"
     *              )
     *          )
     *      )
     * )
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

    /**
     * @OA\Put(
     *      path="/booking/{car_number}",
     *      operationId="bookingUpdated",
     *      summary="Booking Updated",
     *      tags={"Booking"},
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *         name="car_number",
     *         in="path",
     *         description="car number",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Available for booking"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  example={
     *                      "id": 2,
     *                      "bay_id": 2,
     *                      "price_id": 5,
     *                      "carnumber": "N414KI",
     *                      "startsession": "2021-10-22 11:39:44",
     *                      "endsession": "2021-11-16T13:15:03.678097Z",
     *                      "occupied": false,
     *                      "created_at": null,
     *                      "updated_at": "2021-11-16T13:15:03.000000Z"
     *                  },
     *                  @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="bay_id",
     *                         type="integer",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="price_id",
     *                         type="integer",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="carnumber",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="startsession",
     *                         type="datetime",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="endsession",
     *                         type="datetime",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="occupied",
     *                         type="boolean",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="updated_at",
     *                         type="datetime",
     *                         example=""
     *                      )
     *                   )
     *                 )
     *             )
     *
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiRequestException")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiNotFoundException")
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Internal server error"
     *              )
     *          )
     *      )
     *
     * )
     */

    public function update(Request $request, string $car_number)
    {
        /*Check by car number */
        $booking = Booking::where('carnumber','=',$car_number)
                            ->first();

        if ($booking == null) {
            $resError = [
                'message' => 'Car number not found!'
            ];

            return response()->json($resError,
                Response::HTTP_NOT_FOUND);
        }

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

}
