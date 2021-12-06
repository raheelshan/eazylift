<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    protected $table = 'rating';
    protected $primaryKey = 'id';

    public function reservations(){
    	return $this->hasMany('App\User');
    }
}
