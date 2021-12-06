<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Wallet\GetAllWalletsRequest;
use App\Http\Requests\Wallet\GetWalletRequest;
use App\Http\Requests\Wallet\CreateWalletRequest;
use App\Http\Requests\Wallet\UpdateWalletRequest;
use App\Http\Requests\Wallet\DeleteWalletRequest;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllWalletsRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('wallet.index',$response);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetWalletRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('wallet.form', ['wallet' => $response, 'route' => route('wallets.store'), 'edit' => false ] );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWalletRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('wallets.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,GetWalletRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('wallet.form', ['wallet' => $response, 'route' => route('wallets.update',['id' => $request->id ]), 'edit' => true ] );
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalletRequest $request, $id)
    {
        $request->id = $id;
        
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('wallets.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,DeleteRoleRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('wallets.index');
        }
    }  
}