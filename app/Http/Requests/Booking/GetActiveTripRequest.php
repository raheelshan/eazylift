<?php

namespace App\Http\Requests\Booking;

use App\Models\Trip;
use App\Models\Captain;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Vehical;
use App\Http\Requests\BaseRequest;
use Bouncer;

class GetActiveTripRequest extends BaseRequest
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
        $captain = Captain::where(['user_id' => $this->user()->id])->first();

        if(!is_null($captain)){

            $trip = Trip::where(['captain_id' => $captain->id , 'is_active' => 1])->first();

            $vehical = null;

            if(!is_null($trip)){            
                $vehical = Vehical::where(['id' => $trip->vehical_id])->first();

                $origin = json_decode($trip->origin_info,true);
                $destination = json_decode($trip->destination_info,true);

                $data = [
                    'pickup' => ['location' => $origin['location'], 'instructions' => $origin['instructions'] ],
                    'dropoff' => ['location' => $destination['location'], 'instructions' => $destination['instructions'] ],
                    'trip_time' => $trip->trip_time,
                    'distance' => $trip->distance,
                    'via' => $trip->via,
                    'ac' => $trip->ac,
                    'id' => $trip->id
                ];

                $trip = (object)$data;
            }            


            return compact('captain','trip','vehical');
        }

        $customer = Customer::where(['user_id' => $this->user()->id])->first();

        if(!is_null($customer)){
            $customer_id = $customer->id;

            $trip = Trip::whereHas('reservations',function($q) use($customer_id){
                $q->where(['customer_id' => $customer_id , 'active' => 1]);
            })->with(['reservations' => function($q) use($customer_id){
                $q->where(['customer_id' => $customer_id , 'active' => 1]);
            }])->first();

            return $trip->reservations[0];
        }
    }
}
