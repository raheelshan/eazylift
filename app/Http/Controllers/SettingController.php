<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Setting\GetAllSettingsRequest;
use App\Http\Requests\Setting\GetSettingRequest;
use App\Http\Requests\Setting\CreateSettingRequest;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Http\Requests\Setting\DeleteSettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllSettingsRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('setting.index',$response);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetSettingRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('setting.form', ['setting' => $response, 'route' => route('settings.store'), 'edit' => false ] );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSettingRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('settings.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,GetSettingRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('setting.form', ['setting' => $response, 'route' => route('settings.update',['id' => $request->id ]), 'edit' => true ] );
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, $id)
    {
        $request->id = $id;
        
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('settings.index');
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
            return redirect()->route('settings.index');
        }
    }  
}