<?php

namespace App\Http\Requests\Address;

use App\Models\Address;
use App\Http\Requests\BaseRequest;
use Bouncer;

class SaveAddressRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latitude' => 'required',
            'longitude' => 'required',
            'location' => 'required',
            'instructions' => 'required'
        ];
    }

    public function handle(){

        $this->validated();

        $address = new Address();

        $params = $this->all();

        if($params['id'] > 0){
            $address = Address::find($params['id']);
        }

        $address->latitude = $params['latitude'];
        $address->longitude = $params['longitude'];
        $address->instructions = $params['instructions'];
        $address->location = $params['location'];
        $address->user_id = $this->user()->id;
        $address->save();

        return $address;
    }    
}
