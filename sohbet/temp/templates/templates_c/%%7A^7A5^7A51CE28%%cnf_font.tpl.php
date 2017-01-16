<?php /* Smarty version 2.6.10, created on 2008-09-17 17:40:05
         compiled from cnf_font.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t6']; ?>
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
	<?php if ($this->_tpl_vars['val']['level_2'] == 'mainChat'): ?>
		<?php $this->assign('Title', $this->_tpl_vars['cnf_langs']['t2']); ?>
	<?php elseif ($this->_tpl_vars['val']['level_2'] == 'interfaceElements'): ?>
		<?php $this->assign('Title', $this->_tpl_vars['cnf_langs']['t3']); ?>
	<?php elseif ($this->_tpl_vars['val']['level_2'] == 'title'): ?>
		<?php $this->assign('Title', $this->_tpl_vars['cnf_langs']['t4']); ?>
	<?php endif; ?>



	<?php if ($this->_tpl_vars['val']['level_3'] == 'presence'): ?>
		<tr>
			<td colspan="4">&nbsp;

			</td>
		</tr>
		<tr>
			<th colspan="3" align="left">
					<?php echo $this->_tpl_vars['Title']; ?>

			</th>
		</tr>

	<?php endif; ?>

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
" value="<?php echo $this->_tpl_vars['val']['level_3']; ?>
">
		</td>


		<td width="40">
		<div style="white-space: nowrap;height:25px;">
			<?php if ($this->_tpl_vars['val']['type'] == 'integer'): ?>
					<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
			<?php elseif ($this->_tpl_vars['val']['type'] == 'string'): ?>
					<SELECT NAME="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['family']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)0;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
							<?php $this->assign('name', $this->_tpl_vars['family'][$this->_sections['i']['index']]['name']); ?>
							<?php $this->assign('disabled', $this->_tpl_vars['family'][$this->_sections['i']['index']]['disabled']); ?>
							<?php if (! $this->_tpl_vars['disabled']): ?>
							<OPTION VALUE="<?php echo $this->_tpl_vars['name']; ?>
" <?php if ($this->_tpl_vars['val']['value'] == $this->_tpl_vars['name']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>

							<?php endif; ?>
						<?php endfor; endif; ?>
					</SELECT>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>
</label>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
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
		<td colspan="4">&nbsp;

		</td>
	</tr>
	<tr>
		<td>
			<?php echo $this->_tpl_vars['cnf_langs']['t5']; ?>

		</td>
		<td>
			<input type="Text" size="35"  name="size" value="<?php echo $this->_tpl_vars['size']; ?>
">
		</td>
	</tr>
		<tr>
		<td colspan="3">&nbsp;

		</td>
	</tr>
	<tr>
		<th style="width:200px;" colspan="3" align="left">
			<?php echo $this->_tpl_vars['cnf_langs']['t6']; ?>

		</th>
	</tr>
	<tr>
			<td colspan="3">&nbsp;

			</td>
		</tr>
		<tr>
			<th align="left">
				<?php echo $this->_tpl_vars['cnf_langs']['t7']; ?>

			</th>
			<th align="left">
				<?php echo $this->_tpl_vars['cnf_langs']['t8']; ?>

			</th>
		</tr>
		<tr>
			<td colspan="3">
				<HR>
			</td>
		</tr>
<?php $_from = $this->_tpl_vars['family']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['family'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['family']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['family']['iteration']++;
?>
	<tr>
		<td align="left">
			<input type="Hidden" name="family_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['name']; ?>
">
			<div style="white-space: nowrap;height:25px;">
			<?php echo $this->_tpl_vars['val']['name']; ?>

			</div>
		</td>
		<td align="left">
			<div style="white-space: nowrap;height:25px;">
			<input type="Radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['disabled']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>
</label>
			<input type="Radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['disabled']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
</label>
			</div>
		</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="3">

		</td>
	</tr>
	<tr>

		<td colspan="3"align="center">
			<input type="Submit" name="submit" value="<?php echo $this->_tpl_vars['cnf_langs']['t9']; ?>
">
		</td>
	</tr>

</table>

<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>