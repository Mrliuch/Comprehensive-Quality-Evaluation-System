<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\common\Base;
use think\Session;
use app\admin\model\User;
use app\admin\model\Fankui;
use app\admin\model\Student;
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

        if($a[0]['b']==1){
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
		$a = Session::get('user');
		$student = new Student;
		$b = $student ->where('student_id',$a) ->find();
		$name = $b['student_name'];


		$this ->view ->assign('name',$name);
		return $this ->view ->fetch('tianjia');
	}
    public function ckkp()
	{

		$this -> isLogin();
		$a = Session::get('user');
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

	    public function queren($id)
	{


        $fankui = new Fankui;
		$result = "已处理！";
		$fankui ->where('aaa',$id)->update(['result'=>$result,'stat'=>1]);
		$this ->success('确认成功，正在为您跳转到添加考评页面！','index/tianjia');

	}
	    public function fou($id)
	{

        $this ->view ->assign('id',$id);
        return $this ->view ->fetch('fou');

	}
	    public function foujue()
	{
        $data = input('post.');
        $id = $data['aaa'];
        $result = $data['yuanyin'];
        $fankui = new Fankui;
        $fankui ->where('aaa',$id)->update(['result'=>$result,'stat'=>1]);
        return '<center><h1>原因填写成功，以提交给该同学</h1></center>';
        //return $this ->view ->fetch('fou');

	}
}