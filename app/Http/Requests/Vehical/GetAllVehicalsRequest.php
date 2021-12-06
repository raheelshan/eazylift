<?php

namespace App\Http\Requests\Vehical;

use App\Models\Vehical;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllVehicalsRequest extends BaseRequest
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

        $vehicals = Vehical::where([ 'captain_id' => $this->id ])->get();

        return sizeof($vehicals) > 0 ? $vehicals : [];
    }
}
