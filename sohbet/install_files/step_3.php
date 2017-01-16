<?php

if( isset($_POST['rooms']) )
{
	//$rooms = $_POST['rooms'] ? $_POST['rooms'] : CHAT_ROOMS;
	$rooms = $_POST['rooms'];
}
else
{
	$rooms = CHAT_ROOMS;
}

$errmsg = '';
if( isset($_REQUEST['conf_msgRequestInterval']) && $_REQUEST['conf_msgRequestInterval'] != '' )
{
	if( ! is_numeric($_POST['conf_msgRequestInterval']) || strpos($_POST['conf_msgRequestInterval'],'.') !== false ) $errmsg = 'Incorrect <b>Request interval</b> value';
}

$lang_tmp = $GLOBALS['fc_config']['languages'];
if($_SESSION['cache_type'] == 2)
{
	$lang_tmp = $GLOBALS['fc_config']['languages'];
	if(isset($GLOBALS['fc_config']['cachePath_sm']))
	{
		$cachePath = INC_DIR . $GLOBALS['fc_config']['cachePath_sm'];
	} else {
		$cachePath = INC_DIR . $GLOBALS['fc_config']['cachePath'];
	}
	$fname = $cachePath . $GLOBALS['fc_config']['db']['pref'].'config_'.$GLOBALS['fc_config']['cacheFilePrefix'].'_1.txt';
	$lines = file($fname);
	foreach($lines as $v)
	{
		$cols=explode("\t", $v);
		if($cols[1] == 'msgRequestInterval')
		{
			$GLOBALS['fc_config']['msgRequestInterval'] = $cols[13];
		}
	}
}

// search in db admin, moderator, spy users, if set existing table. artemK0
$stmt = new Statement('SELECT value FROM '.$GLOBALS['fc_config']['db']['pref'].'config_values vals, '.$GLOBALS['fc_config']['db']['pref'].'config config WHERE (vals.config_id = config.id AND config.level_0 = "CMSSystem")', 436);

$res = $stmt->process();

