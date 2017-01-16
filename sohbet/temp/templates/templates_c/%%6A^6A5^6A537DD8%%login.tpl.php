<?php /* Smarty version 2.6.10, created on 2008-09-17 17:37:36
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<center>

<?php if ($this->_tpl_vars['error']): ?>
<font color="red"><?php echo $this->_tpl_vars['error']; ?>
</font>
<?php endif; ?>
<?php if ($this->_tpl_vars['installed']): ?>
<h4><?php echo $this->_tpl_vars['langs']['t0']; ?>
</h4>
<form name="loginForm" action="login.php" method="post">
<table border="0">
	<tr>
		<td align="right"><?php echo $this->_tpl_vars['langs']['t1']; ?>
</td>
		<td><input type="text" name="login" value="<?php echo $this->_tpl_vars['fc_login']; ?>
"></td>
	</tr>
	<tr>
		<td align="right"><?php echo $this->_tpl_vars['langs']['t2']; ?>
</td>
		<td><input type="password" name="password" value="<?php echo $this->_tpl_vars['fc_pass']; ?>
"></td>
	</tr>
	<!--tr>
		<td align="right">
			Chat instance
		</td>
		<td>
			<SELECT NAME=session_inst >
				<?php $_from = $this->_tpl_vars['chat_instances']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['name']['iteration']++;
?>
					<OPTION VALUE="<?php echo $this->_tpl_vars['val']['id']; ?>
" <?php if ($_REQUEST['session_inst'] == $this->_tpl_vars['val']['id']): ?>selected <?php endif; ?> ><?php echo $this->_tpl_vars['val']['name']; ?>

				<?php endforeach; endif; unset($_from); ?>
			</SELECT>
		</td>
	</tr-->
	<tr>
		<td align="right"><?php echo $this->_tpl_vars['langs']['t3']; ?>
</td>
		<td>
			<SELECT NAME=language_select onChange="loginForm.submit();">
				<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['language'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['language']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['language']['iteration']++;
?>
						<OPTION VALUE="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['defLanguage'] == $this->_tpl_vars['key']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['val']; ?>

				<?php endforeach; endif; unset($_from); ?>
			</SELECT>
		</td>
	</tr>
	<input type="hidden" name="session_inst" id="session_inst" value="1">
	<tr>
		<td colspan="2" align="center"><input type="submit" name="do" value="<?php echo $this->_tpl_vars['langs']['t4']; ?>
"></td>
	</tr>
</table>
</form>
<?php endif; ?>
</center>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>