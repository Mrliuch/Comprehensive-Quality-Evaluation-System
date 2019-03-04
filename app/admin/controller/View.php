<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\common\Base;
use app\admin\model\User;
use app\admin\model\Perform;
use app\admin\model\Student;
//学生干部查看考评
class view extends Base
{

//查看已上传考评
    public function index()
    {
        $data = input('post.');

        $year = $data['year'];
        $yue = $data['yue'];
        $a = Session::get('user');


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
                      AND p.`upload_id` = ?
                      order by abc desc',[$yue,$year,$a]);

        $this ->view ->assign('shang',$bb);
        return $this ->view ->fetch('view');
    }


 


}
