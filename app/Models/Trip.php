<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Captain;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Vehical;

class Trip extends Model
{
	public $table = 'trip';

    
    protected $fillable = ['captain_id', 'is_active'];

    public function captain()
    {
    	return $this->belongsTo(Captain::class);
    } 

    public function reservations()
    {
    	return $this->hasMany(Reservation::class);
    }

    public function vehical()
    {
    	return $this->belongsTo(Vehical::class);
    } 

    /*
    public function creating(Order $order)
    {
        $prefix = "EL";

        $max = Trip::max('order_number');

        $int = (int) filter_var($max, FILTER_SANITIZE_NUMBER_INT);

        $number = !is_null($int) ? $int : 0 ;
        $number++;
        $unique = str_pad($number, 5, "0", STR_PAD_LEFT);
        $unique = $prefix . $unique;        

        $order->order_number = $unique;
    } 
    */   
}