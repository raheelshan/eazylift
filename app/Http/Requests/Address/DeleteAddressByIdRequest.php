<?php

namespace App\Http\Requests\Address;

use App\Models\Address;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteAddressByIdRequest extends BaseRequest
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
            
        ];
    }

    public function handle(){

        $item = Address::find($this->id);

        $item->delete();

        return true;
    }    
}
