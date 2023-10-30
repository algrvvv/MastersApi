<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function signup(Request $request)
    {
        $attrs = Validator::make($request->all(), [
            'username' => ['required', 'unique:users,username'],
            'password' => ['required'],
        ]);

        if ($attrs->fails()) {
            return response()->json(
                [
                    'error' => [
                        'message' => $attrs->errors()
                    ],
                ],
                401,
                ["Content-Type" => "application/json"]
            );
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(
            [
                "data" => [
                    "message" => "Administrator created"
                ]
            ],
            200,
            ["Content-Type" => "application/json"]
        );
    }
}
