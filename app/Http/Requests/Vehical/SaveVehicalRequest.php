<?php

namespace App\Http\Requests\Vehical;

use App\Models\Vehical;
use App\Http\Requests\BaseRequest;
use Bouncer;

class SaveVehicalRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('view-captains');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function handle(){
        
        $vehical = new Vehical();

        if($this->id > 0){
            $vehical = Vehical::find($this->id);
        }

        $params = $this->all();

        $vehical->brand = $params['brand'];
        $vehical->model = $params['model'];
        $vehical->plate = $params['plate'];
        $vehical->color = $params['color'];
        $vehical->condition = $params['condition'];

        $vehical->car_name = $params['car_name'];
        $vehical->has_ac = $params['has_ac'] ? 1 : 0;
        $vehical->seats = $params['seats'];
        $vehical->allow_luggage = $params['allow_luggage'] ? 1 : 0;
        $vehical->luggage_items = $params['luggage_items'];
        $vehical->vehical_type_id = $params['vehical_type_id'];
        $vehical->vehical_document = $this->file('vehicalDocument')->store('users');

        $vehical->captain_id = $this->captain_id;
        $vehical->created = auth()->user()->id;
        $vehical->updated = auth()->user()->id;
        
        $vehical->save();

        return true;
    }
}
