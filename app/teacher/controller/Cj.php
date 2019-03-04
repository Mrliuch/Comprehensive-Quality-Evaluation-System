<?php

namespace app\teacher\controller;
use think\Session;
use think\Controller;
use app\teacher\common\Base;
use app\admin\model\User;
use app\admin\model\Perform;
use app\admin\model\Sixiang;
use app\admin\model\Student;
use app\teacher\model\Admin;
use app\teacher\model\Grade;
use app\teacher\model\Adminn;
use app\teacher\model\Note;
       
class Cj extends Base
{    
//存入成绩
      public function index(){
      
        $nj = input('post.');
        $xn = $nj['xn'];
        $xq = $nj['xq'];
        //return dump($bb);
        $tiaojian = $nj['nj'].'%';
        //查找学生表
        $stu = Student::query('
                   SELECT 
                   student_id,student_name
                   FROM
                   student s
                   WHERE
                   s.student_id LIKE ?
      
          ',[$tiaojian]);
        //return dump($stu);
        $per = array();//学号
        $per_name = array();//姓名
      foreach ($stu as $key => $value) {
        array_push($per, $value['student_id']);
        array_push($per_name, $value['student_name']);
      }

         $gra = new Grade;
         $aa = $gra ->where('year',$xn) ->where('xq',$xq) ->where('status',$nj['nj']) ->
          select();
         if(!empty($aa)){
      return '<script type="text/javascript">
                alert("已存入该学年学期该学年或该专业成绩");
              </script>';
    }
      for($i=0;$i<count($per);$i++){
         $xh = $per[$i];
         $xm = $per_name[$i];
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
        //return dump($bb5);
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
    


$data = ['student_id'=> $xh,'sum_g1'=>$kao/0.3,'sum_g2'=> $grade5/0.7,'sum_g12'=>$zong,'time1'=>$nj['nj'],'time'=>time(),'xq'=>$nj['xq'],'year'=>$nj['xn'],'status'=>$nj['nj']];
//return dump($data);
User::table('grade')->insert($data);

}
return '<script type="text/javascript">
          alert("存入成功");
        </script>';
}

  public function cun(){
              $grade = User::query('
      SELECT * FROM grade
    ');
  
  $time = array();
  $ye = array(); 
  foreach ($grade as $key => $value) {
    array_push($time, $value['time1']);
    array_push($ye, $value['year']);
  }
  $hao = array_unique($time);
  $year = array_unique($ye);
 

  $hao1 = array();
  $year1 = array();
  foreach ($hao as $key => $value) {
    array_push($hao1, $value); 
  }
    foreach ($year as $key => $value) {
    array_push($year1, $value); 
  }
   //return dump($xq2);
  $this ->view ->assign('year',$year1);
  $this ->view ->assign('grade',$grade);
  return $this ->view ->fetch('cj/cun');
}

//修改成绩
public function xiugai($id){

  $grade = new Grade;
  $gra = $grade -> where('id',$id) ->find();

  //return dump($gra);
  $this ->view ->assign('grade',$gra);
  return $this ->view ->fetch('cj/xiugai');    
}

public function editcj($id){
  $cj = input('post.');

  $grade = new Grade;
  $zong = $cj['kp']*0.3+$cj['qm']*0.7;
  $gra = $grade -> where('id',$id) ->update(['sum_g1'=>$cj['kp'],'sum_g2'=>$cj['qm'],'sum_g12'=>$zong]);

  //return dump($gra);
  //$this ->success('修改成功');
  return '<script type="text/javascript">
            alert("修改成功！");
          </script>';
     
}
//修改成绩end！！！！！！！！！！！！！！！！！！！！！！！

//排名。按综合
 public function viewgrade(){

  $cx = input('post.');
  $cha = $cx['nj'].'%';
  $grade = User::query('
   SELECT * FROM grade WHERE student_id LIKE ? AND xq =? AND year =? order by sum_g12 DESC
    ',[$cha,$cx['xq'],$cx['xn']]);
  $this ->view ->assign('grade',$grade);
  $this ->view ->assign('cha',$cha);
  return $this ->view ->fetch('cj/viewgrade');   
  //return dump($grade);
}

//排名。按考评
 public function viewgrade1(){

  $cx = input('post.');
  $cha = $cx['nj'].'%';
  $grade = User::query('
   SELECT * FROM grade WHERE student_id LIKE ? AND xq =? AND year =? order by sum_g1 DESC
    ',[$cha,$cx['xq'],$cx['xn']]);
  $this ->view ->assign('grade',$grade);
  $this ->view ->assign('cha',$cha);
  return $this ->view ->fetch('cj/viewgrade');   
  //return dump($grade);
} 

//排名。按期末
public function viewgrade2(){

  $cx = input('post.');
  $cha = $cx['nj'].'%';
  $grade = User::query('
   SELECT * FROM grade WHERE student_id LIKE ? AND xq =? AND year =? order by sum_g2 DESC
    ',[$cha,$cx['xq'],$cx['xn']]);
  $this ->view ->assign('grade',$grade);
  $this ->view ->assign('cha',$cha);
  return $this ->view ->fetch('cj/viewgrade');   
  return dump($grade);
} 

}