<?php
/**
 * Smarty模板引擎类 
 */ 

require_once(dirname(__FILE__) . '/Smarty-3.1.6/libs/Smarty.class.php');

class SmartyEngine
{
	static public $objSmarty    = null;

	public function __construct($config)
	{
		if (!self::$objSmarty){
            self::$objSmarty    = new Smarty();

            self::$objSmarty->template_dir    = $config['tmpelate_path'];
            self::$objSmarty->compile_dir     = $config['template_cpatch'];
            if (!empty($config['smarty_plugin_path'])) {
            	if (is_string($config['smarty_plugin_path'])) {
            		self::$objSmarty->plugins_dir[]   = $config['smarty_plugin_path'];
            	} else if (is_array($config['smarty_plugin_path'])) {
		            foreach ($config['smarty_plugin_path'] as $dir) {
		            	self::addPluginsDir($dir);
		            }
            	}
            }
            self::$objSmarty->cache_dir       = $config['template_cache_path'];
            self::$objSmarty->left_delimiter  = '{{';
            self::$objSmarty->right_delimiter = '}}';
            self::$objSmarty->caching = $config['isCached'];
        }
	}

	/**
	 * 赋值并展示模板
	 * @param $values array key => value
	 */
	public function display($templateFile, $values)
	{
		if(!empty($values))
			self::$objSmarty->assign($values);

		self::$objSmarty->display($templateFile);
	}
	
	public function fetch($templateFile, $values)
	{
		if(!empty($values))
			self::$objSmarty->assign($values);

		return self::$objSmarty->fetch($templateFile);
	}
	
	/**
	 * 设置plugins路径
	 */
	public function addPluginsDir($dir)
	{
		if(!empty($dir) && is_dir($dir))
			array_unshift(self::$objSmarty->plugins_dir, $dir);
		else
			return false;
	}
}
