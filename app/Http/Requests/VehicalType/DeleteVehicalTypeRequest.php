<?php

namespace App\Http\Requests\VehicalType;

use App\Models\VehicalType;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteVehicalTypeRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('delete-vehicaltype');
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

        $item = VehicalType::find($this->id);

        $item->delete();

        return true;
    }    
}
