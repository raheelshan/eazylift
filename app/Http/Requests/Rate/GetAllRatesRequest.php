<?php

namespace App\Http\Requests\Rate;

use App\Models\Rate;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllRatesRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-rates');
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

        return Rate::all();

    }
}
