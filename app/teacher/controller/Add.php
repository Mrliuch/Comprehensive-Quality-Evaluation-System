<?php

namespace app\teacher\controller;
use think\Session;
use think\Controller;
use app\teacher\common\Base;
use app\admin\model\User;
use app\admin\model\Perform;
use app\admin\model\Student;
use app\teacher\model\Admin;
use app\teacher\model\Adminn;
use app\teacher\model\Note;
//全局设置、名单管理、 发布通知     
class Add extends Base
{

//***********************设置显示考评年月*********************************
public function view(){
  $this -> isLogin();
    $data = input('post.');
    if(empty($data['a'])){
            $data['a'] = 0;
         }
         if(empty($data['b'])){
            $data['b'] = 0;
         }
         if(empty($data['c'])){
            $data['c'] = 0;
         }
         if(empty($data['d'])){
            $data['d'] = 0;
         }
          if(empty($data['e'])){
            $data['e'] = 0;
         }
          if(empty($data['f'])){
            $data['f'] = 0;
         }
         if(empty($data['g'])){
            $data['g'] = 0;
         }
          if(empty($data['h'])){
            $data['h'] = 0;
         }
          if(empty($data['i'])){
            $data['i'] = 0;
         }
          if(empty($data['j'])){
            $data['j'] = 0;
         }
    $view = new Admin;
    $view ->where('name','显示') ->update(['year'=>$data['year']]);
    $view ->where('yue',1) ->update(['status'=>$data['a']]);
    $view ->where('yue',3) ->update(['status'=>$data['b']]);
    $view ->where('yue',4) ->update(['status'=>$data['c']]);
    $view ->where('yue',5) ->update(['status'=>$data['d']]);
    $view ->where('yue',6) ->update(['status'=>$data['e']]);
    $view ->where('yue',7) ->update(['status'=>$data['f']]);
    $view ->where('yue',9) ->update(['status'=>$data['g']]);
    $view ->where('yue',10) ->update(['status'=>$data['h']]);
    $view ->where('yue',11) ->update(['status'=>$data['i']]);
    $view ->where('yue',12) ->update(['status'=>$data['j']]);
    $this ->success('显示成功');

}
//***********************************************************

//查看年级名单
        public function mingdan(){
               $this -> isLogin();

                 $nj ='';
                 $data = input('post.');
                 if(empty($data['xm'])){
                 if(!empty($data['nj'])){
                 $nj = $data['nj'].'%';
                 }
                 if(!empty($data['njzy'])){
                 $nj = $data['njzy'].'%';
                 }
                 if(!empty($data['xh'])){
                 $nj = $data['xh'];
                 }
                 //return dump($data);
                 $student = User::query('
                 SELECT *  FROM student WHERE student_id like ?
                   ',[$nj]);}else{ $student = User::query('
                 SELECT * FROM student WHERE student_name = ?
                   ',[$data['xm']]);}

                 if(empty($student)){
                  return '<script type="text/javascript">
                            alert("输入有误！请重新输入");
                          </script>';
                 }else{
                  $count = count($student);
                  //return $count;
                  $this ->view ->assign('count',$count);
                  $this ->view ->assign('student',$student);
                  return $this ->view ->fetch('find'); 
                 }
              
         }

//名单编辑
    public function edit($id)
    {

        $this -> isLogin();
        $student = new Student;
        $per = $student ->where('student_id',$id) ->find();
        //return dump($per);
        $this ->view ->assign('per',$per);
        return $this ->view ->fetch('view_edit');

    }
    //更改电话号，政治面貌
    public function genggai($id)
    {

        $this -> isLogin();
        $data = input('post.');
        $student = new Student;
        $student ->where('student_id',$id) ->update(['phone'=>$data['phone']]);
        $student ->where('student_id',$id) ->update(['political_status'=>$data['zz']]);
        return '<script type="text/javascript">
                  alert("更改成功！");
                </script>';

    }
    //添加人员，单人添加
    public function add()
    {

        $this -> isLogin();
        $data = input('post.');
        $student = new Student;
        $student ->student_id = $data['xh'];
        $student ->student_name = $data['xm'];
        $student ->gender = $data['xb'];
        $student ->phone = $data['phone'];
        $student ->nationality = $data['mz'];
        $student ->political_status = $data['zz'];
        $student ->save();
        return '<script type="text/javascript">
                  alert("添加成功！");
                </script>';

    }
   //删除人员 
    public function delete($id)
    {
      $this -> isLogin();
       $user = Student::destroy($id);
       //$this ->success('删除成功');
       return '<script type="text/javascript">
                 alert("删除成功");
               </script>';

    }

    //发布通知
     public function note()
    {
      $this -> isLogin();
      $data = input('post.');
          if(empty($data['a'])){
            $data['a'] = 0;
         }
         if(empty($data['b'])){
            $data['b'] = 0;
         }
         if(empty($data['c'])){
            $data['c'] = 0;
         }
         if(empty($data['d'])){
            $data['d'] = 0;
         }
      
      $note = new Note;
      $note ->up = 'alert("';
      $note ->note = $data['tongzhi'];
      $note ->down = '");';
      $note ->time = time();
      $note ->per = $data['per'];
      $note ->a = $data['a'];
      $note ->b = $data['b'];
      $note ->c = $data['c'];
      $note ->d = $data['d'];
      $note ->save();
      $this ->success('发布成功','index/index');
    }

    //授权登录者
    public function shouquan()
    {

        $this -> isLogin();
        $admin = User::query('SELECT * FROM community');
        //return dump($admin);
        $this ->view ->assign('admin',$admin);
        return $this ->view ->fetch('shouquan');

    }
    //删除授权者
       public function delete1($id)
    {
      $this -> isLogin();
       $user = Adminn::destroy($id);
       //$this ->success('删除成功');
       return '<script type="text/javascript">
                alert("删除成功！");
              </script>';
    }
//添加授权者 #################################
      public function adminadd($id)
    {
      $this -> isLogin();
      return $this ->view ->fetch('adminadd');
    }

      public function addadmin()
    {
      $this -> isLogin();
      $data = input('post.');
      $admin = new Adminn;
      $admin ->student_id = $data['zh'];
      $admin ->name = $data['xm'];
      $admin ->com_key = md5($data['mm']);
      switch ($data['qx']) {
        case '1':
          $admin ->temp = 0;
          $admin ->temp1 = 0;
          break;
        case '2':
          $admin ->temp = 1;
          $admin ->temp1 = 0;
          break;
        case '3':
          $admin ->temp = 1;
          $admin ->temp1 = 1;
          break;
      }
      $admin -> save();
      $this ->success('授权成功','add/shouquan');
    }

//######################end#############################
    //编辑授权者
    public function adminedit($id)
    {
      $this -> isLogin();
      $admin = Adminn::get($id);
      //return dump($admin);
      $this ->view ->assign('admin',$admin);
      return $this ->view ->fetch('adminedit');
    }


        public function editadmin($id)
    {
      $this -> isLogin();
      $data = input('post.');
      $temp = 0;
      $temp1= 0;
            switch ($data['qx']) {
        case '1':
          $temp = 0;
          $temp1 = 0;
          break;
        case '2':
          $temp = 1;
          $temp1 = 0;
          break;
        case '3':
          $temp = 1;
          $temp1 = 1;
          break;
      }
      $admin = new Adminn;
      $admin ->where('student_id',$id) ->update(['com_key'=>md5($data['mm']),'temp'=>$temp,'temp1'=>$temp1]);
      $this ->success('修改成功','add/shouquan');
    }


//上传新名单
    public function load()
    {
      $this -> isLogin();

      if(request() -> isPost())
        {
            vendor("PHPExcel.PHPExcel"); 
            $objPHPExcel =new \PHPExcel();
            //获取表单上传文件
            $file = request()->file('file');
            if($file){
            $info = $file->validate(['ext' => 'xlsx'])->move(ROOT_PATH . 'public');  //上传验证后缀名,以及上传之后移动的地址  E:\wamp\www\bick\public
            
            if($info)
            {
//              echo $info->getFilename();
                $exclePath = $info->getSaveName();  //获取文件名
                $file_name = ROOT_PATH . 'public' . DS . $exclePath;//上传文件的地址
                $objReader =\PHPExcel_IOFactory::createReader("Excel2007");
                $obj_PHPExcel =$objReader->load($file_name, $encode = 'utf-8');  //加载文件内容,编码utf-8
                $excel_array=$obj_PHPExcel->getSheet(0)->toArray();   //转换为数组格式
                array_shift($excel_array);  //删除第一个数组(标题);
                array_shift($excel_array);  //删除第二个数组(标题);
 //此处添加几条看规定的Excel

                $data = [];
                foreach($excel_array as $k=>$v) {
                    $data[$k]['student_id'] = $v[0];
                    $data[$k]['student_name'] = $v[1];
                    $data[$k]['gender'] = $v[2];
                    $data[$k]['phone'] = $v[3];
                    $data[$k]['nationality'] = $v[4];
                    $data[$k]['political_status'] = $v[5];

                    
                }
                User::name("student")->insertAll($data);
                //$this ->success('上传成功，点击查看确认提交！');
                return '<script type="text/javascript">
                          alert("上传成功!");
                        </script>';

                //User::name("admin")->insertAll($dataa);
            }else
            {
                echo $file->getError();
            }
          }else
          {
            return '<script> alert("请选择上传文件！");</script>';
          }
        }

    }




}
