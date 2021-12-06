<?php

namespace App\Http\Requests\Trip;

use App\Models\Trip;
use App\Http\Requests\BaseRequest;
use Bouncer;

class UpdateTripRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('update-trip');
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

        return Trip::where('id', $this->id)->update($params);
    }    
}
