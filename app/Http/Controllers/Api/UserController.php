<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\GetUserDetailRequest;
use App\Models\User;
use App\Models\Captain;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function get(GetUserDetailRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    } 

    public function isActive(Request $request)
    {
        return $request->user()->verified;
    }

    public function pendingAmount(Request $request)
    {
        return response()->json(10000);
    }

    public function unlock(Request $request)
    {
        return $request->user()->locked;
    }    

    public function update(Request $request)
    {
        /*
        $rules = [
          'identity' => 'mimes:jpeg,jpg,png,gif|required|max:4000' // max 10000kb
          'license' => 'mimes:jpeg,jpg,png,gif|required|max:4000' // max 10000kb
          'name' => 'required|string',
          'email' => 'required|email|unique:users'
        ];

        $validator = Validator::make($request, $rules);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        */


        $user = User::find($request->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if($request->client == 'captain-app'){

            $user->identity = $request->file('identity')->store('users');
            $user->license = $request->file('license')->store('users');
            $user->locked = false;
            $user->verified = false;
            $user->save();

            $captain = Captain::firstOrNew([ 'user_id' => $user->id ]);
            $captain->name = $user->name;
            $captain->primary_cell = $user->username;
            $captain->secondary_cell = $user->username;
            $captain->user_id = $user->id;
            $captain->save();

        }else{
            
            $user->locked = false;
            $user->verified = true;
            $user->save();

            $customer = Customer::firstOrNew([ 'user_id' => $user->id ]);
            $customer->name = $user->name;
            $customer->primary_cell = $user->username;
            $customer->secondary_cell = $user->username;
            $customer->user_id = $user->id;

            $customer->save();            
        }
        
        return response()->json($user);
    }
}