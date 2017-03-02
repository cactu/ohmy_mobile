<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partin extends Model
{
    protected $guarded = ['id'];
    //protected $table = 'partins';

    public function user()
    {
        return $this->hasMany('App\Models\User','id', 'user_id');
    }
}
