<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    protected $guarded = ['id'];
    //protected $table = 'users';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function partin()
    {
        return $this->hasMany('App\Models\Partin','work_id', 'id');
    }

    public function designer()
    {
        return $this->hasOne('App\Models\UserDesigner','user_id','id');
    }
}
