<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Captain;
use App\Models\VehicalType;

class Vehical extends Model
{
    protected $table = 'vehical';
    protected $primaryKey = 'id';

    public function captain()
    {
    	return $this->belongsTo(Captain::class);
    }

    public function vehicalType()
    {
    	return $this->belongsTo(VehicalType::class);
    }
    
}
