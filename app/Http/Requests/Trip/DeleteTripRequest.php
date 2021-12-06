<?php

namespace App\Http\Requests\Trip;

use App\Models\Trip;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteTripRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('delete-trip');
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

        $item = Trip::find($this->id);

        $item->delete();

        return true;
    }    
}
