<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Booking\SearchRidesRequest;
use App\Http\Requests\Booking\InitializeTripRequest;
use App\Http\Requests\Booking\GetActiveTripRequest;
use App\Http\Requests\Booking\MakeBookingRequest;
use App\Http\Requests\Booking\InitializeReservationRequest;
use App\Http\Requests\Booking\RideDetailsRequest;
use App\Http\Requests\Booking\RideRequestUpdateRequest;
use App\Http\Requests\Booking\GetTripReservationsRequest;
use App\Http\Requests\Booking\PickupCompleteRequest;
use App\Http\Requests\Booking\EndRideRequest;
use App\Http\Requests\Booking\CancelReservationRequest;
use App\Http\Requests\Booking\CaptainArrivedRequest;
use App\Http\Requests\Booking\CustomerRatingRequest;
use App\Http\Requests\Booking\EndTripRequest;

use App\Events\RideRequest;
use App\Events\RideResponse;
use App\Events\RideCancelled;
use App\Events\ArriveResponse;
use App\Events\PickupComplete;
use App\Events\ReservationCancelled;
use App\Events\RideEnded;

class BookingController extends Controller
{
    /* customer methods */
    public function search(SearchRidesRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }

    public function details(RideDetailsRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    } 

    public function bookingAttempt(InitializeReservationRequest $request)
    {
        $response = $request->handle();

        $response['trip_id'] = $request->trip_id;

        broadcast(new RideRequest($response))->toOthers();

        return response()->json($response);
    }  

    /* captain methods */
    public function savepath(InitializeTripRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    } 

    /* common methods  */
    public function active(GetActiveTripRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }

    public function tripReservations(GetTripReservationsRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);
    }

    public function rideRequestUpdate(RideRequestUpdateRequest $request)
    {
        $response = $request->handle();

        broadcast(new RideResponse(auth()->user(),$request->trip_id,$request->status))->toOthers();

        return response()->json($response);        
    }    

    public function pickupComplete(PickupCompleteRequest $request)
    {
        $response = $request->handle();

        broadcast(new PickupComplete(auth()->user(),$request->trip_id,$request->reservation_id))->toOthers();

        return response()->json($response);
    } 

    public function endRide(EndRideRequest $request)
    {
        $response = $request->handle();

        // end ride event
        broadcast(new RideEnded(auth()->user(),$request->trip_id,$request->reservation_id))->toOthers();

        return response()->json($response);
    } 

    public function cancelReservation(CancelReservationRequest $request)
    {
        $response = $request->handle();

        // end ride event
        broadcast(new ReservationCancelled(auth()->user(),$request->trip_id,$request->reservation_id))->toOthers();

        return response()->json($response);
    }

    public function captainArrived(CaptainArrivedRequest $request)
    {
        $response = $request->handle();

        broadcast(new ArriveResponse(auth()->user(),$request->trip_id,$request->reservation_id))->toOthers();

        return response()->json($response);
    }  

    public function customerRating(CustomerRatingRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);        
    }  

    public function endTrip(EndTripRequest $request)
    {
        $response = $request->handle();

        return response()->json($response);    
    }
}