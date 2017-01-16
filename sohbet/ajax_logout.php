<?php
	function tLg1($title, $str)
	{
		return;
		$fname = 'log_out.txt';

		$fp = @fopen($fname, 'a');
		@fwrite($fp,"\n//-----------------------------------------------------");
		@fwrite($fp,"\n//----$title");
		@fwrite($fp,"\n//-----------------------------------------------------");

		if(is_array($str))
		{
			ob_start();
			print_r($str);
			$str = ob_get_contents();
			ob_end_clean();
		}

		@fwrite($fp, "\n".$str);
		@fclose($fp);
	}

	if( isset($_REQUEST['id']) )
	{
		require_once('inc/common.php');
		$GLOBALS['my_file_name'] = 'dologout';
		$msg = 'Logging out from the chat...';
		$req = array(
			'id' => $_REQUEST['id'],
			'c'  => 'lout',
		);

		$conn =& ChatServer::getConnection($_REQUEST);
		$conn->process($req);

		$stmt = new Statement('DELETE FROM '.$GLOBALS['fc_config']['db']['pref'].'connections WHERE id = ?', 223);
		$stmt->process($rec['id']);
	}
?>