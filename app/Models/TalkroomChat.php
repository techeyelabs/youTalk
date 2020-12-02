<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalkroomChat extends Model
{
    protected $table = 'talkroom_chats';
    protected $primaryKey = 'id';

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }
}
