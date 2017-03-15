<?php

namespace App\Http\Controllers;

use App\Models\ArticleComment;
use PhpSpec\Exception\Exception;
use App\Http\Requests;
use App\Models\Article;
use App\Models\ArticlePreview;
use App\Models\ArticleZan;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Link;
use App\Models\LinkCate;
use App\Models\Partin;
use App\Models\User;
use App\Models\Work;
use App\Services\qqService;
use App\Services\weboService;
use Validator;
use View,Hash;
use Request;
use Session;
use DB;
class HomeController extends Controller
{
    protected $urls = 'http://littleinventors.cn';

    /**
     * HomeController constructor.
     * 构造方法
     * @2017/3/5
     */
    public function __construct()
    {
        $urls = $this->urls;
        $uri = $_SERVER['REQUEST_URI'];
        $computer = 'http://littleinventors.cn'.$uri.'?&from=mobile';
        View::share('urls',$urls);
        View::share('computer',$computer);
    }

/***********************************
* 首页相关
***********************************/
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
        $work = Work::where('isrec',1)->take(3)->orderByRaw('RAND()')
            ->get(['id','cate_id','title','author','age','thumb','isrec']);
        foreach($work as $v){
            $v->urls = $this->urls;
            $v->count = $v->partin->count();
            if($v->partin->count()){
                $v->part = $v->partin->take(1);
                foreach($v->part as $h){
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

/***********************************
* 足迹(新闻,文章)相关
***********************************/
    /**
     * @return View
     * 足迹页面
     * @2017/3/10
     */
    public function getNews()
    {
        $data['webTitle'] = '足迹-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'news';

        //活动预告
        $data['preview'] = ArticlePreview::next()->orderby('sort','desc')
            ->orderby('published_at','asc')->get(['pic']);
        //活动报道
        $data['report'] = Article::whereIn('cate_id',array(2,3))->orderby('sort','desc')
            ->orderby('published_at','desc')->take(4)->get(['id','cate_id','pic','place','time']);
        //活动相关
        $data['article'] = Article::where('cate_id',1)->orderby('sort','desc')
            ->orderby('published_at','desc')->take(4)->get(['id','title','pic','created_at']);

        return view('mobile.news',$data);
    }

    /**
     * @return View
     * 新闻列表页
     * @2017/3/10
     */
    public function getNewList(){
        $data['webTitle'] = '新闻列表-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'news';
        $data['article'] = Article::whereIn('cate_id',array(2,3))->orderby('sort','desc')
            ->orderby('published_at','desc')->take(8)->get(['id','cate_id','pic','place','time']);
        return view('mobile.new_list',$data);

    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 新闻列表页查看更多接口
     * @2017/3/10
     */
    public function postLots(){
        $num = Request::get('count');
        if($num == null){
            return response()->json(['status'=>2,'info'=>'未传入加载的次数']);
        }
        $article = Article::whereIn('cate_id',array(2,3))
            ->orderby('sort','desc')
            ->orderby('published_at','desc')
            ->take(8)->offset($num*8)
            ->get(['id','cate_id','pic','place','time'])
            ->toArray();
        if($article){
            return response()->json(['status'=>1,'urls'=>$this->urls,'info'=>'加载成功','data'=>$article]);
        }else{
            return response()->json(['status'=>2,'info'=>'没有更多文章了']);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 足迹页面的活动相关查看更多接口
     * @2017/3/10
     */
    public function postMores(){
        $num = Request::get('count');
        if($num == null){
            return response()->json(['status'=>2,'info'=>'未传入加载的次数']);
        }
        $article = Article::where('cate_id',1)
            ->orderby('sort','desc')
            ->orderby('published_at','desc')
            ->take(4)->offset($num*4)
            ->get(['id','pic','title','created_at'])
            ->toArray();
        if($article){
            return response()->json(['status'=>1,'urls'=>$this->urls,'info'=>'加载成功','data'=>$article]);
        }else{
            return response()->json(['status'=>2,'info'=>'没有更多文章了']);
        }
    }

    /**
     * @param int $id
     * @return View
     * 文章详情页面
     * @2017/3/15
     */
    public function getNewsDetail($id)
    {
        $data['detail'] = Article::find($id);
        $data['webTitle'] = $data['detail']->title . '-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'news';
        $data['click'] = false;
        if(Session::has('user')){
            $user_id = Session::get('user')->id;
            $zan = ArticleZan::where(['user_id'=>$user_id,'article_id'=>$id])->first();
            if($zan){
                $data['click'] = true;
            }
        }
        $data['comments'] = ArticleComment::where('article_id',$id)
            ->orderby('id','desc')->get();
        return view('mobile.news_details',$data);
    }

    /**
     * @param $id
     * @return mixed
     * 文章详情的评论界面
     */
    public function getCommentArticle($id){
        $data['comments'] = ArticleComment::where(['article_id'=>$id])->orderby('id','desc')->get();
        $data['id'] = $id;
        $data['webTitle'] = '评论-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'idea';
        return view('mobile.comment_article')->with($data);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     * 文章详情评论界面的评论请求
     * @2017/3/15
     */
    public function postArticleComment(){
        if(!Session::has('user')){
            return redirect()->back()->with(['msg'=>['type'=>'danger','txt'=>'请先登录']]);
        }
        $data = Request::all();
        $data['user_id'] = Session::get('user')->id;

        DB::beginTransaction();
        try{
            ArticleComment::create($data);
            DB::commit();
            return redirect()->back();
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with(['msg'=>['type'=>'danger','txt'=>'评论失败']]);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 文章详情界面的点赞的ajax请求
     * @2017/3/15
     */
    public function getSavezan(){
        //登录时候的点赞/取消点赞
        if(Session::has('user') && Request::has('id')){
            $article_id = Request::get('id');
            $user_id = Session::get('user')->id;
            $zan = ArticleZan::where(['user_id'=>$user_id,'article_id'=>$article_id])->first();
            if($zan){
                DB::beginTransaction();
                try{
                    ArticleZan::destroy($zan->id);
                    Article::where('id',$article_id)->decrement('zan');
                    DB::commit();
                }catch(Exception $e){
                    DB::rollback();
                }
                $num = Article::where('id',$article_id)->first()->zan;
                return response()->json(['status'=>2,'data'=>$num]);
            }else{
                DB::beginTransaction();
                try{
                    ArticleZan::create(['user_id'=>$user_id,'article_id'=>$article_id]);
                    Article::where('id',$article_id)->increment('zan');
                    DB::commit();
                }catch(Exception $e){
                    DB::rollback();
                }
                $num = Article::where('id',$article_id)->first()->zan;
                return response()->json(['status'=>1,'data'=>$num]);
            }
        }
        //未登录时候的点赞
        if(!Session::has('user') && Request::has('id')){
            $article_id = Request::get('id');
            DB::beginTransaction();
            try{
                Article::where('id',$article_id)->increment('zan');
                DB::commit();
            }catch(Exception $e){
                DB::rollback();
            }
            $num = Article::where('id',$article_id)->first()->zan;
            return response()->json(['status'=>1,'data'=>$num]);
        }
    }

/***********************************
* 登录,注册相关
***********************************/
    /**
     * @return View
     * 登录界面
     * @2017/3/9
     */
    public function getLogin()
    {
        $data['webTitle']    = '用户登录-LI小小发明家-把世界变成你想象的样子';

        $webo = new weboService();
        $webo_url = $webo->getAuthorizeURL();
        $data['webo_url'] = $webo_url;

        $qq = new qqService();
        $qq_url = $qq->getAuthorizeURL();
        $data['qq_url'] = $qq_url;

        return view('mobile.login',$data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 登录操作
     * @2017/3/9
     */
    public function postLoginDo()
    {
        $rs = User::where('email', Request::get('email'))->first();
        if (empty($rs)) {
            return response()->json(['field' => 'email', 'info' => '邮箱不存在', 'status' => 0]);
        }
        Session::put('user', $rs);
        if ($rs && Hash::check(Request::get('password'), $rs->password)) {
            Session::put('user', $rs);
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['field' => 'password', 'info' => '密码错误', 'status' => 0]);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 退出登录操作
     * @2017/3/9
     */
    public function getLogout()
    {
        Session::flush();
        return redirect('index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|
     * \Symfony\Component\HttpFoundation\Response
     * 注册操作
     * @2017/3/9
     */
    public function postRegSave()
    {
        session_start();
        $clientCode = strtolower(Request::get('code'));     //用户填写的验证码
        $serverCode = strtolower($_SESSION['code']);  //正确的验证码
        //  1.判断用户填写的验证码是否正确，不正确则返回登录页面，正确则继续
        if($clientCode != $serverCode){
            return response()->json(['field'=>'code','info'=>'验证码不正确','status'=>0]);
        }
        $rules =[
            'username'  => 'required|unique:users,username|max:100',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required',
        ];
        $msg = [
            'username.required' =>'请输入用户名',
            'username.unique'	 =>'用户名重复',
            'username.max'	     =>'用户名过长',
            'password.required'  =>'请输入密码',
            'email.required'	 =>'请输入邮箱',
            'email.email'	     =>'邮箱格式错误',
            'email.unique'	     =>'邮箱已经注册过',
        ];
        $v = Validator::make(Request::all(), $rules, $msg);
        if ($v->fails())
        {
            $errors = $v->getMessageBag()->toArray();
            foreach ($errors as $k => $v)
            {
                $error = ['field' => $k, 'info' => $v[0],'status'=>0];
            }
            return response()->json($error);
        }
        $data['username'] = Request::get('username');
        $data['email']    = Request::get('email');
        $data['password'] = Request::get('password');
        if(Request::has('password'))
        {
            $data['password'] = Hash::make(Request::get('password'));
        }
        $flag =  User::create($data);
        unset($_SESSION['code']);

        if($flag)
        {
            Session::put('user', $flag);
            return response()->json(['status'=>1]);
        }else
        {
            return redirect()->back()->with(['msg'=>['type'=>'danger','txt'=>'注册失败']]);
        }
    }

/***********************************
 * 小发明相关
***********************************/
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
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 小发明界面查看更多接口
     * @2017/3/5
     */
    public function postMany(){
        $order = Request::get('order');
        $count = Request::get('count');
        if($order == null){
            return response()->json(['status'=>2,'info'=>'未传入分类类别']);
        }
        if($count == null){
            return response()->json(['status'=>2,'info'=>'未传入加载的次数']);
        }
        $query = Work::take(8)->offset($count*8);
        if($order == 'new'){

        }elseif($order == 'isrec'){
            $query = $query->orderby('isrec','desc');
        }elseif($order == 'plan'){
            $query = $query->orderby('type','desc');
        }
        $work = $query->orderby('id','desc')
            ->get(['id','thumb','isrec','title','author','age']);
        foreach($work as $v){
            $v->urls = $this->urls;
            $v->count = $v->partin->count();
            if($v->partin->count()){
                $v->avatar = $v->partin->take(1)[0]->user->avatar;
            }
        }
        $work = $work->toArray();
        if($work){
            return response()->json(['status'=>1,'info'=>'操作成功','data'=>$work]);
        }else{
            return response()->json(['status'=>2,'info'=>'操作失败']);
        }
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
            ->take(1)->get(['id','user_id']);
        //更多发明
        $data['more'] = Work::take(2)->whereNotIn('id',[$id])
            ->where(['cate_id'=>$detail->cate_id])->orderByRaw("RAND()")
            ->get(['id','thumb','isrec','title','author','age']);
        return view('mobile.invention_detail')->with($data);
    }

    /**
     * @return mixed
     * 小发明详情的评论页面
     * @2017/3/13
     */
    public function getComment($id){
        $data['comments'] = Comment::where(['work_id'=>$id])->orderby('id','desc')->get();
        $data['id'] = $id;
        $data['webTitle'] = '评论-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'idea';
        return view('mobile.comment')->with($data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * 小发明详情的评论页面的评论请求
     * @2017/3/15
     */
    public function postCommentSave()
    {
        if(!Session::get('user'))
        {
            return redirect()->back()->with(['msg'=>['type'=>'danger','txt'=>'请先登录']]);
        }
        $data = Request::all();
        $data['user_id'] = Session::get('user')->id;
        $flag = Comment::create($data);
        if($flag)
        {
            return redirect()->back();
        }else
        {
            return redirect()->back()->with(['msg'=>['type'=>'danger','txt'=>'提交失败']]);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 小发明详情界面点赞的ajax请求
     * @2017/3/15
     */
    public function getSavelike()
    {
        //登录时候的点赞/取消点赞
        if( Session::has('user') && Request::get('id'))
        {
            $work_id = Request::get('id');
            $user_id = Session::get('user')->id;
            $where = ['work_id'=>$work_id,'user_id'=>$user_id,'type'=>2];
            $liked = Favorite::where($where)->first();
            if($liked)
            {
                $res = Favorite::destroy($liked->id);
                if($res){
                    $work = Work::find($work_id);
                    $work->likes = $work->likes-1;
                    if(!$work->save()){
                        return response()->json(['status'=>'2','msg'=>'点赞数量修改失败','data'=>$work->likes]);
                    }
                    return response()->json(['status' => '2','msg'=>'取消点赞成功','data'=>$work->likes]);
                }
            }else{
                $flag = Favorite::create($where);
                $work = Work::find($work_id);
                $work->likes = $work->likes+1;
                if($work->save())
                {
                    return response()->json(['status' => '1','data'=>$work->likes]);
                }
            }
        }
        //未登录时候的点赞
        if(!Session::has('user') && Request::get('id')){
            $work_id = Request::get('id');
            $work = Work::find($work_id);
            $work->likes = $work->likes+1;
            if($work->save()){
                return response()->json(['status'=>1,'data'=>$work->likes]);
            }
        }
    }

/***********************************
 * 搜索相关
***********************************/
    /**
     * @return \Illuminate\Http\RedirectResponse|View
     * 搜索界面
     * @2017/3/10
     */
    public function getSearch()
    {
        if(Request::get('keyword') == null){
            return redirect()->back()->with(['msg'=>['type'=>'danger','txt'=>'请输入关键字']]);
        }
        $data['nav'] = ' ';
        $keyword = Request::get('keyword');
        $data['webTitle'] = '关于'.$keyword.'的搜索-LI小小发明家-把世界变成你想象的样子';
        if(Request::has('keyword'))
        {
            $keyword = Request::get('keyword');
            $data['list']  = Work::with('cate')->where('id','like','%'.$keyword.'%')
                ->orwhere('title','like','%'.$keyword.'%')
                ->orwhere('author','like','%'.$keyword.'%')->take(8)->get();
            foreach($data['list'] as $k=>$v){
                if($v['deleted_at']){
                    unset($data['list'][$k]);
                }
            }
            $data['keyword'] = $keyword;
        }
        $data['work'] = Work::take(3)->orderByRaw("RAND()")->get();
        return view('mobile.search',$data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * 搜索界面的查看更多ajax接口
     * @2017/3/15
     */
    public function postMuch(){
        $keyword = Request::get('keyword');
        $count = Request::get('count');
        if($keyword == null){
            return response()->json(['status'=>2,'info'=>'未传入关键字']);
        }
        if($count == null){
            return response()->json(['status'=>2,'info'=>'未传入加载的次数']);
        }
        $work = Work::where('id','like','%'.$keyword.'%')
            ->orwhere('title','like','%'.$keyword.'%')
            ->orwhere('author','like','%'.$keyword.'%')
            ->take(8)->offset($count*8)
            ->get(['id','thumb','isrec','title','author','age']);
        foreach($work as $k=>$v){
            if($v['deleted_at']){
                unset($work[$k]);
            }
        }
        foreach($work as $v){
            $v->urls = $this->urls;
            $v->count = $v->partin->count();
            if($v->partin->count()){
                $v->avatar = $v->partin->take(1)[0]->user->avatar;
            }
        }
        $work = $work->toArray();
        if($work){
            return response()->json(['status'=>1,'info'=>'操作成功','data'=>$work]);
        }else{
            return response()->json(['status'=>2,'info'=>'操作失败']);
        }
    }

/***********************************
 * 活动简介相关
***********************************/
    /**
     * @return mixed
     * 活动简介界面
     * @2017/3/10
     */
    public function getIntroduction()
    {
        $data['webTitle'] = '活动简介-LI小小发明家-把世界变成你想象的样子';
        $data['nav'] = 'active';
        return view('mobile.introduction')->with($data);
    }
}
