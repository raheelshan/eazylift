<?php

namespace App\Http\Requests\Wallet;

use App\Models\Wallet;
use App\Http\Requests\BaseRequest;
use Bouncer;

class DeleteWalletRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Bouncer::can('delete-wallet');
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

        $item = Wallet::find($this->id);

        $item->delete();

        return true;
    }    
}
