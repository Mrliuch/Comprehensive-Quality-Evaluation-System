<?php
namespace app\index\controller;
use think\Controller;
use app\index\common\Base;
use think\Session;
use app\admin\model\User;
use app\admin\model\Fankui;
use app\admin\model\Student;
//首页渲染
class Index extends Base
{
	public function indexa()
	{
		return $this ->view ->fetch('indexa');
	}
	public function index()
	{

		  $this -> isLogin();
		  $a = User::query('
          SELECT up,note,down,per,time,a,b,c,d from note
          order by id desc
			');
		//return $a[0]['time'];

        if($a[0]['c']==1){
        	$time = date('Y-m-d H:i:s',$a[0]['time']);
		$aaa = $a[0]['up'].$a[0]['note'].'\r\n发布者： '.$a[0]['per'].'\r\n发布时间: '.$time.$a[0]['down'];
		
         }else{
         	$aaa = '';
         }
		$this ->view ->assign('aaa',$aaa);
		return $this ->view ->fetch('index');
	}
	public function welcome()
	{
		return $this ->view ->fetch('diyibu');
	}
	public function tianjia()
	{
		$a = Session::get('us');
		$student = new Student;
		$b = $student ->where('student_id',$a) ->find();
		$name = $b['student_name'];


		$this ->view ->assign('name',$name);
		return $this ->view ->fetch('tianjia');
	}
    public function ckkp()
	{

		$this -> isLogin();
		$a = Session::get('us');
		$student = new Student;
		$b = $student ->where('student_id',$a) ->find();
		$name = $b['student_name'];

		// return dump($b['student_name']);
		$this ->view ->assign('a',$b['student_name']);
		return $this ->view ->fetch('ckkp');
	}
	    


public function fankui()
	{


        $fankui = new Fankui;
		//$this -> isLogin();
		$fan = $fankui ->where('stat',0) ->select();
		//return dump($fan);
		$arr = array_reverse($fan);
		$this ->view ->assign('fan',$arr);

		return $this ->view ->fetch('fankui');
	}

public function fankuia()
	{

        $data = input('post.');
        $fankui = new Fankui;
		//$this -> isLogin();
		$fan = $fankui ->where('stat',0) ->where('student_id',$data['xh']) ->select();
		if(!empty($fan)){
		//return dump($fan);
		$arr = array_reverse($fan);
		$this ->view ->assign('fan',$arr);

		return $this ->view ->fetch('fankui');
	}else{
		$this ->success('未找到该同学反馈');
	}
	}

}