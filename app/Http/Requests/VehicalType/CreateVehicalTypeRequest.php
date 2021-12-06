<?php

namespace App\Http\Requests\VehicalType;

use App\Models\VehicalType;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CreateVehicalTypeRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('add-vehicaltype');
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

        $this->validated();

        $params = $this->all();

        return VehicalType::create($params);
    }    
}
