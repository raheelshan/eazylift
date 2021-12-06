<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehical;
use App\Models\Trip;
use App\Models\User;

class Captain extends Model
{
	protected $table = 'captains';

	protected $fillable = [
        'name',
        'primary_cell',
        'secondary_cell',
        'user_id'
    ];

	public function vehicals()
	{
		return $this->hasMany(Vehical::class);
	} 

	public function trips()
	{
		return $this->hasMany(Trip::class);
	} 

	public function user()
	{
		return $this->belongsTo(User::class,'user_id');
	} 
}