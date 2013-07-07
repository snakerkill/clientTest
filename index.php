<?php
/*=======================================================================
 File Name : index.php
 author    : 王浩 <snakerkill@163.com>
 touch     : 2012-12-17 17:38:20
 description : 客户端测试工具入口文件
 vision  : v0.1
=======================================================================*/
require dirname(__FILE__).'/ClientTest.class.php';
$act = $_POST['action'];
$test = new ClientTest();
switch($act){
	//得到仿真用户信息
	case 'user':
		$test->userAction();
		break;
	//仿真访问
	case 'simulate':
		$test->simulateAction();
		break;
	//得到接口相关信息
	case 'getInfo':
		$test->getInfoAction();
		break;
	//进入首页
	default:
		$test->indexAction();
		break;
}
