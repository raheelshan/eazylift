<?php

namespace App\Http\Requests\Booking;

use App\Models\Address;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\VehicalType;
use App\Http\Requests\BaseRequest;
use Bouncer;

class RideRequestUpdateRequest extends BaseRequest
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

        $trip_id = $params['trip_id'];
        $status = $params['status'];
        $reservation_id = $params['reservation_id'];

        if($status){
            $reservation = Reservation::find($reservation_id);
            $reservation->trip_id = $trip_id;
            $reservation->save();
        }

        return true;
    }
}
