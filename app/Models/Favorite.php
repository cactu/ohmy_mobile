<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Favorite extends Model
{
    protected $table   = 'favorites';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function designer()
    {
        return $this->belongsTo('App\Models\UserDesigner','user_id','user_id');
    }

    public function work()
    {
        return $this->belongsTo('App\Models\Work');
    }

}
