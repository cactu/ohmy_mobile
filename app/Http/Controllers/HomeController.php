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
        return view('mobile.index');
    }

    public function getAbout()
    {
        $data['webTitle'] = '关于我们-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = ' ';
        return view('mobile.about_us')->with($data);
    }

    public function getNews()
    {
        $data['webTitle'] = '足迹-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'news';

        return view('mobile.news',$data);
    }

    public function getNewsDetail($id='')
    {
        /*$data['detail'] = Article::find($id);
        $data['webTitle'] = $data['detail']->title . '-LI小小发明家-把世界变成你想象的样子';*/
        $data['nav'] = 'news';
        return view('mobile.news_details',$data);
    }

    public function getLogin()
    {
        $data['webTitle']    = '用户登录-LI小小发明家-把世界变成你想象的样子';
        return view('mobile.login',$data);
    }

    public function getInventions()
    {
        $data['webTitle'] = '小发明-LI小小发明家-把世界变成你想象的样子';
        $data['nav']      = 'idea';
        return view('mobile.inventions')->with($data);
    }

    public function getInventionDetail($id='')
    {
        /*$detail = Work::with('cate')->find($id);
        $data['nav'] = 'idea';
        $data['webTitle'] = $detail->title.'-LI小小发明家-把世界变成你想象的样子';*/
        return view('mobile.invention_detail')->with($data);
    }

    public function getSearch()
    {

        $data['nav'] = ' ';
        /*$keyword = Request::get('keyword');
        $data['webTitle'] = '关于'.$keyword.'的搜索-LI小小发明家-把世界变成你想象的样子';*/
        return view('mobile.search',$data);
    }

    public function getIntroduction()
    {
        $data['webTitle'] = '活动简介-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'active';
        return view('mobile.introduction')->with($data);
    }
}
