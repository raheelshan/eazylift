<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\GetUserAddressesRequest;
use App\Http\Requests\Address\SaveAddressRequest;
use App\Http\Requests\Address\DeleteAddressByIdRequest;

class AddressController extends Controller
{
    public function getAll(GetUserAddressesRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    } 

    public function save(SaveAddressRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }

    public function delete(DeleteAddressByIdRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }
}