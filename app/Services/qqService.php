<?php

namespace App\Services;
use App\Models\User;
use Session;

/**
 * 腾讯qq OAuth 认证类(OAuth2)
 * @author xueyi
 * @version 1.0
 * @12/15/2016
 */

class qqService {

    /**
     * 下面的所有属性值，就相当于配置文件
     * 所以每次都要讲该填的都填上
     */

    /**
     * 申请QQ登录成功后,分配给应用的appid
     * @var int
     */
    protected $client_id = 101368509;

    /**
     * 申请QQ登录成功后，分配给网站的appkey
     * @var string
     */
    protected $client_secret = '838383f19b80856e83bff4aca8e57f68';

    /**
     * 获取Authorization Code时的授权类型，此值固定为code
     * @var string
     */
    protected $response_type = 'code';

    /**
     * 成功授权后的回调地址,必须是注册appid时填写的主域名下的地址,建议设置为网站首页或网站的用户中心
     * 注意需要将url进行URLEncode
     * @var string
     */
    protected $redirect_uri = 'http://littleinventors.cn/invention-detail/926';

    /**
     * client端的状态值.用于第三方应用防止CSRF攻击,成功授权后回调时会原样带回
     * 请务必严格按照流程检查用户与state参数状态的绑定。
     * @var string
     */
    protected $state = 'ohmy';

    /**
     * 请求用户授权时向用户显示的可进行授权的列表
     * 填写的值是API文档中列出的接口,以及一些动作型的授权,如果要填写多个接口名称,请用逗号隔开
     * 例如scope=get_user_info,list_album,upload_pic,do_like
     * 不传则默认请求对接口get_user_info进行授权
     * 建议控制授权项的数量,只传入必要的接口名称,因为授权项越多,用户越可能拒绝进行任何授权
     * @var string
     */
    protected $scope = 'get_user_info';

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
        return 'https://graph.qq.com/oauth2.0/authorize';
    }

    /**
     * 获取Access Token的接口(不包含参数)
     * @return string
     */
    function accessTokenURL(){
        return 'https://graph.qq.com/oauth2.0/token';
    }

    /**
     * 获取用户的openid的接口(不包含参数)
     * @return string
     */
    function openIdURL(){
        return 'https://graph.qq.com/oauth2.0/me';
    }

    /**
     * 获取用户信息时请求的接口(不包含参数)
     * @return string
     */
    function userInfoURL(){
        return 'https://graph.qq.com/user/get_user_info';
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
        $params['scope'] = $this->scope;
        $params['state'] = $this->state;

        return $this->authorizeURL() . '?' . http_build_query($params);
    }

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
        $data = $this->curl($url);
        parse_str($data,$arr);
        return $arr;
    }

    /**
     * 获取用户openId的接口
     * @param $access_token string
     * @return mixed|string
     */
    public function getOpenId($access_token){
        $params=[];
        $params['access_token'] = $access_token;
        $url = $this->openIdURL() . '?' . http_build_query($params);
        $data = $this->curl($url);

        //将返回的形式换成数组
        $data = substr($data,strpos($data,'{'));
        $data = substr($data,0,strpos($data,'}')+1);
        $data = json_decode($data,true);
        return $data;
    }

    /**
     * 获取用户信息的接口
     * @param $data array=>('access_token','openid')
     * @return mixed
     */
    public function getUserInfo($data){
        $params = [];
        $params['oauth_consumer_key'] = $this->client_id;
        $params['access_token'] = $data['access_token'];
        $params['openid'] = $data['openid'];
        $url = $this->userInfoURL() . '?' . http_build_query($params);
        $arr = $this->curl($url);
        $arr = json_decode($arr,true);
        $arr['openid'] = $data['openid'];
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
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function checkQqData($obj){
        if(empty($obj)){
            return false;
        }
        $data = [];
        $data['username'] = $obj['nickname'];
        $data['avatar'] = $obj['figureurl_qq_1'];
        $data['qq'] = $obj['openid'];
        $qq = User::where(['qq'=>$obj['openid']])->first();

        if($qq){
            $res = User::where(['id'=>$qq['id']])->update($data);
            $id = $qq['id'];
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
     * 一键自动获取用户信息并创建基于本网站的用户,储存的当前用户包含了qq的openid
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function autoLogin(){
        if(isset($_GET['code']) && isset($_GET['state'])){
            if($_GET['state'] != $this->state){
                return redirect('/login');
            }
            $code = $_GET['code'];
            $arr = $this->getAccessToken($code);

            if(!isset($arr['access_token'])){
                return redirect('/login');
            }

            $obj = $this->getOpenId($arr['access_token']);
            if(!isset($obj['openid'])){
                return redirect('/login');
            }
            $data['access_token'] = $arr['access_token'];
            $data['openid'] = $obj['openid'];
            $res = $this->getUserInfo($data);

            if(!isset($res['openid'])){
                return redirect('/login');
            }
            $this->checkQqData($res);
        }

    }

}