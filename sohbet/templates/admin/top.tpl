<html>
	<head>
		<title>FlashChat Admin Panel</title>
		<meta http-equiv=Content-Type content="text/html;  charset=UTF-8">

		<link href="styles.css" rel="stylesheet" type="text/css">
		<script language="javascript" src="funcs.js"></script>
		<script language="javascript" src="cnf_funcs.js"></script>
		<script language=JavaScript src="picker.js"></script>


		{literal}
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
{/literal}
	</head>

<body>
		<center>
		<form action="cnf_config.php" method="post" enctype="multipart/form-data" >

			<a href="index.php?{$rand}">{$b0.l}{$langs_top.t0}{$b0.r}</a>
<!--{if $fc_admin_chat_instance!='' && $IS_ADMIN == 1}| <a href="main.php">{$langs_top.t1}</a>
            <input type="Hidden" value="{$module}" name="module2">
{/if}-->|

			<a href="cnf_config.php?{$rand}&module=general">{$b1.l}{$langs_top.t2}{$b1.r}</a> |
			<a href="msglist.php?{$rand}">{$b2.l}{$langs_top.t3}{$b2.r}</a> |
			<a href="chatlist.php?{$rand}">{$b3.l}{$langs_top.t4}{$b3.r}</a> |
			<a href="usrlist.php?{$rand}">{$b4.l}{$langs_top.t5}{$b4.r}</a> |
			<a href="roomlist.php?{$rand}">{$b5.l}{$langs_top.t6}{$b5.r}</a> |
			<a href="connlist.php?{$rand}">{$b6.l}{$langs_top.t7}{$b6.r}</a> |
			<a href="banlist.php?{$rand}">{$b7.l}{$langs_top.t8}{$b7.r}</a> |
			<a href="ignorelist.php?{$rand}">{$b8.l}{$langs_top.t9}{$b8.r}</a> |
			<a href="botlist.php?{$rand}">{$b9.l}{$langs_top.t10}{$b9.r}</a> |
			<a href="uninstall.php?{$rand}">{$b10.l}{$langs_top.t11}{$b10.r}</a> |
			<a href="logout.php?{$rand}">{$b11.l}{$langs_top.t12}{$b11.r}</a>
			<p>
				{if $fc_admin_chat_instance!='' && $IS_ADMIN == 1 && $chat_instances|@count>1}
				Load another chat instance:
  	          		<SELECT NAME=instances onchange='submit();' >
			   			{foreach name=name from=$chat_instances item=val key=key}
			    			<OPTION VALUE={$val.id}    {if $val.id == $instance_ID}selected{/if}>{$val.name}
		       			{/foreach}
	          		</SELECT>
	         		<input type="Hidden" value="{$module}" name="module">
				{/if}</p>

        </form>
		</center>
		<hr>
