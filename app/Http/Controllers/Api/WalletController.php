<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Wallet\GetCustomerWalletRequest;

class WalletController extends Controller
{
    public function get(GetCustomerWalletRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }    
}