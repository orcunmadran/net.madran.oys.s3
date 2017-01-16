<?php

// formatting module dir name, to module name. artemK0
function performModuleName($name)
{
	$name = str_replace('_', ' ', $name);
	$return = '';
	for($i = 0; $i < strlen($name); $i++)
	{
		if($i == 0)
		{
			$return = strtoupper($name[0]);
		}
		elseif($name[$i-1] == ' ')
		{
			$return .= strtoupper($name[$i]);
		}
		else
		{
			$return .= $name[$i];
		}
	}
	return $return;
}

function selectFields($module_path, $module_id)
{
	global $anchor_points;
	$query = 'SELECT '.$GLOBALS['fc_config']['db']['pref'].'config.*, '.$GLOBALS['fc_config']['db']['pref'].'config_values.value
		  FROM '.$GLOBALS['fc_config']['db']['pref'].'config, '.$GLOBALS['fc_config']['db']['pref'].'config_values
		  WHERE '.$GLOBALS['fc_config']['db']['pref'].'config.parent_page = ? AND
		  '.$GLOBALS['fc_config']['db']['pref'].'config.id = '.$GLOBALS['fc_config']['db']['pref'].'config_values.config_id AND
		  '.$GLOBALS['fc_config']['db']['pref'].'config_values.instance_id = ?
		  ORDER BY _order';
	$stmt = new Statement($query, 401);
	$f = $stmt->process('modules', $_SESSION['session_inst']);
	$fields = array();
	$values = array();
	$selected_key = -1;
	$anchor_tmp = '';

	while($v = $f->next())
	{
		$fields[$v['id']] = $v;
		if ( $fields[$v['id']]['level_1'] == 'anchor' )
		{
			$anchor_tmp = $fields[$v['id']]['value'];
		}
		if ( $fields[$v['id']]['level_1'] == 'path' )
		{
			$values_search = explode(',', $fields[$v['id']]['value']);
			if(array_search($module_path, $values_search) !== false)
			{
				$selected_key = array_search($module_path, $values_search);
			}
		}

		$fields[$v['id']]['comment'] = addslashes($fields[$v['id']]['comment']);
		if ($fields[$v['id']]['level_1'] != 'anchor' && $fields[$v["id"]]['level_1'] != 'path' && $fields[$v["id"]]['level_1'] != 'stretch')
		{
		    $fields[$v['id']]['type'] = 'integer';
		}
		if ( $fields[$v['id']]['level_1'] == 'stretch' )
		{
		    $fields[$v['id']]['type'] = 'boolean';
		}
		$fields[$v['id']]['info']=str_replace('"', "\'", $fields[$v['id']]['info']);
		$values_found = explode(',', $fields[$v['id']]['value']);
		$values[$fields[$v['id']]['level_1']] = $values_found[$selected_key];
	}
	$tmp_arr = explode(',', $anchor_tmp);
	$values['anchor'] = $tmp_arr[$selected_key];
	$string_fields = '';
	$dis = '';
	foreach($fields as $k => $v)
	{
		if($k == 1191) continue;
		switch($v['type'])
		{
			case 'combo':
				if($v['level_1'] == 'path')
				{
					$field_elem = $module_path;
					$field_elem .= '<input type="hidden" name="fld_'.$module_id.'_846" value="'.$module_path.'">';
					$field_elem .= '&nbsp;<a href="#" class="hintanchor" onMouseover="showhint(\''.$v['info'].'\', this, event, \'200px\')" >[?]</a>';
					$string_fields .= '<tr><td width="30%" valign="top"><b>'.$v['title'].'</b>';
					$string_fields .= '<input type="hidden" name="type_'.$module_id.'_'.$v['id'].'" value="'.$v['type'].'">';
					$string_fields .= '<input type="hidden" name="name_'.$module_id.'_'.$v['id'].'" value="'.$v['title'].'">';
					$string_fields .= '<input type="hidden" name="field_'.$module_id.'_'.$v['id'].'" value="'.$v['level_1'].'">';
					$string_fields .= '</td><td width="70%" valign="top" nowrap>'.$field_elem.'</td></tr>';
					continue;
				}
				$field_elem = '<select name="fld_'.$module_id.'_'.$v['id'].'" onChange="javascript:
				if(this.value == -1)
				{
					';
					for($j=848; $j<852; $j++)
					{
						$field_elem .= 'document.getElementById(\'inner_div_'.$module_id.'\').style.display = \'block\';';
					}
				$field_elem .='
				}
				else
				{
					';
					for($j=848; $j<852; $j++)
					{
						$field_elem .= 'document.getElementById(\'inner_div_'.$module_id.'\').style.display = \'none\';';
					}
				$field_elem .='
				}">';
				foreach($anchor_points as $an_value => $an_name)
				{
					if($an_value == $values[$v['level_1']])
					{
						$field_elem .= '<option value="'.$an_value.'" selected>'.$an_name;
						if($an_value != -1)
						{
							$dis = 'style="display:none"';
						}
						else
						{
							$dis = '';
						}
					}
					else
					{
						$field_elem .= '<option value="'.$an_value.'">'.$an_name;
					}
				}
				$field_elem .= '</select>';
				$field_elem .= '&nbsp;<a href="#" class="hintanchor" onMouseover="showhint(\''.$v['info'].'\', this, event, \'200px\')" >[?]</a>';
				$string_fields .= '<tr><td width="30%" valign="top"><b>'.$v['title'].'</b>';
				$string_fields .= '<input type="hidden" name="type_'.$module_id.'_'.$v['id'].'" value="'.$v['type'].'">';
				$string_fields .= '<input type="hidden" name="name_'.$module_id.'_'.$v['id'].'" value="'.$v['title'].'">';
				$string_fields .= '<input type="hidden" name="field_'.$module_id.'_'.$v['id'].'" value="'.$v['level_1'].'">';
				$string_fields .= '</td><td width="70%" valign="top" nowrap>'.$field_elem.'</td></tr>';
			break;
			case 'boolean':
				$radio_true = 'checked';
				$radio_false = '';
				if($values[$v['level_1']] == 'false')
				{
					$radio_true = '';
					$radio_false = 'checked';
				}
				$field_elem = '<input type="Radio" name="fld_'.$module_id.'_'.$v['id'].'" '.$radio_true.' value="true" id="yes"><label for="yes">Yes</label>';
				$field_elem .= '<input type="Radio" name="fld_'.$module_id.'_'.$v['id'].'" '.$radio_false.' value="false" id="no"><label for="no">No</label>';
				$field_elem .= '&nbsp;<a href="#" class="hintanchor" onMouseover="showhint(\''.$v['info'].'\', this, event, \'200px\')" >[?]</a>';
				$string_fields .= '<tr><td width="30%" valign="top"><b>'.$v['title'].'</b>';
				$string_fields .= '<input type="hidden" name="type_'.$module_id.'_'.$v['id'].'" value="'.$v['type'].'">';
				$string_fields .= '<input type="hidden" name="name_'.$module_id.'_'.$v['id'].'" value="'.$v['title'].'">';
				$string_fields .= '<input type="hidden" name="field_'.$module_id.'_'.$v['id'].'" value="'.$v['level_1'].'">';
				$string_fields .= '</td><td width="70%" valign="top" nowrap>'.$field_elem.'</td></tr>';
				$string_fields .= '<tr><td width="100%" valign="top" colspan="2">';
				$string_fields .= '<div id="inner_div_'.$module_id.'" '.$dis.'>';
				$string_fields .= '<table border="0" cellpadding="0" cellspacing="2" width="100%" class="body_table" style="border-top: 0px; border-bottom: 0px; border-left: 0px; border-right: 0px">';
			break;
			case 'integer':
				$field_elem = '<input type="Text" size="5" name="fld_'.$module_id.'_'.$v['id'].'" value="'.$values[$v['level_1']].'">&nbsp;<a href="#" class="hintanchor" onMouseover="showhint(\''.$v['info'].'\', this, event, \'200px\')" >[?]</a>';
				$string_fields .= '<tr><td width="30%"><b>'.$v['title'].'</b>';
				$string_fields .= '<input type="hidden" name="type_'.$module_id.'_'.$v['id'].'" value="'.$v['type'].'">';
				$string_fields .= '<input type="hidden" name="name_'.$module_id.'_'.$v['id'].'" value="'.$v['title'].'">';
				$string_fields .= '<input type="hidden" name="field_'.$module_id.'_'.$v['id'].'" value="'.$v['level_1'].'">';
				$string_fields .= '</td><td width="70%" valign="top" nowrap>'.$field_elem.'</td></tr>';
			break;
		}
	}
	$string_fields .= '</table></div></td>';
	return $string_fields;
}

