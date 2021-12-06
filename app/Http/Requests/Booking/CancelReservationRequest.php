<?php

namespace App\Http\Requests\Booking;

use App\Models\Address;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\VehicalType;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CancelReservationRequest extends BaseRequest
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

        $reason = $params['reason'];
        $reservation_id = $params['reservation_id'];

        $reservation = Reservation::find($params['reservation_id']);
        $reservation->cancelled = 1;
        $reservation->cancel_time = date('Y-m-d H:i:s');
        $reservation->cancel_reason = $params['reason'];
        $reservation->updated = auth()->user()->id;

        //$reservation->active = 0;
        $reservation->save();
        return true;
    }
}
