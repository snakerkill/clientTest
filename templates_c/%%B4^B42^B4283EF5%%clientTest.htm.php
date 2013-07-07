<?php /* Smarty version 2.6.19, created on 2012-12-13 13:21:20
         compiled from clientTest.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'clientTest.htm', 35, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>客户端测试工具v1.0</title>
</head>
<body>
<div id="container" style="height:925px;width:1000px;margin:0 auto;">
	<div id="title"style="position:relative;left:4px;top:4px;background-color:#4876FF;height:125px;">
		<h2 style="display:inline;">客户端测试工具v1.0</h2>
		<div id="author" style="position:absolute;right:10px;bottom:2px;">make by snaker&lt;wanghao3@ganji.com&gt;</div>
	</div>
	<div id="presentation" style="position:relative;left:4px;top:4px;background-color:grey;width:300px;height:900px">
		<div id="interface">

		<div style="color:red;">请首先选择接口</div>
			<form action="http://www.ganji.com/clientTest.php" method="get">
				<select name="interface" style="width:200px;">
					<?php $_from = $this->_tpl_vars['options']['interfaces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
						<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['interface'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select><nobr/>
				<input type="submit" value="确定"/>
				<input type="hidden" name="action" value="choose"/>
			</form>
			<hr/>
			<div id="remind">
			<h2 style="display:inline;">注意Remind</h2>
			<hr/>
			<hr/>
			<?php if (is_array ( $this->_tpl_vars['options']['default']['jsonArgs'] )): ?>
				<h3 style="display:inline">jsonArgs必填字段以及默认值<h3>
				<?php $_from = $this->_tpl_vars['options']['default']['jsonArgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>	
				<h4 style="display:inline"><?php echo $this->_tpl_vars['key']; ?>
:&nbsp;&nbsp;<?php echo $this->_tpl_vars['value']; ?>
</h4><br/>
				<?php if (((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'userid' || ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'user_id'): ?>
				<div>生成新的userid和token</div>
				<form action="http://www.ganji.com/clientTest.php" method="get">
				<label for="loginName">用户名</label><input type="text" name="loginName" size="13" value="<?php echo $this->_tpl_vars['user']['loginName']; ?>
" />
				<br/>
				<label for="password">密&nbsp;&nbsp;码</label><input type="password" name="password" size="13" value="<?php echo $this->_tpl_vars['user']['password']; ?>
"/>
				<br/>
				<label for="environment">环&nbsp;&nbsp;境</label><select name="environment">
				<?php $_from = $this->_tpl_vars['options']['environment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
				<option value="<?php echo $this->_tpl_vars['value']; ?>
" <?php if ($_GET['environment'] == $this->_tpl_vars['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				<input type="hidden" name="action" value="user"/>
				<input type="submit" value="生成"/>
				<input type="hidden" name="interface" value="<?php echo $_GET['interface']; ?>
" />
				</form>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				<hr/>
			<?php endif; ?>
			<?php if (is_array ( $this->_tpl_vars['options']['default']['post_fields'] )): ?>
				<h3 style="display:inline">post_fields必填字段以及默认值<h3>
				<?php $_from = $this->_tpl_vars['options']['default']['post_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>	
				<h4 style="display:inline"><?php echo $this->_tpl_vars['key']; ?>
:&nbsp;&nbsp;<?php echo $this->_tpl_vars['value']; ?>
</h4><br/>
				<?php if (((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'userid' || ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'user_id'): ?>
				<div>生成新的userid和token</div>
				<form action="http://www.ganji.com/clientTest.php" method="get">
				<label for="loginName">用户名</label><input type="text" name="loginName"  size="13" value="<?php echo $this->_tpl_vars['user']['loginName']; ?>
" />
				<br/>
				<label for="password">密&nbsp;&nbsp;码</label><input type="password" name="password" size="13" value="<?php echo $this->_tpl_vars['user']['password']; ?>
"/>
				<br/>
				<label for="environment">环&nbsp;&nbsp;境</label><select name="environment">
				<?php $_from = $this->_tpl_vars['options']['environment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
				<option value="<?php echo $this->_tpl_vars['value']; ?>
" <?php if ($_GET['environment'] == $this->_tpl_vars['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				<input type="hidden" name="action" value="user"/>
				<input type="submit" value="生成"/>
				<input type="hidden" name="interface" value="<?php echo $_GET['interface']; ?>
" />
				</form>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				<hr/>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="simulator" style="position:relative;left:304px;top:-896px;width:700px;height:900px;margin:1px;">
	<div>
		<h2 style="display:inline;"><?php echo $this->_tpl_vars['show']; ?>
</h2>
		<hr/>
		<?php if ($this->_tpl_vars['action'] != 'index'): ?>
			<form action="http://www.ganji.com/clientTest.php?action=simulate" method="">
			<label for="environment"><span>访问环境:</span></label><select name="environment">
			<?php $_from = $this->_tpl_vars['options']['environment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
				<option value="<?php echo $this->_tpl_vars['value']; ?>
" <?php if ($_GET['environment'] == $this->_tpl_vars['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
			<br/>
			<div>当前用户：<?php echo $this->_tpl_vars['user']['loginName']; ?>
</div>
			<textarea name="jsonArgs"></textarea><label for="jsonArgs">需要添加或覆盖的jsonArgs参数</label>
			<br/>
			<textarea name="post_fields"></textarea><label for="post_fiels"/>需要添加或覆盖的post_fields参数</label>
			<input type="hidden" value="simulate" name="action"/>
			<input type="hidden" value="<?php echo $_GET['interface']; ?>
" name="interface"/>
			<?php if ($this->_tpl_vars['action'] == 'user'): ?>
			<input type="hidden" value="<?php echo $this->_tpl_vars['user']['userid']; ?>
" name="userid"/>
			<input type="hidden" value="<?php echo $this->_tpl_vars['user']['token']; ?>
" name="token"/>
			<?php endif; ?>
			<input type="submit" value="发送"/>	
			</form>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['action'] == 'simulate'): ?>
		<hr/>
		<div>
			<textarea rows="20" cols="80" ><?php echo $this->_tpl_vars['result']; ?>
</textarea>
		</div>
		<?php endif; ?>
	</div>
	</div>
</div>
</body>
</html>

