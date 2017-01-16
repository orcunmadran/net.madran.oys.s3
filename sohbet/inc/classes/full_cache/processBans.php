<?php

$this->result = array();
$file_name = $this->getCachFileName('Bans');


if( $this->code_sql == 252 )//$this->queryStr=="SELECT * FROM {$GLOBALS['fc_config']['db']['pref']}bans WHERE (banneduserid=? OR ip=?) AND roomid IS NULL"
{
	$content = file( $file_name );
	$allUsers = array();
	for( $i=0 ; $i < sizeof($content) ; $i++ )
	{
		$buffer = $content[$i];
		$array = explode("\t",$buffer);

		if( ($array[2]==$params[0] || $array[4]==$params[1]) && $array[3]==$params[2] )
		{
			$array['created'] = $array[0];
			$array['userid'] = $array[1];
			$array['banneduserid'] = $array[2];
			$array['roomid'] = $array[3];
			$array['ip'] = $array[4];
			$array = $this->unsetAll($array);
			$allUsers[] = $array;
		}
	}
	//return $allUsers;
	return new ResultSet1( $allUsers );
}
elseif( $this->code_sql==270 || strpos($this->queryStr, 'INSERT INTO')!==FALSE )
{

	if( $file_name == null )
	{
		$cacheDir = $this->getCachDir();
		$cachePath = $cacheDir->path;
		$file_name = $cachePath.$GLOBALS['fc_config']['db']['pref'].'bans_'.$GLOBALS['fc_config']['cacheFilePrefix'].'_'.$_SESSION['session_inst'].'.txt';
	}
	$file = @fopen($file_name,'a');
	$str = date('Y-m-d H:i:s')."\t".$params[0]."\t".$params[1]."\t".$params[2]."\t".$params[3]."\t".$params[4]."\t\n";

	
	@fwrite($file, $str);
	fflush($file);
	@fclose($file);
	$this->result = array();
	return true;
}
elseif( $this->code_sql==253 )//$this->queryStr=='SELECT * FROM '.$GLOBALS['fc_config']['db']['pref'].'bans WHERE banneduserid=? AND roomid=?'
{
	//$handle = @fopen($file_name, 'r');
	$total = '';
	$allUsers = array();
	$content = file($file_name);
	for( $i=0 ; $i < sizeof($content) ; $i++ )
	{
		$buffer = $content[$i];

		if( $buffer=='' )
			continue;

		$array = explode("\t",$buffer);
		if( $array[2]==$params[0] && $array[3]==$params[1] )
		{
			$array['created'] = $array[0];
			$array['userid'] = $array[1];
			$array['banneduserid'] = $array[2];
			$array['roomid'] = $array[3];
			$array['ip'] = $array[4];

			$array = $this->unsetAll($array);

			$allUsers[] = $array;
		}
	}
	return new ResultSet1( $allUsers );
}
elseif( $this->code_sql==272 )//$this->queryStr=="SELECT count"
{
	$content = file($file_name);
	$total = 0;
	$allUsers = array();

	for( $i=0 ; $i < sizeof($content) ; $i++ )
	{
		$buffer = $content[$i];

		if( $buffer=='' )
			continue;

		$total++;
	}
	
	$allUsers[]['msgnumb'] = $total;
	return new ResultSet1($allUsers);
}
elseif( $this->code_sql==254 )//$this->queryStr=="SELECT * FROM {$GLOBALS['fc_config']['db']['pref']}bans ORDER BY userid"
{
	$content = file($file_name);
	$total = '';
	$allUsers = array();

	for( $i=0 ; $i < sizeof($content) ; $i++ )
	{
		$buffer = $content[$i];

		if( $buffer=='' )
			continue;

		$array = explode("\t",$buffer);
		$array['created'] = $array[0];
		$array['userid'] = $array[1];
		$array['banneduserid'] = $array[2];
		$array['roomid'] = $array[3];
		$array['ip'] = $array[4];
		$array = $this->unsetAll($array);
		$allUsers[] = $array;
	}
	return new ResultSet1($allUsers);
}
elseif( $this->code_sql==271 || $this->queryStr=='SELECT roomid FROM '.$GLOBALS['fc_config']['db']['pref'].'bans WHERE banneduserid=?' )
{
	$handle = @fopen($file_name, "r");
	$total = '';
	$allUsers = array();
	while (!feof($handle))
	{
    	$buffer = fgets($handle);
		$array = explode("\t",$buffer);

		if( $array[2]==$params[0] )
		{
			$array['created'] = $array[0];
			$array['userid'] = $array[1];
			$array['banneduserid'] = $array[2];
			$array['roomid'] = $array[3];
			$array['ip'] = $array[4];
			$array['instance_id'] = 1;
			
			$array = $this->unsetAll($array);
			$allUsers[] = $array;
		}
	}
	@fclose($handle);
	return new ResultSet1( $allUsers );
}//
elseif( $this->code_sql==256 )//$this->queryStr=="DELETE FROM {$GLOBALS['fc_config']['db']['pref']}bans WHERE banneduserid=? AND roomid IS NOT NULL"
{
	//$file_name = $this->getCachFileName('Ignors');
	$handle = @fopen($file_name, "r");
	$total = '';
	$allUsers = array();
	while (!feof($handle))
	{
    	$buffer = fgets($handle);
		$array = explode("\t",$buffer);
		if( $buffer=='' )
			continue;

		if( $array[3]!='' && (int)$array[2]==(int)$params[0] )// && $array[2]!=$params[1]
			continue;
		$total .= $buffer;
	}
	@fclose($handle);
	$handle = fopen($file_name, 'w');
	fwrite($handle,$total);
	fflush($handle);
	fclose($handle);
	return true;
}
elseif( $this->code_sql == 251 )
{
	$content = file($file_name);
	$total = '';
	$allUsers = array();

	for( $i=0 ; $i<sizeof( $content ) ; $i++ )
	{
		$buffer = $content[$i];
		$array = explode("\t",$buffer);
		if( $buffer=='' )
			continue;

		if( $array[3]!='' && (int)$array[2]==(int)$params[0] )// && $array[2]!=$params[1]
			continue;
		$total .= $buffer;
	}

	$handle = fopen($file_name, 'w');
	fwrite($handle,$total);
	fflush($handle);
	fclose($handle);
	return true;
}
elseif( $this->code_sql == 274 )
{
	$content = file($file_name);
	$total = '';
	$allUsers = array();

	for( $i=0 ; $i<sizeof( $content ) ; $i++ )
	{
		$buffer = $content[$i];
		$array = explode("\t",$buffer);
		if( $buffer=='' )
			continue;

		if( (int)$array[2]==(int)$params[0] )// && $array[2]!=$params[1]
			continue;
			
		$total .= $buffer;
	}

	$handle = fopen($file_name, 'w');
	fwrite($handle,$total);
	fflush($handle);
	fclose($handle);
	return true;
}
elseif( $this->code_sql==255 )//$this->queryStr=="SELECT * FROM {$GLOBALS['fc_config']['db']['pref']}bans WHERE banneduserid=?"
{
	//$handle = @fopen($file_name, "r");
	$content = file($file_name);
	$total = '';
	$allUsers = array();

	for( $i=0 ; $i < sizeof($content) ; $i++ )
	{
		$buffer = $content[$i];
		if( $buffer=='' )
			continue;

		$array = explode("\t",$buffer);

		if( $array[2]==$params[0] )
		{
			$array = explode("\t",$buffer);
			$array['created'] = $array[0];
			$array['userid'] = $array[1];
			$array['banneduserid'] = $array[2];
			$array['roomid'] = $array[3];
			$array['ip'] = $array[4];
			$array = $this->unsetAll($array);
			$allUsers[] = $array;
		}
	}

	return new ResultSet1($allUsers);
}
elseif( $this->code_sql==271 )//$this->queryStr=="SELECT * FROM {$GLOBALS['fc_config']['db']['pref']}bans WHERE banneduserid=?"
{
	//$handle = @fopen($file_name, "r");
	$content = file($file_name);
	$total = '';
	$allUsers = array();
	foreach( $content as $key=>$val )
	{
		if( trim($val)=='' )
			continue;
		
		$array = explode("\t",$val);
		$today = date('Y-m-d H:i:s');//
		if( $array[0]==$params[3]  )
		{
			$userID = $array[1];
			$total = $total.$today."\t".$params[0]."\t".$params[3]."\t".$params[1]."\t".$params[2]."\t1\t\n";
		}
		else
			$total = $total.$val;
	}


	$file = @fopen($file_name,'w');
	@fwrite($file , $total);
	fflush($file);
	@fclose($file);
	return true;
}
elseif( $this->code_sql==280 )//$this->queryStr=="SELECT * FROM {$GLOBALS['fc_config']['db']['pref']}bans WHERE banneduserid=?"
{
	//$handle = @fopen($file_name, "r");
	$content = file($file_name);
	$total = '';
	$allUsers = array();
	foreach( $content as $key=>$val )
	{
		if( trim($val)=='' )
			continue;
		
		$array = explode("\t",$val);
		$today = date('Y-m-d H:i:s');//
		if( $array[0]==$params[3]  )
		{
			$userID = $array[1];
			$total = $total.$today."\t".$array[1]."\t".$params[3]."\t".$params[2]."\t".$params[3]."\t1\t\n";
		}
		else
			$total = $total.$val;
	}


	$file = @fopen($file_name,'w');
	@fwrite($file , $total);
	fflush($file);
	@fclose($file);
	return true;
}
?>