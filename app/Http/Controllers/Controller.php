<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    /**
     * @OA\OpenApi(
     *      @OA\Server(
     *          url="/api"
     *      ),
     *      @OA\Info(
     *          title="Simple Parking Booking",
     *          version="1.0",
     *          description="API Documentation"
     *      )
     * )
     */

    /**
     *@OA\Tag(name="Booking", description="Authorize required")
     */

    /**
     * @OA\SecurityScheme(
     *       scheme="Bearer",
     *       securityScheme="Bearer",
     *       type="apiKey",
     *       in="header",
     *       name="Authorization",
     * )
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
