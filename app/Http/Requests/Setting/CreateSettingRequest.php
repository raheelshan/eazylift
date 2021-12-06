<?php

namespace App\Http\Requests\Setting;

use App\Models\Setting;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CreateSettingRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('add-setting');
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

        return Setting::create($params);
    }    
}
