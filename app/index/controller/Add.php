<?php

namespace app\index\controller;
use think\Session;
use think\Controller;
use app\index\common\Base;
use app\admin\model\User;
use app\admin\model\Perform;
use app\admin\model\Student;
use app\admin\model\Sixiang;
       
class Add extends Base
{

//查看上传

    public function view()
    {

        //$this -> isLogin();
        //$aa = User::all(); 
         $a = Session::get('us');
         if(empty($a)){
          $a = Session::get('user');
         }
        $bb = User::query('SELECT
            *
        FROM
            (
                SELECT
                    p.number,
                    p.perform_id,
                    p.activity,
                    p.grade,
                    p.three_id,
                    t.three_name,
                    p.upload_id,
                    p.date,
                    p.xq,
                    p.temp,
                    p.per,
                    p.beizhu,
                    p.year,
                    p.examine_id
                FROM
                    perform AS p,
                    three AS t
                WHERE
                    p.three_id = t.three_id
                    AND p.per = ?
            ) AS a 
            
        LEFT JOIN student ON a.number = student_id',[$a]); 
        //return dump($bb);
        $this ->view ->assign('aa',$bb);
        //$this ->view ->assign('number_arr',$number_arr);
        return $this ->view ->fetch('view_up');
    }


    //上传excal代码
    public function add(){
        //$this -> isLogin();
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
                //return dump($excel_array);
                //$year = $excel_array[2][2];
                switch ($excel_array[2][2]) {
                  case '政治素养':
                    $three_id = 18;
                    break;
                    case '道德素养':
                    $three_id = 19;
                    break;
                    case '法纪观念':
                    $three_id = 20;
                    break;
                    case '集体观念':
                    $three_id = 1;
                    break;
                    case '诚信意识':
                    $three_id = 21;
                    break;
                    case '安全意识':
                    $three_id = 22;
                    break;
                    case '文明修养':
                    $three_id = 23;
                    break;
                    case '学习态度':
                    $three_id = 2;
                    break;
                    case '卫生习惯':
                    $three_id = 3;
                    break;
                    case '生活习惯':
                    $three_id = 4;
                    break;
                    case '学期内各课程平均学分绩成绩':
                    $three_id = 5;
                    break;
                    case '体质健康状况':
                    $three_id = 6;
                    break;
                    case '阳光运动情况':
                    $three_id = 7;
                    break;
                    case '参加校园文化活动情况':
                    $three_id = 8;
                    break;
                    case '文化、艺术竞赛成绩':
                    $three_id = 9;
                    break;
                    case '发表文艺、新闻作品':
                    $three_id = 10;
                    break;
                    case '社会实践':
                    $three_id = 11;
                    break;
                    case '志愿服务':
                    $three_id = 12;
                    break;
                    case '创新创业':
                    $three_id = 13;
                    break;
                    case '学科竞赛':
                    $three_id = 14;
                    break;
                    case '学术著作':
                    $three_id = 15;
                    break;
                    case '实践技能':
                    $three_id = 16;
                    break;
                    case '学生干部任职':
                    $three_id = 17;
                    break;
                    default:
                    return '<script type="text/javascript">
                              alert("填写三级指标有误");
                            </script>';
                    break;
                }
                
                $qq = explode('-',$excel_array[5][1]);
                $year = (int)$qq[0];


                $yue = $excel_array[2][5];
                if($excel_array[5][4]=='第一学期'){
                  $xq = 1;
                }
                if($excel_array[5][4]=='第二学期'){
                  $xq = 2;
                }
                //return $three_id.$yue.$xq.$year;
                array_shift($excel_array);  //删除第二个数组(标题);
                array_shift($excel_array);  //此处添加几条看规定的Excel
                array_shift($excel_array);
                array_shift($excel_array);
                array_shift($excel_array);
                array_shift($excel_array);
                array_shift($excel_array);
                //array_shift($excel_array);
         
          
          $a = Session::get('us');
         if(empty($a)){
          $a = Session::get('user');
         }

                //return dump($excel_array);
                
                $data = [];
                foreach($excel_array as $k=>$v) {
                    if(!empty(array_filter($v))){
                    $data[$k]['number'] = $v[0];
                    $data[$k]['activity'] = $v[2];
                    $data[$k]['grade'] = $v[4];
                    $data[$k]['beizhu'] = $v[5];
                    $data[$k]['temp'] = $v[5];
                    $data[$k]['three_id'] = $three_id;
                    $data[$k]['date'] = $yue;
                    $data[$k]['year'] = $year;
                    $data[$k]['xq'] = $xq;
                    $data[$k]['create_time'] = date('Y-m-d H:i:s');
                    $data[$k]['abc'] = time();
                    $data[$k]['per'] = $a;
                   }
                   // if (count(array_filter($v))==9) {
                   //   return '请检查Excal填写手否完整';
                   // }
                }
                //return dump($data);
                User::name("perform")->insertAll($data);
                //$this ->success('上传成功，点击查看确认提交！');
                return '<script> alert("上传成功，点击查看查看上传按钮确认上传！");</script>';
                

                //User::name("admin")->insertAll($dataa);
            }else
            {
                echo $file->getError();
            }
          }else{return '<script> alert("请选择上传文件！");</script>';}
        }

    }



