<?php /* Smarty version 2.6.10, created on 2008-09-17 17:49:40
         compiled from cnf_view.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>View</title>
</head>

<body>
<?php if ($this->_tpl_vars['ext'] == 'swf'): ?>
	<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" WIDTH="100%" HEIGHT="100%">
	<PARAM name="movie" value="<?php echo $this->_tpl_vars['patch']; ?>
">
	<PARAM name="quality" value="hight">

	<EMBED src="<?php echo $this->_tpl_vars['patch']; ?>
" quality="high" WIDTH="100%" HEIGHT="100%" TYPE="application/x-shockwave-flash">
	</EMBED>

	</OBJECT>
<?php else: ?>
	<img border='1' src="<?php echo $this->_tpl_vars['patch']; ?>
">
<?php endif; ?>
</body>
</html>