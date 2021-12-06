<?php

namespace App\Http\Requests\Booking;

use App\Models\Reservation;
use App\Http\Requests\BaseRequest;
use Bouncer;

class CaptainArrivedRequest extends BaseRequest
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
        $reservation->arrival_time = date('Y-m-d H:i:s');
        $reservation->save();
        return true;
    }
}
