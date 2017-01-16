<?php /* Smarty version 2.6.10, created on 2008-09-17 17:17:53
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'index.tpl', 235, false),)), $this); ?>
<html>
<head>
<title>FlashChat v<?php echo $this->_tpl_vars['data']['version']; ?>
</title>
<meta http-equiv=Content-Type content="text/html;  charset=UTF-8" >
<?php echo '
<style type=text/css>
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
}
.small {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
}
.title {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
input {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
}
select {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
}
A {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #0000FF;
}
A:hover {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
}

.error_border {
	border: 1px solid #FF0000;
	background-color: #FFFFFF;
 	font-size: 12px;
    font-weight: normal;
}
-->
</style>
<script language=\'Javascript\'>
<!--
function formIsValid() {
	// check to make sure a valid username has been entered
	if ( document.login.username.value == \'\' ) {
		alert(\'Please input a username.\');
		return false;
	}

	return true;
}

// a small poupup window to show who\'s in the chat at the current time
function showInfo() {
	// the size of the popup window
	var width = 400;
	var height = 300;


	// the x,y position of the popup window
	// NOTE: this formula will auto-center the popup on the screen
	var y = (screen.height - height) / 2;
	var x = (screen.width - width) / 2;

	var session_inst = 1;
	if(document.login.session_inst != undefined)
	{
	 session_inst = document.login.session_inst.value;
	}
	var url = \'info.php?session_inst=\' + session_inst;
	var options = \'width=\' + width + \',height=\' + height + \',top=\' + y + \',left=\' + x + \',resizable\';

	// open the info window as a popup, instead of embedded in webpage
	window.open( url, \'info\', options );
}

function basicLogin() {
	if (formIsValid()) document.login.submit();
}
function changeConf(chat,instances,selectchat,selectinst)
{

	var i;
	var start = 0;
	var index;
	var newObj;
	var str;
	var end;

	while( 0 < 1)
	{
		if ( chat.indexOf(selectchat.value,start) != -1)
			if ( chat.charAt(chat.indexOf(selectchat.value,start)+1) == "|" )
			{
				index = chat.indexOf(selectchat.value,start);
				break;
			}
			else
				start = chat.indexOf(selectchat.value,start)+1;
		else
			break;
	}


	for( i = selectinst.length ; i >= 0 ; i-- )
		selectinst.remove(i);

	start = 0;
	var k;
	k = 0;
	index = index + 2;
	for( i = index ; i < chat.indexOf(";",index) ; i++ )
	{
		end = chat.indexOf(",",index);
		if ( end > chat.indexOf(";",index) || end == -1 )
			end = chat.indexOf(";",index);


		start = instances.indexOf(chat.substring(index,end));
		if (start != -1)
		{
			newObj = document.createElement("OPTION");
			start = start + 2;
			newObj.text = instances.substring(start,instances.indexOf(";",start));
			newObj.value = chat.substring(index,end);

			if ( navigator.userAgent.indexOf("Firefox") != -1)
				selectinst.add(newObj,null);
			else
				selectinst.add(newObj,k);
			k++;
		}
		else
			break;


		if (chat.charAt(chat.substring(index,end).length+index) == ";")
			break;


		index = chat.indexOf(",",index) + 1;

	}
}

function popupLogin() {
	// check to make sure a valid username has been entered
	if (!formIsValid()) return;

	var username = document.login.username.value;
	var password = document.login.password.value;
	var lang = document.login.lang.value;

	// the size of the popup window
	var width = 800;
	var height = 600;

	// the x,y position of the popup window
	// NOTE: this formula will auto-center the popup on the screen
	var y = (screen.height - height) / 2;
	var x = (screen.width - width) / 2;

	var session_inst = 1;
	if(document.login.session_inst != undefined)
	{
	 session_inst = document.login.session_inst.value;
	}

	var url = \'flashchat.php?username=\' + username + \'&password=\' + password + \'&lang=\' + lang+\'&session_inst=\'+session_inst;
	var options = \'width=\' + width + \',height=\' + height + \',top=\' + y + \',left=\' + x + \',resizable\';

	// open the chat window as a popup, instead of embedded in webpage
	window.open( url, \'chat\', options );
}
//-->
</script>
'; ?>

</head>
<body>

<table border="0" align="center" width=500 cellpadding="4">
  <tr>
    <td nowrap width="34%"> <span class=title>Welcome to FlashChat v <?php echo $this->_tpl_vars['data']['version']; ?>
</span> </td>
    <td width="66%" align=right> <a href="javascript:showInfo();">Who's in the chat?</a></a> </td>
  </tr>
  <?php if ($this->_tpl_vars['data']['file_exists']): ?>
  	<tr>
		<td colspan=2 class="error_border" align="center">
		<font color="red"><b>Security alert!</b><br>install.php, or the install_files folder, are still present on your server. Please remove these files before continuing.
		</font>
		</td>
	</tr>
  <?php endif; ?>

    <tr>
      <td width="34%" nowrap>Start FlashChat using built-in login</td>
      <td width="66%"><form action="flashchat.php" method="post"><input name="submit" type="submit" id="submit" value="Login &gt;&gt;"></form></td>
    </tr>

  <tr>
    <td colspan="2"><hr></td>
  </tr>

    <tr>
      <td colspan="2">Start FlashChat using HTML-based login</td>
    </tr>
    <tr>
      <td colspan="2" align="right"><form action="flashchat.php" method="post" name="login"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td><div align="right">Username:</div></td>
            <td><input type="text" name="username">
			<?php if ($this->_tpl_vars['data']['is_cms']): ?>
				&nbsp;<a href="profile.php?register=true"  target="_blank">register</a><br>
				<!-- You can buy an instance by clicking
			    <a href="profile.php?register=true&fc_instance_purchase=1">here </a> --><?php endif; ?></td>
          </tr>
          <tr>
            <td><div align="right">Password:</div></td>
            <td><input type="password" name="password">
				<?php if ($this->_tpl_vars['data']['is_cms']): ?>
					&nbsp;<a href="profile.php?newpassword=true"  target="_blank">new password</a>
					&nbsp;&nbsp;<a href="profile.php?oldpassword=true"  target="_blank">current password</a>
				<?php endif; ?>
				</td>
          </tr>
		  <?php if (count($this->_tpl_vars['data']['instances']) > 1): ?>
		  <tr>
            <td><div align="right">Chat Instance:</div></td>
            <td>
				<select name="session_inst">
					<?php $_from = $this->_tpl_vars['data']['instances']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
?>
						<option value="<?php echo $this->_tpl_vars['val']['id']; ?>
"<?php if ($this->_tpl_vars['val']['is_default'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']['name']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
                </select>
			</td>

          </tr>
		  <?php endif; ?>
          <tr>
            <td><div align="right">Language:</div></td>
            <td><select name="lang">
                <?php $this->assign('selected', $this->_tpl_vars['data']['defaultLanguage']); ?>
				<?php $_from = $this->_tpl_vars['data']['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['ordersel']):
?>
					<option value="<?php echo $this->_tpl_vars['key']; ?>
"<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['selected']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['ordersel']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
              </select></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="button" type="button" onClick="javascript:basicLogin();" value="Login &gt;&gt;"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="button" type="button" onClick="javascript:popupLogin();" value="Popup Login &gt;&gt;"></td>
          </tr>
          <tr>
            <td colspan="2">
			<?php if ($this->_tpl_vars['data']['is_statelesscms']): ?>
				<!-- onClick="javascript:alert(session_inst.value);"
			  	To login as a moderator, use <b><?php echo $this->_tpl_vars['data']['adminPassword']; ?>
</b> as the password.
				To login as a spy, use <b><?php echo $this->_tpl_vars['data']['spyPassword']; ?>
</b> as the password. These passwords can be set in the FlashChat configuration file.
				-->
				<font color="Red"><b> To login as an administrator, moderator or spy, please use the passwords found in FlashChat's
				configuration file, with any username.
				 </b></font>
			<?php else: ?>
				To login as a moderator or spy, you must use a registered login with the moderator
				or spy "role" assigned to it. This can be done at registration, or using FlashChat's
				<a href="admin.php">admin.php</a> file (to access this you must have a valid admin login).
			<?php endif; ?>
			</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2" class=small><hr></td>
    </tr>
    <tr>
      <td colspan=2><a target=demo href="sample.php">ACME Widgets Demo</a>.
          This demo shows how you can integrate FlashChat into your website's template. ACME Widgets is a ficticous company.
        </td>
    </tr>
    <tr>
      <td colspan=2 class=small><hr></td>
    </tr>
    <tr>
      <td colspan=2><a href=http://www.tufat.com/chat.php target="purchase">Purchase
        FlashChat for your website for $5!</a></td>
    </tr>
    <tr>
      <td class=small colspan=2>What you get: All PHP source code, All Flash source code (.FLA file), MySQL
        table structures, installation instructions, free technical support at
        the <a href=http://www.tufat.com/phpBB2/ target="support">TUFaT.com support
        forum</a>.</td>
    </tr>
    <tr>
      <td class=small colspan=2>Minimum requirements: PHP 4.1.2, MySQL 3.23, Flash
        7. You do NOT need Flash Communication Server or any other server components.</td>
    </tr>
    <tr>
      <td class=small colspan=2>FlashChat is the copyright of Darren Gates and
        TUFaT.com. Re-sale of FlashChat is strictly prohibited. The purpose of
        FlashChat is to give companies, organizations, and individuals a simple
        way to add live chat capabilities to any PHP/MySQL-enabled website. Technical
        support is available on the TUFaT.com support forum, and upgrades are
        free.</td>
    </tr>

</table>
 </form>
</body>
</html>