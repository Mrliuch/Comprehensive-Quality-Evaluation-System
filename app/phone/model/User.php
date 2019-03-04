<?php
namespace app\phone\model;
use think\Model;
class User extends Model
{
	//时间戳转换
	public function getLastTimeAttr($val)
	{
		return date('Y/m/d H:m:s',$val);
	} 
		public function getTimeAttr($val)
	{
		return date('Y/m/d H:m:s',$val);
	} 
	//protected $name = 'perform';
}