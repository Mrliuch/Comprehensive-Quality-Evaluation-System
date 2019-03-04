<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\index\common\Base;
use app\admin\model\User;
use app\admin\model\Perform;
use app\teacher\model\Three;
use app\admin\model\Student;
use app\admin\model\Sixiang;

class view extends Base
{

//查看已上传考评
    public function index()
    {
        $data = input('post.');

        $year = $data['year'];
        $yue = $data['yue'];
        $a = Session::get('us');
        $perform = new Perform;
        $shang = $perform ->where('date',$yue) ->where('year',$year) ->select();


        $bb = User::query('
                             SELECT
                        *
                      FROM
                        perform AS p
                      LEFT JOIN three AS t ON p.three_id = t.three_id
                      LEFT JOIN student AS s ON p.number = s.student_id
                      WHERE
                      p.date = ?
                      AND p.`year` = ?
                      order by abc desc,number desc',[$yue,$year]);

        //return dump($bb);
        $id = 0;
        $this ->view ->assign('shang',$bb);
        $this ->view ->assign('id',$id);
        return $this ->view ->fetch('view');
    }
//=============================查看同学考评======================//
//查看同学考评
  public function viewcj()
  {
    //$this -> isLogin();
    $data = input('post.');
    $student = new Student;
    $xh = $data['xh'];
    $xn = $data['xn'];
    $xq = $data['xq'];
    $name = $student ->where('student_id',$xh) ->find();

    
    //学习态度
        $bb2 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=2 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);

//卫生习惯
        $bb3 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=3 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //生活态度
        $bb4 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=4 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
   //学习成绩
        $bb5 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=5 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
        //体质健康状况
        $bb6 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=6 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //阳光体育
        $bb7 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=7 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //文化活动
        $bb8 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=8 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //文艺、艺术竞赛
        $bb9 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=9 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //发表文艺、新闻作品
        $bb10 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=10 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //社会实践
        $bb11 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=11 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
//志愿服务
        $bb12 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=12 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //创新创业
        $bb13 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=13 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //学科竞赛
        $bb14 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=14 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //学术著作
        $bb15 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=15 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //实践技能
        $bb16 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=16 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
    //任职情况
        $bb17 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=17 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);

