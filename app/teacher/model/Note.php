<?php
namespace app\teacher\model;
use think\Model;
class Note extends Model
{
	//时间戳转换
	public function getTimeAttr($val)
	{
		return date('Y/m/d H:m:s',$val);
	} 
	protected $name = 'note';
}