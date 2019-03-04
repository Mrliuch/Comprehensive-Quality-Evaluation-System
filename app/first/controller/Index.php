<?php
namespace app\first\controller;
use think\Controller;


class Index extends Controller
{
	//
	public function develop() //待开发界面
	{
      return $this ->view ->fetch('develop');
	}

		public function developphone()  //待开发手机版
	{
      return $this ->view ->fetch('developphone');
	}

		public function errorr()  //错误界面(未启用)
	{
      return $this ->view ->fetch('error');
	}

		public function errorrphone()  //错误界面手机版（未启用）
	{
      return $this ->view ->fetch('errorphone');
	}

		public function our()  //关于我们
	{

      if($this->isMobile()){
      	return $this ->view ->fetch('ourphone');
      }else{
      return $this ->view ->fetch('our');
      }
	}

		public function ourphone()  //关于我们手机
	{
      return $this ->view ->fetch('ourphone');
	}

	public function index() //开发进程及花絮界面
	{
      return $this ->view ->fetch('index');
	}
		public function cuo()
	{
      return $this ->view ->fetch('cuo');
	}


    function isMobile()
{ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 


}