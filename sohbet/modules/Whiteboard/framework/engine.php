<?php	

	//if( !isset( $_POST['action'] ) )	
	//	return;

	include_once 'framework.php';
	
	//create framework
	$appServer = new Framework();
	
	$actions = explode(";",$_POST['doCommand']);
	
	for($i=0;$i < count($actions)-1;$i++)
	{
		$command = explode(":",$actions[$i]);
		$doAction	= $command[0];
		$onHandler	= $command[1];
		
		switch( $doAction )
		{
			case "doGetActiveUsers":
					print "<event handler=\"{$onHandler}\">\n";
					print $appServer->getActiveUsers();
					print "\n</event>\n";
					break;
					
			case "doGetMessage":
					print "<event handler=\"{$onHandler}\">\n";
					print $appServer->doGetMesasge( $_POST['userid'] );
					print "\n</event>\n";
					break;
					
			case "doSendMessage":
					$appServer->doSendMesasge( $_POST['touserid'], $_POST['userid'], $_POST['message'] );
					break;
					
			case "doSaveMessage":
					$appServer->doSaveMesasge( $_POST['userid'], $_POST['drawingname'], $_POST['message'] );
					break;
					
			case "doMarkMsgAsRead":
					$appServer->doMarkMsgAsRead( $_POST['msgid'] );
					break;
					
			case "doRemoveMessage":
					$appServer->doRemoveMessage( $_POST['drawingid'] );			
					break;
					
			case "doLoadMessage":
					print "<event handler=\"{$onHandler}\">\n";
					print $appServer->doLoadMesasge( $_POST['userid'], $_POST['drawingid'] );
					print "\n</event>\n";
					break;

			case "doLoadMessageList":
					print "<event handler=\"{$onHandler}\">\n";
					print $appServer->doLoadMesasgeList( $_POST['userid'] );
					print "\n</event>\n";
					break;					
		}	
	}

?>