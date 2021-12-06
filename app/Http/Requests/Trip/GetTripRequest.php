<?php

namespace App\Http\Requests\Trip;

use App\Models\Trip;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetTripRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-trip');
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

        return Trip::findOrNew($this->id);
        
    }
}
