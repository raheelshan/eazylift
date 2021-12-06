<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Vehical\GetAllVehicalsRequest;
use App\Http\Requests\Vehical\SaveVehicalRequest;
use App\Http\Requests\Vehical\DeleteVehicalRequest;

class VehicalController extends Controller
{
    public function getAll(GetAllVehicalsRequest $request)
    {
        $request->id = $request->user()->id;

        $response = $request->handle();
        
        return response()->json($response);
    }

    public function save(SaveVehicalRequest $request)
    {
        $request->captain_id = $request->user()->id;

        $response = $request->handle();
        
        return response()->json($response);
    }

    public function delete(DeleteVehicalRequest $request)
    {
        $response = $request->handle();
        
        return response()->json($response);
    }
}
