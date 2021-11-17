<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BookingResource
 * @package app\Http\Resources
 * @OA\Schema(
 * )
 */

class BookingResource extends JsonResource
{
    /**
     *         @OA\Property(
     *                   format="string",
     *                   title="message",
     *                   default="Occupied",
     *                   description="message",
     *                   property="message"),
     *         @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  example={
     *                      "id": 1,
     *                      "bay_id": 1,
     *                      "carnumber": "L181KL",
     *                      "startsession": "2021-10-22 11:39:44",
     *                      "endsession": "2021-10-22 11:39:44",
     *                      "updated_at": "2021-11-16T06:56:38.000000Z",
     *                      "created_at": "2021-11-16T06:56:38.000000Z",
     *                      "price_id": 1
     *                      },
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
     *                         property="price_id",
     *                         type="float",
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
     *                  ),
     *
     *              )
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