$isStateless = true;
while($rec = $res->next())
{
	if($rec['value'] == 'defaultCMS')
	{
		$isStateless = false;
	}
	elseif($rec['value'] == 'statelessCMS')
	{
		$isStateless = true;
	}
}
$def_users = array();
for($i = 2; $i < 5; $i++)
{
	if(!$isStateless)
	{
		$stmt = new Statement('SELECT * FROM '.$GLOBALS['fc_config']['db']['pref'].'users WHERE roles = ? LIMIT 1', 148);
		$res = $stmt->process($i);
		while($rec = $res->next())
		{
			$tmp['login'] = $rec['login'];
			$tmp['password'] = $rec['password'];
			$tmp['id'] = $rec['id'];
		}
		$def_users[$i] = $tmp;
	}
	else
	{
		$stmt = new Statement('SELECT value FROM '.$GLOBALS['fc_config']['db']['pref'].'config config, '.$GLOBALS['fc_config']['db']['pref'].'config_values vals WHERE config.id = vals.config_id AND config.level_0 IN ("adminPassword", "moderatorPassword", "spyPassword") AND vals.value NOT IN ("adminpass", "modpass", "spypass")', 437);
		$res = $stmt->process();
		$j = 5;
		while($rec = $res->next())
		{
			$def_users[$j++] = $rec['value'];
		}
		break;
	}
}
if($_SESSION['cache_type'] == 0)
{
	$stmt = new Statement('SELECT value FROM '.$GLOBALS['fc_config']['db']['pref'].'config config, '.$GLOBALS['fc_config']['db']['pref'].'config_values vals WHERE config.id = vals.config_id AND config.level_0 = "encryptPass"', 438);
	$res = $stmt->process();
	$rec = $res->next();
	$prevEncPass = $rec['value'];
	if($prevEncPass != '1')
	{
		$prevEncPass = '0';
	}
}
if( isset($_POST['submit']) && $_POST['submit'] && $errmsg == '')
{
	$_SESSION['cache_type']=$_POST['cache_type'];
	//save rooms
	$rms = split(',\W*', $rooms);
	$dbpref = '';

	if($errmsg == '')
	{
		include './inc/config.srv.php';
		$dbpref = $GLOBALS['fc_config']['db']['pref'];

		if( isset($_REQUEST['cms']) && $_REQUEST['cms'] == 'statelessCMS' )
		{
			//set password
			$query="UPDATE ".$dbpref."config_values SET value= ? WHERE config_id=(
					SELECT id FROM ".$dbpref."config WHERE level_0='adminPassword')";
			$stmt = new Statement($query, 428);
			$f = $stmt->process($_REQUEST['stt_adminpass']);

			$query="UPDATE ".$dbpref."config_values SET value= ? WHERE config_id=(
					SELECT id FROM ".$dbpref."config WHERE level_0='moderatorPassword')";
			$stmt = new Statement($query, 429);
			$f = $stmt->process($_REQUEST['stt_moderatorpass']);

			$query="UPDATE ".$dbpref."config_values SET value= ? WHERE config_id=(
					SELECT id FROM ".$dbpref."config WHERE level_0='spyPassword')";
			$stmt = new Statement($query, 430);
			$f = $stmt->process($_REQUEST['stt_spypass']);

			$query = 'UPDATE '.$dbpref.'config_values SET value = ? WHERE config_id = (
					SELECT id FROM '.$dbpref.'config WHERE level_0 = "encryptPass")';
			$stmt = new Statement($query, 442);
			$f = $stmt->process('0');
		}



		if( isset($_REQUEST['cms']) )
		{
			$_SESSION['forcms'] = $_REQUEST['cms'];
			$query="UPDATE ".$dbpref."config_values,".$dbpref."config
				    SET ".$dbpref."config_values.value = ?
		       		WHERE ".$dbpref."config_values.config_id = ".$dbpref."config.id
			   		AND ".$dbpref."config.level_0 = 'CMSsystem'";
			$stmt = new Statement($query, 431);
			$f = $stmt->process($_SESSION['forcms']);
		}

		//change config.php
		if( isset($_POST['conf_defaultLanguage']) )
			$repl['defaultLanguage']    = $_POST['conf_defaultLanguage'].'';



		if( isset($_POST['conf_liveSupportMode']) && $_POST['conf_liveSupportMode'] )
			$repl['liveSupportMode']    = 1;
		else
			$repl['liveSupportMode']    = 0;


		if( isset($_POST['conf_msgRequestInterval']) )
			$repl['msgRequestInterval']    = $_POST['conf_msgRequestInterval'];



		if( isset($_POST['login_utf'])  )
			$repl['loginUTF8decode']    = $_POST['login_utf'];

		$query="UPDATE ".$dbpref."config_values,".$dbpref."config
				    SET ".$dbpref."config_values.value = ?
		       		WHERE ".$dbpref."config_values.config_id = ".$dbpref."config.id
			   		AND ".$dbpref."config.level_0 = ?";
		$stmt = new Statement($query, 432);
		$f = $stmt->process($repl['liveSupportMode'], "liveSupportMode");


		$query="UPDATE ".$dbpref."config_values,".$dbpref."config
				    SET ".$dbpref."config_values.value = ?
		       		WHERE ".$dbpref."config_values.config_id = ".$dbpref."config.id
			   		AND ".$dbpref."config.level_0 = ?";
		$stmt = new Statement($query, 432);
		$f = $stmt->process($repl['defaultLanguage'], "defaultLanguage");

		$query="UPDATE ".$dbpref."config_values,".$dbpref."config
				    SET ".$dbpref."config_values.value = ?
		       		WHERE ".$dbpref."config_values.config_id = ".$dbpref."config.id
			   		AND ".$dbpref."config.level_0 = ?";
		$stmt = new Statement($query, 432);
		$f = $stmt->process($repl['msgRequestInterval'], "msgRequestInterval");

		$query="UPDATE ".$dbpref."config_values,".$dbpref."config
				    SET ".$dbpref."config_values.value = ?
		       		WHERE ".$dbpref."config_values.config_id = ".$dbpref."config.id
			   		AND ".$dbpref."config.level_0 = ?";
		$stmt = new Statement($query, 432);
		$f = $stmt->process($repl['loginUTF8decode'], "loginUTF8decode");

		unlink(dirname(__FILE__).'/../temp/appdata/config_1.php');
		include dirname(__FILE__).'/../inc/config.php';

		for($i = 0; $i < sizeof($rms); $i++)
		{
				$rms[$i] = trim($rms[$i]);
				if($rms[$i]=="") continue;//skip if the name is blank

				if( $_SESSION['cache_type'] != 2 )
				{
					//check if room exists
					$sql="SELECT * FROM {$dbpref}rooms WHERE name='{$rms[$i]}'";
					$res = mysql_query($sql);
					if( mysql_num_rows($res) ) continue;
					//---

					if(!mysql_query("INSERT INTO {$dbpref}rooms (created, name, ispublic, ispermanent) VALUES (NOW(), '{$rms[$i]}', 'y', '" . ($i + 1) . "')"))
					{
						$errmsg = "<b>Could not create room '{$rms[$i]}'<br>" . mysql_error() . "</b><br>";
						break;
					}
				}
				else
				{
					$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'rooms_'.$_SESSION['rand_num'].'_1.txt', 'a');

					if(!$file) return;

					fwrite($file, ($i + 1)."\t".date("Y-m-d H:i:s")."\t".date("Y-m-d H:i:s")."\t".$rms[$i]."\t\t".'y'."\t".($i + 1)."\t".""."\n");
					fclose($file);
				}
		}

		if( $_SESSION['cache_type'] != 0 )
		{
			$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'configinst_'.$_SESSION['rand_num'].'.txt', 'w');

			$query="SELECT * FROM ".$dbpref."config_instances";
			$stmt = new Statement($query, 419);
			$result = $stmt->process();

			while($ret = $result->next())
			{
				$str = '';
				foreach( $ret as $key=>$val )
				{
					$str .= $val."\t";
				}

				fwrite($file,$str."\n");
			}
			fclose($file);

			$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'configmain_'.$_SESSION['rand_num'].'.txt', 'w');

			$query="SELECT * FROM ".$dbpref."config_main";
			$stmt = new Statement($query, 433);
			$result = $stmt->process();
			$bool = false;
			while($ret = $result->next())
			{
				$str = '';

				foreach( $ret as $key=>$val )
				{
					$str = $str."\t".$val;
				}
				$str=substr($str, 1);
				fwrite($file, $str);
			}
			fclose($file);

			$old_prefix="";
			$d=dir("./temp/templates/cache");
			while(false!==($entry = $d->read()))
			{
				if(strpos($entry, "_users_")!==false)
				{
					$old_prefix_arr=explode("_", $entry);
					$old_prefix=$old_prefix_arr[count($old_prefix_arr)-2];
					break;
				}
			}
			$d->close();
			$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'bans_'.$_SESSION['rand_num'].'_1.txt', 'w');
			fclose($file);
			if($old_prefix!="")
			{
				rename($GLOBALS['fc_config']['cachePath'].$dbpref."users_".$old_prefix."_1.txt", $GLOBALS['fc_config']['cachePath'].$dbpref."users_".$_SESSION['rand_num']."_1.txt");
			}
			else
			{
				$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'users_'.$_SESSION['rand_num'].'_1.txt', 'w');
				fclose($file);
			}
			$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'ignors_'.$_SESSION['rand_num'].'_1.txt', 'w');
			fclose($file);
			$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'connections_'.$_SESSION['rand_num'].'_1.txt', 'w');
			fclose($file);
			$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'messages_'.$_SESSION['rand_num'].'_1.txt', 'w');
			fclose($file);

			$fname = $GLOBALS['fc_config']['cachePath'].'tables_id_1.txt';
			$fp = @fopen($fname,"w+");
			@fwrite($fp, '0#0#0#0#0#0#0#0#4#0');
			@fclose( $fp );
		}

		if( isset($_REQUEST['cms']) && $_REQUEST['cms']=='defaultCMS' )
		{
			$query = 'UPDATE '.$dbpref.'config_values SET value = ? WHERE config_id = (
					SELECT id FROM '.$dbpref.'config WHERE level_0 = "encryptPass")';
			$stmt = new Statement($query, 442);
			$f = $stmt->process($_REQUEST['enc_pass']);
			//set password

			$password = $_REQUEST['def_adminpass'];
			if($_REQUEST['enc_pass'] && ($_REQUEST['prevEncPass'] == '0' || ($_REQUEST['prevEncPass'] == '1' && $_REQUEST['prevAdminPass'] != $password)))
			{
				$password = md5($password);
			}
			if($_SESSION['cache_type'] != 1)
			{
				$query="UPDATE ".$dbpref."config_values SET value= ? WHERE config_id=(
						SELECT id FROM ".$dbpref."config WHERE level_0='adminPassword')";
				$stmt = new Statement($query, 428);
				$f = $stmt->process($password);
			}
			else
			{
				$sql = "UPDATE ".$dbpref."config_values SET value= '{$password}' WHERE config_id=(
						SELECT id FROM ".$dbpref."config WHERE level_0='adminPassword')";
				$res = mysql_query($sql);
			}

			$password = $_REQUEST['def_moderatorpass'];
			if($_REQUEST['enc_pass'] && ($_REQUEST['prevEncPass'] == '0' || ($_REQUEST['prevEncPass'] == '1' && $_REQUEST['prevModeratorPass'] != $password)))
			{
				$password = md5($password);
			}
			if($_SESSION['cache_type'] != 1)
			{
				$query="UPDATE ".$dbpref."config_values SET value= ? WHERE config_id=(
						SELECT id FROM ".$dbpref."config WHERE level_0='moderatorPassword')";
				$stmt = new Statement($query, 429);
				$f = $stmt->process($password);
			}
			else
			{
				$sql = "UPDATE ".$dbpref."config_values SET value= '{$password}' WHERE config_id=(
						SELECT id FROM ".$dbpref."config WHERE level_0='moderatorPassword')";
				$res = mysql_query($sql);
			}

			$password = $_REQUEST['def_spypass'];
			if($_REQUEST['enc_pass'] && ($_REQUEST['prevEncPass'] == '0' || ($_REQUEST['prevEncPass'] == '1' && $_REQUEST['prevSpyPass'] != $password)))
			{
				$password = md5($password);
			}
			if($_SESSION['cache_type'] != 1)
			{
				$query="UPDATE ".$dbpref."config_values SET value= ? WHERE config_id=(
						SELECT id FROM ".$dbpref."config WHERE level_0='spyPassword')";
				$stmt = new Statement($query, 430);
				$f = $stmt->process($password);
			}
			else
			{
				$sql = "UPDATE ".$dbpref."config_values SET value= '{$password}' WHERE config_id=(
						SELECT id FROM ".$dbpref."config WHERE level_0='spyPassword')";
				$res = mysql_query( $sql );
			}
			//set login

			if( $_SESSION['cache_type'] == 0 || $_SESSION['cache_type'] == 1 )
			{
				$password = $_REQUEST['def_adminpass'];
				if($_REQUEST['enc_pass'] && ($_REQUEST['prevEncPass'] == '0' || ($_REQUEST['prevEncPass'] == '1' && $_REQUEST['prevAdminPass'] != $password)))
				{
					$password = md5($password);
				}
				if(!isset($def_users[2]['login']))
				{
					$stmt = new Statement('INSERT INTO '.$GLOBALS['fc_config']['db']['pref'].'users (login,password,roles,instance_id) VALUES (?,?,?,?)',113);
					$res = $stmt->process($_REQUEST['def_adminlogin'], $password, '2', 1);
				}
				else
				{
					$stmt = new Statement('UPDATE '.$GLOBALS['fc_config']['db']['pref'].'users SET login = ?, password = ?, roles = ? WHERE id = ?', 142);
					$res = $stmt->process($_REQUEST['def_adminlogin'], $password, 2, $def_users[2]['id']);
				}

				$password = $_REQUEST['def_moderatorpass'];
				if($_REQUEST['enc_pass'] && ($_REQUEST['prevEncPass'] == '0' || ($_REQUEST['prevEncPass'] == '1' && $_REQUEST['prevModeratorPass'] != $password)))
				{
					$password = md5($password);
				}
				if(!isset($def_users[3]['login']))
				{
					$stmt = new Statement('INSERT INTO '.$GLOBALS['fc_config']['db']['pref'].'users (login,password,roles,instance_id) VALUES (?,?,?,?)',113);
					$res = $stmt->process($_REQUEST['def_moderatorlogin'], $password, '3', 1);
				}
				else
				{
					$stmt = new Statement('UPDATE '.$GLOBALS['fc_config']['db']['pref'].'users SET login = ?, password = ?, roles = ? WHERE id = ?', 142);
					$res = $stmt->process($_REQUEST['def_moderatorlogin'], $password, 3, $def_users[3]['id']);
				}

				$password = $_REQUEST['def_spypass'];
				if($_REQUEST['enc_pass'] && ($_REQUEST['prevEncPass'] == '0' || ($_REQUEST['prevEncPass'] == '1' && $_REQUEST['prevSpyPass'] != $password)))
				{
					$password = md5($password);
				}
				if(!isset($def_users[4]['login']))
				{
					$stmt = new Statement('INSERT INTO '.$GLOBALS['fc_config']['db']['pref'].'users (login,password,roles,instance_id) VALUES (?,?,?,?)',113);
					$res = $stmt->process($_REQUEST['def_spylogin'], $password, '4', 1);
				}
				else
				{
					$stmt = new Statement('UPDATE '.$GLOBALS['fc_config']['db']['pref'].'users SET login = ?, password = ?, roles = ? WHERE id = ?', 142);
					$res = $stmt->process($_REQUEST['def_spylogin'], $password, 4, $def_users[4]['id']);
				}
			}
			if($_SESSION['cache_type'] == 1 || $_SESSION['cache_type'] == 2)
			{
				if($old_prefix != '')
				{
					$lines_tmp = file($GLOBALS['fc_config']['cachePath'].$dbpref.'users_'.$_SESSION['rand_num'].'_1.txt');
					$file_tmp = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'users_'.$_SESSION['rand_num'].'_1.txt', 'w');
					foreach($lines_tmp as $k => $v)
					{
						if($k>2)
						{
							if($v!="")
							{
								@fwrite($file_tmp, $v);
							}
						}
					}
					@fclose($file_tmp);

					$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'users_'.$_SESSION['rand_num'].'_1.txt', 'a');
				}
				else
				{
					$file = @fopen($GLOBALS['fc_config']['cachePath'].$dbpref.'users_'.$_SESSION['rand_num'].'_1.txt', 'w');
				}

				if( isset($_REQUEST['enc_pass']) && $_REQUEST['enc_pass'] )
				{
					if( isset($_REQUEST['def_adminlogin']) && isset($_REQUEST['def_adminpass']) )
						$str = "1\t".$_REQUEST['def_adminlogin']."\t".md5($_REQUEST['def_adminpass'])."\t2\t\t\n";

					if( isset($_REQUEST['def_moderatorlogin']) && isset($_REQUEST['def_moderatorpass']) )
						$str = $str."2\t".$_REQUEST['def_moderatorlogin']."\t".md5($_REQUEST['def_moderatorpass'])."\t3\t\t\n";

					if( isset($_REQUEST['def_spylogin']) && isset($_REQUEST['def_spypass']) )
						$str = $str."3\t".$_REQUEST['def_spylogin']."\t".md5($_REQUEST['def_spypass'])."\t4\t\t\n";
				}
				else
				{
					if( isset($_REQUEST['def_adminlogin']) && isset($_REQUEST['def_adminpass']) )
						$str = "1\t".$_REQUEST['def_adminlogin']."\t".$_REQUEST['def_adminpass']."\t2\t\t\n";

					if( isset($_REQUEST['def_moderatorlogin']) && isset($_REQUEST['def_moderatorpass']) )
						$str = $str."2\t".$_REQUEST['def_moderatorlogin']."\t".$_REQUEST['def_moderatorpass']."\t3\t\t\n";

					if( isset($_REQUEST['def_spylogin']) && isset($_REQUEST['def_spypass']) )
						$str = $str."3\t".$_REQUEST['def_spylogin']."\t".$_REQUEST['def_spypass']."\t4\t\t\n";
				}
				@fwrite($file, $str);
				fflush($file);
			}
		}
		// inserts files from /fonts to config file/table. artemK0
		addFontsToConfig($GLOBALS['fc_config']['db']['pref'], $_SESSION['session_inst'], $GLOBALS['fc_config']['cacheType'], $GLOBALS['fc_config']['cachePath'], $GLOBALS['fc_config']['cacheFilePrefix']);
	}
	//---


	//if( isset($useCMS) )
	if( !isset($useCMS) ) $repl['CMSsystem'] = "'".$_REQUEST['cms']."'";

	if( isset($all_lang) )
	$GLOBALS['fc_config']['languages'] = $all_lang;
	//finish step
	$step = 6;

	if( isset($_SESSION['forcms']) && $_SESSION['forcms'])
		$step = 6;

	$_SESSION['forcms'] = $_REQUEST['cms'];

	// found modules. if dir is not empty, then redirect to step 3.5
	$d = dir(INC_DIR . '../modules');
	$all_modules = array();
	$i = 0;
	while($entry = $d->read())
	{
		if($entry == '.' || $entry == '..' || $entry == 'readme.txt') continue;

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
	if(count($all_modules) > 0)
	{
		$step = '3.5';
	}
	else
	{
		if($_SESSION['cache_type'] == 2)
		{
			$step = '8';
		}
		else
		{
			$step = '6';
		}
	}
	redirect_inst('install.php?step='.$step);
}

