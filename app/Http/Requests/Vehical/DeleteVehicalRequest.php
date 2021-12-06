<?php

namespace App\Http\Requests\Vehical;

use App\Models\Vehical;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteVehicalRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('view-captains');
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

        if($this->id > 0){
            Vehical::find($this->id)->delete();
        }

        return true;
    }
}
