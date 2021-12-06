<?php

namespace App\Http\Requests\User;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Bouncer;
use App\Models\Rating;
use App\Models\Address;
use App\Models\Reservation;

class GetUserDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//Bouncer::can('view-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function handle()
    {
        $user = User::find($this->user()->id);

        $user->office = Address::where(['user_id' => $user->id , 'location' => 'office'])->first();
        $user->home = Address::where(['user_id' => $user->id , 'location' => 'home'])->first();
        $user->rate = number_format(Rating::where(['rating_to' => $user->id])->avg('rating'),2);

        $user->trips = Reservation::where(['customer_id' => $user->id])->count();

        $ts1 = strtotime($user->created_at);
        $ts2 = strtotime(date('Y-m-d'));

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $months = (($year2 - $year1) * 12) + ($month2 - $month1);

        $user->join_count = $months > 12 ? floor($months / 12) : $months;
        $user->join_description = $months > 12 ? "Year(s)" : 'Month(s)';

        //$user->load('vehicals');

        $user->load(['vehicals' => function($query) {
            $query->take(2);
        }]);

        return $user;
    }    
}
