<?php /* Smarty version 2.6.10, created on 2008-09-17 17:39:35
         compiled from cnf_top.tpl */ ?>
<script language='Javascript'>
fc_help_url="<?php echo $this->_tpl_vars['fc_help_url']; ?>
";
</script>
<?php echo '
<script language=\'Javascript\'>
<!--
// a small poupup window to show who\'s in the chat at the current time
function show_info_page(url){
//send user to help page in site
window.open(fc_help_url + url,\'Help\',\'width=640, height=540, left=100,top=100,menu=no,toolbar=no,scrollbars=yes\');
return false;
}
-->
</script>
'; ?>

<table width="80%" align="center" border="0">

<tr>

<td valign="top" width="200" nowrap>
<div style="visibility:hidden;display:none;">
<?php if ($this->_tpl_vars['module'] == 'instances'): ?>
	<a href="cnf_config.php?module=instances"><b><?php echo $this->_tpl_vars['langs']['t0']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=instances"><?php echo $this->_tpl_vars['langs']['t0']; ?>
</a><br>
<?php endif; ?>
<br>
<?php if ($this->_tpl_vars['IS_ADMIN'] == 1): ?>
<form action="cnf_config.php" method="post" enctype="multipart/form-data" >
	<SELECT NAME=instances onchange='submit();' style="width: 100%;">
		<?php $_from = $this->_tpl_vars['instances_name']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['name']['iteration']++;
?>
			<OPTION VALUE=<?php echo $this->_tpl_vars['val']['id']; ?>
    <?php if ($this->_tpl_vars['val']['id'] == $this->_tpl_vars['instance_ID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']['name']; ?>

		<?php endforeach; endif; unset($_from); ?>
	</SELECT>
	<input type="Hidden" value="<?php echo $this->_tpl_vars['module']; ?>
" name="module">
</form>
<?php endif; ?>
</div>
<?php if ($this->_tpl_vars['module'] == 'general'): ?>
	<a href="cnf_config.php?module=general"><b><?php echo $this->_tpl_vars['langs']['t1']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=general"><?php echo $this->_tpl_vars['langs']['t1']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'conn'): ?>
	<a href="cnf_config.php?module=conn"><b><?php echo $this->_tpl_vars['langs']['t2']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=conn"><?php echo $this->_tpl_vars['langs']['t2']; ?>
</a><br>
<?php endif; ?>

<!--
<?php if ($this->_tpl_vars['module'] == 'msg'): ?>
	<a href="cnf_config.php?module=msg"><b><?php echo $this->_tpl_vars['langs']['t3']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=msg"><?php echo $this->_tpl_vars['langs']['t3']; ?>
</a><br>
<?php endif; ?>
-->
<?php if ($this->_tpl_vars['module'] == 'theme'): ?>
	<a href="cnf_config.php?module=theme"><b><?php echo $this->_tpl_vars['langs']['t4']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=theme"><?php echo $this->_tpl_vars['langs']['t4']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'layout'): ?>
	<a href="cnf_config.php?module=layout"><b><?php echo $this->_tpl_vars['langs']['t5']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=layout"><?php echo $this->_tpl_vars['langs']['t5']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'font'): ?>
	<a href="cnf_config.php?module=font"><b><?php echo $this->_tpl_vars['langs']['t6']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=font"><?php echo $this->_tpl_vars['langs']['t6']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'sound'): ?>
	<a href="cnf_config.php?module=sound"><b><?php echo $this->_tpl_vars['langs']['t7']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=sound"><?php echo $this->_tpl_vars['langs']['t7']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'smilies'): ?>
	<a href="cnf_config.php?module=smilies"><b><?php echo $this->_tpl_vars['langs']['t8']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=smilies"><?php echo $this->_tpl_vars['langs']['t8']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'avatars'): ?>
	<a href="cnf_config.php?module=avatars"><b><?php echo $this->_tpl_vars['langs']['t9']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=avatars"><?php echo $this->_tpl_vars['langs']['t9']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'filesharing'): ?>
	<a href="cnf_config.php?module=filesharing"><b><?php echo $this->_tpl_vars['langs']['t10']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=filesharing"><?php echo $this->_tpl_vars['langs']['t10']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'modules'): ?>
	<a href="cnf_config.php?module=modules"><b><?php echo $this->_tpl_vars['langs']['t11']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=modules"><?php echo $this->_tpl_vars['langs']['t11']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'preloader'): ?>
	<a href="cnf_config.php?module=preloader"><b><?php echo $this->_tpl_vars['langs']['t12']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=preloader"><?php echo $this->_tpl_vars['langs']['t12']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'logout'): ?>
	<a href="cnf_config.php?module=logout"><b><?php echo $this->_tpl_vars['langs']['t13']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=logout"><?php echo $this->_tpl_vars['langs']['t13']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'languages'): ?>
	<a href="cnf_config.php?module=languages"><b><?php echo $this->_tpl_vars['langs']['t14']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=languages"><?php echo $this->_tpl_vars['langs']['t14']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'badwords'): ?>
	<a href="cnf_config.php?module=badwords"><b><?php echo $this->_tpl_vars['langs']['t15']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=badwords"><?php echo $this->_tpl_vars['langs']['t15']; ?>
</a><br>
<?php endif; ?>
<?php if ($this->_tpl_vars['module'] == 'other'): ?>
	<a href="cnf_config.php?module=other"><b><?php echo $this->_tpl_vars['langs']['t16']; ?>
</b></a><br>
<?php else: ?>
	<a href="cnf_config.php?module=other"><?php echo $this->_tpl_vars['langs']['t16']; ?>
</a><br>
<?php endif; ?>
</td>

<td valign="top">

