<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        return response()->json([
            "list" => HotelResource::collection(Hotel::all())
        ]);
    }

    public function store(StoreHotelRequest $requst)
    {
        $hotel = Hotel::create($requst->all());

        return response()->json([
            "data" => [
                "id" => $hotel->id,
                "name" => $hotel->name,
                "number" => $hotel->number
            ]
        ]);
    }
}
