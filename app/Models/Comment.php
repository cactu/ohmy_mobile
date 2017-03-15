<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    protected $guarded = ['id'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function work()
    {
        return $this->belongsTo('App\Models\Work');
    }

    public function reply()
    {
        return $this->belongsTo('App\Models\User','pid','id');
    }

}
