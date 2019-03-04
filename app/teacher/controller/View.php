<?php

namespace app\teacher\controller;

use app\student\model\View as V;
use think\Controller;
use think\Request;
use think\Session;
use app\teacher\common\Base;
use app\admin\model\User;
use app\admin\model\Perform;
use app\admin\model\Student;
use app\admin\model\Sixiang;

class view extends Base
{

//查看以上传考评
    public function index()
    {
        $data = input('post.');

        $year = $data['year'];
        $yue = $data['yue'];
        $a = Session::get('use');
        // $perform = new Perform;
        // $shang = $perform ->where('date',$yue) ->where('year',$year) ->
        // select();


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
                      order by abc desc',[$yue,$year]);

        //return dump($bb);
        $this ->view ->assign('shang',$bb);
        return $this ->view ->fetch('view');
    }



 public function notok(){

     $perform = new Perform;
     $view = new V;
     $yue = $view -> where('status',1) -> select();
     $nu = array();
     $year = 0;
     $aa = array();
     foreach ($yue as $key => $value) {

       $a = $value['yue'];
       $year = $value['year'];
       array_push($aa, $a);
       //$xh = Session::get('xh');
       $xh = 12165108;
       $num = $perform ->where('status',0) ->where('date',$a) ->where('year',$year) ->select();
       foreach ($num as $key => $value) {
         array_push($nu,$value['number']);
       }
       
     }
     $num = array_unique($nu);
     $number = array();
     foreach ($num as $key => $value) {
       array_push($number, $value);
     }


      $this ->view ->assign('aa',$aa);
      $this ->view ->assign('year',$year);
      $this ->view ->assign('number',$number);
      return $this ->view ->fetch('view/notok');
 }


}
