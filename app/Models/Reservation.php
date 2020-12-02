<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';

    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id');
    }

    //created by Shiam
    public function whichService()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    //Created by Shiam
    public function reserver()
    {
        return $this->belongsTo('App\Models\User', 'reserver_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\Models\User', 'seller_id');
    }

    //Created by Shiam
    public function creditCard()
    {
        return $this->belongsTo('App\Models\CardInfo', 'card_cred_id');
    }

    public function slots()
    {
        return $this->hasMany('App\Models\Slot', 'reservation_id');
    }


    public function acceptedSlot()
    {
        return $this->belongsTo('App\Models\Slot', 'slot');
    }

     // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
             $user->slots()->delete();
             //$user->acceptedSlot()->delete();
             // do the rest of the cleanup...
        });
    }

}

