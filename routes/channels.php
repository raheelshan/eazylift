<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Trip;
use App\Models\Captain;
use App\Models\Customer;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat', function ($user) {
	return $user;
});

Broadcast::channel('trip.{trip_id}', function ($user, $trip_id) {

	$trip = Trip::find($trip_id);

	$captain = Captain::where('user_id', $user->id)->first();

	if(!is_null($captain) && $captain->id === $trip->captain_id ){
		return $user->toArray();
	}

	$customer = Customer::where('user_id', $user->id)->first();

	if(!is_null($customer)){
		return $user->toArray();
	}
});