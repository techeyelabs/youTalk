<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    protected $table = 'service_histories';
    protected $primaryKey = 'id';

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Models\User', 'provider_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }
    
    public function seller()
    {
        return $this->hasOne('App\Models\User', 'id');
    }
}
