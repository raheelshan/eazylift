<?php

namespace App\Http\Requests\Captain;

use App\Models\Captain;
use App\Http\Requests\BaseRequest;
use Bouncer;

class UpdateCaptainRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('update-captain');
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

        return Captain::where('id', $this->id)->update($params);
    }    
}
