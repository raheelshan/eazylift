<?php

namespace App\Http\Requests\Booking;

use App\Models\Trip;
use App\Models\Captain;
use App\Models\Reservation;
use App\Models\Vehical;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetTripReservationsRequest extends BaseRequest
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
        $params = $this->all();
        $trip_id = $params['trip_id'];

        $reservations = Reservation::with('customer')->where(['trip_id' => $trip_id,'active' => 1])->get();

        $data = [];

        foreach ($reservations as $reservation) {

            $customer = $reservation->customer;

            $pickup = json_decode($reservation->pickup_info,true);
            $dropoff = json_decode($reservation->dropoff_info,true);

            $pickupObj = [ 
                'location' => $pickup['instructions'],
                'latitude' => $pickup['latitude'],
                'longitude' => $pickup['longitude']
            ];

            $dropoffObj = [
                'location' => $dropoff['instructions'],
                'latitude' => $dropoff['latitude'],
                'longitude' => $dropoff['longitude']                    
            ];            

            $item = [
                'trip_id' => $trip_id,
                'reservation_id' => $reservation->id,
                'pickup' => $pickupObj,
                'dropoff' => $dropoffObj,
                'fare' => $reservation->fare
            ];

            $row = ['customer' => $customer , 'reservation' => $item ];

            array_push($data, $row);
        }

        return $data;
    }
}
