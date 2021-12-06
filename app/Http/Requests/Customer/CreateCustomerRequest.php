<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CreateCustomerRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('add-customer');
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

        return Customer::create($params);
    }    
}
