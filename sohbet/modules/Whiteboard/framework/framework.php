<?php

include_once 'dbconnector.php';

//
class Framework{

	var $db;
	var $usersList;

	function Framework()
	{
		$GLOBALS['CHAT_ROOT_DIR'] = '../../../';	
				
		include_once "{$GLOBALS['CHAT_ROOT_DIR']}/inc/common.php";
				
		$this->db = new DbConnector();		
		$this->db->connectToDB();
		
		$this->initTables();
	}
	
	function initTables()
	{
		//setup table for messages
		$sql = 	"CREATE TABLE IF NOT EXISTS `{$GLOBALS['fc_config']['db']['pref']}whiteboard_msg` (
				  `id` int(11) NOT NULL auto_increment,
				  `created` timestamp(14) NOT NULL,
				  `touserid` int(11) default NULL,
  				  `userid` int(11) default NULL,
				  `message` text default NULL,
				  `unread` int(1) default 1,
				  PRIMARY KEY  (`id`),
				  KEY `userid` (`userid`),
			      KEY `created` (`created`)
				) TYPE=MyISAM AUTO_INCREMENT=1;";
		$this->db->dbExec( $sql );
		
		//setup table for files
		$sql = 	"CREATE TABLE IF NOT EXISTS `{$GLOBALS['fc_config']['db']['pref']}whiteboard_drawings` (
				  `id` int(11) default NULL auto_increment,
				  `userid` int(11) default NULL,
				  `drawing_name` text default NULL,
				  `drawing_msg` text default NULL,
				  PRIMARY KEY  (`id`),
				  KEY `userid` (`userid`)
				) TYPE=MyISAM AUTO_INCREMENT=1;";
		
		$this->db->dbExec( $sql );
	}
	
	function getActiveUsers()
	{
		$xml = "<users>\n";
		
		$table1 = "{$GLOBALS['fc_config']['db']['pref']}connections";
		$sql = "SELECT $table1.userid FROM $table1 WHERE userid <> ''";
			
		$this->usersList = $this->db->dbQurey( $sql );
		for($i=0;$i < count( $this->usersList );$i++)
		{
			$user = ChatServer::getUser($this->usersList[$i]["userid"]);
			$attributes = array( "userid" => $this->usersList[$i]["userid"],
					  	         "login"  => $user["login"] );
			
			$xml .= $this->xmlTagCover("user", $attributes, NULL )."\n";
		}
		$xml .= "</users>";
	
		return $xml;
	}
	
	function doSendMesasge( $touserid, $userid, $message )
	{
		$table = "{$GLOBALS['fc_config']['db']['pref']}whiteboard_msg";
		$sql = "INSERT INTO $table VALUES ( NULL, NULL, $touserid, $userid, '$message', 1 )";
		
		$this->db->dbExec( $sql );
	}

	function doSaveMesasge( $userid, $drawingname, $message )
	{
		$table = "{$GLOBALS['fc_config']['db']['pref']}whiteboard_drawings";
		$sql = "INSERT INTO $table VALUES ( NULL, $userid, '$drawingname' , '$message' )";
		
		$this->db->dbExec( $sql );
	}


	function doGetMesasge( $userid )
	{	
		$table1 = "{$GLOBALS['fc_config']['db']['pref']}whiteboard_msg";
		$sql  = "SELECT $table1.* FROM $table1 ";
		$sql .= "WHERE $table1.touserid=$userid AND unread=1 ORDER BY created LIMIT 1";

		$messages = $this->db->dbQurey( $sql );

		//print $sql;
		
			if( count($messages) == 0 )
				return "<message />";
			
			$user = ChatServer::getUser($messages[0]["userid"]);
			$attributes = array(	"msgid"		=> $messages[0]["id"],
									"userid"	=> $messages[0]["userid"],
									"username"	=> $user["login"] );
			$message = $messages[0]["message"];
			
			$xml = $this->xmlTagCover("message", $attributes, $message);
			$xml = $this->xmlTagCover("messages", array(), $xml );
		
		return $xml;		
	}
	
	function doMarkMsgAsRead( $msgid )
	{
		$table1 = "{$GLOBALS['fc_config']['db']['pref']}whiteboard_msg";
		$sql = "UPDATE $table1 SET unread=0 WHERE id=$msgid";
		$this->db->dbExec( $sql );	
	}
	
	function doRemoveMessage( $drawingid )
	{
		$table1 = "{$GLOBALS['fc_config']['db']['pref']}whiteboard_drawings";
		$sql = "DELETE FROM $table1 WHERE id=$drawingid LIMIT 1";
		$this->db->dbExec( $sql );	
	}		

	function doLoadMesasge( $userid, $drawingid )
	{	
		$table = "{$GLOBALS['fc_config']['db']['pref']}whiteboard_drawings";
		$sql = "SELECT * FROM $table WHERE userid=$userid AND id=$drawingid LIMIT 1";
		$messages = $this->db->dbQurey( $sql );

			if( count($messages) == 0 )
				return "<message />";
			
			$message = $messages[0]["drawing_msg"];
						
			$xml = $this->xmlTagCover("message",  array(), $message);
			$xml = $this->xmlTagCover("messages", array(), $xml );
		
		return $xml;		
	}
	
	function doLoadMesasgeList( $userid  )
	{	
		$table = "{$GLOBALS['fc_config']['db']['pref']}whiteboard_drawings";
		$sql = "SELECT * FROM $table WHERE userid=$userid";
		$drawings = $this->db->dbQurey( $sql );

			if( count($drawings) == 0 )
				return "<drawings />";
			
			$xml = "<drawings>\n";
		
			for($i=0;$i < count( $drawings );$i++)
			{
				$attributes = array( "id"	=> $drawings[$i]["id"],
						  	         "name" => $drawings[$i]["drawing_name"] );
				
				$xml .= $this->xmlTagCover("drawing", $attributes, NULL )."\n";
			}
			
			$xml .= "</drawings>";
						
//			$xml = $this->xmlTagCover("message",  array(), $message);
//			$xml = $this->xmlTagCover("messages", array(), $xml );
		
		return $xml;		
	}

	///////////////////////
	//additional functions
	
	function xmlTagCover( $tagName, $attributes , $tagStuff )
	{
		$xml = "<$tagName";
		
		while (list($key, $value) = each ($attributes))
			$xml .= " $key=\"$value\"";
			
		if( isset($tagStuff) ){
			$xml .= ">\n";
			$xml .= "$tagStuff\n";
			$xml .= "</$tagName>";
		}
		else
			$xml .= " />";
		
		//print $tagStuff.",";
		
		return $xml;
	}
	
}

?>