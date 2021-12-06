<?php

namespace App\Http\Requests\Trip;

use App\Http\Requests\BaseRequest;
use Bouncer;
use App\Models\Trip;
use App\Models\Reservation;
use App\Models\Captain;
use App\Models\Customer;
use App\Models\Vehical;

class GetTripsHistoryRequest extends BaseRequest
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
        if($this->client == 'customer-app'){
            
            $customer = Customer::where(['user_id' => $this->user()->id ])->first();

            $reservations = Reservation::where(['customer_id' => $customer->id])->orderBy('id','desc')->get();
            
            $reservations->transform(function($reservation){
                $reservation->trip_time = (strtotime($reservation->dropoff_datetime) - strtotime($reservation->pickup_datetime)) / 60;
                $reservation->start_time = date('M d, H:m',strtotime($reservation->pickup_datetime));
                return $reservation;
            });

            return $reservations;

        }else{

            $captain = Captain::where(['user_id' => $this->user()->id])->first();

            $trips = Trip::with('reservations:trip_id,customer_id,pickup,dropoff,pickup_datetime,dropoff_datetime,distance,time,fare,service,vat,subtotal,wallet_amount,total,paid_amount,currency')->where(['captain_id' => $captain->id, 'is_active' => 0])->orderBy('id','desc')->get();
    
            $trips->transform(function($trip){
                
                $vehical = Vehical::find($trip->vehical_id,['color','brand','model','plate']);

                $trip->reservations->transform(function($reservation){
                    $customer = Customer::find($reservation->customer_id,['name','primary_cell']);
                    $reservation->trip_time = (strtotime($reservation->dropoff_datetime) - strtotime($reservation->pickup_datetime)) / 60;
                    $reservation->start_time = date('M d, H:m',strtotime($reservation->pickup_datetime));
                    $reservation->customer_name = $customer->name;
                    $reservation->primary_cell = $customer->primary_cell;
                    return $reservation;
                });

                $origin = json_decode($trip->origin_info,true);
                $destination = json_decode($trip->destination_info,true);

                $originObj = [ 
                    'location' => $origin['instructions'],
                    'latitude' => $origin['latitude'],
                    'longitude' => $origin['longitude']
                ];

                $destinationObj = [
                    'location' => $destination['instructions'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude']                    
                ];                 
                
                $data =  [
                    'trip_time' => $trip->trip_time,
                    'distance' => $trip->distance,
                    'origin' => $originObj,
                    'destination' => $destinationObj,
                    'currency' => $trip->currency,
                    'amount_collected' => $trip->amount_collected,
                    'datetime' => date('M d, H:m',strtotime($trip->created_at)),
                    'reservations' => $trip->reservations,
                    'id' => 'trip-'.$trip->id,
                    'vehical' => $vehical,
                    'path' => $trip->path
                ];

                return $data;
            });

            return $trips;
        }      
    }
}
