<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema()
 */
class ApiNotFoundException extends ApiException
{
    /**
     * The err message
     * @var string
     *
     * @OA\Property(
     *   property="message",
     *   type="string",
     *   example="Car number not found"
     * )
     */
    public function __construct(string $message = null)
    {
        parent::__construct(self::NO_FOUND_ERROR, $message ?? Response::$statusTexts[self::NO_FOUND_ERROR]);
    }
}
