<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    protected $guarded = ['id'];
    //protected $table = 'works';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function partin()
    {
        return $this->hasMany('App\Models\Partin','work_id', 'id');
    }
}
