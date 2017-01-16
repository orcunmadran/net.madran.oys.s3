<?php /* Smarty version 2.6.10, created on 2008-09-17 17:40:16
         compiled from cnf_filesharing.tpl */ ?>
<h3><?php echo $this->_tpl_vars['langs']['t10']; ?>
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

<tr>
	<th colspan="3" align="left">
		<?php echo $this->_tpl_vars['cnff_langs']['t0']; ?>

	</th>
</tr>
<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>
	<?php if ($this->_tpl_vars['val']['level_1'] == 'allowFileExt'): ?>


				<?php if ($this->_tpl_vars['val']['level_0'] == 'avatarbgloading'): ?>
				<tr>
					<td colspan="3">&nbsp;

					</td>
				</tr>
				<tr>
				<th colspan="3" align="left">
					<?php echo $this->_tpl_vars['cnff_langs']['t1']; ?>

				<?php elseif ($this->_tpl_vars['val']['level_0'] == 'photoloading'): ?>
				<tr>
					<td colspan="3">&nbsp;

					</td>
				</tr>
				<tr>
				<th colspan="3" align="left">
					<?php echo $this->_tpl_vars['cnff_langs']['t2']; ?>

				<?php endif; ?>
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
" value="<?php echo $this->_tpl_vars['val']['level_1']; ?>
">
		</td>

		<td width="50">
		<div style="white-space: nowrap;height:25px;">
			<?php if ($this->_tpl_vars['val']['type'] == 'integer' || $this->_tpl_vars['val']['type'] == 'double'): ?>

				<input type="Text" size="5"  name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
				<?php if ($this->_tpl_vars['val']['type'] == 'integer'): ?>
					<?php echo $this->_tpl_vars['cnff_langs']['t6']; ?>

				<?php elseif ($this->_tpl_vars['val']['type'] == 'double'): ?>
					<?php echo $this->_tpl_vars['cnff_langs']['t7']; ?>

				<?php endif; ?>

			<?php elseif ($this->_tpl_vars['val']['type'] == 'string'): ?>
					<input type="Text" size="40" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
			<?php elseif ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnff_langs']['t3']; ?>
</label>
					<input type="Radio" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['value']): ?> checked <?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
"><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnff_langs']['t4']; ?>
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

		<td colspan="3" align="center">
			<input type="Submit" name="submit" value="<?php echo $this->_tpl_vars['cnff_langs']['t5']; ?>
">
		</td>
	</tr>

</table>

<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>