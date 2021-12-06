<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Rate\GetAllRatesRequest;
use App\Http\Requests\Rate\GetRateRequest;
use App\Http\Requests\Rate\CreateRateRequest;
use App\Http\Requests\Rate\UpdateRateRequest;
use App\Http\Requests\Rate\DeleteRateRequest;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllRatesRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('rate.index',$response);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetRateRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('rate.form', ['rate' => $response, 'route' => route('rates.store'), 'edit' => false ] );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRateRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('rates.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,GetRateRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('rate.form', ['rate' => $response, 'route' => route('rates.update',['id' => $request->id ]), 'edit' => true ] );
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRateRequest $request, $id)
    {
        $request->id = $id;
        
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('rates.index');
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
            return redirect()->route('rates.index');
        }
    }  
}