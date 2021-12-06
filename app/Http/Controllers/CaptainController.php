<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Captain\GetAllCaptainsRequest;
use App\Http\Requests\Captain\GetCaptainRequest;
use App\Http\Requests\Captain\CreateCaptainRequest;
use App\Http\Requests\Captain\UpdateCaptainRequest;
use App\Http\Requests\Captain\DeleteCaptainRequest;

use App\Http\Requests\Vehical\GetAllVehicalsRequest;
use App\Http\Requests\Trip\GetAllTripsRequest;

class CaptainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllCaptainsRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('captain.index',['captains' => $response]);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetCaptainRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('captain.form', ['captain' => $response, 'route' => route('captains.store'), 'edit' => false ] );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCaptainRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('captains.index');
        }
    }

    public function show($id,GetCaptainRequest $request)
    {
        $request->id = $id;

        $captain = $request->handle();

        $request = new GetAllVehicalsRequest();

        $request->id = $id;

        $vehicals = $request->handle();

        $request = new GetAllTripsRequest();

        $request->id = $id;

        $trips = $request->handle();

        return view('captain.view', ['captain' => $captain, 'vehicals' => $vehicals, 'trips' => $trips ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,GetCaptainRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('captain.form', ['captain' => $response, 'route' => route('captains.update',['id' => $request->id ]), 'edit' => true ] );
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCaptainRequest $request, $id)
    {
        $request->id = $id;
        
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('captains.index');
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
            return redirect()->route('captains.index');
        }
    }  
}