    //政治素养
        $bb18 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=18 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
        //道德素养
        $bb19 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=19 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);  
        //法纪观念      
        $bb20 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=20 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
        //return dump($bb20);
        //诚信意识
        $bb21 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=21 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
        //安全意识
        $bb22 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=22 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
        //文明修养
        $bb23 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=23 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
        //集体观念
        $bb1 = User::query('
                     SELECT p.activity,p.grade,t.three_name,p.year,p.xq FROM perform AS p LEFT JOIN three AS t ON p.three_id = t.three_id LEFT JOIN student AS s ON p.number = s.student_id WHERE p.examine_id IS NOT NULL AND p.number=? AND p.three_id=1 AND p.year=? AND p.xq=?',[$xh,$xn,$xq]);
       //return dump($bb8);
//************2222****************************
$g2=array();
foreach ($bb2 as $key => $value) {
  array_push($g2, $value['grade']);
}
$grade2 = (array_sum($g2)+6)*0.15;
if($grade2>1.5){$grade2=1.5;}
if($grade2<=0){$grade2=0;}
//****************************************
//************181818****************************
$g18=array();
foreach ($bb18 as $key => $value) {
  array_push($g18, $value['grade']);
}
$grade18 = (array_sum($g18)+6)*0.15;
if($grade18>1.5){$grade18=1.5;}
if($grade18<=0){$grade18=0;}
//****************************************
//************191919****************************
$g19=array();
foreach ($bb19 as $key => $value) {
  array_push($g19, $value['grade']);
}
$grade19 = (array_sum($g19)+6)*0.15;
if($grade19>1.5){$grade19=1.5;}
if($grade19<=0){$grade19=0;}
//****************************************
//************202020****************************
$g20=array();
foreach ($bb20 as $key => $value) {
  array_push($g20, $value['grade']);
}
$grade20 = (array_sum($g20)+6)*0.15;
if($grade20>1.5){$grade20=1.5;}
if($grade20<=0){$grade20=0;}
//****************************************

//************212121****************************
$g21=array();
foreach ($bb21 as $key => $value) {
  array_push($g21, $value['grade']);
}
$grade21 = (array_sum($g21)+6)*0.15;
if($grade21>1.5){$grade21=1.5;}
if($grade21<=0){$grade21=0;}
//****************************************
//************222222****************************
$g22=array();
foreach ($bb22 as $key => $value) {
  array_push($g22, $value['grade']);
}
$grade22 = (array_sum($g22)+6)*0.15;
if($grade22>1.5){$grade22=1.5;}
if($grade22<=0){$grade22=0;}
//****************************************
//************232323****************************
$g23=array();
foreach ($bb23 as $key => $value) {
  array_push($g23, $value['grade']);
}
$grade23 = (array_sum($g23)+6)*0.15;
if($grade23>1.5){$grade23=1.5;}
if($grade23<=0){$grade23=0;}
//****************************************
//************111****************************
$g1=array();
foreach ($bb1 as $key => $value) {
  array_push($g1, $value['grade']);
}
$grade1 = (array_sum($g1)+6)*0.15;
if($grade1>1.5){$grade1=1.5;}
if($grade1<=0){$grade1=0;}
//****************************************
//***************33333*************************
$g3=array();
foreach ($bb3 as $key => $value) {
  array_push($g3, $value['grade']);
}
$grade3 = (array_sum($g3)+6)*0.15;
if($grade3>1.5){$grade3=1.5;}
if($grade3<=0){$grade3=0;}
//****************************************
//***************4444*************************
$g4=array();
foreach ($bb4 as $key => $value) {
  array_push($g4, $value['grade']);
}
$grade4 = (array_sum($g4)+6)*0.15;
if($grade4>1.5){$grade4=1.5;}
if($grade4<=0){$grade4=0;}
//****************************************

//***************5555**期末成绩***********************
$g5=array();
foreach ($bb5 as $key => $value) {
  array_push($g5, $value['grade']);
}
$grade5 = (array_sum($g5))*0.7;
if($grade5>70){$grade5=70;}
if($grade5<=0){$grade5=0;}
//****************************************

//***************6666*************************
$g6=array();
foreach ($bb6 as $key => $value) {
  array_push($g6, $value['grade']);
}
$grade6 = (array_sum($g6))*0.03;
if($grade6>0.9){$grade6=0.9;}
if($grade6<=0){$grade6=0;}
//****************************************

//***************7777*************************
$g7=array();
foreach ($bb7 as $key => $value) {
  array_push($g7, $value['grade']);
}
$grade7 = (array_sum($g7))*0.03;
if($grade7>2.1){$grade7=2.1;}
if($grade7<=0){$grade7=0;}
//****************************************

//*********##1******8888*************************
$g8=array();
foreach ($bb8 as $key => $value) {
  array_push($g8, $value['grade']);
}
$grade8 = (array_sum($g8))*0.04;
if($grade8>4){$grade8=4;}
if($grade8<=0){$grade8=0;}
//****************************************

//*********##1******9999*************************
$g9=array();
foreach ($bb9 as $key => $value) {
  array_push($g9, $value['grade']);
}
$grade9 = (array_sum($g9))*0.04;
if($grade9>4){$grade9=4;}
if($grade9<=0){$grade9=0;}
//****************************************

//*********##1******10101010*************************
$g10=array();
foreach ($bb10 as $key => $value) {
  array_push($g10, $value['grade']);
}
$grade10 = (array_sum($g10))*0.04;
if($grade10>4){$grade10=4;}
if($grade10<=0){$grade10=0;}
//****************************************

//*************##2**11111111*************************
$g11=array();
foreach ($bb11 as $key => $value) {
  array_push($g11, $value['grade']);
}
$grade11 = (array_sum($g11))*0.06;
if($grade11>6){$grade11=6;}
if($grade11<=0){$grade11=0;}
//****************************************

//*********##2******12121212*************************
$g12=array();
foreach ($bb12 as $key => $value) {
  array_push($g12, $value['grade']);
}
$grade12 = (array_sum($g12))*0.06;
if($grade12>6){$grade12=6;}
if($grade12<=0){$grade12=0;}
//****************************************

//*********##2******13131313*************************
$g13=array();
foreach ($bb13 as $key => $value) {
  array_push($g13, $value['grade']);
}
$grade13 = (array_sum($g13))*0.06;
if($grade13>6){$grade13=6;}
if($grade13<=0){$grade13=0;}
//****************************************

//*********##2******14141414*************************
$g14=array();
foreach ($bb14 as $key => $value) {
  array_push($g14, $value['grade']);
}
$grade14 = (array_sum($g14))*0.06;
if($grade14>6){$grade14=6;}
if($grade14<=0){$grade14=0;}
//****************************************

//*********##2******15151515*************************
$g15=array();
foreach ($bb15 as $key => $value) {
  array_push($g15, $value['grade']);
}
$grade15 = (array_sum($g15))*0.06;
if($grade15>6){$grade15=6;}
if($grade15<=0){$grade15=0;}
//****************************************

//*********##2******16161616*************************
$g16=array();
foreach ($bb16 as $key => $value) {
  array_push($g16, $value['grade']);
}
$grade16 = (array_sum($g16))*0.06;
if($grade16>6){$grade16=6;}
if($grade16<=0){$grade16=0;}
//****************************************

//*********##2******17171717*************************
$g17=array();
foreach ($bb17 as $key => $value) {
  array_push($g17, $value['grade']);
}
$grade17 = (array_sum($g17))*0.02;
if($grade17>2){$grade17=2;}
if($grade17<=0){$grade17=0;}
//****************************************
$wenhua = $grade8+$grade9+$grade10;
if($wenhua>4){$wenhua = 4;}
$shijian = $grade11+$grade12+$grade13+$grade14+$grade15+$grade16;
if($shijian>6){$shijian = 6;}
$kao = $grade2+$grade3+$grade4+$grade6+$grade7+$wenhua+$shijian+$grade17;



$gradebb = $grade1+$grade18+$grade19+$grade20+$grade21+$grade22+$grade23;
//****************************************

$kao = $gradebb+$grade2+$grade3+$grade4+$grade6+$grade7+$wenhua+$shijian+$grade17;
$zong = $kao+$grade5;
//return dump($kao);
$chengji = $grade5/0.7;
$sixiang = $gradebb+$grade2+$grade3+$grade4;
$tizhi = $grade6+$grade7;
$huodong = $grade8+$grade9+$grade10;
$ganbu = $grade17;
$chuangxin = $grade11+$grade12+$grade13+$grade14+$grade15+$grade16;
//return dump($grade6);
$this ->view ->assign('b',$chengji);
$this ->view ->assign('a',$sixiang);
$this ->view ->assign('c',$tizhi);
$this ->view ->assign('d',$huodong);
$this ->view ->assign('f',$ganbu);
$this ->view ->assign('e',$chuangxin);


//return dump($pic[0]['sum']);
    $arr =array();
    $arr[0] = $sixiang;
    $arr[1] = $chengji;
    $arr[2] = $tizhi;
    $arr[3] = $huodong;
    $arr[4] = $chuangxin;
    $arr[5] = $sixiang;

    $this ->view ->assign('kao',$kao);
    $this ->view ->assign('arr',$arr);
    $this ->view ->assign('cheng',$grade5);
    $this ->view ->assign('zong',$zong);
    //$this ->view ->assign('bb',$bb);
    $this ->view ->assign('bb1',$bb1);
    $this ->view ->assign('bb2',$bb2);
    $this ->view ->assign('bb3',$bb3);
    $this ->view ->assign('bb4',$bb4);
    $this ->view ->assign('bb5',$bb5);
    $this ->view ->assign('bb6',$bb6);
    $this ->view ->assign('bb7',$bb7);
    $this ->view ->assign('bb8',$bb8);
    $this ->view ->assign('bb9',$bb9);
    $this ->view ->assign('bb10',$bb10);
    $this ->view ->assign('bb11',$bb11);
    $this ->view ->assign('bb12',$bb12);
    $this ->view ->assign('bb13',$bb13);
    $this ->view ->assign('bb14',$bb14);
    $this ->view ->assign('bb15',$bb15);
    $this ->view ->assign('bb16',$bb16);
    $this ->view ->assign('bb17',$bb17);
    $this ->view ->assign('bb18',$bb18);
    $this ->view ->assign('bb19',$bb19);
    $this ->view ->assign('bb20',$bb20);
    $this ->view ->assign('bb21',$bb21);
    $this ->view ->assign('bb22',$bb22);
    $this ->view ->assign('bb23',$bb23);
    $this ->view ->assign('name',$name['student_name']);
    return $this ->view ->fetch('view/one');
  }
