<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatThread extends Model
{
    protected $table = 'chat_threads';
    protected $primaryKey = 'id';

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }
}
