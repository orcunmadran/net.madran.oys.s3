<?php /* Smarty version 2.6.10, created on 2008-09-17 17:39:35
         compiled from cnf_list.tpl */ ?>
<FORM action="cnf_config.php" method="post" enctype="multipart/form-data" name="cnf_form" onsubmit="javascript:sbmt();">
<input type="Hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<input type="hidden" name="js" value="">

<table border="0" <?php if ($this->_tpl_vars['module'] == 'msg'): ?>width="500"<?php else: ?>width="700"<?php endif; ?> height="100%">

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

	<?php if (! ( $this->_tpl_vars['val']['level_0'] == 'is_paid_chat' || $this->_tpl_vars['val']['level_0'] == 'membership_amount' || $this->_tpl_vars['val']['level_0'] == 'payment_test_mode' || $this->_tpl_vars['val']['level_0'] == 'paypal_bussiness_email' || $this->_tpl_vars['val']['level_0'] == 'payment_currency_type' )): ?>

	<?php if (( $this->_tpl_vars['val']['value'] == '' || $this->_tpl_vars['val']['value'] == 'statelessCMS' ) && $this->_tpl_vars['val']['level_0'] == 'CMSsystem'): ?>
		<?php $this->assign('cms', 'true'); ?>
	<?php endif; ?>
	<?php if (! ( $this->_tpl_vars['val']['level_0'] == 'adminPassword' || $this->_tpl_vars['val']['level_0'] == 'spyPassword' || $this->_tpl_vars['val']['level_0'] == 'moderatorPassword' )): ?>
	<tr>
		<td style="width:250px;" valign="top"><?php echo $this->_tpl_vars['val']['title']; ?>

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
		<td nowrap height="25" valign="top">
		<div style="white-space: nowrap;">
			<?php if ($this->_tpl_vars['val']['type'] == 'integer'): ?>
				<input type="hidden" id="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" name="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
				<input type="Text" size="5"  id="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">&nbsp;<?php echo $this->_tpl_vars['value']['dimension'][$this->_tpl_vars['val']['level_0']]; ?>

			<?php elseif ($this->_tpl_vars['val']['type'] == 'string'): ?>
				<?php if ($this->_tpl_vars['val']['level_0'] == 'modsAdminRestrictions'): ?>
					<select name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
[]" multiple size="8" style="WIDTH: 255px">
						<?php $_from = $this->_tpl_vars['mod_rest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
							<?php if ($this->_tpl_vars['val1'] == "#"): ?>
								<option value=<?php echo $this->_tpl_vars['mods_rest_selected'][$this->_tpl_vars['key1']]; ?>
 selected><?php echo $this->_tpl_vars['mods_rest_selected'][$this->_tpl_vars['key1']]; ?>

							<?php else: ?>
								<option value=<?php echo $this->_tpl_vars['val1']; ?>
><?php echo $this->_tpl_vars['val1']; ?>

							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				<?php elseif ($this->_tpl_vars['val']['level_0'] == 'mods'): ?>
					<select name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
[]" multiple size="8" style="WIDTH: 255px">
						<?php $_from = $this->_tpl_vars['mods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
							<?php if ($this->_tpl_vars['val1'] == "#"): ?>
								<option value=<?php echo $this->_tpl_vars['mods_selected'][$this->_tpl_vars['key1']]; ?>
 selected><?php echo $this->_tpl_vars['mods_selected'][$this->_tpl_vars['key1']]; ?>

							<?php else: ?>
								<option value=<?php echo $this->_tpl_vars['val1']; ?>
><?php echo $this->_tpl_vars['val1']; ?>

							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				<?php elseif ($this->_tpl_vars['val']['level_0'] == 'disabledIRC'): ?>
					<select name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
[]" multiple size="8" style="WIDTH: 255px">
						<?php $_from = $this->_tpl_vars['disabledIRC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
							<?php if ($this->_tpl_vars['val1'] == "#"): ?>
								<option value=<?php echo $this->_tpl_vars['disabledIRC_selected'][$this->_tpl_vars['key1']]; ?>
 selected><?php echo $this->_tpl_vars['disabledIRC_selected'][$this->_tpl_vars['key1']]; ?>

							<?php else: ?>
								<option value=<?php echo $this->_tpl_vars['val1']; ?>
><?php echo $this->_tpl_vars['val1']; ?>

							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				<?php else: ?>
						<?php if ($this->_tpl_vars['val']['level_0'] == 'cachePath' || $this->_tpl_vars['val']['level_0'] == 'cacheFilePrefix'): ?>
							<?php echo $this->_tpl_vars['val']['value']; ?>

							<input type="hidden" id="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" name="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
							<input type="hidden" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
						<?php else: ?>
							<input type="Text" size="40"
							<?php if ($this->_tpl_vars['val']['level_0'] == 'version' || $this->_tpl_vars['val']['level_0'] == 'cachePath' || $this->_tpl_vars['val']['level_0'] == 'cacheFilePrefix' || ( $this->_tpl_vars['cms'] != 'true' && ( $this->_tpl_vars['val']['level_0'] == 'adminPassword' || $this->_tpl_vars['val']['level_0'] == 'spyPassword' || $this->_tpl_vars['val']['level_0'] == 'moderatorPassword' ) )): ?>disabled style="background-color:#cccccc;color:#000000;" <?php endif; ?>
							<?php if ($this->_tpl_vars['val']['level_0'] == 'adminPassword'): ?>id="admin"<?php endif; ?>
							<?php if ($this->_tpl_vars['val']['level_0'] == 'spyPassword'): ?>id="spy"<?php endif; ?>
							<?php if ($this->_tpl_vars['val']['level_0'] == 'moderatorPassword'): ?>id="moderator"<?php endif; ?>
						name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
						<input type="hidden" id="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" name="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
						<?php endif; ?>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'combo'): ?>
				<input type="hidden" id="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" name="test_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
				<?php if ($this->_tpl_vars['val']['level_0'] == 'cacheType'): ?>
					<?php $this->assign('cacheType', $this->_tpl_vars['val']['value']); ?>
					<input type="hidden" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
" id="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
					<?php $this->assign('array', $this->_tpl_vars['value'][$this->_tpl_vars['val']['level_0']]); ?>
					<?php echo $this->_tpl_vars['array'][$this->_tpl_vars['val']['value']]; ?>

				<?php else: ?>
				<select <?php if ($this->_tpl_vars['val']['level_0'] == 'cacheType'): ?> disabled style="background-color:white;color:black;" <?php endif; ?> <?php if ($this->_tpl_vars['val']['level_0'] == 'CMSsystem'): ?>id="cmsSystem" onchange="javascript:changeCms();"<?php else: ?>id="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
"<?php endif; ?> name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
">
					<?php if ($this->_tpl_vars['val']['level_1'] == 'anchor' || $this->_tpl_vars['val']['level_1'] == 'window'): ?>
						<?php $this->assign('array', $this->_tpl_vars['value'][$this->_tpl_vars['val']['level_1']]); ?>
					<?php else: ?>
						<?php $this->assign('array', $this->_tpl_vars['value'][$this->_tpl_vars['val']['level_0']]); ?>
					<?php endif; ?>

					<?php $_from = $this->_tpl_vars['array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key1'] => $this->_tpl_vars['val1']):
        $this->_foreach['name']['iteration']++;
?>
						<option value=<?php echo $this->_tpl_vars['key1']; ?>
 <?php if ($this->_tpl_vars['key1'] == $this->_tpl_vars['val']['value'] || ( $this->_tpl_vars['val']['value'] == 'defaultUsrExtCMS' && $this->_tpl_vars['key1'] == 'defaultCMS' )): ?>selected<?php endif; ?>><?php if ($this->_tpl_vars['val']['level_0'] == 'defaultSkin'): ?> <?php echo $this->_tpl_vars['val1']['name']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['val1']; ?>
 <?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['val']['type'] == 'boolean'): ?>
					<input type="hidden" id="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" name="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
					<input <?php if (( $this->_tpl_vars['cacheType'] == 2 && $this->_tpl_vars['val']['level_0'] == 'enableBots' ) || ( $this->_tpl_vars['cms'] && $this->_tpl_vars['val']['level_0'] == 'encryptPass' )): ?>disabled<?php endif; ?> type="Radio" <?php if ($this->_tpl_vars['val']['level_0'] == 'encryptPass'): ?>id="encYes"<?php else: ?>id="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