// array of anchor points. artemK0
$anchor_points = array('-1' => 'Floating',
	'0' => 'Center of space below Room List',
	'1' => 'Top-Left of space below Room List',
	'2' => 'Top-Right of space below Room List',
	'3' => 'Bottom-Left of space below Room List',
	'4' => 'Bottom-Right of space below Room List',
	'5' => 'Top-Left of Title Bar',
	'6' => 'Top-Center of Title Bar',
	'7' => 'Top-Right of Title Bar',
	'8' => 'Top-Left of Chat Pane',
	'9' => 'Top-Right of Chat Pane',
	'10' => 'Bottom-Right of Chat Pane',
	'11' => 'Bottom-Left of Chat Pane',
	'12' => 'Center of Chat Pane'
);

// array of installed modules. artemK0
$d = dir(INC_DIR . '../modules');
$entries = array();
$all_modules = array();
$i = 0;
while($entry = $d->read())
{
	if($entry == '.' || $entry == '..' || $entry == 'readme.txt') continue;
	$entries[] = $entry;
}
natcasesort($entries);
foreach($entries as $k=>$entry)
{
	$entry_d = dir(INC_DIR . '../modules/'.$entry);
	while($mod_name = $entry_d->read())
	{
		if(strpos($mod_name, '.swf') !== false)
		{
			$all_modules[$i] []= $entry;
			$all_modules[$i] []= 'modules/'.$entry.'/'.$mod_name;
		}
	}
	$entry_d->close();
	$i++;
}
$d->close();

