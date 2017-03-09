<?php

namespace App\Services;
use App\Models\User;
use Session;

/**
 * 新浪微博 OAuth 认证类(OAuth2)
 * @author xueyi
 * @version 1.0
 * @12/15/2016
 */

class weboService {

    /**
     * 下面的所有属性值，就相当于配置文件
     * 所以每次都首先要讲该填的都填上
     */

    /**
     * 申请应用时分配的AppKey
     * @var int
     */
    protected $client_id = 1439549587;

    /**
     * 申请应用时分配的AppSecret
     * @var
     */
    protected $client_secret = 'd39f5cd022610f3621aaaa43449e4372';

    /**
     * 回调地址,需要与注册应用里的回调地址一致
     * @var string
     */
    protected $redirect_uri = 'http://littleinventors.cn';

    /**
     * 获取Authorization Code时的授权类型,此值为code
     * @var string
     */
    protected $response_type = 'code';

    /**
     * 通过Authorization Code获取Access Token时的授权类型,在本步骤中,此值为authorization_code
     * @var string
     */
    protected $grant_type = 'authorization_code';

    /**
     * Authorization Code请求的接口(不包含参数)
     * @return string
     */
    function authorizeURL(){
        return 'https://api.weibo.com/oauth2/authorize';
    }

    /**
     * 获取Access Token的接口(不包含参数)
     * @return string
     */
    function accessTokenURL(){
        return 'https://api.weibo.com/oauth2/access_token';
    }

    /**
     * 获取用户信息时请求的接口(不包含参数)
     * @return string
     */
    function userInfoURL(){
        return 'https://api.weibo.com/2/users/show.json';
    }

    /**
     * 跳转到authorize的接口
     * @return string
     */
    public function getAuthorizeURL(){
        $params = [];
        $params['response_type'] = $this->response_type;
        $params['client_id'] = $this->client_id;
        $params['redirect_uri'] = $this->redirect_uri;

        return $this->authorizeURL() . '?' . http_build_query($params);
    }

    /**
     * OAuth的服务端只要看到本次提交的行为是POST就行
     * 至于POST集合里面有没有数据,有些什么数据,它才不会管
     * 所以,无论我们在POST里面添加了什么键|值,无论怎么切换顺序,都是错误的,因为它就没有去读取
     * 就是这样,终于正确获得token值,服务器只管你的method是POST就行了,你的实际参数都是在GET里面的
     * 这是新浪的一个大坑啊,坑的一笔,真是无语了,切记切记
     */
    /**
     * 获取access_token的接口
     * @param $code string
     * @return mixed
     */
    function getAccessToken($code){
        $params = [];
        $params['grant_type'] = $this->grant_type;
        $params['client_id'] = $this->client_id;
        $params['client_secret'] = $this->client_secret;
        $params['code'] = $code;
        $params['redirect_uri'] = $this->redirect_uri;

        $url = $this->accessTokenURL() . '?' . http_build_query($params);
        $cUrl = curl_init();
        curl_setopt($cUrl, CURLOPT_URL, $url);
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cUrl, CURLOPT_POST, 1);
        curl_setopt($cUrl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($cUrl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($cUrl, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        $data = curl_exec($cUrl);
        curl_close($cUrl);
        $data = json_decode($data,true);
        return $data;
    }

    /**
     * 获取用户信息的接口
     * @param $data array=>('access_token','uid')
     * @return mixed
     */
    public function getUserInfo($data){
        $params = [];
        $params['uid'] = $data['uid'];
        $params['access_token'] = $data['access_token'];
        $url = $this->userInfoURL() . '?' . http_build_query($params);
        $arr = $this->curl($url);
        $arr = json_decode($arr,true);
        return $arr;
    }

    /**
     * curl请求方法
     * @param $url
     * @return mixed
     */
    public function curl($url){
        $cUrl = curl_init();
        curl_setopt($cUrl, CURLOPT_URL, $url);
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cUrl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($cUrl, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        $data = curl_exec($cUrl);
        curl_close($cUrl);
        return $data;
    }

    /**
     * 根据腾讯返回的用户信息去相应的创建用户
     * @param $obj
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function checkWeboData($obj){
        if(empty($obj)){
            return redirect('/login');
        }
        $data = [];
        $data['username'] = $obj['screen_name'];
        $data['avatar'] = $obj['avatar_large'];
        $data['webo'] = $obj['id'];
        $webo = User::where(['webo'=>$obj['id']])->first();

        if($webo){
            $res = User::where(['id'=>$webo['id']])->update($data);
            $id = $webo['id'];
        }else{
            $res = User::create($data);
            $id = $res['id'];
        }

        if($res){
            $rs = User::where('id',$id)->first();
            Session::put('user', $rs);
            return redirect('index');
        }else{
            return redirect('index');
        }
    }

    /**
     * 一键自动获取用户信息并创建基于本网站的用户,储存的当前用户包含了新浪微博的uid
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function autoLogin(){
        if(isset($_GET['code'])){
            $code = $_GET['code'];
            $arr = $this->getAccessToken($code);

            if(!isset($arr['access_token'])){
                return redirect('/login');
            }
            $obj = $this->getUserInfo($arr);

            if(!isset($obj['id'])){
                return redirect('/login');
            }
            $this->checkWeboData($obj);
        }
    }

}