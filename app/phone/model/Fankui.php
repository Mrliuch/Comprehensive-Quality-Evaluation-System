<?php
namespace app\phone\model;
use think\Model;
class Fankui extends Model
{
	//时间戳转换
	public function getTimeAttr($val)
	{
		return date('Y/m/d H:m:s',$val);
	} 
	protected $name = 'apply';
}