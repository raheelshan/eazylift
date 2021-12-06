<?php

namespace App\Http\Requests\Booking;

use App\Models\Trip;
use App\Models\Captain;
use App\Http\Requests\BaseRequest;
use Bouncer;

class EndTripRequest extends BaseRequest
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

        $captain = Captain::where(['user_id' => auth()->user()->id])->first();
        $trip = Trip::where(['is_active' => 1, 'captain_id' => $captain->id ])->first();

        $trip->consumed = sizeof($trip->reservations) > 0;
        $trip->consumed_percentage = sizeof($trip->reservations) / $trip->available_seats * 100;
        $trip->amount_collected = 0;

        foreach($trip->reservations as $reservation)
        {
            $trip->amount_collected += $reservation->total;
        }

        $trip->created = $trip->updated = auth()->user()->id;
        $trip->is_active = 0;
        $trip->end_time = date('Y-m-d H:i:s');
        $trip->save();

        return true;
    }
}
