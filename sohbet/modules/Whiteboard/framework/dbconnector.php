<?php
	class DbConnector{

		var $connectionLink;
		
		function connectToDB()
		{
			$dbhost = $GLOBALS['fc_config']['db']['host'];
			$dbuser = $GLOBALS['fc_config']['db']['user'];
			$dbpass = $GLOBALS['fc_config']['db']['pass'];
			$dbname = $GLOBALS['fc_config']['db']['base'];
			$dbpref = $GLOBALS['fc_config']['db']['pref'];
		
			if($this->connectionLink = @mysql_connect($dbhost, $dbuser, $dbpass)){
				if(! mysql_select_db($dbname, $this->connectionLink))
					die( mysql_error() );
			}
			else
				die( mysql_error() );
		}
	
		function dbQurey($query)
		{
			$result	= mysql_query( $query , $this->connectionLink );
			$num	= mysql_num_rows($result);
			$resArray = array();

			for ($i = 0; $i < $num; $i++)
				$resArray[$i] = mysql_fetch_assoc( $result );
				
			return $resArray;
		}
		
		function dbExec($query)
		{
			$result	= mysql_query( $query , $this->connectionLink );
		}
	}
?>