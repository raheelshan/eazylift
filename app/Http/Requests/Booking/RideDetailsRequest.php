<?php

namespace App\Http\Requests\Booking;

use App\Models\Address;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\VehicalType;
use App\Http\Requests\BaseRequest;
use Bouncer;

class RideDetailsRequest extends BaseRequest
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

        $origin = $params['origin'];
        $destination = $params['destination'];

        $trip = Trip::with(['vehical'])->where(['is_active' => 1, 'id' => $params['id'] ])->first();

        $origin_info = json_decode($trip->origin_info,true);
        $destination_info = json_decode($trip->destination_info,true);

        $vehicalType = VehicalType::find($trip->vehical->vehical_type_id);

        $path = json_decode($trip->path,true);
        $pickup_distances = [];
        $dropoff_distances = [];

        foreach($path as $row){
            $distance = $this->getDistance($origin['latitude'],$origin['longitude'],$row['latitude'],$row['longitude'],'Mi');
            array_push($pickup_distances,['latitude' => $row['latitude'], 'longitude' => $row['longitude'], 'distance' => $distance]);

            $distance = $this->getDistance($destination['latitude'],$destination['longitude'],$row['latitude'],$row['longitude'],'Mi');
            array_push($dropoff_distances,['latitude' => $row['latitude'], 'longitude' => $row['longitude'], 'distance' => $distance]);                
        }

        $pickup = array_reduce($pickup_distances,function($A,$B){
            return $A['distance'] < $B['distance'] ? $A : $B;
        },array_shift($pickup_distances));

        $dropoff = array_reduce($dropoff_distances,function($A,$B){
            return $A['distance'] < $B['distance'] ? $A : $B;
        },array_shift($dropoff_distances));

        $data = [
            'color' => $trip->vehical->color,
            'brand' => $trip->vehical->brand,
            'model' => $trip->vehical->model,
            'plate' => $trip->vehical->plate,
            'has_ac' => $trip->ac,
            'available_seats' => $trip->available_seats - $trip->reservations_count,
            'start_latitude' => $origin_info['latitude'],
            'start_longitude' => $origin_info['longitude'],
            'end_latitude' => $destination_info['latitude'],
            'end_longitude' => $destination_info['longitude'],
            'start_time' => $trip->start_time,
            'currency' => $trip->currency,
            'pickup_latitude' => $pickup['latitude'],
            'pickup_longitude' => $pickup['longitude'],
            'pickup_distance' => $pickup['distance'],
            'dropoff_latitude' => $dropoff['latitude'],
            'dropoff_longitude' => $dropoff['longitude'],
            'dropoff_distance' => $dropoff['distance'],             
        ];

        return $data;
    }

    private function getDistance($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi') {
        $theta = $longitude1 - $longitude2;
        $distance = sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta));

        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515;

        switch($unit) 
        { 
            case 'Mi': break;
            case 'Km' : $distance = $distance * 1.609344; 
        }

        return (round($distance,2)); 
    }

    private function getFair($fair,$duration,$has_ac)
    {
        $duration = str_replace("km","",$duration);
        $duration = trim($duration);
        $duration = (float)$duration;

        return ((float)$fair * $duration) + 10 + ($has_ac ? 20 : 0); 
    } 
}
