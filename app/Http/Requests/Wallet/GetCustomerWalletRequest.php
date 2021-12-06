<?php

namespace App\Http\Requests\Wallet;

use App\Models\Wallet;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetCustomerWalletRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('view-wallet');
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
        $wallet = Wallet::where(['user_id' => $this->user()->id])->orderBy('id','desc')->get();

        $wallet->transform(function($row){
            $row->date = date('M d, H:m',strtotime($row->created_at));
            return $row;
        });

        $total = 0;

        foreach ($wallet->toArray() as $item) {
            if($item['type']){
                $total += $item['amount'];
            }else{
                $total -= $item['amount'];
            }
        }

        $data = [
            'amount' => $total,
            'currency' => 'PKR',
            'history' => $wallet
        ];

        return $data;
    }
}
