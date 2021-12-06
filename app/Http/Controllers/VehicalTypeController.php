<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\VehicalType\GetAllVehicalTypesRequest;
use App\Http\Requests\VehicalType\GetVehicalTypeRequest;
use App\Http\Requests\VehicalType\CreateVehicalTypeRequest;
use App\Http\Requests\VehicalType\UpdateVehicalTypeRequest;
use App\Http\Requests\VehicalType\DeleteVehicalTypeRequest;

class VehicalTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllVehicalTypesRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('vehicaltype.index',$response);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetVehicalTypeRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('vehicaltype.form', ['vehicaltype' => $response, 'route' => route('vehicaltypes.store'), 'edit' => false ] );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVehicalTypeRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('vehicaltypes.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,GetVehicalTypeRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('vehicaltype.form', ['vehicaltype' => $response, 'route' => route('vehicaltypes.update',['id' => $request->id ]), 'edit' => true ] );
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicalTypeRequest $request, $id)
    {
        $request->id = $id;
        
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('vehicaltypes.index');
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
            return redirect()->route('vehicaltypes.index');
        }
    }  
}