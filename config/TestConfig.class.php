<?php
/*=======================================================================
 File Name : testConfig.php
 author    : 王浩 <snakerkill@163.com>
 touch     : 2012-12-10 14:54:40
 description : 客户端测试配置文件
 vision  : v0.2
=======================================================================*/
class TestConfig {
//可以调用的接口以及其默认值
public static $CLIENT_INTERFACE = array(
        //3.3.0接口
        3301=>'JudgePubWantedPostAuthority',
		301=>'SaveComment',	
		302=>'GetMyCommentList',
		188=>'GetCommentList',
		120=>'GetPostsByAppId',
		10000=>'GetCompanyOtherJobs',
		104=>'GetContactInfo',
		106=>'GetCompanyOtherWanted',
		107=>'SetResumeStatus',
        27=>'GetWantedTagList',
		102=>'SearchPostsByJson2',
        23=>'GetUserJobList',
		100=>'GetResumeCategory',
		101=>'GetResumeDownloadedRecords',
		103=>'GetWantedInformation',
		105=>'GetPostByPuid',
		1=>'CheckVersion',  
		2=>'CreateStickyOrder', 
        3=>'GetCompanyInfo',
        4=>'CreateCompanyComment',
        5=>'GetCompanyComment',
        6=>'JudgeCompanyCommentAuthority',
        7=>'GetLastCategories',
        8=>'GetLastCategory', 
        9=>'GetLastGeography',
        10=>'GetLastGeographyDistricts',//
        11=>'GetLastPostTemplates',
        12=>'GetLastTags',
        13=>'GetMajorCategoryFilter', 
        14=>'GetMajorCategoryFilters',
        15=>'GetNewCategories',
        16=>'GetPost',
        17=>'GetPostsByAppId',
        18=>'GetPostsByPhone',
        19=>'GetStickyPostAvgPv',
        20=>'GetTradingStickyInfo',
        21=>'GetTradingStickyOption',
        22=>'GetUserFindJobList', 
        24=>'GetUserJobListCount',
        25=>'GetWantedHotPv',
        26=>'GetWantedInfo',
        28=>'PostPvStat',
        29=>'RefreshPost',
        30=>'SearchCityByLocation', 
        31=>'SearchPostsByJson', 
        32=>'SendResume',
        33=>'SubscribePosts',
        34=>'UploadImages',
        35=>'UserFavorites',
        36=>'getClientCommercial',
        37=>'userRegister',
        38=>'CheckResumeIsBuyed',
        39=>'GetRemainResumeNum',
        40=>'DownloadResume',
        41=>'GetBuyedResumeList',
        42=>'BuyResume',
        43=>'GetUserInfo',
        44=>'GetResumeTotalPrice',
        45=>'GetResumeOrderStatus',
        46=>'GetWantedTagList',

        47=>'register',  //线上暂时没有使 
        48=>'userLogin', //线上没有使用

		   );
public static $COMMON_HEADER = array (
		'customerId:705',
    	'clientAgent:iphone#640*480',
    	'GjData-Version:1.0',
    	'versionId:3.2.0',
    	'model:Generic/iPhone',
    	'agency:wap',
    	'contentformat:json2',
    	'userId:A00A52AB1C820CCADCA7EC4982CB290F',//7833D0DC80957230A2B3FA45835D937D',563B02E75EFB1C143C14A4E2808387F3
		//'userId:649B0B50A0C8D5ABF8A895D9BCDA343B',//测试环境
		'mac:787987779',
		//interface程序后面会根据配置动态更改
		);
public static $URL = array(
			'test1'=>'http://mobds.ganjistatic3.com',
			'web6'=>'http://web6.mobds.ganji.cn',
			'rd'=>'http://mobds.ganji.com:1800',
			'online'=>'http://mobds.ganji.cn',
		);
public static $ENVIRONMENT = array(
			'test1','online','rd','web6',
		);
	/*
	*@brief : 获得相应接口的请求参数
	*@param int $interface 请求接口的编号
	*/
	public function getInterfaceConfig($interface){
		$name = self::$CLIENT_INTERFACE[$interface];
		$config = include ("interface/{$name}.class.php");
		if($config['header'] == 'common'){
			$config['header'] = self::$COMMON_HEADER;
		}
	}
}

