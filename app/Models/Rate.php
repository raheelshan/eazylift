<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public $table = 'rating';

    public $fillable = [
		'rating_to',
		'trip_id',
		'rating',
		'rating_by',
		'created'
    ];
}