<h3>{$langs.t11}</h3>
{if $is_modules==0}
	{$cnf_langs.t0}
{else}

<FORM action="cnf_config.php?module=modules" method="post" enctype="multipart/form-data" name="mod">

<input type="Hidden" name="module" value="{$module}">
<input type="hidden" name="module125" value="modules125">

<TABLE border="0" width="500" height="100%">
<!--error process -->
{if $errMsg != ''}
	<TR>
		<TD class="errorMsg" valign='middle' align="center" colspan="2">
			{$errMsg}
		</TD>
	</TR>
{/if}
<!--end error handling-->
	<TR>
		<TD colspan="2"><font color="#ff0000">*</font> {$cnf_langs.t7}</TD>
	</TR>
<!--representation values-->
{foreach name=fields from=$fields item=field key=i}
	<TR>
		<TH align="left" width="40%" valign="middle">
			{$field.name}
		</TH>
		<TD align="center" width="30%" valign="middle" nowrap>
			<input type="Hidden" name="type_{$i}_1191" value="{$field.1191.type}">
			<input type="Hidden" name="name_{$i}_1191" value="{$field.1191.title}">
			<input type="Hidden" name="field_{$i}_1191" value="{$field.1191.level_1}">
			<input type="checkbox" name="fld_{$i}_1191" {if $field.1191.value } checked {/if}> {$cnf_langs.t8}
		</TD>
		<TD align="center" width="30%" valign="middle">
			<input type="button" onClick="javascript:
			if(document.getElementById('div_{$i}').style.display == 'none')
			{literal}{{/literal}
				document.getElementById('div_{$i}').style.display = 'block';
			{literal}}{/literal}
			else
			{literal}{{/literal}
				document.getElementById('div_{$i}').style.display = 'none';
			{literal}}{/literal}" name="configure_{$i}" value="{$cnf_langs.t9}">
		</TD>
	</TR>
	<TR>
		<TD colspan="3">
				{foreach name=values from=$field item=value key=key}
					{if $smarty.foreach.values.first == "true"}
						<div id="div_{$i}" style="display:none;">
						<table border="0" width="100%" cellpadding="3" cellspacing="2">
					{/if}
						{if !($key == 'name' || $value.level_1 == 'enabled')}
							{if $key < 848 || $key > 851}
								<tr>
									<td width="40%"><b>{$value.title}</b></td>
									<td width="60%">
										<div style="white-space: nowrap;">
										<input type="Hidden" name="type_{$i}_{$key}" value="{$value.type}">
										<input type="Hidden" name="name_{$i}_{$key}" value="{$value.title}">
										<input type="Hidden" name="field_{$i}_{$key}" value="{$value.level_1}">
									{if $value.type == 'integer'}
										<input type="Text" size="5"  name="fld_{$i}_{$key}" value="{$value.value}">
									{elseif $value.type == 'string'}
										<input type="Text" size="40" name="fld_{$i}_{$key}" value="{$value.value}">
									{elseif $value.type == 'combo'}
										{if $value.level_1 == 'path'}
										<input type="Hidden" name="fld_{$i}_{$key}" value="{$value.value}">{$value.value}
										{else}
										<select name="fld_{$i}_{$key}" onChange="javascript:
										if(this.value == -1)
										{literal}{{/literal}
											document.getElementById('inner_div_{$i}').style.display = 'block';
										{literal}}{/literal}
										else
										{literal}{{/literal}
											document.getElementById('inner_div_{$i}').style.display = 'none';
										{literal}}{/literal}
										">
											{foreach name=name from=$anchors item=val2 key=key2}
												<option value={$key2} {if $key2 == $value.value}selected {if $key2 == -1}{assign var="dis" value="block"}{else}{assign var="dis" value="none"}{/if}{/if}>{$val2}
											{/foreach}
										</select>
										{/if}
									{elseif $value.type == 'boolean'}
											<input type="Radio" name="fld_{$i}_{$key}" value="true" {if $value.value } checked {/if} id="yes{$key}"><label for="yes{$key}">{$cnf_langs.t3}</label>
											<input type="Radio" name="fld_{$i}_{$key}" value="false" {if !$value.value } checked {/if} id="no{$key}"><label for="no{$key}">{$cnf_langs.t4}</label>
									{/if}
									{if $value.info!='' }
										<a href="#" class="hintanchor" onMouseover="showhint('{$value.info}', this, event, '200px')">[?]</a>
									{/if}
									</div></td></div>
								</tr>
							{else}
								{if $key == 848}
									<tr>
									<td colspan="2" width="100%"><div id="inner_div_{$i}" style="display:{$dis};"><table border="0" width="100%">
								{/if}
									<tr>
									<td width="40%"><b>{$value.title}</b></td>
									<td width="60%">
										<div style="white-space: nowrap; ">
										<input type="Hidden" name="type_{$i}_{$key}" value="{$value.type}">
										<input type="Hidden" name="name_{$i}_{$key}" value="{$value.title}">
										<input type="Hidden" name="field_{$i}_{$key}" value="{$value.level_1}">
									{if $value.type == 'integer'}
										<input type="Text" size="5" name="fld_{$i}_{$key}" value="{$value.value}">
									{/if}
									{if $value.info!='' }
										<a href="#" class="hintanchor" onMouseover="showhint('{$value.info}', this, event, '200px')">[?]</a>
									{/if}
									</div></td></div>
								</tr>
								{if $key == 851}
									</table></div></td></tr>
								{/if}
							{/if}
						{/if}
						{if $smarty.foreach.values.last == "true"}
							</div></table>
						{/if}
				{/foreach}
		</TD>
	</TR>
	<TR>
		<TD colspan="3"><HR size="1"></TD>
	</TR>
{/foreach}
	<TR>
		<TD colspan="3"></TD>
	</TR>
	<TR>
		<TD colspan="3" align="center">
			<input type="Submit" name="sub_save" value="{$cnf_langs.t6}">
		</TD>
	</TR>
</TABLE>

</FORM>
{/if}
