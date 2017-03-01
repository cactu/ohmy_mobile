<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    protected $guarded = ['id'];

    public function cate()
    {
        return $this->hasOne('App\Models\LinkCate','id', 'cate_id');
    }

}

