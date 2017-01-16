<?php /* Smarty version 2.6.10, created on 2008-09-17 17:39:57
         compiled from cnf_theme.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t4']; ?>
</h3>
<FORM action="cnf_config.php" method="post" enctype="multipart/form-data" name="cnf_form">
<table border="0" width="700" height="100%">
<tr>
	<td>
		<?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>

	</td>
	<td align="left">
		<input type="hidden" name="MAX_FILE_SIZE" value=<?php echo $this->_tpl_vars['value']['maxSize']; ?>
>
		<input type="file" name="file">
		<input type="submit" name="sub4" value="<?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
" onclick="return onSubmit('<?php echo $this->_tpl_vars['value']['pls_select']; ?>
','<?php echo $this->_tpl_vars['value']['extens']; ?>
')">
	</td>

</tr>
<tr>
	<td colspan="2">
		<input type="submit" name="sub1" value="<?php echo $this->_tpl_vars['cnf_langs']['t2']; ?>
">
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;

	</td>
</tr>
<tr>
	<td colspan="2" align="left">
		<?php echo $this->_tpl_vars['cnf_langs']['t3']; ?>

		<SELECT NAME=theme onchange='javascript:Send(cnf_form,"true");'>
			<?php $_from = $this->_tpl_vars['themes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['name']['iteration']++;
?>
				<OPTION VALUE=<?php echo $this->_tpl_vars['val']; ?>
  <?php if ($this->_tpl_vars['val'] == $this->_tpl_vars['name']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']; ?>

				<?php if (($this->_foreach['name']['iteration'] == $this->_foreach['name']['total']) == 'true'): ?>
					<?php $this->assign('last_name', $this->_tpl_vars['val']); ?>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</SELECT>
		<?php if ($this->_tpl_vars['name'] != '0'): ?>
			<input type="submit" name="sub2" value="<?php echo $this->_tpl_vars['disabled']; ?>
 <?php echo $this->_tpl_vars['cnf_langs']['t4']; ?>
" >
			<input type="Hidden" name="disable" value="<?php echo $this->_tpl_vars['disabled']; ?>
">
		<?php endif; ?>
	</td>
</tr>



	<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
	<?php $this->assign('name_theme', $this->_tpl_vars['name']); ?>


<tr>
	<?php if ($this->_tpl_vars['name'] == '0'): ?>
		<td>
			<?php echo $this->_tpl_vars['cnf_langs']['t5']; ?>

		</td>
		<td >
			<input type="Text" size="30" name="Name" value="<?php echo $this->_tpl_vars['last_name']; ?>
">
			<input type="Hidden" name="Add" value="New">
			<?php $this->assign('name_theme', 'xp'); ?>
		</td>
	<?php else: ?>
		<!--
		<td colspan="4">
			<input type="submit" name="sub2" value="<?php echo $this->_tpl_vars['disabled']; ?>
 <?php echo $this->_tpl_vars['cnf_langs']['t6']; ?>
" >
			<input type="Hidden" name="disable" value="<?php echo $this->_tpl_vars['disabled']; ?>
">
		</td>
		-->
	<?php endif; ?>

</tr>
<!--error process -->

<?php if ($this->_tpl_vars['errMsg'] != ''): ?>
	<TR>
		<TD class="errorMsg" valign='middle'  align="center" colspan="2">
			<?php echo $this->_tpl_vars['errMsg']; ?>

		</TD>
	</TR>
<?php endif; ?>
<!--end error handling-->


<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>
	<tr>


		<td width="40%">
			<?php echo $this->_tpl_vars['val']['title']; ?>

			<input type="Hidden" name="type_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['type']; ?>
">
			<input type="Hidden" name="name_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['title']; ?>
">
			<input type="Hidden" name="field_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['level_2']; ?>
">
		</td>



			<?php if ($this->_tpl_vars['val']['type'] == 'integer'): ?>
				<td width="40">
				<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
				</td>
				<td width="100">
					&nbsp;
			<?php elseif ($this->_tpl_vars['val']['type'] == 'string'): ?>
				<?php if ($this->_tpl_vars['val']['level_2'] != 'name' && $this->_tpl_vars['val']['level_2'] != 'backgroundImage' && $this->_tpl_vars['val']['level_2'] != 'dialogBackgroundImage'): ?>
				<td>
					<input type="Text" size="30" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
" >
				<!--/td>
				<td-->
					<a href="javascript:TCP.popup(document.forms['cnf_form'].elements['fld_<?php echo $this->_tpl_vars['val']['id']; ?>
'])">
						<img width="15" height="13" border="0" alt="<?php echo $this->_tpl_vars['cnf_langs']['t9']; ?>
" src="../images/cnf_img/sel.gif">
					</a>
				<?php elseif ($this->_tpl_vars['val']['level_2'] == 'name'): ?>
				<td width="40" colspan="2">
						<input type="Text" size="30" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
				<?php else: ?>
				<td>
						<select name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
							<?php $_from = $this->_tpl_vars['img']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['fields']['iteration']++;
?>
								<?php $this->assign('name1', "images/".($this->_tpl_vars['val1'])); ?>
								<OPTION VALUE="<?php echo $this->_tpl_vars['name1']; ?>
" <?php if ($this->_tpl_vars['name1'] == $this->_tpl_vars['val']['value']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['val1']; ?>

							<?php endforeach; endif; unset($_from); ?>
						</select>
						<input type="button" value="<?php echo $this->_tpl_vars['cnf_langs']['t10']; ?>
" onclick="javascript:openWindow(fld_<?php echo $this->_tpl_vars['val']['id']; ?>
.value, 'winName', '',500,500 )">
				</td>
				<td>

				<?php endif; ?>


			<?php elseif ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
				<td width="40" colspan="2">
					<div style="white-space: nowrap;">
						<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t7']; ?>
</label>
						<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t8']; ?>
</label>
					</div>
			<?php endif; ?>
			</td>



			<td align="right" width="5">
			<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
				<!--img src="info.jpg" alt="<?php echo $this->_tpl_vars['val']['comment']; ?>
" border="0" onClick="return show_info_page('<?php echo $this->_tpl_vars['val']['comment']; ?>
');"-->
				<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >
					<img src="info.jpg" alt="<?php echo $this->_tpl_vars['val']['comment']; ?>
" border="0" >
				</a>
			<?php endif; ?>
			</td>


	</tr>
<?php endforeach; endif; unset($_from); ?>

	<tr>
		<td>&nbsp;

		</td>
	</tr>
	<tr>

		<td align="center" colspan="2">
			<input type="submit" value="<?php echo $this->_tpl_vars['cnf_langs']['t11']; ?>
" name="sub3" >
		</td>
	</tr>

</table>

<input type="Hidden" name="change" value="false">
<input type="Hidden" name="name" value="<?php echo $this->_tpl_vars['name_theme']; ?>
">
<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>