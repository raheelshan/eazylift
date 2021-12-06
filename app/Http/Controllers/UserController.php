<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\User\GetAllUsersRequest;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;

use App\Http\Requests\Role\GetAllRolesRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllUsersRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('user.index',[ 'users' => $response]);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetUserRequest $request)
    {
        $request->id = 0;

        $response = $request->handle();

        $request = new GetAllRolesRequest();

        $roles = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('user.form', ['user' => $response, 'route' => route('users.store'), 'edit' => false , 'roles' => $roles ] );
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('users.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,GetUserRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        $request = new GetAllRolesRequest();

        $roles = $request->handle();        

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return view('user.form', ['user' => $response, 'route' => route('users.update',['user' => $id ]), 'edit' => true, 'roles' => $roles ] );
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $request->id = $id;
        
        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,DeleteUserRequest $request)
    {
        $request->id = $id;

        $response = $request->handle();

        if(\Request::wantsJson()) { 
            return response()->json($response);
        } else {
            return redirect()->route('users.index');
        }
    }    
}