<?php /* Smarty version 2.6.10, created on 2008-09-17 17:40:14
         compiled from cnf_avatars.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t9']; ?>
</h3>
<FORM action="cnf_config.php" method="post" enctype="multipart/form-data" name="k" >
	<?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>

	<SELECT NAME=avatar onchange='submit();'>
		<?php $_from = $this->_tpl_vars['avatars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['name']['iteration']++;
?>
			<OPTION VALUE=<?php echo $this->_tpl_vars['val']; ?>
    <?php if ($this->_tpl_vars['val'] == $this->_tpl_vars['name']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']; ?>

		<?php endforeach; endif; unset($_from); ?>
	</SELECT>

	<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
	<?php $this->assign('name_avator', $this->_tpl_vars['name']); ?>
</FORM>




<FORM action="cnf_config.php" method="post" enctype="multipart/form-data">

<table border="0" width="700" height="100%">

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
<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>
		<?php if ($this->_tpl_vars['val']['level_2'] == 'male' && $this->_tpl_vars['bool1'] == 0): ?>
		<?php $this->assign('bool1', '1'); ?>
			<tr>
				<th colspan="3" align="left"><br>
					<?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>

				</th>
			</tr>
		<?php elseif ($this->_tpl_vars['val']['level_2'] == 'female' && $this->_tpl_vars['bool1'] == 1): ?>
		<?php $this->assign('bool1', '0'); ?>
			<tr>
				<th colspan="3" align="left"><br>
					<?php echo $this->_tpl_vars['cnf_langs']['t2']; ?>

				</th>
			</tr>
		<?php endif; ?>

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
				<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
			<?php elseif ($this->_tpl_vars['val']['type'] == 'combo'): ?>
				<select name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
					<?php $_from = $this->_tpl_vars['smilies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
						<?php $_from = $this->_tpl_vars['sm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sm_name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sm_name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['sm_key'] => $this->_tpl_vars['sm_val']):
        $this->_foreach['sm_name']['iteration']++;
?>
							<?php if ($this->_tpl_vars['sm_val']['level_1'] == $this->_tpl_vars['key1']): ?>
								<?php $this->assign('sm_code', $this->_tpl_vars['sm_val']['value']); ?>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
							<option value=<?php echo $this->_tpl_vars['key1']; ?>
  <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['val']['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val1']; ?>
 <?php echo $this->_tpl_vars['sm_code']; ?>

					<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'string'): ?>
					<?php $_from = $this->_tpl_vars['mod_only_def']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
						<input name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
[]" type="checkbox" value="<?php echo $this->_tpl_vars['val1']; ?>
" <?php if ($this->_tpl_vars['val1'] == $this->_tpl_vars['mod_only'][$this->_tpl_vars['key1']]): ?>checked<?php endif; ?>><?php echo $this->_tpl_vars['val1']; ?>
 </br>
					<?php endforeach; endif; unset($_from); ?>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
				<?php if ($this->_tpl_vars['val']['title'] == 'default_state'): ?>
					<?php $this->assign('true', 'On'); ?>
					<?php $this->assign('false', 'Off'); ?>
				<?php else: ?>
					<?php $this->assign('true', 'Yes'); ?>
					<?php $this->assign('false', 'No'); ?>
				<?php endif; ?>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['true']; ?>
</label>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['false']; ?>
</label>

			<?php endif; ?>
			<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
				<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >[?]</a>
			<?php endif; ?>
			</div>
		</td>



			<td align="right" width="5">

			</td>


	</tr>
<?php endforeach; endif; unset($_from); ?>

	<tr>
		<td colspan="3">&nbsp;

		</td>
	</tr>
	<tr>

		<td colspan="3"align="center">
			<input type="Submit" name="submit" value="<?php echo $this->_tpl_vars['cnf_langs']['t3']; ?>
">
		</td>
	</tr>

</table>


<input type="Hidden" name="name" value="<?php echo $this->_tpl_vars['name_avator']; ?>
">
<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>

