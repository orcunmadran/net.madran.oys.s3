<?php /* Smarty version 2.6.10, created on 2008-09-17 17:40:11
         compiled from cnf_sound.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t7']; ?>
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
<?php $_from = $this->_tpl_vars['fields']['sound']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val1']):
        $this->_foreach['fields1']['iteration']++;
?>
	<tr>
		<td style="width:200px;">
			<?php $this->assign('k', $this->_tpl_vars['key']-$this->_tpl_vars['fields']['sound_patch'][0]['_order']+1); ?>
			<?php if ($this->_tpl_vars['fields']['sound_patch'][0]['_order']-1 <= $this->_tpl_vars['key']): ?>
				<?php echo $this->_tpl_vars['fields']['sound_patch'][$this->_tpl_vars['k']]['title']; ?>

				<?php $this->assign('array', $this->_tpl_vars['fields']['sound_patch'][$this->_tpl_vars['k']]); ?>
			<?php elseif ($this->_tpl_vars['fields']['sound_patch'][0]['_order']-1 > $this->_tpl_vars['key']): ?>
				<?php echo $this->_tpl_vars['fields']['sound'][$this->_tpl_vars['key']]['title']; ?>

				<?php $this->assign('array', $this->_tpl_vars['fields']['sound'][$this->_tpl_vars['key']]); ?>
			<?php else: ?>
			<?php endif; ?>
			<input type="Hidden" name="name_<?php echo $this->_tpl_vars['val1']['id']; ?>
" value="<?php echo $this->_tpl_vars['val1']['title']; ?>
">
			<input type="Hidden" name="type_<?php echo $this->_tpl_vars['val1']['id']; ?>
" value="<?php echo $this->_tpl_vars['val1']['type']; ?>
">
			<input type="Hidden" name="field_<?php echo $this->_tpl_vars['val1']['id']; ?>
" value="<?php echo $this->_tpl_vars['val1']['level_1']; ?>
">
		</td>


		<td width="50">
		<div style="white-space: nowrap;height:25px;">
			<?php if ($this->_tpl_vars['val1']['type'] == 'integer'): ?>
					<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['val1']['id']; ?>
" value="<?php echo $this->_tpl_vars['val1']['value']; ?>
">
			<?php elseif ($this->_tpl_vars['val1']['type'] == 'string'): ?>
					<input type="Text" size="40" name="fld_<?php echo $this->_tpl_vars['val1']['id']; ?>
" value="<?php echo $this->_tpl_vars['val1']['value']; ?>
">
			<?php elseif ($this->_tpl_vars['val1']['type'] == 'boolean'): ?>

					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val1']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val1']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>
</label>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val1']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val1']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
</label>
					<?php if ($this->_tpl_vars['fields']['sound_patch'][0]['_order']-1 <= $this->_tpl_vars['key']): ?>
						<SELECT NAME="fld_<?php echo $this->_tpl_vars['array']['id']; ?>
">
							<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['fields']['sound_files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)2;
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
								<?php $this->assign('name', $this->_tpl_vars['fields']['sound_files'][$this->_sections['i']['index']]); ?>
								<?php $this->assign('patch', "sounds/".($this->_tpl_vars['name'])); ?>
								<OPTION VALUE="<?php echo $this->_tpl_vars['patch']; ?>
" <?php if ($this->_tpl_vars['array']['value'] == $this->_tpl_vars['patch']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>

							<?php endfor; endif; ?>
						</SELECT>
					<?php endif; ?>

			<?php endif; ?>
			<?php if ($this->_tpl_vars['val1']['r'] != ''): ?>
				<?php echo $this->_tpl_vars['val1']['r']; ?>

			<?php endif; ?>
			<?php if ($this->_tpl_vars['val1']['info'] != ''): ?>
				<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val1']['info']; ?>
', this, event, '200px')" >[?]</a>
			<?php endif; ?>
			</div>
		</td>


			<td align="right" width="5">

			</td>

	</tr>
	<?php if ($this->_tpl_vars['val1']['level_1'] == 'muteAll'): ?>
		<tr>
			<td colspan="4">&nbsp;

			</td>
		</tr>
		<tr>
			<th align="left">
				<?php echo $this->_tpl_vars['cnf_langs']['t2']; ?>

			</th>
			<th colpsan="2" align="left">
				<?php echo $this->_tpl_vars['cnf_langs']['t3']; ?>
&nbsp;<?php echo $this->_tpl_vars['cnf_langs']['t4']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MP3
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<HR>
			</td>
		</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="3">&nbsp;

		</td>
	</tr>
	<tr>

		<td colspan="3"align="center">
			<input type="Submit" name="submit" value="<?php echo $this->_tpl_vars['cnf_langs']['t5']; ?>
">
		</td>
	</tr>

<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</table>
</FORM>