<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingBankDeposit extends Model
{
    protected $table = 'pending_bank_deposits';
    protected $primaryKey = 'id';

    public function userActual()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
