<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomForUserResource;
use App\Models\Rooms;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\RoomsResource;
use App\Http\Requests\StoreRoomsRequest;
use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{

    public function index()
    {
        // $rooms = Rooms::orderBy("id", "asc")->paginate(10);
        $rooms = Rooms::all();
        return RoomsResource::collection($rooms);
    }

    public function store(StoreRoomsRequest $request)
    {
        //$request->headers->set('Accept', 'application/json');
        //$request->headers->set('Content-Type', 'application/json');

        new RoomsResource(Rooms::create($request->all()));

        return response()->json(
            [
                "data" => [
                    "message" => "Created"
                ]
            ],
            200,
            ["content-type" => "application/json"]
        );
    }

    public function delete($id)
    {
        $room = Rooms::find($id);

        if ($room === null) {
            return response()->json(
                [
                    "error" => [
                        "message" => "Not found"
                    ]
                ],
                403
            );
        }

        $room->delete();
        return response()->json(
            [
                "data" => [
                    "message" => "Deleted"
                ]
            ],

        );
    }

    public function userInRoom(){
        return RoomForUserResource::collection(Rooms::with('clients')->get());
    }
}
