<?php /* Smarty version 2.6.10, created on 2008-09-17 17:40:22
         compiled from cnf_modules.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t11']; ?>
</h3>
<?php if ($this->_tpl_vars['is_modules'] == 0): ?>
	<?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>

<?php else: ?>

<FORM action="cnf_config.php?module=modules" method="post" enctype="multipart/form-data" name="mod">

<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<input type="hidden" name="module125" value="modules125">

<TABLE border="0" width="500" height="100%">
<!--error process -->
<?php if ($this->_tpl_vars['errMsg'] != ''): ?>
	<TR>
		<TD class="errorMsg" valign='middle' align="center" colspan="2">
			<?php echo $this->_tpl_vars['errMsg']; ?>

		</TD>
	</TR>
<?php endif; ?>
<!--end error handling-->
	<TR>
		<TD colspan="2"><font color="#ff0000">*</font> <?php echo $this->_tpl_vars['cnf_langs']['t7']; ?>
</TD>
	</TR>
<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['field']):
        $this->_foreach['fields']['iteration']++;
?>
	<TR>
		<TH align="left" width="40%" valign="middle">
			<?php echo $this->_tpl_vars['field']['name']; ?>

		</TH>
		<TD align="center" width="30%" valign="middle" nowrap>
			<input type="Hidden" name="type_<?php echo $this->_tpl_vars['i']; ?>
_1191" value="<?php echo $this->_tpl_vars['field']['1191']['type']; ?>
">
			<input type="Hidden" name="name_<?php echo $this->_tpl_vars['i']; ?>
_1191" value="<?php echo $this->_tpl_vars['field']['1191']['title']; ?>
">
			<input type="Hidden" name="field_<?php echo $this->_tpl_vars['i']; ?>
_1191" value="<?php echo $this->_tpl_vars['field']['1191']['level_1']; ?>
">
			<input type="checkbox" name="fld_<?php echo $this->_tpl_vars['i']; ?>
_1191" <?php if ($this->_tpl_vars['field']['1191']['value']): ?> checked <?php endif; ?>> <?php echo $this->_tpl_vars['cnf_langs']['t8']; ?>

		</TD>
		<TD align="center" width="30%" valign="middle">
			<input type="button" onClick="javascript:
			if(document.getElementById('div_<?php echo $this->_tpl_vars['i']; ?>
').style.display == 'none')
			<?php echo '{'; ?>

				document.getElementById('div_<?php echo $this->_tpl_vars['i']; ?>
').style.display = 'block';
			<?php echo '}'; ?>

			else
			<?php echo '{'; ?>

				document.getElementById('div_<?php echo $this->_tpl_vars['i']; ?>
').style.display = 'none';
			<?php echo '}'; ?>
" name="configure_<?php echo $this->_tpl_vars['i']; ?>
" value="<?php echo $this->_tpl_vars['cnf_langs']['t9']; ?>
">
		</TD>
	</TR>
	<TR>
		<TD colspan="3">
				<?php $_from = $this->_tpl_vars['field']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['values'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['values']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['values']['iteration']++;
?>
					<?php if (($this->_foreach['values']['iteration'] <= 1) == 'true'): ?>
						<div id="div_<?php echo $this->_tpl_vars['i']; ?>
" style="display:none;">
						<table border="0" width="100%" cellpadding="3" cellspacing="2">
					<?php endif; ?>
						<?php if (! ( $this->_tpl_vars['key'] == 'name' || $this->_tpl_vars['value']['level_1'] == 'enabled' )): ?>
							<?php if ($this->_tpl_vars['key'] < 848 || $this->_tpl_vars['key'] > 851): ?>
								<tr>
									<td width="40%"><b><?php echo $this->_tpl_vars['value']['title']; ?>
</b></td>
									<td width="60%">
										<div style="white-space: nowrap;">
										<input type="Hidden" name="type_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['type']; ?>
">
										<input type="Hidden" name="name_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['title']; ?>
">
										<input type="Hidden" name="field_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['level_1']; ?>
">
									<?php if ($this->_tpl_vars['value']['type'] == 'integer'): ?>
										<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['value']; ?>
">
									<?php elseif ($this->_tpl_vars['value']['type'] == 'string'): ?>
										<input type="Text" size="40" name="fld_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['value']; ?>
">
									<?php elseif ($this->_tpl_vars['value']['type'] == 'combo'): ?>
										<?php if ($this->_tpl_vars['value']['level_1'] == 'path'): ?>
										<input type="Hidden" name="fld_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['value']; ?>
"><?php echo $this->_tpl_vars['value']['value']; ?>

										<?php else: ?>
										<select name="fld_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" onChange="javascript:
										if(this.value == -1)
										<?php echo '{'; ?>

											document.getElementById('inner_div_<?php echo $this->_tpl_vars['i']; ?>
').style.display = 'block';
										<?php echo '}'; ?>

										else
										<?php echo '{'; ?>

											document.getElementById('inner_div_<?php echo $this->_tpl_vars['i']; ?>
').style.display = 'none';
										<?php echo '}'; ?>

										">
											<?php $_from = $this->_tpl_vars['anchors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['val2']):
        $this->_foreach['name']['iteration']++;
?>
												<option value=<?php echo $this->_tpl_vars['key2']; ?>
 <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['value']['value']): ?>selected <?php if ($this->_tpl_vars['key2'] == -1):  $this->assign('dis', 'block');  else:  $this->assign('dis', 'none');  endif;  endif; ?>><?php echo $this->_tpl_vars['val2']; ?>

											<?php endforeach; endif; unset($_from); ?>
										</select>
										<?php endif; ?>
									<?php elseif ($this->_tpl_vars['value']['type'] == 'boolean'): ?>
											<input type="Radio" name="fld_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="true" <?php if ($this->_tpl_vars['value']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t3']; ?>
</label>
											<input type="Radio" name="fld_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="false" <?php if (! $this->_tpl_vars['value']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t4']; ?>
</label>
									<?php endif; ?>
									<?php if ($this->_tpl_vars['value']['info'] != ''): ?>
										<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['value']['info']; ?>
', this, event, '200px')">[?]</a>
									<?php endif; ?>
									</div></td></div>
								</tr>
							<?php else: ?>
								<?php if ($this->_tpl_vars['key'] == 848): ?>
									<tr>
									<td colspan="2" width="100%"><div id="inner_div_<?php echo $this->_tpl_vars['i']; ?>
" style="display:<?php echo $this->_tpl_vars['dis']; ?>
;"><table border="0" width="100%">
								<?php endif; ?>
									<tr>
									<td width="40%"><b><?php echo $this->_tpl_vars['value']['title']; ?>
</b></td>
									<td width="60%">
										<div style="white-space: nowrap; ">
										<input type="Hidden" name="type_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['type']; ?>
">
										<input type="Hidden" name="name_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['title']; ?>
">
										<input type="Hidden" name="field_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['level_1']; ?>
">
									<?php if ($this->_tpl_vars['value']['type'] == 'integer'): ?>
										<input type="Text" size="5" name="fld_<?php echo $this->_tpl_vars['i']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['value']['value']; ?>
">
									<?php endif; ?>
									<?php if ($this->_tpl_vars['value']['info'] != ''): ?>
										<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['value']['info']; ?>
', this, event, '200px')">[?]</a>
									<?php endif; ?>
									</div></td></div>
								</tr>
								<?php if ($this->_tpl_vars['key'] == 851): ?>
									</table></div></td></tr>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
						<?php if (($this->_foreach['values']['iteration'] == $this->_foreach['values']['total']) == 'true'): ?>
							</div></table>
						<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
		</TD>
	</TR>
	<TR>
		<TD colspan="3"><HR size="1"></TD>
	</TR>
<?php endforeach; endif; unset($_from); ?>
	<TR>
		<TD colspan="3"></TD>
	</TR>
	<TR>
		<TD colspan="3" align="center">
			<input type="Submit" name="sub_save" value="<?php echo $this->_tpl_vars['cnf_langs']['t6']; ?>
">
		</TD>
	</TR>
</TABLE>

</FORM>
<?php endif; ?>