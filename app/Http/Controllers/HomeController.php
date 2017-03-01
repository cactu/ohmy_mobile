<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Link;
use App\Models\LinkCate;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use View;

class HomeController extends Controller
{

    public function __construct()
    {
        $urls = 'http://test.littleinventors.cn';
        View::share('urls',$urls);
    }


    public function getIndex()
    {
        $data = '';
        //首页3幅随机推荐作品
        $data['work'] = Work::where('isrec',1)->orderByRaw("RAND()")->take(3)
            ->get(['id','title','author','type','age','thumb','isrec']);
        //首页设计师说
        $data['designers'] = User::where(['role'=>2])
            ->whereNotIn('id', array(14))->take(10)
            ->orderByRaw("RAND()")->get(['id','avatar']);
        //查询前三个赞助商分类
        $cate = LinkCate::take(3)->lists('id');
        $links = [];
        //活动支持三个分类的logo图片
        foreach($cate as $v){
            $links[] = Link::where('cate_id',$v)->orderby('sort','desc')
                ->orderby('updated_at','desc')->get(['logo']);
        }
        $data['links'] = $links;
        return view('mobile.index',$data);
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
        $data = [];
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
