<?php
//require_once( 'config.socketSrv.php' );

$GLOBALS['my_file_name'] = 'settings';

require_once('../common.php');
$xml = "<socketServer";
$str = "";
foreach( $GLOBALS['fc_config']['socketServer'] as $key=>$val )
	$str = $str." $key=\"$val\" ";

$xml = $xml.$str."errorReports=\"".$GLOBALS['fc_config']['errorReports']."\" />";//errorReports

echo $xml; 

?>