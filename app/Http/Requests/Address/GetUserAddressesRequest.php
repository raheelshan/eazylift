<?php

namespace App\Http\Requests\Address;

use App\Models\Address;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetUserAddressesRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('view-addresses');
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

    public function handle()
    {
        return Address::where(['user_id' => $this->user()->id])->get();
    }
}