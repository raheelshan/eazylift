<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\GetTripsHistoryRequest;

class TripController extends Controller
{
    public function history(GetTripsHistoryRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }    
}