<?php

namespace App\Http\Requests\Rate;

use App\Models\Rate;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CreateRateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('add-rate');
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

        return Rate::create($params);
    }    
}
