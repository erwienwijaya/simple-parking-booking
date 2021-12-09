<?php

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
     *      )
     * )
     */

    /**
     * @OA\Post(
     *      path="/booking",
     *      operationId="bookingCreated",
     *      summary="Booking Created",
     *      tags={"Booking"},
     *      security={{ "Bearer":{} }},
     *
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="array",
     *              example={
     *                 "bay_id": 1,
     *                 "carnumber": "L181KL"
     *              },
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="bay_id",
     *                      type="integer",
     *                  ),
     *                  @OA\Property(
     *                      property="carnumber",
     *                      type="string",
     *                  )
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(ref="#/components/schemas/BookingResource")
     *      )
     * )
     *
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
     *      )
     * )
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
     *      )
     *
     * )
     */
