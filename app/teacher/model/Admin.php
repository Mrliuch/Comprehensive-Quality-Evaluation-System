<?php
namespace app\teacher\model;
use think\Model;
class Admin extends Model
{
	//时间戳转换
	public function getLastTimeAttr($val)
	{
		return date('Y/m/d',$val);
	} 
	protected $name = 'view';
}