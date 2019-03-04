<?php
namespace app\admin\model;
use think\Model;
class User extends Model
{
	//时间戳转换
	public function getAbcAttr($val)
	{
		return date('Y/m/d H:m:s',$val);
	} 
	//protected $name = 'perform';
}