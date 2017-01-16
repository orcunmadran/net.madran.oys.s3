<?php /* Smarty version 2.6.10, created on 2008-09-17 17:37:30
         compiled from admin_index.tpl */ ?>
<?php $this->assign('title', 'Home'); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<center>
<h4><?php echo $this->_tpl_vars['langs']['t0']; ?>
</h4>
</center>
<center>
<p><?php echo $this->_tpl_vars['langs']['t1']; ?>

<?php if ($this->_tpl_vars['manageUsers']): ?>
	<?php echo $this->_tpl_vars['langs']['t2']; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>