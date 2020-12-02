<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';

    public function service()
    {
        return $this->hasMany('App\Models\Service', 'category_id');
    }
}
