<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'id';

    public function userActual()
    {
        // return $this->belongsTo('App\Models\User', 'id');
    }
}
