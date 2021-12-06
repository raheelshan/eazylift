<?php

namespace App\Http\Requests\Booking;

use App\Models\Address;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\VehicalType;
use App\Http\Requests\BaseRequest;
use Bouncer;
use DateTime;
use DateInterval;

class SearchRidesRequest extends BaseRequest
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
        $directions = $params['directions'];

        $ride_distance = $directions['distance'];
        $duration = $directions['duration'];

        $trips = Trip::withCount(['reservations' => function($q){ 
            $q->where(['cancelled' => false, 'active' => 1 ]); 
        }])->with(['captain','vehical'])->where(['is_active' => 1 ])->where('via', 'like', '%'.$directions['via'].'%')->get();


        $available_rides = [];

        foreach ($trips as $key => $value) {

            $available_seats = $value['available_seats'] - $value['reservations_count'];
            
            if($available_seats > 0){

                $path = json_decode($value['path'],true);
                $pickup_distances = [];
                $dropoff_distances = [];

                
                $data = $this->getPickupDropoff($directions['coords'],$path);
                $pickup = $data['pickup'];
                $dropoff = $data['dropoff'];

                /*

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
                */

                if($pickup != null && $dropoff != null){
                    
                    $vehicalType = VehicalType::find($value['vehical']['vehical_type_id']);

                    $fare = $this->getFare($vehicalType->fare,$ride_distance,$value['ac']);

                    $distance = str_replace("km","",$ride_distance);
                    $distance = trim($distance);
                    $distance = (float)$distance;

                    $estimatedMinutes = $this->getTime($pickup['distance'],55);
                    //$estimatedMinutes = $this->getTime($pickup_distances[0]['distance'],55);

                    $time = new DateTime($value['start_time']);
                    $time->modify("+$estimatedMinutes minutes");
                    $pickupTime = $time->format('h:i a');

                    $duration = str_replace("mins","",$duration);
                    $duration = trim($duration);
                    $duration = (int)$duration;
                    
                    $time->modify("+$duration minutes");
                    $dropoffTime = $time->format('h:i a');

                    $pickupObj = [ 
                        'time' => $pickupTime, 
                        'duration' => $this->getWalkingTime($pickup['distance'],3), 
                        'distance' => $pickup['distance'],
                        'latitude' => $pickup['latitude'],
                        'longitude' => $pickup['longitude']
                    ];

                    $dropoffObj = [
                        'time' => $dropoffTime, 
                        'duration' => $this->getWalkingTime($dropoff['distance'],3), 
                        'distance' => $dropoff['distance'],
                        'latitude' => $dropoff['latitude'],
                        'longitude' => $dropoff['longitude']                    
                    ];

                    $rideObj = [
                        'fare' => $fare,
                        'currency' => $value['currency'],
                        'seats' => $available_seats,
                        'distance' => $distance
                    ];

                    $record = [
                        'id' => $value['id'],
                        'pickup' => $pickupObj,
                        'dropoff' => $dropoffObj,                
                        'vehical' => $value['vehical'],
                        'ride' => $rideObj,  
                        'dropoff_distance' => $dropoff['distance']
                    ];  

                    array_push($available_rides,$record);
                }

            }
        }

        array_multisort(array_column($available_rides, 'dropoff_distance'), SORT_ASC, $available_rides);

        return $available_rides;

    }

    private function getTime($dist, $speed)
    {            
        return (int)($speed * $dist) ;
    }

    private function getDistance($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi') 
    {
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

    private function getPickupDropoff($coords,$paths)
    {
        $locations = [];

        foreach($paths as $row){
            foreach($coords as $value){
                $distance = $this->getDistance($value['latitude'],$value['longitude'],$row['latitude'],$row['longitude'],'Mi');
                
                if($distance > 0 && $distance < 0.06){          
                    array_push($locations,[
                        //'captain_data' =>   $row['latitude'].','.$row['longitude'],
                        //'customer_data' => $value['latitude'].','.$value['longitude'],
                        'latitude' => $value['latitude'],
                        'longitude' => $value['longitude'],
                        'distance' => $distance,
                    ]);
                }
            }
        }

        if(sizeof($locations) > 1){
            return ['pickup' => $locations[0], 'dropoff'     => end($locations)];
        }else{
            return ['pickup' => null, 'dropoff' => null ];
        }

    }

    private function getWalkingTime($distance,$speed,$unit = 'Mi')
    {
        switch($unit) 
        { 
            case 'Mi': break;
            case 'Km' : $distance = $distance * 1.609344; 
        }
        return round($distance / $speed * 60);
    }

    private function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key=> $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }

    private function getFare($fare,$distance,$has_ac)
    {
        $distance = str_replace("km","",$distance);
        $distance = trim($distance);
        $distance = (float)$distance;

        return ((float)$fare * $distance) + 10 + ($has_ac ? 20 : 0); 
    } 
}
