<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    protected $table = 'withdraw_requests';
    protected $primaryKey = 'id';
    protected $guarded = [];  

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
