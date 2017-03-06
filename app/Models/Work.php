<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    protected $guarded = ['id'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function partin()
    {
        return $this->hasMany('App\Models\Partin','work_id', 'id');
    }

    public function cate()
    {
        return $this->belongsTo('App\Models\WorkCate','cate_id','id');
    }

}