//上传者点击确认无误，数据库存入上传者学号
        public function stat()
       {       
//关联加分  
         $a = Session::get('user');
         if(empty($a)){
          $a = Session::get('us');
         }
         $data = input('post.');//关联项目提交的表单
         //return dump($data);
        if(count($data)!=0) { 

         if(!empty($data['a'])){
            self::guanlian(18);
         }
         if(!empty($data['b'])){
            self::guanlian(19);
         }
         if(!empty($data['c'])){
            self::guanlian(20);
         }
         if(!empty($data['d'])){
            self::guanlian(1);
         }
          if(!empty($data['e'])){
            self::guanlian(21);
         }
          if(!empty($data['f'])){
            self::guanlian(22);
         }
         if(!empty($data['g'])){
            self::guanlian(23);
         }
         

         //return dump($number);
         
    }
         $a = Session::get('us');
         if(empty($a)){
          $a = Session::get('user');
         }
         $user = new Perform;
         $user->where('upload_id', 0)->where('per', $a)->update(['upload_id'=>$a]);

         //$this ->success('数据保存成功');
         return '<script> alert("数据保存成功！");</script>';

    }
    //内部调用关联选项，内部函数
     public function guanlian($id){
          $perform = new Perform;
          $bb = $perform ->where('upload_id',0)-> select();
           $a = Session::get('us');
         if(empty($a)){
          $a = Session::get('user');
         }
           $number = [];
         foreach ($bb as $key => $value) {
             if($value['upload_id']<2){
             //$number[$key]['num'] = $value['perform_id'];
             $number[$key]['number'] = $value['number'];
             $number[$key]['activity'] = $value['activity'];
             $number[$key]['three_id'] = $id;
             $number[$key]['grade'] = 0.5;
             $number[$key]['date'] = $value['date'];
             $number[$key]['year'] = $value['year'];
             $number[$key]['xq'] = $value['xq'];
             $number[$key]['temp'] = '关联项';
             $number[$key]['beizhu'] = '关联项';
             $number[$key]['date'] = $value['date'];
             $number[$key]['year'] = $value['year'];
             $number[$key]['create_time'] = date('Y-m-d H:i:s');
             $number[$key]['upload_id'] = $a;
             $number[$key]['abc'] = $value['abc'];
             $number[$key]['per'] = $a;
      
             }
         }
         User::name("perform")->insertAll($number);
}
//按学号查询
     public function chaxun()
    {
      //$this -> isLogin();
       $data = input('post.');
       $xh = $data['xh'];
       //return dump($aa);

        $bb = User::query('
       SELECT
           t.student_id,
           t.student_name,
           t.phone,
           per.activity,
           per.perform_id,
           per.grade,
           per.abc,
           per.beizhu,
           per.year,
           per.xq,
           per.examine_id,
           per.three_name,
           per.upload_id,
           per.three_id,
           per.examine_id
       FROM
           student AS t
       LEFT JOIN (
           SELECT
               p.number,
               p.perform_id,
               p.activity,
               p.grade,
               p.abc,
               p.year,
               p.xq,
               p.beizhu,
               p.three_id,
               t.three_name,
               p.upload_id,
               p.examine_id
           FROM
               perform AS p,
               three AS t
           WHERE
               p.three_id = t.three_id
       ) AS per ON t.student_id = per.number
       WHERE
           t.student_id = ? AND per.examine_id is not null
           order by abc desc,number desc',[$xh]);

       // return dump($bb[0]['upload_id']);


       if(!empty($bb)){
       $student = new Student;
       $upload = $student ->where('student_id',$bb[0]['upload_id']) ->find();
       //return dump($upload);
       //return dump($upload);
       //$this ->view ->assign('time', date('Y/m/d H:i:s',$bb[0]['abc']));
       $this ->view ->assign('upload',$upload['student_name']);
       $this ->view ->assign('aa',$bb);
       $this ->view ->assign('xh',$xh);
       return $this->fetch("find");
     }
       else{
            return '<script type="text/javascript">
                      alert("无法查询到该学号，请核实正确后查询");
                    </script>';
     }

    }
//按姓名查询
    public function chaxunn()
    {
       //$this -> isLogin();
       $data = input('post.');
       $xm = $data['xm'];
       //return dump($aa);

        $bb = User::query('
       SELECT
           t.student_id,
           t.student_name,
           t.phone,
           per.activity,
           per.perform_id,
           per.grade,
           per.abc,
           per.beizhu,
           per.year,
           per.xq,
           per.examine_id,
           per.three_name,
           per.upload_id,
           per.three_id,
           per.examine_id
       FROM
           student AS t
       LEFT JOIN (
           SELECT
               p.number,
               p.perform_id,
               p.activity,
               p.grade,
               p.abc,
               p.year,
               p.xq,
               p.beizhu,
               p.three_id,
               t.three_name,
               p.upload_id,
               p.examine_id
           FROM
               perform AS p,
               three AS t
           WHERE
               p.three_id = t.three_id
       ) AS per ON t.student_id = per.number
       WHERE
           t.student_name = ? AND per.examine_id is not null
           order by abc desc,number desc',[$xm]);

        //return dump($bb);

       if(!empty($bb)){
       $student = new Student;
       $upload = $student ->where('student_id',$bb[0]['upload_id']) ->find();
       //return dump($upload);
       $this ->view ->assign('time', date('Y/m/d H:m:s',$bb[0]['abc']));
       $this ->view ->assign('upload',$upload['student_name']);
       $this ->view ->assign('aa',$bb);
       $this ->view ->assign('xh',$xm);
       return $this->fetch("find");
     }
       else{
            return '<script type="text/javascript">
                      alert("无法查询到该姓名，请核实正确后查询");
                    </script>';
     }
    }

//查看该同学学年学期上传的考评。  位置：添加考评——>姓名学号搜索下的学年学期检索
    public function jiansuo()
    {
            //$this -> isLogin();
       $data = input('post.');
       $xh = $data['xh'];
       $xn = $data['xn'];
       $xq = $data['xq'];
       //return dump($aa);

        $bb = User::query('
       SELECT
           t.student_id,
           t.student_name,
           t.phone,
           per.activity,
           per.perform_id,
           per.grade,
           per.abc,
           per.year,
           per.xq,
           per.temp,
           per.beizhu,
           per.examine_id,
           per.three_name,
           per.upload_id,
           per.three_id,
           per.examine_id
       FROM
           student AS t
       LEFT JOIN (
           SELECT
               p.number,
               p.perform_id,
               p.activity,
               p.grade,
               p.abc,
               p.year,
               p.xq,
               p.temp,
               p.beizhu,
               p.three_id,
               t.three_name,
               p.upload_id,
               p.examine_id
           FROM
               perform AS p,
               three AS t
           WHERE
               p.three_id = t.three_id
       ) AS per ON t.student_id = per.number
       WHERE
           t.student_id = ? AND per.year = ? AND per.xq = ? 
           order by abc desc,number desc',[$xh,$xn,$xq]);

       //return dump($bb);


       if(!empty($bb)){
       $student = new Student;
       $upload = $student ->where('student_id',$bb[0]['upload_id']) ->find();
       //return dump($upload);
       //$this ->view ->assign('time', date('Y/m/d H:i:s',$bb[0]['abc']));
       $this ->view ->assign('upload',$upload['student_name']);
       $this ->view ->assign('aa',$bb);
       $this ->view ->assign('xh',$xh);
       return $this->fetch("find");
     }
       else{
            return '<script type="text/javascript">
                      alert("无法查询到该学号，请核实正确后查询");
                    </script>';
     }
    }

//查找后编辑
    public function edit($id)
    {

        //$this -> isLogin();
        $aa = Perform::get($id);

        $bb = User::query('SELECT
       *
       FROM
       perform as p
       LEFT JOIN
       student
       ON
       p.number = student.student_id
       WHERE
       p.perform_id = ?
       ',[$id]);

       //return dump($bb);
       if(!empty($bb[0]['student_name'])){

        $xm = $bb[0]['student_name'];
        $xh = $bb[0]['student_id'];
        //return dump($aa);
        $this ->view ->assign('xm',$xm);
        $this ->view ->assign('aa',$aa);
        $this ->view ->assign('xh',$xh);
        return $this ->view ->fetch('view_edit');
      }else{
        echo "<center><h1>该项为空，不支持编辑<h1></center>";
      }
    }



     //上传者更改，更改内容：事件、分数
        public function genggai($id)
    {
       //$this -> isLogin();
        $data = input('post.');
        $admin = Perform::get($id);
        $admin ->activity = $data['shijian'];
        $admin ->grade = $data['fen'];
        $admin ->update_time = date('Y-m-d H:i:s');
        $admin ->save();
        //$this ->success('更改成功');
        return '<script> alert("更改成功！");</script>';

    }

   //删除
    public function delete($id)
    {
      //$this -> isLogin();
       $user = Perform::destroy($id);
       //$this ->success('删除成功');
       return '<script> alert("删除成功！");</script>';
    }

    //取消上传
    public function cel()
    {
               $a = Session::get('us');
         if(empty($a)){
          $a = Session::get('user');
         }
       $user = new Perform;
       $user -> where('upload_id',0) ->where('per', $a)->delete();
       //$this ->success('已取消上传');
       return '<script> alert("已取消上传！");</script>';
    }
//%%%%%%%%%%%%%手动添加考评！！！！！！！！！！！！！！
    public function tianjia($ida)
    {
        $user = Student::get($ida);
        
        $this ->view ->assign('xm',$user['student_name']);
        $this ->view ->assign('xh',$ida);
        return $this ->view ->fetch('add');
    }


     public function tianjiaq($id)
    {
        //$this -> isLogin();
         $a = Session::get('us');
         if(empty($a)){
          $a = Session::get('user');
         }
        $data = input('post.');
        $perform = new Perform;
        $perform ->number = $id;
        $perform ->activity = $data['shijian'];
        $perform ->grade = $data['fen'];
        $perform ->date = $data['yue'];
        $perform ->year = $data['year'];
        $perform ->xq = $data['xq'];
        $perform ->three_id = $data['san'];
        //$perform ->upload_id = Session::get('us');
        $perform ->create_time = date('Y-m-d H:i:s');
        $perform ->update_time = date('Y-m-d H:i:s');
        $perform ->abc = time();
        $perform ->save();

//加关联项，如无post为5项
if(count($data)!=5){

        if(!empty($data['a'])){
            self::guanlian(18);
         }
         if(!empty($data['b'])){
            self::guanlian(19);
         }
         if(!empty($data['c'])){
            self::guanlian(20);
         }
         if(!empty($data['d'])){
            self::guanlian(1);
         }
          if(!empty($data['e'])){
           self::guanlian(21);
         }
          if(!empty($data['f'])){
            self::guanlian(22);
         }
         if(!empty($data['g'])){
            self::guanlian(23);
         }


}
         $user = new Perform;
         $user->where('upload_id', 0)->update(['upload_id'=>$a]);
        //$this ->success('已保存信息');
        return '<script> alert("已保存信息！");</script>';
    }

//############################################################
   


}