include INST_DIR . 'header.php';
?>



<TR>
	<TD colspan="2"></TD>
</TR>
<TR>
	<TD colspan="2" class="subtitle">Step 3: Chat Configuration</TD>
</TR>
<TR>
	<TD colspan="2" class="normal">	To help you configure FlashChat for the first time, input some information about how you would like the chat to operate. This step will write some configuration data to the configuration file.
	</TD>
</TR>


<tr><td colspan=2 class="error_border"><font color="red"><?php echo @$errmsg; ?></font></td></tr>

<FORM action="install.php?step=3" method="post" align="center" name="installInfo" onSubmit="javascript:return checkEqual();">
	<TR>
		<TD colspan="2">
			<TABLE width="100%" class="body_table" cellspacing="10" border="0">
			<?php if(!isset($_SESSION['usecms'])) { ?>
				<TR>
					<TD width="30%" align="right" valign=top>
						How would you like to use FlashChat?
					</td>
					<td>

					<table width="100%" class="normal">
					<tr>
						<td valign="top"><INPUT type="radio" name="cms" value="statelessCMS" <?php if($isStateless) echo 'CHECKED'; ?> onclick="javascript:setLogin('1');" ></td>
						<td>As a free-for-all chatroom, where users can chat without registering or creating a profile (so-called "stateless CMS")</td>
					</tr>
					<tr>
						<td valign="top"><INPUT type="radio" name="cms" value="defaultCMS" <?php if(!$isStateless) echo 'CHECKED'; ?> onclick="javascript:setLogin('0');" ></td>
						<td>As a registered users-only chatroom. Users must register and create a profile before being allowed to chat (so-called "default CMS")</td>
					</tr>


					<!--
					<tr>
						<td valign="top"><INPUT type="radio" name="cms" value=""></td>
						<td>I have a content-management system (CMS), like phpNuke, Mambo, phpBB, or other system, that I want to integrate with FlashChat</td>
					</tr>
					-->
					</table>

					</TD>

				</TR>
				<TR>
					<TD width="30%" align="right" valign=top>
					</TD>
					<TD >
						<DIV style="display:<?php if($isStateless) echo 'block'; else echo 'none'; ?>;" name="stateless" id="stateless" >
							<TABLE style="font-size:12px;" border="0" >
								<TR>
									<TD align="left" style="width:100px;"><div style="white-space: nowrap;">Administrator&nbsp;Password:</div></TD>
									<TD valign="top" align="left" >
										<input type="text" name="stt_adminpass" id="stt_adminpass" maxlength="20" <?php if(isset($def_users[5])) echo 'value="'.$def_users[5].'"';?>>&nbsp;&nbsp;(required)
									</TD>
								</TR>
								<TR>
									<TD align="left" style="width:130px"><div style="white-space: nowrap;">Moderator Password:</div></TD>
									<TD valign="top" align="left" >
										<input type="text" name="stt_moderatorpass" id="stt_moderatorpass" maxlength="20" <?php if(isset($def_users[6])) echo 'value="'.$def_users[6].'"';?>>&nbsp;&nbsp;(required)
									</TD>
								</TR>
								<TR>
									<TD align="left" nowrap style="width:130px"><div style="white-space: nowrap;">Spy Password:</div></TD>
									<TD valign="top" align="left" >
										<input type="text" name="stt_spypass" id="stt_spypass" maxlength="20" <?php if(isset($def_users[7])) echo 'value="'.$def_users[7].'"';?>>&nbsp;&nbsp;(required)
									</TD>
								</TR>
							</TABLE>
							<TABLE  style="font-size:12px;" border="0" width="100%">
								<TR>
									<TD align="left" >
										When using FlashChat in "free-for-all" mode, the administrator, moderator, or spy may</br> login with ANY username, but they must input the password above to be assigned the</br> administrator, moderator, or spy roles, respectively.
									</TD>
								</TR>
							</table>
						</DIV>
						<DIV style="display:<?php if(!$isStateless) echo 'block'; else echo 'none'; ?>;" name="default" id="default" >
							<TABLE style="font-size:12px;">
								<TR>
									<TD align="left"  style="width:100px;"><div style="white-space: nowrap;">Administrator Login:</div></TD>
									<TD valign="top" align="left" >
										<input type="text" name="def_adminlogin" id="def_adminlogin" maxlength="20" <?php if(isset($def_users[2]['login'])) echo 'value="'.$def_users[2]['login'].'"';?>>
									</TD>
								</TR>
								<TR>
									<TD align="left"  style="width:100px;"><div style="white-space: nowrap;">Administrator Password:</div></TD>
									<TD valign="top" align="left" >
										<input type="text" name="def_adminpass" id="def_adminpass" maxlength="20" <?php if(isset($def_users[2]['password'])) echo 'value="'.$def_users[2]['password'].'"';?>>
										<input type="hidden" name="prevAdminPass" <?php if(isset($def_users[2]['password'])) echo 'value="'.$def_users[2]['password'].'"';?> >
									</TD>
								</TR>
								<tr><td>&nbsp; </td><td>&nbsp; </td></tr>
								<TR>
									<TD align="left"  style="width:100px;"><div style="white-space: nowrap;">Moderator Login:</div>
									</TD>
									<TD valign="top" align="left" >
										<input type="text" name="def_moderatorlogin" id="def_moderatorlogin" maxlength="20" <?php if(isset($def_users[3]['login'])) echo 'value="'.$def_users[3]['login'].'"';?>>
									</TD>
								</TR>
								<TR>
									<TD align="left" nowrap   style="width:100px;"><div style="white-space: nowrap;">Moderator Password:</div></TD>
									<TD valign="top" align="left" >
										<input type="text" name="def_moderatorpass" id="def_moderatorpass" maxlength="20" <?php if(isset($def_users[3]['password'])) echo 'value="'.$def_users[3]['password'].'"';?>>
										<input type="hidden" name="prevModeratorPass" <?php if(isset($def_users[3]['password'])) echo 'value="'.$def_users[3]['password'].'"';?> >
									</TD>
								</TR>
								<tr><td>&nbsp; </td><td>&nbsp; </td></tr>
								<TR>
									<TD align="left" nowrap  style="width:100px;"><div style="white-space: nowrap;">Spy Login:</div>
									</TD>
									<TD valign="top" align="left" >
										<input type="text" name="def_spylogin" id="def_spylogin" maxlength="20" <?php if(isset($def_users[4]['login'])) echo 'value="'.$def_users[4]['login'].'"';?>>
									</TD>
								</TR>
								<TR>
									<TD align="left" nowrap  style="width:100px;"><div style="white-space: nowrap;">Spy Password:</div></TD>
									<TD valign="top" align="left" >
										<input type="text" name="def_spypass" id="def_spypass" maxlength="20" <?php if(isset($def_users[4]['password'])) echo 'value="'.$def_users[4]['password'].'"';?>>
										<input type="hidden" name="prevSpyPass" <?php if(isset($def_users[4]['password'])) echo 'value="'.$def_users[4]['password'].'"';?> >
									</TD>
								</TR>
							</TABLE>
							<table style="font-size:12px;">
								<TR>
									<TD align="left" colspan="2">
										Inputting the username/passwords above will help you get started with FlashChat, by</br> auto-registering these 3 users. Additional users may use the "register" link</br> on the FlashChat default page.</br></br>

									</TD>
								</TR>
								<tr><td colspan="2">Encrypt Passwords in the Database?</td></tr>
								<tr >

									<td nowrap valign="top" colspan="2"><INPUT type="radio" name="enc_pass" value="1" <?php if($prevEncPass == '1') echo 'checked'; ?> > Yes, use encryption <INPUT type="radio" name="enc_pass" value="0" <?php if($prevEncPass == '0') echo 'checked'; ?> > No, do not use encryption</td>

								</tr>
							</table>
						</DIV>
					</TD>
				</TR>
				<TR>
					<TD width="30%" align="right">Room List (comma delimited):
					</TD>
					<TD>
						<INPUT type="text"  size="100%" name="rooms" value="<?php echo $rooms ?>">
					</TD>
				</TR>

			<?php }	?>


				<TR>
					<TD colspan=2>Some systems use UTF-8 encoding for user names. If you are using a system with non-English character sets, you may need to enable UTF-8 decoding for user names. Would you like to enable it now?:
					</TD>
				</TR>
				<TR>
					<td></td>
					<TD>
						<table width="100%" class="normal" border=0>
							<tr>
								<td valign="top" width="2"><INPUT type="radio" name="login_utf" value="false" CHECKED></td>
								<td>No, do not enable UTF-8 at this time.</td>
							</tr>
							<tr>
								<td valign="top" width="2"><INPUT type="radio" name="login_utf" value="true"></td>
								<td>Yes, please enable UTF-8</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan=2>
								If you discover that UTF-8 conversions are needed, you can enable it later by setting the loginUTF8decode value in /inc/config.php to true.
					</td>
				</TR>

				<TR>
					<TD align="right">Live support mode:
					</TD>
					<TD>
						<INPUT type="checkbox" name="conf_liveSupportMode" value="1"
						<?php

						if( isset($_POST['conf_liveSupportMode']) && $_POST['conf_liveSupportMode'] && isset($GLOBALS['fc_config']['liveSupportMode']) &&  $GLOBALS['fc_config']['liveSupportMode'] )
						{
						 	//echo $_POST['conf_liveSupportMode']?'CHECKED': ($GLOBALS['fc_config']['liveSupportMode']?'CHECKED':'');
						 	echo 'CHECKED';
						}
						else
						{
							//echo $_POST['conf_liveSupportMode']?'CHECKED': ($GLOBALS['fc_config']['liveSupportMode']?'CHECKED':'');
						}


						?>
						> Check here to use FlashChat as a customer support system.
					</TD>
				</TR>


				<TR>
					<TD align="right" nowrap>Default language:
					</TD>
					<TD valign="top">
						<SELECT name="conf_defaultLanguage">
						<?php
							foreach($lang_tmp as $k => $v)
							{
								if($k == 'en') $sel = 'SELECTED';
								else $sel = '';

								echo "<option value=\"$k\" $sel>{$v['name']}";
							}
						?>
						</SELECT>
					</TD>
				</TR>

				<TR>
					<TD width="30%" align="right">Request interval:
					</TD>
					<TD>
						<INPUT type="hidden" size="5" name="cache_type" value="<?php echo $_SESSION['cache_type']; ?>">
						<INPUT type="hidden" name="prevEncPass" value="<?php echo $prevEncPass; ?>">
						<INPUT type="text" size="5" name="conf_msgRequestInterval" value="<?php if( isset($_POST['conf_msgRequestInterval']) )
																								{
																									echo $_POST['conf_msgRequestInterval'];
																								}
																								else
																								{
																									echo $GLOBALS['fc_config']['msgRequestInterval'];
																								}
																							?>">(seconds)
					</TD>
				</TR>
		</TD>
	</TR>