// [SUBMIT]---------------------------------------------------------------------
if( isset($_POST['module125']) && $_POST['module125'] )
{
	$tmp_post = array();
	foreach($_POST as $k => $v)
	{
		$exploded_k = explode('_', $k);
		if($exploded_k[0] == 'fld' && $v == '')
		{
			$tmp_post[$k] = '0';
			continue;
		}
		$tmp_post[$k] = $v;
		if(isset($_POST['fld_'.$exploded_k[1].'_1191']) && $exploded_k[0] == 'field')
		{
			$tmp_post['fld_'.$exploded_k[1].'_1191'] = 'true';
		}
		elseif(!isset($_POST['fld_'.$exploded_k[1].'_1191']) && $exploded_k[0] == 'field')
		{
			$tmp_post['fld_'.$exploded_k[1].'_1191'] = 'false';
		}
	}
	unset($_POST);
	$_POST = $tmp_post;
	$fld = getPOSTfields('fld_');
	//validator rule
	//greate array $valid_rule
	//validator rule
	require_once(INC_DIR . '../admin/cnf_validators.php');
	$valid_rule = array();
	foreach($fld['err'] as $k => $v)
	{
		if ( substr($fld['err'][$k]['field'],0,strpos($fld['err'][$k]['field'],"_")) == 'float')
		{
			$valid_rule[$k][0] = '^[0-9]+(\,([0-9])+)*$';
			$valid_rule[$k][1] = 1;
			$valid_rule[$k][2] = $fld['err'][$k]['name'];
		}
	}

	$errMsg = '';
	//---------------------------------------------
	reset($fld);
	foreach($fld['err'] as $k => $v)
	{
		if( isset($valid_rule[$k]) )
		{
			$errMsg = value_validator($v['value'],$valid_rule[$k],$valid_rule[$k]['name']);
			if($errMsg != '')
			{
				break;
			}
		}
	}

	if( $errMsg == '' )
	{
		foreach($fld['ins'] as $k=>$v)
		{
			$query = 'UPDATE '.$GLOBALS['fc_config']['db']['pref'].'config_values SET value=? WHERE config_id=?
					AND instance_id = ? LIMIT 1';
			$stmt = new Statement($query, 403);
			$f = $stmt->process($v, $k, $_SESSION['session_inst']);
		}

		if($_SESSION['cache_type'] == 2/* || isset($_SESSION['fc_gender_cache']) */)
		{
			$step = 8;
		}
		else
		{
			if($_SESSION['forcms'] == 'defaultCMS')
			{
				$step = 4;
			}
			else
			{
				$step = 6;
			}
		}
		redirect_inst('install.php?step='.$step);
	}
	else
	{
		if($errMsg == 'LANG_VALUE_REQUIRED')
		{
			$errMsg = 'Please insert data.';
		}
		elseif($errMsg == 'LANG_VALUE_INCORRECT')
		{
			$errMsg = 'Please insert correct value.';
		}
	}
}

