<h3>{$langs.t6}</h3>
<FORM action="cnf_config.php" method="post" enctype="multipart/form-data">

<table border="0" width="700" height="100%">

<!--error process -->

{if $errMsg != ''}
	<TR>
		<TD class="errorMsg" valign='middle'  align="center" colspan="2">
			{$errMsg}
		</TD>
	</TR>
{/if}
<!--end error handling-->


<!--representation values-->
{foreach name=fields from=$fields item=val key=key}
	{if $val.level_2 == 'mainChat'}
		{assign var="Title" value=$cnf_langs.t2}
	{elseif $val.level_2 == 'interfaceElements'}
		{assign var="Title" value=$cnf_langs.t3}
	{elseif $val.level_2 == 'title'}
		{assign var="Title" value=$cnf_langs.t4}
	{/if}



	{if $val.level_3 == 'presence'}
		<tr>
			<td colspan="4">&nbsp;

			</td>
		</tr>
		<tr>
			<th colspan="3" align="left">
					{$Title}
			</th>
		</tr>

	{/if}

	<tr>


		<td style="width:200px;">
			{$val.title}
			<input type="Hidden" name="type_{$val.id}" value="{$val.type}">
			<input type="Hidden" name="name_{$val.id}" value="{$val.title}">
			<input type="Hidden" name="field_{$val.id}" value="{$val.level_3}">
		</td>


		<td width="40">
		<div style="white-space: nowrap;height:25px;">
			{if $val.type == 'integer'}
					<input type="Text" size="5"  name="fld_{$val.id}" value="{$val.value}">
			{elseif $val.type == 'string'}
					<SELECT NAME="fld_{$val.id}">
						{section name=i loop=$family start=0}
							{assign var="name" value=$family[i].name}
							{assign var="disabled" value=$family[i].disabled}
							{if !$disabled}
							<OPTION VALUE="{$name}" {if $val.value == $name} selected {/if}>{$name}
							{/if}
						{/section}
					</SELECT>
			{elseif $val.type == 'boolean'}
					<input type="Radio" name="fld_{$val.id}" value="1" {if $val.value } checked {/if} id="yes{$key}"><label for="yes{$key}">{$cnf_langs.t0}</label>
					<input type="Radio" name="fld_{$val.id}" value="0" {if !$val.value } checked {/if} id="no{$key}"><label for="no{$key}">{$cnf_langs.t1}</label>

			{/if}
			{if $val.info!='' }
				<a href="#" class="hintanchor" onMouseover="showhint('{$val.info}', this, event, '200px')" >[?]</a>
			{/if}
			</div>
		</td>



			<td align="right" width="5">

			</td>


	</tr>
{/foreach}
	<tr>
		<td colspan="4">&nbsp;

		</td>
	</tr>
	<tr>
		<td>
			{$cnf_langs.t5}
		</td>
		<td>
			<input type="Text" size="35"  name="size" value="{$size}">
		</td>
	</tr>
		<tr>
		<td colspan="3">&nbsp;

		</td>
	</tr>
	<tr>
		<th style="width:200px;" colspan="3" align="left">
			{$cnf_langs.t6}
		</th>
	</tr>
	<tr>
			<td colspan="3">&nbsp;

			</td>
		</tr>
		<tr>
			<th align="left">
				{$cnf_langs.t7}
			</th>
			<th align="left">
				{$cnf_langs.t8}
			</th>
		</tr>
		<tr>
			<td colspan="3">
				<HR>
			</td>
		</tr>
{foreach name=family from=$family item=val key=key}
	<tr>
		<td align="left">
			<input type="Hidden" name="family_{$val.id}" value="{$val.name}">
			<div style="white-space: nowrap;height:25px;">
			{$val.name}
			</div>
		</td>
		<td align="left">
			<div style="white-space: nowrap;height:25px;">
			<input type="Radio" name="disabled_{$val.id}" value="1" {if $val.disabled } checked {/if} id="yes{$key}"><label for="yes{$key}">{$cnf_langs.t0}</label>
			<input type="Radio" name="disabled_{$val.id}" value="0" {if !$val.disabled } checked {/if} id="no{$key}"><label for="no{$key}">{$cnf_langs.t1}</label>
			</div>
		</td>
	</tr>
{/foreach}
	<tr>
		<td colspan="3">

		</td>
	</tr>
	<tr>

		<td colspan="3"align="center">
			<input type="Submit" name="submit" value="{$cnf_langs.t9}">
		</td>
	</tr>

</table>

<input type="Hidden" name="module" value="{$module}">
</form>
