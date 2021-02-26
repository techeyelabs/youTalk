<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $guarded = [];  

    //realtion with category
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'seller_id');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\Faq', 'service_id');
    }

    public function reservation(){
        return $this->hasMany('App\Models\Reservation', 'service_id');
    }

    public function serviceHistory(){
        return $this->hasMany('App\Models\ServiceHistory', 'service_id', 'id');
    }

    public function review(){
        return $this->hasMany('App\Models\Review', 'service_id');
    }

    public function serviceAllCallCount(){
        return $this->hasMany('App\Models\Talkroom', 'service_id');
    }

    public function userServicesAllCallCount(){
        return $this->hasMany('App\Models\Talkroom', 'seller_id', 'seller_id');
    }
}
