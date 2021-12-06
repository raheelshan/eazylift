<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Vehical\GetAllVehicalsRequest;
use App\Http\Requests\Captain\GetCaptainRequest;

use App\Models\Vehical;
use App\Core\Response;

class VehicalController extends Controller
{
    public function index($id,GetAllVehicalsRequest $request)
    {
        $response = $request->handle();

        $request = new GetCaptainRequest();

        $request->id = $id;

        $captain = $request->handle();

        return view('vehical.index',['vehicals' => $response , 'captain' => $captain ]);
    }

    public function getAll(Request $request)
    {
        $vehicals = Vehical::where(['user_id' => $request->user()->id])->get();

        $response = new Response();
        $response->isValid = true;
        $response->payload = $vehicals;
        return response()->json($response);
    }

    public function save(Request $request)
    {
        $vehical = new Vehical();

        if($request->id > 0){
            $vehical = Vehical::find($request->id);
        }

        $vehical->brand = $request->brand;
        $vehical->model = $request->model;
        $vehical->plate = $request->plate;
        $vehical->color = $request->color;
        $vehical->condition = $request->condition;

        $vehical->car_name = $request->car_name;
        $vehical->has_ac = $request->has_ac;
        $vehical->seats = $request->seats;
        $vehical->allow_luggage = $request->allow_luggage;
        $vehical->luggage_items = $request->luggage_items;
        $vehical->vehical_type_id = $request->vehical_type_id;

        $vehical->user_id = $request->user()->id;
        $vehical->save();

        $response = new Response();
        $response->isValid = true;
        $response->message = $request->id > 0 ? "Vehical has been udpated successfully" : "Vehical has been saved successfully";
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        if($request->id > 0){
            Vehical::find($request->id)->delete();
        }

        $response = new Response();
        $response->isValid = true;
        $response->message = $request->id > 0 ? "Vehical has been deleted successfully" : "Unable to delete vehical";
        return response()->json($response);
    }
}
