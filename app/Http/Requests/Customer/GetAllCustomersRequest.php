<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetAllCustomersRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('view-customers');
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

        return Customer::all();

    }
}
