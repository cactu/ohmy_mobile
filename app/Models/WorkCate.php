<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkCate extends Model
{
    protected $guarded = ['id'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
