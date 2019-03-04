<?php

namespace app\teacher\controller;
use app\teacher\common\Base;
use think\Request;
use think\Session;
use app\admin\model\Admin;
class Login extends Base
{
    //渲染登录页面
    public function index()

    {
       $this -> alreadyLogin();
        return $this -> view ->fetch('index');
    }

        //验证登录页面
    public function check()
    {
        $status = 0;
        $data = input('post.');
        // $data = $request ->param();
        $username = $data['username'];
        $password = md5($data['password']);

        //查询
        $map = ['student_id'=>$username];

        $admin = Admin::get($map);

        if(is_null($admin)){
            $message = "用户名不正确";
        } elseif ($admin -> com_key !=$password) {
            $message = '密码不正确';
        }
        else {
            if($admin -> temp !=1)
            { $message = '无登录权限，请联系相关负责老师';
            }else{
                if($admin -> temp1 !=1){ $message = '无登录权限，请联系管理员';
            }else{
            $status=1;
            $message = '验证通过';
            $admin -> setInc('login_count');
            $admin ->save(['last_time'=>time()]);
            Session::set('use',$username);
}}
        } 
        // return $message;
        if($status==1){
            
            $this ->success('登录成功，正在跳转......','index/indexa');
            // return $this -> view ->fetch('index/index');

        }else{
        $this ->success($message,'login/index');
}
           // return ['status'=> $status,'message'=> $message];
              }
        //退出登录

    public function logout()
    {

            Session::delete('use');
            $this ->success('注销成功，正在返回......','login/index');
    }

    
}
