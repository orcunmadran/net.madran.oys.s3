<?php /* Smarty version 2.6.10, created on 2008-09-17 17:42:15
         compiled from cnf_smilies.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t8']; ?>
</h3>
<FORM action="cnf_config.php" method="post" enctype="multipart/form-data" name="cnf_form">

<table border="0" width1="700" height="100%">

<!--error process -->

<?php if ($this->_tpl_vars['errMsg'] != ''): ?>
	<TR>
		<TD class="errorMsg" valign='middle'  align="center" colspan="2">
			<?php echo $this->_tpl_vars['errMsg']; ?>

		</TD>
	</TR>
<?php endif; ?>
<!--end error handling-->

<?php $this->assign('index', '0'); ?>
<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>
	<tr>


		<td style="width:200px;">
			<!--  <?php echo $this->_tpl_vars['val']['title']; ?>
 -->
			<!-- <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="50" height="20" id="chat/admin/snf_smile" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="movie" value="snf_smile.swf?smi_name=<?php echo $this->_tpl_vars['val']['level_1']; ?>
" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<embed src="../smiles.swf?smi_name=<?php echo $this->_tpl_vars['val']['level_1']; ?>
" quality="high" bgcolor="#ffffff" width="50" height="20" name="chat/admin/snf_smile" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object> -->
			<input type="Hidden" name="type_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['type']; ?>
">
			<input type="Hidden" name="name_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['title']; ?>
">
		</td>


		<td width="25">
			<input type="Text" size="25" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
		</td>
		<td>
			<SELECT NAME="order_<?php echo $this->_tpl_vars['val']['id']; ?>
" id="<?php echo $this->_tpl_vars['val']['id']; ?>
" onchange="javascript:neworder(this, <?php echo $this->_tpl_vars['val']['id']; ?>
);">
				<?php $_from = $this->_tpl_vars['_order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
					<OPTION VALUE=<?php echo $this->_tpl_vars['val1']; ?>
 <?php if ($this->_tpl_vars['val1'] == $this->_tpl_vars['val']['_order']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val1']; ?>

				<?php endforeach; endif; unset($_from); ?>
			</SELECT>
			<input type="hidden" id="oldOrder_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['_order']; ?>
">
		</td>
		<td width="25">
			<div style="white-space: nowrap;">
				<input type="radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['disabled']): ?>checked<?php endif; ?> id="on<?php echo $this->_tpl_vars['key']; ?>
"><label for="on<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>
</label>
				<input type="radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['disabled']): ?>checked<?php endif; ?> id="off<?php echo $this->_tpl_vars['key']; ?>
"><label for="off<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
</label>
			</div>
		</td>

			<td align="right" width="5">
			<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
				<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >[?]</a>
			<?php endif; ?>
			</td>

	</tr>
<?php endforeach; endif; unset($_from); ?>

	<tr>
		<td colspan="3">&nbsp;

		</td>
	</tr>
	<tr>

		<td colspan="3"align="center">
			<input type="Submit" name="submit" value="Save Settings">
		</td>
	</tr>

</table>

<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>