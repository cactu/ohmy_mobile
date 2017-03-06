<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Article;
use App\Models\Link;
use App\Models\LinkCate;
use App\Models\Partin;
use App\Models\User;
use App\Models\Work;
use View;
use Request;
class HomeController extends Controller
{

    /**
     * HomeController constructor.
     * 构造方法
     * @2017/3/5
     */
    public function __construct()
    {
        $urls = 'http://littleinventors.cn';
        View::share('urls',$urls);
    }

    /**
     * @return View
     * 首页
     * @2017/3/5
     */
    public function getIndex()
    {
        $data['webTitle'] = '首页-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'index';
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

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 首页换一批接口
     * @2017/3/5
     */
    public function postOthers(){
        $work = Work::where('isrec',1)->take(6)->orderByRaw('RAND()')
            ->get(['id','cate_id','title','author','age','thumb','isrec']);
        foreach($work as $v){
            $v->count = $v->partin->count();
            if($v->partin->count()){
                $v->part = $v->partin->take(1);
                foreach($v->part as $h){
                    $h->role = $h->user->role;
                    $h->avatar = $h->user->avatar;
                }
                $v->part = $v->part->toArray();
            }
        }
        $work = $work->toArray();
        if($work){
            return response()->json(['status'=>1,'info'=>'操作成功','data'=>$work]);
        }else{
            return response()->json(['status'=>2,'info'=>'操作失败']);
        }
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

    public function getNewsDetail($id)
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

    /**
     * @return mixed
     * 小发明界面
     * @2017/3/5
     */
    public function getInventions()
    {
        $data['webTitle'] = '小发明-LI小小发明家-把世界变成你想象的样子';
        $data['nav']      = 'idea';
        $query = Work::take(8);
        if(Request::has('order')){
            $order = Request::get('order');
            if($order == 'new'){

            }elseif($order == 'isrec'){
                $query = $query->orderby('isrec','desc');
            }elseif($order == 'plan'){
                $query = $query->orderby('type','desc');
            }
            $data['order'] = $order;
        }else{
            $query = $query->orderby('type','desc');
            $data['order'] = 'plan';
        }
        //八幅作品
        $data['work'] = $query->orderby('id','desc')
            ->get(['id','thumb','isrec','title','author','age']);
        //五幅新闻banner
        $data['news'] = Article::orderby('isbanner','desc')
            ->take(5)->get(['id','banner']);
        return view('mobile.inventions')->with($data);
    }

    /**
     * @param $id
     * @return mixed
     * 小发明详情界面
     * @2017/3/5
     */
    public function getInventionDetail($id)
    {
        $data['nav'] = 'idea';
        $detail = Work::with('cate')->find($id);
        $data['webTitle'] = $detail->title.'-LI小小发明家-把世界变成你想象的样子';
        $data['data'] = $detail;
        //创意征集
        $data['part'] = Partin::where('work_id',$id)
            ->take(3)->get(['id']);
        //更多发明
        $data['more'] = Work::take(3)->whereNotIn('id',[$id])
            ->where(['cate_id'=>$detail->cate_id])->orderByRaw("RAND()")
            ->get(['id','thumb','isrec','title','author','age']);
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
