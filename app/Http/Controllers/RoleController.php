<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Role\GetAllRolesRequest;
use App\Http\Requests\Role\GetRoleRequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Requests\Role\DeleteRoleRequest;
use App\Http\Requests\Role\SavePermissionsRequest;
use App\Http\Requests\Permission\GetAllPermissionsRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllRolesRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('role.index',['roles' => $response]);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetRoleRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('role.form', ['role' => $response, 'route' => route('roles.store'), 'edit' => false ] );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('roles.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,GetRoleRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('role.form', ['role' => $response, 'route' => route('roles.update',['role' => $request->id ]), 'edit' => true ] );
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $request->id = $id;
        
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('roles.index');
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
            return redirect()->route('roles.index');
        }
    }  

    public function permission($id)
    {
        $request = new GetRoleRequest();

        $request->id = $id;

        $response = $request->handle();        

        $request = new GetAllPermissionsRequest();

        $permissions = $request->handle();

        return view('role.permission',[ 'role' => $response, 'permissions' => $permissions ]);
    }

    public function savePermissions(SavePermissionsRequest $request)
    {
        $response = $request->handle();        

        return redirect()->route('roles.index');
    }     
}