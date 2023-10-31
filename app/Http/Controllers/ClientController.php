<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
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

    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::find($id);

        if ($client == null) {
            return response()->json([
                "error" => [
                    "message" => "client not found"
                ]
            ], 403);
        }

        $client->update($request->all());

        return response()->json([
            "data" => [
                "id" => $id,
                "message" => "Updated"
            ]
        ], 200);
    }

    public function delete($id){
        $client = Client::find($id);

        if($client == null){
            return response()->json([
                "error"=> [
                    "message" => "Not found"
                ]
            ], 403);
        }

        $client->delete();

        return response()->json([
            "data"=> [
                "message" => "Deleted"
            ]
        ]);
    }
}
