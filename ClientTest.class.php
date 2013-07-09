<?php
/*=======================================================================
 File Name : ClientTest.class.php
 author    : 王浩 <snakerkill@163.com>
 touch     : 2012-12-17 17:46:51
 description : 客户端测试工具
 vision  :	v0.1 
=======================================================================*/
require (dirname(__FILE__).'/SmartyEngine.class.php');
require dirname(__FILE__) . '/config/TestConfig.class.php';
Class ClientTest{
	//模板引擎
	private $templateEngine;
	//模板参数
	private $templateValues;	

	public function __construct(){

		//模板设置
		$this->template = 'clientTestNew.htm';
		//构造模板对象
		$template_config = array (
			'template_type' => 'smarty',                                                                                           
		    'tmpelate_path' => dirname(__FILE__) . '/templates', 'template_cpatch' => dirname(__FILE__) . '/templates_c', 
		    'isCached' => false );
		$this->templateEngine = new SmartyEngine ( $template_config );

		//环境rd,test1,web6,online
		$this->environment = $_POST['environment'];

		if($_POST['action'] == 'user'){//模拟用户登录获得token所需字段
			$this->loginName = $_POST['LoginName'];
			$this->password = $_POST['password'];
		}elseif($_POST['action'] == 'getInfo'){//获得接口相关信息
			$this->interface = $_POST['interface'];
		}elseif($_POST['action'] == 'simulate'){//模拟接口调用相关信息
			//去掉第一个值action(代表是什么请求)
			array_shift($_POST);
			foreach($_POST as $key=>$value){
				$this->post[$key] = $value;
			}
		}
	}	
	/*
	* 渲染函数
	*/
	private function render(){
		$this->templateEngine->display($this->template,$this->templateValues);
	}
    
	/*
	* 首页
	*/
	public function indexAction(){
		$options = array();
		$options['client_interface'] = $this->getClientInterface();
		$options['environment'] = $this->getEnvironment();
		$user['LoginName'] = $_COOKIE['CT_LoginName'];
		$user['environment'] = $_COOKIE['CT_environment'];
		$user['LoginId'] = $_COOKIE['CT_LoginId'];
		$user['token'] = $_COOKIE['CT_token'];
		$this->templateValues['options'] = $options;
		$this->templateValues['user'] = $user;
		$this->render();
	}
	/*
	* 返回所以的接口列表
	*/
	private function getClientInterface(){
		return TestConfig::$CLIENT_INTERFACE;
	}
	/*
	* ajax获取用户信息
	*/
	public function userAction(){
		$post['loginName'] = $this->loginName;
		$post['password']  = $this->password;
		$post['jsonArgs'] = array();
		$url = $this->getBaseUrl().'/users/';
		
		$header = TestConfig::$COMMON_HEADER;
		//请求userLogin接口
		$header[] = 'interface:userLogin';

		//返回头部
		$flag = 1;
		//返回的结果包括header
		$result = $this->request($url,$header,$post,$flag);

		preg_match('/Token:.?([^\n\r]*)\r\nsessionId/',$result,$matches);

		//获得token
		$token = $matches[1];
		
		$result = preg_replace('/^[^{]*/','',$result);
		$user = json_decode($result,1);

		$user['token'] = $token;
		$user['environment'] = $this->environment;
		//登录后记录到cookie中
		setcookie('CT_LoginId',$user['LoginId']);
		setcookie('CT_LoginName',$user['LoginName']);
		setcookie('CT_token',$user['token']);
		setcookie('CT_environment',$this->environment);
		
		echo json_encode($user);
		return ;
	}
	/*
	* 得到接口信息
	*/
	public function getInfoAction(){
		$interface = TestConfig::getInterfaceConfig($this->interface);
		$interface['header'][] = 'interface:'.TestConfig::$CLIENT_INTERFACE[$this->interface];
		echo json_encode($interface);
		return;
	}
	/*
	* 模拟发送请求并返回结果
	*/
	public function simulateAction(){

		$jsonArgs = array();
		$post = array();

		$header = urldecode($this->post['header']);	
		$header = str_replace('\\','',$header);	
		$header = json_decode($header,1);

		//set interface
		$this->setInterface($header[9]);
		
		//查看是否使用强帐号
		$this->setToken($header);

		if(!empty($this->post['jsonArgs']))
		{
			$jsonArgs = urldecode($this->post['jsonArgs']);
			$jsonArgs = str_replace('\\','',$jsonArgs);
			$jsonArgs = json_decode($jsonArgs,1);
			$this->setUserInfo($jsonArgs);
		}

		if(!empty($this->post['post']))
		{
			$post = urldecode($this->post['post']);
			$post = str_replace('\\','',$post);
			$post = json_decode($post,1);
			$this->setUserInfo($post);
		}
		$post['jsonArgs'] = json_encode($jsonArgs);

		$url = $this->getUrl();

		$result = $this->request($url,$header,$post);
		echo $result;
		return ;
	}
	/*
	* 模拟客户端发送请求
	*/
	private function request($url,$header,$post,$flag = 0){
		$ch = curl_init();
		//设置是否返回头部
		curl_setopt($ch, CURLOPT_HEADER, $flag);
		//设置访问的url
		curl_setopt($ch, CURLOPT_URL, $url);                                                                                                            
		//设置头部信息
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_POST, 1 );
		//设置body
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post) ; 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
		//返回结果
        return  curl_exec($ch);
	}
	/*
	* 根据需要访问的环境获得server_name
	*/
	private function getBaseUrl(){
		return TestConfig::$URL[$this->environment];
	}
	private function getUrl(){
		$uri = TestConfig::$INTERFACE_INFO[$this->interface]['url'];
		return $this->getBaseUrl().'/'.$uri.'/';
	}
	
	/*
	* 获得环境选项
	*/
	private function getEnvironment(){
		return TestConfig::$ENVIRONMENT;
	}
	/*
	* 设置interface变量
	*/
	private function setInterface($interface){
		if(!isset($interface))
			return false;
		$this->interface = array_search(preg_replace('/\w+:/','',$interface),TestConfig::$CLIENT_INTERFACE);
	}
	/*
	* 设置发送请求的用户信息
	*/
	private function setUserInfo(array &$params){
		$i=0;
		foreach($params as $key => $value){
			if( empty($params[$key]) &&
					($i== 0 && (strtolower($key) == 'userid' || strtolower($key) == 'user_id'))){
				$params[$key] = $_COOKIE['CT_LoginId'];
			}
			if($i == 1 && $key == 'token'){
				$params[$key] = $_COOKIE['CT_token'];
			}
			else if($i>1 ){
				break;
			}
			$i++;
		}
	}
	private function setToken(array &$header){
		$header[] = 'token:'.$_COOKIE['CT_token'];
	}

}


