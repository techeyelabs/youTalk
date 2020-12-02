<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';

    public function threads_all()
    {
        return $this->belongsTo('App\Models\User', 'other_side');
    }
}
