<?php /* Smarty version 2.6.10, created on 2008-09-17 17:37:30
         compiled from top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'top.tpl', 146, false),)), $this); ?>
<html>
	<head>
		<title>FlashChat Admin Panel</title>
		<meta http-equiv=Content-Type content="text/html;  charset=UTF-8">

		<link href="styles.css" rel="stylesheet" type="text/css">
		<script language="javascript" src="funcs.js"></script>
		<script language="javascript" src="cnf_funcs.js"></script>
		<script language=JavaScript src="picker.js"></script>


		<?php echo '
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

.hintanchor{ /*CSS for link that shows hint onmouseover*/
font-weight: bold;
color: navy;
margin: 3px 8px;
}

</style>

<script type="text/javascript">

/***********************************************
* Show Hint script- © Dynamic Drive (www.dynamicdrive.com)
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
'; ?>

	</head>

<body>
		<center>
		<form action="cnf_config.php" method="post" enctype="multipart/form-data" >

			<a href="index.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b0']['l'];  echo $this->_tpl_vars['langs_top']['t0'];  echo $this->_tpl_vars['b0']['r']; ?>
</a>
<!--<?php if ($this->_tpl_vars['fc_admin_chat_instance'] != '' && $this->_tpl_vars['IS_ADMIN'] == 1): ?>| <a href="main.php"><?php echo $this->_tpl_vars['langs_top']['t1']; ?>
</a>
            <input type="Hidden" value="<?php echo $this->_tpl_vars['module']; ?>
" name="module2">
<?php endif; ?>-->|

			<a href="cnf_config.php?<?php echo $this->_tpl_vars['rand']; ?>
&module=general"><?php echo $this->_tpl_vars['b1']['l'];  echo $this->_tpl_vars['langs_top']['t2'];  echo $this->_tpl_vars['b1']['r']; ?>
</a> |
			<a href="msglist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b2']['l'];  echo $this->_tpl_vars['langs_top']['t3'];  echo $this->_tpl_vars['b2']['r']; ?>
</a> |
			<a href="chatlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b3']['l'];  echo $this->_tpl_vars['langs_top']['t4'];  echo $this->_tpl_vars['b3']['r']; ?>
</a> |
			<a href="usrlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b4']['l'];  echo $this->_tpl_vars['langs_top']['t5'];  echo $this->_tpl_vars['b4']['r']; ?>
</a> |
			<a href="roomlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b5']['l'];  echo $this->_tpl_vars['langs_top']['t6'];  echo $this->_tpl_vars['b5']['r']; ?>
</a> |
			<a href="connlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b6']['l'];  echo $this->_tpl_vars['langs_top']['t7'];  echo $this->_tpl_vars['b6']['r']; ?>
</a> |
			<a href="banlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b7']['l'];  echo $this->_tpl_vars['langs_top']['t8'];  echo $this->_tpl_vars['b7']['r']; ?>
</a> |
			<a href="ignorelist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b8']['l'];  echo $this->_tpl_vars['langs_top']['t9'];  echo $this->_tpl_vars['b8']['r']; ?>
</a> |
			<a href="botlist.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b9']['l'];  echo $this->_tpl_vars['langs_top']['t10'];  echo $this->_tpl_vars['b9']['r']; ?>
</a> |
			<a href="uninstall.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b10']['l'];  echo $this->_tpl_vars['langs_top']['t11'];  echo $this->_tpl_vars['b10']['r']; ?>
</a> |
			<a href="logout.php?<?php echo $this->_tpl_vars['rand']; ?>
"><?php echo $this->_tpl_vars['b11']['l'];  echo $this->_tpl_vars['langs_top']['t12'];  echo $this->_tpl_vars['b11']['r']; ?>
</a>
			<p>
				<?php if ($this->_tpl_vars['fc_admin_chat_instance'] != '' && $this->_tpl_vars['IS_ADMIN'] == 1 && count($this->_tpl_vars['chat_instances']) > 1): ?>
				Load another chat instance:
  	          		<SELECT NAME=instances onchange='submit();' >
			   			<?php $_from = $this->_tpl_vars['chat_instances']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['name']['iteration']++;
?>
			    			<OPTION VALUE=<?php echo $this->_tpl_vars['val']['id']; ?>
    <?php if ($this->_tpl_vars['val']['id'] == $this->_tpl_vars['instance_ID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']['name']; ?>

		       			<?php endforeach; endif; unset($_from); ?>
	          		</SELECT>
	         		<input type="Hidden" value="<?php echo $this->_tpl_vars['module']; ?>
" name="module">
				<?php endif; ?></p>

        </form>
		</center>
		<hr>