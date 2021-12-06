<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\Customer;

class Reservation extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    
    public function trip(){
    	return $this->belongsTo(Trip::class);
    }
    
    public function customer(){
    	return $this->belongsTo(Customer::class);
    }    
}
