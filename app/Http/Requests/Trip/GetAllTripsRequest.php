<?php

namespace App\Http\Requests\Trip;

use App\Models\Trip;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllTripsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-trips');
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

    public function handle()
    {
        //$model->position = Country::max('position') + 1;

        if(isset($this->id) && $this->id > 0)
        {
            return Trip::where([ 'captain_id' => $this->id ])->get();
        }else{
            return Trip::all();
        }
    }
}
