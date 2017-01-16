<?php /* Smarty version 2.6.10, created on 2008-09-17 17:41:45
         compiled from cnf_other.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t16']; ?>
</h3>
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


<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>
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
" value="<?php echo $this->_tpl_vars['val']['level_0']; ?>
">
		</td>


		<td width="50">
		<div style="white-space: nowrap;height:25px;">
			<?php if ($this->_tpl_vars['val']['type'] == 'integer'): ?>
					<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
			<?php elseif ($this->_tpl_vars['val']['type'] == 'string'): ?>
					<input type="Text" size="40" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
			<?php elseif ($this->_tpl_vars['val']['type'] == 'combo'): ?>
				<select name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
					<?php $this->assign('array', $this->_tpl_vars['value'][$this->_tpl_vars['val']['level_0']]); ?>
					<?php $_from = $this->_tpl_vars['array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
						<?php $this->assign('v', $this->_tpl_vars['val1']); ?>
						<?php if ($this->_tpl_vars['val']['level_0'] == 'defaultTheme'): ?>
							<option value="<?php echo $this->_tpl_vars['val1']; ?>
"  <?php if ($this->_tpl_vars['val1'] == $this->_tpl_vars['val']['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val1']; ?>

						<?php elseif ($this->_tpl_vars['val']['level_0'] == 'defaultSkin'): ?>
							<option value="<?php echo $this->_tpl_vars['val1']['swf_name']; ?>
"  <?php if ($this->_tpl_vars['val1']['swf_name'] == $this->_tpl_vars['val']['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val1']['name']; ?>

						<?php else: ?>
							<option value=<?php echo $this->_tpl_vars['key1']; ?>
  <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['val']['value']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val1']; ?>

						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnfo_langs']['t0']; ?>
</label>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnfo_langs']['t1']; ?>
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
			<input type="Submit" name="submit" value="<?php echo $this->_tpl_vars['cnfo_langs']['t2']; ?>
">
		</td>
	</tr>

</table>

<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>