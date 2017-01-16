<?php /* Smarty version 2.6.10, created on 2008-09-17 17:41:32
         compiled from cnf_languages.tpl */ ?>
<H3><?php echo $this->_tpl_vars['langs']['t14']; ?>
</H3>
<script type="text/javascript">
var option_count = <?php echo $this->_tpl_vars['rowcount']; ?>
;
var optionstr = '<?php echo $this->_tpl_vars['lang_option']; ?>
';


</script>


<table width="50%" border="1">
 <tr>

 <td align="center"><?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>
</td>
 <td  colspan="2" align="center"><?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
</td>
 </tr>
<?php $_from = $this->_tpl_vars['fc_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fc_languages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fc_languages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fc_languages']['iteration']++;
?>
<FORM name="languages" action="cnf_config.php?module=<?php echo $_REQUEST['module']; ?>
" method="post" enctype="multipart/form-data" name="cnf_form1">
 <tr>
 <td align="center">
  <?php echo $this->_tpl_vars['val']; ?>

  </td>
  <td align="right"><?php echo $this->_tpl_vars['key']; ?>
 </td>

  <td align="center">
  <?php if ($this->_tpl_vars['val'] > 0): ?>
	<input type="image" src="bumper.gif" border="0" alt="<?php echo $this->_tpl_vars['cnf_langs']['t2']; ?>
">
  <?php else: ?>
   &nbsp;
  <?php endif; ?>
  </td>
  </tr>
  <input type="hidden" name="<?php echo $this->_tpl_vars['key']; ?>
" id="<?php echo $this->_tpl_vars['val']; ?>
" value=<?php echo $this->_tpl_vars['val']; ?>
  >
   </FORM>
<?php endforeach; endif; unset($_from); ?>
</table>

