<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'id';

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'id');
    }
}
