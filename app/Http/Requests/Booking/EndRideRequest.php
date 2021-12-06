<?php

namespace App\Http\Requests\Booking;

use App\Models\Reservation;
use App\Models\Wallet;
use App\Http\Requests\BaseRequest;
use Bouncer;

class EndRideRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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

        $params = $this->all();

        $reservation_id = $params['reservation_id'];
        $amount = $params['amount'];
        $user_id = $params['user_id'];

        $reservation = Reservation::find($reservation_id);
        $reservation->dropoff_datetime = date("Y-m-d H:i:s");
        $reservation->paid_amount = $amount;

        $additional_amount = $reservation->paid_amount - $reservation->fare;

        $reservation->subtotal = $reservation->fare;
        $reservation->total = $reservation->fare;
        //$reservation->active = 0;

        $reservation->save();

        if($additional_amount > 0){
            $wallet = new Wallet();

            $wallet->user_id = $user_id;
            $wallet->name = 'TOP UP';
            $wallet->description = 'Additional amount on trip end';
            $wallet->type = 1;
            $wallet->user_id = $user_id;
            $wallet->amount = $additional_amount;
            $wallet->save();
        }

        return true;
    }
}
