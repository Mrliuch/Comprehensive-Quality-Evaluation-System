<?php
namespace app\teacher\controller;
use think\Controller;
use app\teacher\common\Base;
use think\Session;
use app\admin\model\User;
use app\teacher\model\Note;
use app\teacher\model\Admin;
use app\student\model\Fan;
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
		// $note = new Note;
		// $a = $note -> find();

		$a = User::query('
          SELECT up,note,down,per,time,a,b,c,d from note
          order by id desc
			');
		//return $a[0]['time'];
        if(!empty($a[0]['a'])){
        if($a[0]['a']==1){
        	$time = date('Y-m-d H:i:s',$a[0]['time']);
		$aaa = $a[0]['up'].$a[0]['note'].'\r\n发布者： '.$a[0]['per'].'\r\n发布时间: '.$time.$a[0]['down'];
		
         }else{
         	$aaa = '';
         }}else {$aaa = '';}
		$this ->view ->assign('aaa',$aaa);
		return $this ->view ->fetch('index');
	}
	public function welcome()
	{
        $view = new Admin;
        $fan = new Fan;
        $year = $view ->where('yue',1) ->find();
        $yue = $view ->where('status',1) ->select();

        $f = $fan ->where('id',1) ->find();
        $status = $f['status'];
        $str = '';
        if($status==0)
        {
            $str = '已关闭';
        }else
        {
            $str = '已开启';
        }
        $this ->view ->assign('str',$str);

        //return dump($yue);
        $this ->view ->assign('year',$year['year']);
        $this ->view ->assign('yue',$yue);
		return $this ->view ->fetch('diyibu');
	}
	public function tianjia()
	{
		$a = Session::get('use');
		$student = new Student;
		
		$b = $student ->where('student_id',$a) ->find();
		$name = $b['student_name'];


		$this ->view ->assign('name',$name);
		return $this ->view ->fetch('tianjia');
	}
    public function ckkp()
	{

		$this -> isLogin();
		$a = Session::get('use');
		$student = new Student;
		$b = $student ->where('student_id',$a) ->find();
		$name = $b['student_name'];

		//return dump($b['student_name']);
		$this ->view ->assign('a',$b['student_name']);
		return $this ->view ->fetch('ckkp');
	}
	    
	    public function fankui()
	{

		$this -> isLogin();
		return $this ->view ->fetch('fankui');
	}

     	    
	    public function openfan()
	{

		$fan = new Fan;
		$fan -> where('id',1) ->update(['status'=>1]);
		$this ->success('开启成功');
	}     
	    public function clossfan()
	{

		$fan = new Fan;
		$fan -> where('id',1) ->update(['status'=>0]);
		$this ->success('关闭成功');
	} 


}