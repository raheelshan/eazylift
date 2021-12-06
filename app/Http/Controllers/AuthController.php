<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Core\Response;
use App\Models\Rating;
use App\Models\Address;
use App\Models\Reservation;
use App\Models\Captain;
use App\Models\Customer;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->type = $request->type;
        $user->primary_cell = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->phone);

        $user->save();
        
        $response = new Response();

        if(Auth::attempt(['primary_cell' => request('phone'), 'password' => request('phone')])){ 
            $user = Auth::user(); 
            $token = $user->createToken('eazyshop-customer-app')->accessToken; 

            $location = [
                'user_id' => $user->id,
                'instructions' => 'Not added yet',
                'location' => 'Home',
                'latitude' => 0,
                'longitude' => 0
            ];

            Address::create($location);

            $location['location'] = 'Office';

            Address::create($location);

            $user = $this->getUserData($user);

            $response->payload = $user;
            $response->token = $token;
            $response->code = sprintf( "%04d", rand(1000,9999));
            $response->isValid = true;

        } else{ 
            $response->message = 'Invalid phone or password';
            $response->isValid = false;
        } 
        
        return response()->json($response); 
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
   public function login(Request $request){ 

        $response = new Response();

        if(Auth::attempt(['primary_cell' => request('phone'), 'password' => request('password')])){ 

            $user = Auth::user(); 
            $token = $user->createToken('eazylift-app')->accessToken; 

            $user = $this->getUserData($user);

            $response->payload = $user;
            $response->token = $token;
            $response->code = sprintf( "%04d", rand(1000,9999));
            $response->isValid = true;

        } else{ 
            $response->message = 'Invalid phone or password';
            $response->isValid = false;
        } 
        
        return response()->json($response); 
    } 

    private function getUserData($user)
    {
        $user->home = Address::where(['user_id' => $user->id , 'location' => 'home'])->first();
        $user->office = Address::where(['user_id' => $user->id , 'location' => 'office'])->first();
        $user->rate = number_format(Rating::where(['user_id' => $user->id])->avg('rating'),2);

        $user->trips = Reservation::where(['user_id' => $user->id])->count();

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
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}