<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function register(StoreClientRequest $request)
    {
        Client::create($request->all());

        return response()->json([
            "data" => [
                "message" => "Created"
            ]
        ]);
    }
}
