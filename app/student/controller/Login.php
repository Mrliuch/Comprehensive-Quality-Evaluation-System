<?php

namespace app\student\controller;
use app\student\common\Base;
use think\Request;
use think\Session;
use app\admin\model\Admin;
use app\admin\model\Perform;
use app\admin\model\Student;
use think\Loader;


class Login extends Base
{
    

        //验证登录页面
    public function index()
    {

        $info=$this->getauth();
        $name = $info['yb_realname'];
        $class = $info['yb_classname'];     //获取班级
        $stuID = $info['yb_studentid'];

        $student =new Student;
        $na = $student ->where('student_id',$stuID)->find();
        if(empty($na)){
            return '<script>alert("您不是信息技术学院学生!该系统暂时未对您开放!敬请谅解!")</script>';
        }
        $name = $na['student_name'];

        Session::set('xh',$stuID);
        Session::set('xm',$name);
        if($this->isMobile()){
        $mess = '欢迎您! '.$class.'-'.$name.'  正在为您查询，请稍后......';
        $this ->view ->assign('name',$name);
        $this ->view ->assign('xh',$stuID);
        $this ->success($mess,'phone/index/indexx');
        }else{
        //跳转PC端页面
        $mess = '欢迎您! '.$class.'-'.$name.'  正在为您查询，请稍后......';
        $this ->view ->assign('name',$name);
        $this ->view ->assign('xh',$stuID);
        $this ->success($mess,'student/index/index');
        // }
        }
        //return $name;


     }


function isMobile()
{ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 
 




public function getauth()
    {
        Loader::import('YBApp.yb-globals',EXTEND_PATH);

          //初始化
        $api = \YBOpenApi::getInstance()->init('', '', '');  //此处删去轻应用信息，具体请参照易班api
        $iapp  = $api->getIApp();
        
        try {
           //轻应用获取access_token，未授权则跳转至授权页面
           
           $tokeninfo = $iapp->perform();

        } catch (YBException $ex) {
           echo $ex->getMessage();
        }
        $token = $tokeninfo['visit_oauth']['access_token'];//轻应用获取的token

        if(!isset($_SESSION)){
           session_start();
        }
        $_SESSION["token"] = $token;//存储授权令牌 用于回收授权
        $api->bind($token);

        // 发送请求获取接口信息，不同的接口request参数不一样（见官方文档
        $data = $api->request('user/verify_me');
        // return $data['info'];
        return $data['info'];
    
    }



    
    public function logout()
    {
            Session::delete('xh');
            Session::delete('xm');
            
            $token = $_SESSION['token'];
            Loader::import('YBApp.yb-globals',EXTEND_PATH);
              //初始化
            $api = \YBOpenApi::getInstance()->init('f1930e3748136875', '58279f663d8270316357027c377c2d3e', 'http://f.yiban.cn/iapp339210');
            $api->bind($token);

            $res=$api->request('oauth/revoke_token', array('client_id'=>$api->getConfig('appid')), true);
            if ($res['status']==200){
                $this ->success('退出成功，正在返回......','student/login/index');
            }
            
    }


    // public function dele(){
    //     Perform::destroy(['year' => 2018]);
    //     return 'OK';
    // }


    // public function xun(){
    //     $perform = new Perform;
    //     $a = $perform ->where('number',12174130) ->select();
       
    //     return dump($a);
    // }

    // public function gai(){
    //     $perform = new Perform;
    //     $perform ->where('per',0) ->update(['per'=>12161126]);
       
    //     return "OK";
    // }

    // public function aabb(){
    //         Perform::where('per',12161126)->where('activity','校庆志愿者')->delete();
            
    //         return '删除成功';
    // }



}