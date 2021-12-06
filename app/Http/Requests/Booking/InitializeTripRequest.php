<?php

namespace App\Http\Requests\Booking;

use App\Models\Trip;
use App\Models\Captain;
use App\Http\Requests\BaseRequest;
use Bouncer;

class InitializeTripRequest extends BaseRequest
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

        $origin = $params['origin'];
        $destination = $params['destination'];

        $captain = Captain::where(['user_id' => $this->user()->id])->first();

        $trip = Trip::firstOrNew(['is_active' => 1, 'captain_id' => $captain->id]);

        $trip->trip_id = $this->generateRandomString();
        $trip->captain_id = $captain->id;
        $trip->vehical_id = $params['vehical_id'];
        $trip->is_active = true;
        $trip->origin = $origin['instructions'];
        $trip->origin_info = json_encode($origin);
        $trip->destination = $destination['instructions'];
        $trip->destination_info = json_encode($destination);
        $trip->via = $params['path']['via'];
        $trip->trip_time = $params['path']['duration'];
        $trip->distance = $params['path']['distance'];
        $trip->available_seats = $params['available_seats'];
        $trip->ac = $params['ac'];
        $trip->luggage_items = $params['luggage_items'];
        $trip->currency = 'PKR';
        $trip->intra_city = 1;
        $trip->start_time = date('Y-m-d H:i:s');
        $trip->path = json_encode($params['path']['coords']);

        $trip->save();

        return $trip->id;
    }

    private function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
