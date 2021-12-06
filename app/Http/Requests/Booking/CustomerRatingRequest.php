<?php

namespace App\Http\Requests\Booking;

use App\Models\Reservation;
use App\Models\Rate;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CustomerRatingRequest extends BaseRequest
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

        $reservation = Reservation::find($params['reservation_id']);

        $rate = Rate::firstOrNew(['rating_to' => $reservation->customer_id, 'trip_id' => $reservation->trip_id, 'rating_by' => auth()->user()->id ]);

        $rate->rating_to  = $reservation->customer_id;
        $rate->trip_id = $reservation->trip_id;
        $rate->rating = $params['rating'];
        $rate->rating_by = auth()->user()->id;
        $rate->created = $rate->updated = auth()->user()->id;
        
        $rate->save();
        return true;
    }
}
