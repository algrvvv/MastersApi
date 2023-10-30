<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $attrs = Validator::make($request->all(), [
            "username" => ['required'],
            "password" => ["required"],
        ]);

        if ($attrs->fails()) {
            return response()->json(
                [
                    "message" => "Validation error",
                    "errors" => $attrs->errors()
                ],
                401,
                ["content-type" => "application/json"]
            );
        }

        $credentials = $request->only("username","password");

        if(!auth()->attempt($credentials)){
            return response()->json(
                [
                    "message" => "Unauthorized",
                    "errors"  => [
                        "login" => "Invalid credentials"
                    ]
                ],
                401,
                ["Content-type" => "application/json"]
            );
        }

        $user = User::find($request->user()->id);
        //$user = User::where('email', $request->email)->first();

        $adminToken = $user->createToken("admin-token", ["token:main"])->plainTextToken;

        return response()->json(
            [
                "data" => [
                    "token_user" => $adminToken
                ]
            ],
            200,
            ["content-type" => "application/json"]
        );
    }
}
