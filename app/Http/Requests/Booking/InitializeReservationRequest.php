<?php

namespace App\Http\Requests\Booking;

use App\Models\Address;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\Reservation;
use App\Http\Requests\BaseRequest;

class InitializeReservationRequest extends BaseRequest
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

    public function handle()
    {
        $params = $this->all();

        $origin  = $params['origin'];
        $destination = $params['destination'];
        $pickup = $params['pickup'];
        $dropoff = $params['dropoff'];
        $fare = $params['fare'];

        $customer = Customer::where(['user_id' => $this->user()->id])->first();

        $reservation = Reservation::where([ 'customer_id' => $customer->id , 'active' => 1 ])->first();

        if(is_null($reservation)){
            $reservation = new Reservation();
        }

        $reservation->customer_id = $customer->id;
        $reservation->fare = $fare;
        $reservation->origin = $origin['instructions'];
        $reservation->origin_info = json_encode($origin);
        $reservation->destination = $destination['instructions'];
        $reservation->destination_info = json_encode($destination);

        $reservation->pickup = $pickup['instructions'];
        $reservation->pickup_info = json_encode($pickup);

        $reservation->dropoff = $dropoff['instructions'];
        $reservation->dropoff_info = json_encode($dropoff);

        $reservation->pickup_datetime = $pickup['time'];
        $reservation->dropoff_datetime = $pickup['time'];

        $reservation->active = 1;
        $reservation->created = $this->user()->id;

        $reservation->save();

        $user = [
            'name' => $customer->name,
            'cell' => $customer->primary_cell,
            'fare' => $fare,
            'pickup' => $pickup,
            'dropoff' => $dropoff,
            'reservation_id' => $reservation->id
        ];

        return $user;
    }    
}
