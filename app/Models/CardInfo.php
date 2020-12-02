<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardInfo extends Model
{
    protected $table = 'card_info';
    protected $primaryKey = 'id';

    public function reservation()
    {
        return $this->hasMany('App\Models\Reservation', 'card_cred_id');
    }

}
