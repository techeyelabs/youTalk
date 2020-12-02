<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'slots';
    protected $primaryKey = 'id';

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation', 'reservation_id');
    }

    public function buyer()
    {
        return $this->belongsTo('App\Models\User', 'buyer_id');
    }

    public function acceptedReservation()
    {
        return $this->hasMany('App\Models\Slot', 'slot');
    }

    
}
