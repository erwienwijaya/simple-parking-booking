<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="UserLogin",
     *      summary="Users Login",
     *      tags={"Users"},
     *
     *      @OA\Parameter(
     *          name="email",
     *          description="email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="password",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *               @OA\Property(
     *                   format="string",
     *                   title="message",
     *                   default="Success",
     *                   description="Success",
     *                   property="message"),
     *               @OA\Property(
     *                   format="string",
     *                   title="token",
     *                   default="7|p2E0XEiTJBh07vcFgjAvZeQ71msi2qD2NZFEIBsl",
     *                   description="token",
     *                   property="token"),
     *               @OA\Property(
     *                  property="user",
     *                  type="array",
     *                  example={
     *                      "id": 1,
     *                      "name": "demo",
     *                      "email": "demo@parking.id",
     *                      "email_verified_at": null,
     *                      "created_at": "2021-11-18T12:52:12.000000Z",
     *                      "updated_at": "2021-11-18T12:52:12.000000Z"
     *                   },
     *                   @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="email_verified_at",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                      ),
     *                      @OA\Property(
     *                         property="updated_at",
     *                         type="datetime",
     *                      )
     *                  ),
     *            )
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
     *
     */

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|max:200',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $validator['email'])
                            ->first();

        if (!$user || !Hash::check($validator['password'], $user->password)) {

            return response()->json([
                    'message' => 'Invalid Credentials'
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $token = $user->createToken('SimpleParkingTokenLogin')->plainTextToken;

        $response = [
            'message' => 'Success',
            'user' => $user,
            'token' => $token
        ];

        return response()->json(
            $response,
            Response::HTTP_UNAUTHORIZED
        );

    }

    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="UserRegister",
     *      summary="Users Register",
     *      tags={"Users"},
     *
     *      @OA\Parameter(
     *          name="name",
     *          description="name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="email",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="password",
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
     *          @OA\JsonContent(
     *              type="object",
     *               @OA\Property(
     *                   format="string",
     *                   title="message",
     *                   default="New user created",
     *                   description="Success",
     *                   property="message"),
     *               @OA\Property(
     *                   format="string",
     *                   title="token",
     *                   default="7|p2E0XEiTJBh07vcFgjAvZeQ71msi2qD2NZFEIBsl",
     *                   description="token",
     *                   property="token"),
     *               @OA\Property(
     *                  property="user",
     *                  type="array",
     *                  example={
     *                      "id": 1,
     *                      "name": "demo",
     *                      "email": "demo@parking.id",
     *                      "created_at": "2021-11-18T12:52:12.000000Z",
     *                      "updated_at": "2021-11-18T12:52:12.000000Z"
     *                   },
     *                   @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                      ),
     *                      @OA\Property(
     *                         property="updated_at",
     *                         type="datetime",
     *                      )
     *                  ),
     *            )
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
     *
     */
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:200|unique:users,email',
            'password' => 'required|string'
        ]);

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);

        $token = $user->createToken('SimpleParkingToken')->plainTextToken;

        $response = [
            'message' => 'New user created',
            'user' => $user,
            'token'=> $token
        ];

        return \response()->json($response,
                                Response::HTTP_CREATED);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return \response(
            ['message' => 'Logged out successfuly'],
            Response::HTTP_OK
        );
    }

}
