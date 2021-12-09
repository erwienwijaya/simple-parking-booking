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
                Response::HTTP_NOT_ACCEPTABLE
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
            Response::HTTP_OK
        );

    }

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
