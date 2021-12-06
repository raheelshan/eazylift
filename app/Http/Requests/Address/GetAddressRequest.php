<?php

namespace App\Http\Requests\Address;

use App\Models\Address;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAddressRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-address');
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

        return Address::findOrNew($this->id);
        
    }
}