"<?php endif; ?> name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="1" <?php if ($this->_tpl_vars['val']['value']): ?> checked<?php endif; ?> id="yes<?php echo $this->_tpl_vars['key']; ?>
"><label for="yes<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t0']; ?>
</label>
					<input type="Radio" <?php if ($this->_tpl_vars['val']['level_0'] == 'encryptPass'): ?>id="encNo"<?php else: ?>id="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
"<?php endif; ?> name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="0"<?php if (! $this->_tpl_vars['val']['value']): ?> checked<?php endif; ?> id="no<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cms'] && $this->_tpl_vars['val']['level_0'] == 'encryptPass'): ?>checked disabled<?php endif; ?>><label for="no<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['cnf_langs']['t1']; ?>
</label>
					<?php if ($this->_tpl_vars['val']['level_0'] == 'encryptPass'): ?><input type="hidden" name="encPassOld" value="<?php echo $this->_tpl_vars['val']['value']; ?>
"><?php endif; ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
				<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >[?]</a>
			<?php endif; ?>
			</div>
		</td>
		</tr>
		<?php else: ?>
		<?php if ($this->_tpl_vars['cms']): ?>
			<tr>
			<td style="width:250px;" valign="top"><?php echo $this->_tpl_vars['val']['title']; ?>

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
			<td nowrap height="25" valign="top">
			<div style="white-space: nowrap">
				<input type="Text" size="40"
					<?php if ($this->_tpl_vars['val']['level_0'] == 'adminPassword'): ?>id="admin"<?php endif; ?>
					<?php if ($this->_tpl_vars['val']['level_0'] == 'spyPassword'): ?>id="spy"<?php endif; ?>
					<?php if ($this->_tpl_vars['val']['level_0'] == 'moderatorPassword'): ?>id="moderator"<?php endif; ?>
					name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
				<input type="hidden" id="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" name="val_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
				<?php if ($this->_tpl_vars['val']['info'] != ''): ?>
					<a href="#" class="hintanchor" onMouseover="showhint('<?php echo $this->_tpl_vars['val']['info']; ?>
', this, event, '200px')" >[?]</a>
				<?php endif; ?>
				</div>
			</td>
			</tr>
		<?php else: ?>
			<input type="hidden" name="fld_<?php echo $this->_tpl_vars['val']['id']; ?>
" value="<?php echo $this->_tpl_vars['val']['value']; ?>
">
		<?php endif; ?>
		<?php endif; ?>
		<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="2">&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="Submit" name="submit" value="<?php echo $this->_tpl_vars['cnf_langs']['t2']; ?>
">
		</td>
	</tr>
</table>
</form>