<?php

namespace app\phone\controller;
use app\student\common\Base;
use think\Request;
use think\Session;
use app\admin\model\Admin;
use app\admin\model\Student;
use think\Loader;


class Login extends Base
{
    

    

        //验证登录页面
    public function index()
    {

        $info=$this->auth();   //易班授权登录
        $token_info=$this->getTokenInfo();
        $token_status=$token_info['status'];
        if($token_status==404)
        {
            $info=$this->auth();
        }
        $name = $info['yb_realname'];
        $class = $info['yb_classname'];     //获取班级
        $stuID = $info['yb_studentid'];
        
        $student =new Student;
        $na = $student ->where('student_id',$stuID)->find();
        $name = $na['student_name'];

        Session::set('xh',$stuID);
        Session::set('xm',$name);
        //return $name;
        $mess = '欢迎您! '.$class.$name.'  正在为您查询，请稍后......';
        $this ->view ->assign('name',$name);
        $this ->view ->assign('xh',$stuID);
        $this ->success($mess,'index/index');

     }
     public function getTokenInfo()
    {
        Loader::import('YBApp.yb-globals',EXTEND_PATH);
              //初始化
        $api = \YBOpenApi::getInstance()->init('', '', '');  //此处删去轻应用信息，具体请参照易班api
        $res = $api->request('oauth/token_info', array('client_id'=>$api->getConfig('appid')), true);
        return $res;
    }
private function auth()
    {
        var_dump(21323123133213213123);
        Loader::import('YBApp.yb-globals',EXTEND_PATH);

          //初始化
        $api = \YBOpenApi::getInstance()->init('f1930e3748136875', '58279f663d8270316357027c377c2d3e', 'http://f.yiban.cn/iapp339210');
        $iapp  = $api->getIApp();
        
        try {
           //轻应用获取access_token，未授权则跳转至授权页面
           
           $info = $iapp->perform();

        } catch (YBException $ex) {
           echo $ex->getMessage();
        }
        var_dump(2132312313);
         var_dump($info);
        $token = $info['visit_oauth']['access_token'];//轻应用获取的token
 
        $api->bind($token);

        // 发送请求获取接口信息，不同的接口request参数不一样（见官方文档
        $data = $api->request('user/verify_me');
        return $data['info'];
    
    }
       public function logout()
    {
            Session::delete('xh');
            Session::delete('xm');
            
            $this ->success('退出成功，正在返回......','student/login/check');
    } 
}
