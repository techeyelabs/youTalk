<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallet_expenditure';
    protected $primaryKey = 'id';
    protected $guarded = [];  

    public function createdBy()
    {
        return $this->hasOne('App\Models\User', 'seller_id');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\Faq', 'service_id');
    }

    public function reservation(){
        return $this->hasMany('App\Models\Reservation', 'service_id');
    }

    public function serviceHistory(){
        return $this->hasMany('App\Models\ServiceHistory', 'service_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
