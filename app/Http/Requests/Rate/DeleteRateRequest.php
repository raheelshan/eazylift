<?php

namespace App\Http\Requests\Rate;

use App\Models\Rate;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteRateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('delete-rate');
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

        $item = Rate::find($this->id);

        $item->delete();

        return true;
    }    
}
