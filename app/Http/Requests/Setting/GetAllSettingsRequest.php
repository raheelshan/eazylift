<?php

namespace App\Http\Requests\Setting;

use App\Models\Setting;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllSettingsRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-settings');
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

        return Setting::all();

    }
}
