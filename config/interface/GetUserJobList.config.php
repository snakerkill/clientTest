<?php	
/*
* generate by script
*
*/
return array (
  'url' => 'datashare',
  'header' => 'common',
  'jsonArgs' => 
  array (
    'userid' => '',
    'token' => '',
    'city_code' => '',
    'can_create' => '',
  ),
  'post_fields' => 
  array (
    'resumeSchema' => '',
    'schema' => '',
  ),
  'message' => 
  array (
    0 => 'jsonArgs必传字段<br/>
						 用户Id:userid<br/>
						 验证登录参数:token<br/>
						 城市信息:city_code,貌似没有用<br/>
						 jsonArgs选传字段<br/>
						 是否能创建:can_create<br/>
						 =1->只得到是否能创建新简历<br/>
						 post_fields必传字段<br/>
						 是否包含兼职简历:resumeSchema<br/>
						 新版工作通标志:schema<br/>
						 ',
    1 => '',
  ),
);