<?php /* Smarty version 2.6.19, created on 2012-12-31 11:07:02
         compiled from clientTestNew.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>客户端测试工具v1.0</title>
<style>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "clientTest.css", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</style>
</head>
<body>
<div id="container">
	<div id="title">
		<h2 style="display:inline;">客户端测试工具v1.0</h2>
		<div id="author" >make by snaker&lt;wanghao3@ganji.com&gt;</div>
	</div>
	<div>
		<div id="presentation" >
			<div id="userInfo">
				<div id="register">
				<label>用户名</label><input type="text" id="LoginName" size="10" value="<?php echo $this->_tpl_vars['user']['LoginName']; ?>
"/>
				<label for="user_environment">环境</label><select name="user_environment" id="user_environment">
					<?php $_from = $this->_tpl_vars['options']['environment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
					<option value="<?php echo $this->_tpl_vars['value']; ?>
" <?php if ($this->_tpl_vars['user']['environment'] != "" && $this->_tpl_vars['user']['environment'] == $this->_tpl_vars['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select><br/>
				<label>密&nbsp;&nbsp;码</label><input type="password" id="password" size="10"/>
				<a class="button" onclick="getUserInfo();">登录</a>
				</div>
				<span>当前环境:</span><div id="user_environmentshow" class="user"><?php echo $this->_tpl_vars['user']['environment']; ?>
</div><br/>
				<span>当前用户:</span><div id="username" class="user"><?php echo $this->_tpl_vars['user']['LoginName']; ?>
</div><br/>
				<span>用户ID:</span><div id="user_id" class="user"><?php echo $this->_tpl_vars['user']['LoginId']; ?>
</div><br/>
				<hr/>
			</div>
			<div>
				<div style="color:red;">请首先选择接口</div>
				<select  id="interface" name="client_interface" style="width:200px;" onblur="getInterfaceInfo();">
					<?php $_from = $this->_tpl_vars['options']['client_interface']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
						<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['interface'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select><nobr/>
				<hr/>
			</div>
			<div id="remind">
				<h4>接口信息</h4>
				<div id="interface_info" class="user"></div>
				<hr/>
				<hr/>
			</div>
		</div>
		<div id="simulator">
			<h2><?php echo $this->_tpl_vars['show']; ?>
</h2>
			<hr/>

				<label for="environment"><span>访问环境:</span></label><select id="environment" name="environment">
				<?php $_from = $this->_tpl_vars['options']['environment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
					<option value="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				<br/>
				<h4>header信息</h4><br/>
				<div id="header_content"></div>
				<h4>需要添加或覆盖的jsonArgs参数</h4><br/>
				<div id="jsonArgs_content">
				</div>
				<h4>需要添加或覆盖的post_fields参数</h4><br/>
				<div id="post_fields_content">
				</div>
			<button class="request" onclick="request();">fire in hole模拟请求</button><div class='request_remind'>&lt;==click me to simulate</div>
			<hr/>

				<div><h3>返回结果</h3>
				<a id="asjson" class="unselect" onclick="showAsJson();">实际返回的json串</a>&nbsp;&nbsp;
				<a id="asjsonEasy" class="select" onclick="showAsJsonEasy();">易读模式</a><br/>
					<textarea id="result" rows="18" cols="80" ></textarea>
				</div>
		</div>
	</div>
</div>
<script language="javascript">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "clientTest.js", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</script>
</body>
</html>

