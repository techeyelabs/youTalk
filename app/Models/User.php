<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'user_id');
    }

    public function service()
    {
        return $this->hasMany('App\Models\Service', 'user_id');
    }

    public function reservation()
    {
        return $this->hasMany('App\Models\Reservation', 'reserver_id');
    }

    public function providerServiceHistory()
    {
        return $this->hasMany('App\Models\ServiceHistory', 'provider_id');
    }

    public function receiverServiceHistory()
    {
        return $this->hasMany('App\Models\ServiceHistory', 'receiver_id');
    }

    public function reviewSeller()
    {
        return $this->hasMany('App\Models\Review', 'seller_id');
    }

    public function reviewBuyer()
    {
        return $this->hasMany('App\Models\Review', 'buyer_id');
    }

    public function seller()
    {
        return $this->hasMany('App\Models\Reservation', 'seller_id');
    }

}
