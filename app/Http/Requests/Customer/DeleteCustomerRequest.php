<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteCustomerRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('delete-customer');
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

        $item = Customer::find($this->id);

        $item->delete();

        return true;
    }    
}
