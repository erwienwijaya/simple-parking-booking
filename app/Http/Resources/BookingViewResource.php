<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BookingViewResource
 * @package app\Http\Resources
 * @OA\Schema(
 * )
 */
class BookingViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    /**
     *         @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  example={{
     *                      "bayname": "A",
     *                      "capacity": 1,
     *                      "carnumber": "L181KL",
     *                      "startsession": "2021-10-22 11:39:44",
     *                      "endsession": "2021-10-22 11:39:44",
     *                      "occupied": true,
     *                      "price": "0"
     *                      }, {
     *                      "bayname": "",
     *                      "capacity": 0,
     *                      "carnumber": "",
     *                      "startsession": "",
     *                      "endsession": "",
     *                      "occupied": true,
     *                      "price": ""
     *                  }},
     *                  @OA\Items(
     *                      @OA\Property(
     *                         property="bayname",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="capacity",
     *                         type="number",
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
     *                         property="price",
     *                         type="float",
     *                         example=""
     *                      )
     *                  ),
     *
     *              ),
     *         @OA\Property(
     *                   format="string",
     *                   title="message",
     *                   default="List booking successful",
     *                   description="message",
     *                   property="message"),
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
