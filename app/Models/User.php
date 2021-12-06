<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Laravel\Passport\HasApiTokens;
use App\Models\Message;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndAbilities,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'locked',
        'verified',
        'identity',
        'license'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }   

    public function addresses()
    {
        return $this->hasMany('App\Models\Address','user_id');
    }

    public function rating()
    {
        return $this->hasMany('App\Models\Rating','rating_to');
    }

    public function  vehicals()
    {
        return $this->hasMany('App\Models\Vehical','captain_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }    
}
