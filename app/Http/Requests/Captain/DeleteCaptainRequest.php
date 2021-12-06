<?php

namespace App\Http\Requests\Captain;

use App\Models\Captain;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteCaptainRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('delete-captain');
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

        $item = Captain::find($this->id);

        $item->delete();

        return true;
    }    
}
