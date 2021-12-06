<?php

namespace App\Http\Requests\Rate;

use App\Models\Rate;
use App\Http\Requests\BaseRequest;
use Bouncer;

class UpdateRateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('update-rate');
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

        return Rate::where('id', $this->id)->update($params);
    }    
}