</TABLE>
	<TR>
		<TD>&nbsp;</TD>
		<TD align="right">
			<INPUT type="submit" name="submit" value="Continue >>" >
		</TD>
	</TR>



	<tr><!--
	<td colspan="2">

	<p class="subtitle">More About Configuring FlashChat</p>

The options listed above are to help you get started with FlashChat. When you click Continue, some of the options in config.php will be set for you. However, you may change many more options after installation by directly editing the PHP files that come with FlashChat. Here are a few tips...

<p>
<b> Language Settings </b><br>
To disable or re-order a language, edit the /inc/config.php file. To change the text of a language, edit the appropriate langauge file in /inc/langs/
</p>

<p>
<b>Interface Layout </b><br>
To disable or re-arrange elements of the FlashChat interface, edit the /inc/layouts/ files. Use 'users.php' for general chatters, and admin.php for moderators.
</p>

<p>
<b>Colors and Themes</b><br>
To change the colors of FlashChat's 'themes', edit the files in /inc/themes. To change the background image for any theme, edit the appropriate JPG file in the /images folder. Be sure to use only non-progressive JPG files.
</p>

<p>
<b>Sounds</b><br>
You may use your own MP3 files with FlashChat by replacing any MP3 file in the /sounds folder. To set the default sound configuration, edit the appropriate options in /inc/config.php
</p>

<p>
<b>Integrating with your Database</b><br>
If you have a database of users that you would like to use with FlashChat, or if you are having difficult integrating FlashChat with an existing system like phpBB or Mambo, you may wish to edit the appropriate PHP file in the /inc/cmses folder.
</p>

<p>
<b>Other Options</b><br>
The best thing to do is simply open the /inc/config.php file and browse through the various options that are available to you. There are a lot! You will see that FlashChat is the most versatile and flexible chat room around. Be careful that you do not introduce any PHP errors when editing these PHP files.
</p>
	</td> -->
	</tr>



<?php
include INST_DIR . 'footer.php';
?>