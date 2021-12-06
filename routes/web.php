<?php

use Illuminate\Support\Facades\Route;
use App\Events\MessageSent;
use App\Events\RideResponse;
use App\Events\RideRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/fire', function () {
    $user = User::find(38);
    $user = ['name' => 'Saleem Ahmad', 'cell' => '+923463029571', 'fare' => 120, 'trip_id' => 4, 'reservation_id' => 1 ];
     $rideRequest = new RideRequest($user);
     event($rideRequest);

    //broadcast(new \App\Events\RideResponse($user,1,false))->toOthers();

    return 'ok';
});

Route::get('/home', 'HomeController@index')->name('home');

/*
use Illuminate\Http\Request;

// First route that user visits on consumer app
Route::get('/', function () {
    // Build the query parameter string to pass auth information to our request
    $query = http_build_query([
        'client_id' => 3,
        'redirect_uri' => 'http://localhost:8000/callback',
        'response_type' => 'code',
        'scope' => 'conference'
    ]);

    // Redirect the user to the OAuth authorization page
    return redirect('http://localhost:8000/oauth/authorize?' . $query);
});

// Route that user is forwarded back to after approving on server
Route::get('callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost:8000/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 3, // from admin panel above
            'client_secret' => 'cAJdLhW6YIKhm82KrdmRa0PNNcf4j59k7pYD6XtJ', // from admin panel above
            'redirect_uri' => 'http://localhost:8000/callback',
            'code' => $request->code // Get code from the callback
        ]
    ]);

    // echo the access token; normally we would save this in the DB
    return json_decode((string) $response->getBody(), true)['access_token'];
});
*/

Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

Route::get('/trip','TripController@test');
Route::get('/trip-ok',function(){
    
    broadcast(new RideResponse(auth()->user(),3,true))->toOthers();
});

Route::middleware(['auth','verified'])->group(function(){

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('user/profile','UserController@profile')->name('user.profile');
    Route::get('role/permissions/{id}', 'RoleController@permission')->name('role.permission');
    Route::post('role/permissions', 'RoleController@savePermissions')->name('save.role.permission');
    Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');


    Route::resource('vehicalTypes', VehicalTypeController::class);
    Route::resource('captains', CaptainController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('trips', TripController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('wallets', WalletController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('rates', RateController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('captains.vehicals',VehicalController::class)->only(['index']);
});

Route::fallback(function() {
    return view('errors.404');
});