//*************************end查看同学考评end************************//

//=======================查看未审核考评=======================//
  //查看未审核考评
public function viewnull()
    {


        $a = Session::get('us');
        $perform = new Perform;
        //$shang = $perform ->where('examine_id',null) ->select();


        $bb = User::query('
                             SELECT
                        *
                      FROM
                        perform AS p
                      LEFT JOIN three AS t ON p.three_id = t.three_id
                      LEFT JOIN student AS s ON p.number = s.student_id
                      WHERE
                      p.examine_id is null 
                      
                      ');

        //return dump($bb);
        $id = 0;
        $this ->view ->assign('shang',$bb);
        $this ->view ->assign('id',$id);
        return $this ->view ->fetch('view');
    }
//查看未审核考评----最终确认
public function queren($id)
    {
     //return $id;
      $data = input('post.');
      $xm = $data['xm'];
      //return $xm;s
      $a = Session::get('us');
      $user = new Perform;
      if($id==0){
      $user->where('examine_id', null)->update(['examine_id'=>$a,'examine'=>$xm]);
      return '<center><h1>'.$xm.'署名成功，确认成功，已完成最终审核！<h1></center>';
    }else{
      $user->where('examine_id', null)->where('upload_id', $id)->update(['examine_id'=>$a,'examine'=>$xm]);
      return '<center><h1>'.$xm.'署名成功，确认成功，已完成最终审核！<h1></center>';
    }
      

    }
//***********************end查看未审核考评end*************************//


//============================查看各上传者考评============================//
//查看各上传者考评
public function viewload()
    {
      $perform = new Perform;
      $per = User::query('
        SELECT
a.upload_id,a.student_name,a.s1,a.t,b.s2
FROM
(SELECT
perform.upload_id, student.student_name,count(perform.upload_id)as s1,max(perform.abc) as t
FROM
perform LEFT JOIN student ON perform.upload_id=student.student_id
GROUP BY
perform.upload_id) as a
LEFT JOIN
(SELECT
perform.upload_id,COUNT(*) as s2
FROM
perform
WHERE
perform.examine_id IS NULL

GROUP BY
perform.upload_id)as b
ON
a.upload_id=b.upload_id

        '); 
      
      $this ->view ->assign('per',$per);
      return $this ->view ->fetch('view/viewload');
    }

//查看上传者未审核

public function viewguannot($id){
  $sixiang = User::query('
SELECT
p.number as student_id,s.student_name,p.perform_id,p.beizhu,p.activity,p.grade,t.three_name,t.three_id,p.date,p.`year`,p.upload_id,p.examine_id,p.create_time,p.abc
FROM
perform as p 
left join student as s on p.number=s.student_id
LEFT JOIN three as t ON p.three_id=t.three_id
WHERE
p.examine_id is NULL
AND
p.upload_id=?',[$id]);
//return dump($sixiang);
  $this ->view ->assign('shang',$sixiang);
  $this ->view ->assign('id',$id);
  return $this ->view ->fetch('view/view');
}

//查看上传者全部考评
public function viewguanall($id){
  $sixiang = User::query('
SELECT
p.number as student_id,s.student_name,p.perform_id,p.beizhu,p.activity,p.grade,t.three_name,t.three_id,p.date,p.`year`,p.upload_id,p.examine_id,p.create_time,p.abc
FROM
perform as p 
left join student as s on p.number=s.student_id
LEFT JOIN three as t ON p.three_id=t.three_id
WHERE
p.upload_id=?

order by abc desc,number desc',[$id]);
//return dump($sixiang);
  $this ->view ->assign('shang',$sixiang);
  $this ->view ->assign('id',$id);
      return $this ->view ->fetch('view/view');
}

//************************end查看各上传者考评end***********************//



//============================查看关联考评=============================//

    //学生干部、教师端：查看关联考评
    public function viewguan(){

    $sixiang = User::query('
    SELECT * FROM perform WHERE temp="关联项" order by abc desc
      ');
    //return dump($sixiang);
    $this ->view ->assign('sixiang',$sixiang);
    return $this ->view ->fetch('view/viewguan');
    }

//学生干部端：查看关联考评----编辑
  public function editguan($id){
    $aa = Perform::get($id);
    //return dump($aa);
    $this ->view ->assign('aa',$aa);
    return $this ->view ->fetch('view/editguan');
    }


//学生干部端：查看关联考评----编辑----保存
   public function editgai($id){
      $data = input('post.');
       $perform = new Perform;
       $perform ->where('perform_id',$id)->update(['activity'=>$data['activity'],'grade'=>$data['grade']]);
       //$this ->success('更改成功！');
       return '<script> alert("更改成功！");</script>';
   }

//============================end查看关联考评end===============================//
}
