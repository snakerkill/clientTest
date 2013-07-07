<?php
//生成interface配置
require dirname(__FILE__) . '/TestConfig.class.php';

$interfaceInfos = TestConfig::$INTERFACE_INFO;
$interfacekeys = array_keys(TestConfig::$INTERFACE_INFO);
foreach($interfacekeys as $key){
	$name = TestConfig::$CLIENT_INTERFACE[$key];
	$file = fopen("interface/{$name}.config.php",'w');
	
	$config = var_export($interfaceInfos[$key],true);

$content =<<<CODE
<?php	
/*
* generate by script
*
*/
return $config;
CODE;
	
	fwrite($file,$content);
	fclose($file);
}
