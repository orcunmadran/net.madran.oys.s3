<?php /* Smarty version 2.6.10, created on 2008-09-17 17:41:41
         compiled from cnf_badwords.tpl */ ?>
<h3>
	<?php echo $this->_tpl_vars['langs']['t15']; ?>

</h3>
<?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>
<br>
<?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
<br>
<?php echo $this->_tpl_vars['cnf_langs']['t2']; ?>
<br><br>

<FORM action="cnf_config.php" method="post" name="cnf_form" enctype="multipart/form-data">

<table border="0" width="80%" height="100%" align=left>

<!--error process -->

<?php if ($this->_tpl_vars['errMsg'] != ''): ?>
	<TR>
		<TD class="errorMsg" valign='middle'  align="center" colspan="4">
			<?php echo $this->_tpl_vars['errMsg']; ?>

		</TD>
	</TR>
<?php endif; ?>
<!--end error handling-->


<tr>
	<td colspan="2" align="center" nowrap>
		<?php echo $this->_tpl_vars['cnf_langs']['t3']; ?>

	</td>
	<td colspan="3">
		<input type="text" size="15" name="Substitute" value=<?php echo $this->_tpl_vars['substitute']; ?>
>
	</td>
</tr>

<!--Add badword-->
	<tr>
		<td colspan="5">&nbsp;

		</td>
	</tr>

	<tr>
		<td align="right">
			<input type="Text" size="15" name="AddName" value="">
		</td>
		<td  align="center" size="5" >
			=>
		</td>
		<td>
			<input type="Text" size="15" name="AddValue" value="">
		</td>
		<td colspan="2">
			<input type="submit" name="Submit1" value="<?php echo $this->_tpl_vars['cnf_langs']['t4']; ?>
" onclick='javascript:submit();' align="left">
		</td>
	</tr>

	<tr>
		<td colspan="5" align="right">&nbsp;

		</td>
	</tr>

<!--representation values-->
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['fields']['iteration']++;
?>
	<tr>


		<td width="40%" align="right">
			<input type="Text" size="15" name="name_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['level_1']; ?>
">
			<input type="Hidden" name="type_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['type']; ?>
">
			<input type="Hidden" name="field_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_foreach['fields']['iteration']; ?>
">
		</td>
		<td align="center" >
			=>
		</td>
		<td >
			<input type="Text" size="15" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
		</td>
		<td  align="left">
			<div style="white-space: nowrap;">
				<input type="Radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0" <?php if (! $this->_tpl_vars['val']['disabled']): ?> checked <?php endif; ?> id="on<?php echo $this->_tpl_vars['key']; ?>
"><label for="on<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t5']; ?>
</label>
				<input type="Radio" name="disabled_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['disabled']): ?> checked <?php endif; ?> id="off<?php echo $this->_tpl_vars['key']; ?>
"><label for="off<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t6']; ?>
</label>
			</div>
		</td>
		<td>
			<a href="javascript:decision('<?php echo $this->_tpl_vars['cnf_langs']['t10']; ?>
','cnf_config.php?module=badwords&method=Delete&ID=<?php echo $this->_tpl_vars['val']['id']; ?>
')"><?php echo $this->_tpl_vars['cnf_langs']['t7']; ?>
</a>
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
		<td colspan="4">

		</td>
	</tr>
	<tr>

		<td align="center" colspan="5">
			<!-- <input type="submit" name="sub2" value="<?php echo $this->_tpl_vars['cnf_langs']['t8']; ?>
" > --> <input type="submit" name="Submit2" value="<?php echo $this->_tpl_vars['cnf_langs']['t9']; ?>
" onclick='javascript:submit();'>
		</td>
	</tr>

</table>

<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
</form>