<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ArticlePreview extends Model
{
    protected $guarded = ['id'];
    use SoftDeletes;
    protected $dates = ['deleted_at', 'published_at'];

    /**
     * 查询当前时间之前的所有预告
     * @2017/3/9
     * @param $query
     */
    public function scopePrev($query){
        $time = Carbon::now();
        $query->where('published_at','<',$time);
    }

    /**
     * 查询当前时间之后的所有预告
     * @2017/3/9
     * @param $query
     */
    public function scopeNext($query){
        $time = Carbon::now();
        $query->where('published_at','>',$time);
    }

}