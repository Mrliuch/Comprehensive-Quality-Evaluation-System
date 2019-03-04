<?php
namespace app\student\model;
use think\Model;
class Fan  extends Model
{
	//时间戳转换
	public function getCreateTimeAttr($val)
	{
		return date('Y/m/d',$val);
	} 
	protected $name = 'fan';
}