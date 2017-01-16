<?php /* Smarty version 2.6.10, created on 2008-09-17 17:40:00
         compiled from cnf_layout.tpl */ ?>

<H3><?php echo $this->_tpl_vars['langs']['t5']; ?>
</H3>


<FORM action="cnf_config.php" method="post" enctype="multipart/form-data" name="k">
	<?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>

	<SELECT NAME=layout onchange=k.submit()>
		<?php $_from = $this->_tpl_vars['layouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['name']['iteration']++;
?>
			<OPTION VALUE=<?php echo $this->_tpl_vars['val']['value']; ?>
 <?php if ($this->_tpl_vars['val']['value'] == $this->_tpl_vars['name']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']['name']; ?>

		<?php endforeach; endif; unset($_from); ?>
	</SELECT>

	<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
	<?php $this->assign('name_layout', $this->_tpl_vars['name']); ?>
</FORM>




<FORM action="cnf_config.php" method="post" enctype="multipart/form-data">
<table border="0" width1="700" height="100%" align="left">

<!--error process -->

<?php if ($this->_tpl_vars['errMsg'] != ''): ?>
	<TR>
		<TD class="errorMsg" valign='middle'  align="center" colspan="2">
			<?php echo $this->_tpl_vars['errMsg']; ?>

		</TD>
	</TR>
<?php endif; ?>
<!--end error handling-->

<?php $this->assign('bool1', '0'); ?>
<!--Title for value-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>

	<?php if ($this->_tpl_vars['val']['level_2'] == 'toolbar' && $this->_tpl_vars['bool1'] == '0'): ?>
	<?php $this->assign('bool1', '1'); ?>
		<tr>
			<th colspan="2" align="left"><br>
				<?php echo $this->_tpl_vars['cnf_langs']['t4']; ?>

			</th>
		</tr>
	<?php elseif ($this->_tpl_vars['val']['level_2'] == 'optionPanel' && $this->_tpl_vars['bool1'] == '1'): ?>
	<?php $this->assign('bool1', '0'); ?>
		<tr>
			<th colspan="2" align="left"><br>
				<?php echo $this->_tpl_vars['cnf_langs']['t5']; ?>

			</th>
		</tr>
	<?php elseif ($this->_tpl_vars['val']['level_3'] == 'userList' && $this->_tpl_vars['bool1'] == '0'): ?>
	<?php $this->assign('bool1', '1'); ?>
		<tr>
			<th colspan="2" align="left"><br>
				<?php echo $this->_tpl_vars['cnf_langs']['t6']; ?>

			</th>
		</tr>
	<?php elseif ($this->_tpl_vars['val']['level_3'] == 'publicLog' && $this->_tpl_vars['bool1'] == '1'): ?>
	<?php $this->assign('bool1', '0'); ?>
		<tr>
			<th colspan="2" align="left"><br>
				<?php echo $this->_tpl_vars['cnf_langs']['t7']; ?>

			</th>
		</tr>
	<?php elseif ($this->_tpl_vars['val']['level_3'] == 'privateLog' && $this->_tpl_vars['bool1'] == '0'): ?>
	<?php $this->assign('bool1', '1'); ?>
		<tr>
			<th colspan="2" align="left"><br>
				<?php echo $this->_tpl_vars['cnf_langs']['t8']; ?>

			</th>
		</tr>
	<?php elseif ($this->_tpl_vars['val']['level_3'] == 'inputBox' && $this->_tpl_vars['bool1'] == '1'): ?>
	<?php $this->assign('bool1', '0'); ?>
		<tr>
			<th colspan="2" align="left"><br>
				<?php echo $this->_tpl_vars['cnf_langs']['t9']; ?>

			</th>
		</tr>
	<?php endif; ?>
<!--end Title for value-->


<!--representation values-->
	<?php if ($this->_tpl_vars['val']['level_2'] == 'allowBan' && $this->_tpl_vars['name'] == 1): ?>
	<tr><td><input type="hidden" name="fld_<?php echo $this->_tpl_vars['val_id']; ?>
" value="0"></td></tr>
	<?php else: ?>
	<tr>
		<td style="width:200px;">
			<?php echo $this->_tpl_vars['val']['title']; ?>

			<input type="Hidden" name="type_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['type']; ?>
">
			<input type="Hidden" name="name_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['title']; ?>
">
			<input type="Hidden" name="field_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['level_4']; ?>
">
		</td>


		<td width="50">
		<div style="white-space: nowrap;height:25px;">
			<?php if ($this->_tpl_vars['val']['type'] == 'integer'): ?>
				<?php if ($this->_tpl_vars['val']['level_3'] == 'userList' && $this->_tpl_vars['val']['level_4'] == 'position'): ?>
					<SELECT name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
						<?php $_from = $this->_tpl_vars['userListItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['option']):
        $this->_foreach['name']['iteration']++;
?>
							<OPTION VALUE=<?php echo $this->_tpl_vars['key']; ?>
 <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['val']['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['option']; ?>

						<?php endforeach; endif; unset($_from); ?>
					</SELECT>
				<?php elseif ($this->_tpl_vars['val']['level_3'] == 'inputBox' && $this->_tpl_vars['val']['level_4'] == 'position'): ?>
					<SELECT name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
						<?php $_from = $this->_tpl_vars['inputBoxItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['option']):
        $this->_foreach['name']['iteration']++;
?>
							<OPTION VALUE=<?php echo $this->_tpl_vars['key']; ?>
 <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['val']['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['option']; ?>

						<?php endforeach; endif; unset($_from); ?>
					</SELECT>
				<?php else: ?>
					<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">&nbsp;<?php echo $this->_tpl_vars['value']['dimension'][$this->_tpl_vars['val']['level_4']];  echo $this->_tpl_vars['val']['units']; ?>

				<?php endif; ?>
				<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
					<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >[?]</a>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'string'): ?>
				<input type="Text" size="40" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
"><?php echo $this->_tpl_vars['val']['units']; ?>

				<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
					<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >[?]</a>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
				<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
</label>
				<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t2']; ?>
</label>

				<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
					<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >[?]</a>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'select'): ?>

				<SELECT name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
					<?php $_from = $this->_tpl_vars['val']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['option']):
        $this->_foreach['name']['iteration']++;
?>
						<OPTION VALUE=<?php echo $this->_tpl_vars['key']; ?>
 <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['val']['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['option']; ?>

					<?php endforeach; endif; unset($_from); ?>
				</SELECT>

			<?php endif; ?>
			</div>
		</td>



			<td align="right" width="5">

			</td>


	</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

	<tr>
		<td colspan="3">&nbsp;

		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<input type="Submit" name="submit" value="<?php echo $this->_tpl_vars['cnf_langs']['t3']; ?>
">
		</td>
	</tr>

</table>

<input type="Hidden" name="name" value="<?php echo $this->_tpl_vars['name_layout']; ?>
">
<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>