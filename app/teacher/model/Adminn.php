<?php
namespace app\teacher\model;
use think\Model;
class Adminn extends Model
{
	//时间戳转换
	public function getLastTimeAttr($val)
	{
		return date('Y/m/d H:m:s',$val);
	} 
	protected $name = 'community';
}