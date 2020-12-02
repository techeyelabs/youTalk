<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talkroom extends Model
{
    protected $table = 'talkrooms';
    protected $primaryKey = 'id';

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
