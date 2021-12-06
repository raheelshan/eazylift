<?php

namespace App\Http\Requests\Wallet;

use App\Models\Wallet;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CreateWalletRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('add-wallet');
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

        return Wallet::create($params);
    }    
}
