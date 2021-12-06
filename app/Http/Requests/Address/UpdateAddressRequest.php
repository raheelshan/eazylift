<?php

namespace App\Http\Requests\Address;

use App\Models\Address;
use App\Http\Requests\BaseRequest;
use Bouncer;

class UpdateAddressRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('update-address');
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

        return Address::where('id', $this->id)->update($params);
    }    
}
