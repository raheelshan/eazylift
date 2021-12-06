<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table = 'customers';

    protected $fillable = [
        'name',
        'primary_cell',
        'secondary_cell',
        'user_id'
    ];

    public function trips()
	{
		return $this->hasMany(Trip::class);
	}  
}