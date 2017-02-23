<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {

    }


    public function getIndex()
    {
        return view('mobile.welcome');
    }

    public function getAbout()
    {
        $data['webTitle'] = '关于我们-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = ' ';
        return view('dream.about_us')->with($data);
    }

    public function getNews()
    {
        $data['webTitle'] = '足迹-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'news';

        return view('dream.news',$data);
    }

    public function getNewsDetail($id)
    {
        /*$data['detail'] = Article::find($id);
        $data['webTitle'] = $data['detail']->title . '-LI小小发明家-把世界变成你想象的样子';*/
        $data['nav'] = 'news';
        return view('dream.news_details',$data);
    }

    public function getLogin()
    {
        $data['webTitle']    = '用户登录-LI小小发明家-把世界变成你想象的样子';
        return view('dream.login',$data);
    }

    public function getInventions()
    {
        $data['webTitle'] = '小发明-LI小小发明家-把世界变成你想象的样子';
        $data['nav']      = 'idea';
        return view('dream.inventions')->with($data);
    }

    public function getInventionDetail($id)
    {
        /*$detail = Work::with('cate')->find($id);
        $data['nav'] = 'idea';
        $data['webTitle'] = $detail->title.'-LI小小发明家-把世界变成你想象的样子';*/
        return view('dream.invention_detail')->with($data);
    }

    public function getSearch()
    {

        $data['nav'] = ' ';
        /*$keyword = Request::get('keyword');
        $data['webTitle'] = '关于'.$keyword.'的搜索-LI小小发明家-把世界变成你想象的样子';*/
        return view('dream.search',$data);
    }

    public function getIntroduction()
    {
        $data['webTitle'] = '活动简介-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'active';
        return view('dream.introduction')->with($data);
    }
}
