<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';

    public function talkroom()
    {
        return $this->belongsTo('App\Models\Talkroom', 'talkroom_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\Models\User', 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo('App\Models\User', 'buyer_id');
    }
}
