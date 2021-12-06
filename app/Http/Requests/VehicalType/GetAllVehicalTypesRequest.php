<?php

namespace App\Http\Requests\VehicalType;

use App\Models\VehicalType;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllVehicalTypesRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('view-vehicaltypes');
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

        return VehicalType::all();

    }
}