$query = 'SELECT '.$GLOBALS['fc_config']['db']['pref'].'config.*, '.$GLOBALS['fc_config']['db']['pref'].'config_values.value
		  FROM '.$GLOBALS['fc_config']['db']['pref'].'config, '.$GLOBALS['fc_config']['db']['pref'].'config_values
		  WHERE '.$GLOBALS['fc_config']['db']['pref'].'config.parent_page = ? AND
		  '.$GLOBALS['fc_config']['db']['pref'].'config.id = '.$GLOBALS['fc_config']['db']['pref'].'config_values.config_id AND
		  '.$GLOBALS['fc_config']['db']['pref'].'config_values.instance_id = ?
		  ORDER BY _order';
$stmt = new Statement($query, 401);
$f = $stmt->process('modules', $_SESSION['session_inst']);

$enabled_buttons = array();
while($v = $f->next())
{
	$exploded = explode(',', $v['value']);
	foreach($exploded as $key => $val)
	{
		if($val == 'true')
		{
			$enabled_buttons[$key] = 'checked';
		}
		elseif($val == 'false')
		{
			$enabled_buttons[$key] = '';
		}
	}
}
$modules = '';
foreach($all_modules as $i => $mod)
{
	$modules .= '<TR><TD width="10%" align="left" valign="top"><b>';
	$modules .= performModuleName($mod[0]);
	if(strpos(strtolower($mod[0]), 'video') !== false || strpos(strtolower($mod[0]), 'whiteboard') !== false )
	{
		$modules .= '<font color="#ff0000">*</font>';
	}
	$modules .= '</b></TD><TD width="10%" align="left" valign="top">
	<input type="Hidden" name="type_'.$i.'_1191" value="boolean">
	<input type="Hidden" name="name_'.$i.'_1191" value="Enabled:">
	<input type="Hidden" name="field_'.$i.'_1191" value="enabled">
	<input type="checkbox" '.$enabled_buttons[$i].' name="fld_'.$i.'_1191" id="enabled'.$i.'"> Enabled';
	$modules .= '</TD><TD width="30%" align="left" valign="top">';
	$modules .= '<input type="button" onClick="javascript:
		if(document.getElementById(\'div_'.$i.'\').style.display == \'none\')
		{
			document.getElementById(\'div_'.$i.'\').style.display = \'block\'
		}
		else
		{
			document.getElementById(\'div_'.$i.'\').style.display = \'none\'
		}" name="configure_'.$i.'" value="Configure"></TD></TR>';
	$modules .= '<TR><TD colspan="3"><div id="div_'.$i.'" style="display:none"><table border="0" width="70%" cellpadding="0" cellspacing="5" class="body_table" style="border-top: 0px; border-bottom: 0px; border-left: 0px; border-right: 0px">
		'.selectFields($mod[1], $i).'
	</table></div>';
	$modules .= '</TD></TR><TR><TD colspan="3"><HR size="1"></TD></TR>';
}
include INST_DIR . 'header.php';
?>
<style type="text/css">

#hintbox{ /*CSS for pop up hint box */
position:absolute;
top: 0;
background-color: lightyellow;
width: 150px; /*Default width of hint.*/
padding: 3px;
border:1px solid black;
font:normal 11px Verdana;
line-height:18px;
z-index:100;
border-right: 2px solid black;
border-bottom: 2px solid black;
visibility: hidden;
}
A.hintanchor{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #0000FF;
	font-weight: bold;
	color: navy;
	margin: 3px 8px;
}
A.hintanchor:hover{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
}
</style>

<script type="text/javascript">

/***********************************************
* Show Hint script- � Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var horizontal_offset="9px" //horizontal offset of hint box from anchor link

/////No further editting needed

var vertical_offset="0" //horizontal offset of hint box from anchor link. No need to change.
var ie=document.all
var ns6=document.getElementById&&!document.all

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=(whichedge=="rightedge")? parseInt(horizontal_offset)*-1 : parseInt(vertical_offset)*-1
if (whichedge=="rightedge"){
var windowedge=ie && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-30 : window.pageXOffset+window.innerWidth-40
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure+obj.offsetWidth+parseInt(horizontal_offset)
}
else{
var windowedge=ie && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetHeight
}
return edgeoffset
}

function showhint(menucontents, obj, e, tipwidth){
if ((ie||ns6) && document.getElementById("hintbox")){
dropmenuobj=document.getElementById("hintbox")
dropmenuobj.innerHTML=menucontents
dropmenuobj.style.left=dropmenuobj.style.top=-500
if (tipwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=tipwidth
}
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+obj.offsetWidth+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+"px"
dropmenuobj.style.visibility="visible"
obj.onmouseout=hidetip
}
}

function hidetip(e){
dropmenuobj.style.visibility="hidden"
dropmenuobj.style.left="-500px"
}

function createhintbox(){
var divblock=document.createElement("div")
divblock.setAttribute("id", "hintbox")
document.body.appendChild(divblock)
}

if (window.addEventListener)
window.addEventListener("load", createhintbox, false)
else if (window.attachEvent)
window.attachEvent("onload", createhintbox)
else if (document.getElementById)
window.onload=createhintbox

</script>


	<TR>
		<TD colspan="2"></TD>
	</TR>
	<TR>
		<TD colspan="2" class="subtitle">Step 4: Modules</TD>
	</TR>
	<TR>
		<TD colspan="2" class="normal">	The following modules are available in the "modules" directory. We recommend that you only enable one module for best perforamnce. Enabling many modules can slow your Flash player.
		</TD>
	</TR>
	<TR>
		<TD colspan="2"><font color="#ff0000">*</font> module requires Flash Media Server or Red5 Server</TD>
	</TR>
	<FORM action="install.php?step=3.5" method="post" align="center" name="installInfo">
    <input type="hidden" name="module" value="modules">
    <input type="hidden" name="module125" value="modules125">
	<TR>
		<TD colspan="2">
			<TABLE width="100%" class="body_table" cellspacing="5" cellpadding="0" border="0">
				<TR>
					<TD colspan="4"><?php echo $errMsg; ?></TD>
				</TR>
				<?php
					echo $modules;
				?>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD>&nbsp;</TD>
		<TD align="right">
			<INPUT type="submit" name="submitModule" value="Continue >>">
		</TD>
	</TR>

<?php
include INST_DIR . 'footer.php';
?>