<?php

namespace App\Http\Requests\Captain;

use App\Models\Captain;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllCaptainsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-captains');
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

        return Captain::all();

    }
}
