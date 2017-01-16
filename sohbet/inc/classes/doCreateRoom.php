<?php

/*$stmt = new Statement("INSERT INTO {$GLOBALS['fc_config']['db']['pref']}rooms (created, name, password, ispublic) VALUES (NOW(), ?,?,?)");

$id       = $stmt->process($label, $pass, (($isPublic)?'y':null));*/
//changed on 090706 for chat instances
$stmt = new Statement('INSERT INTO '.$GLOBALS['fc_config']['db']['pref'].'rooms (created, name, password, ispublic, instance_id) VALUES (NOW(), ?,?,?,?)', 58);
$id = $stmt->process($label, $pass, (($isPublic)?'y':null), $this->session_inst);
//changed on 090706 for chat instances ends here

$msg = new Message('adr', null, $id, $label);
$msg_lock = new Message('srl', null, $id, 'true');
if($isPublic)
{
	$this->sendToAll($msg);
	if($pass != '')
	{
		$this->sendToAll($msg_lock);
	}
}
else
{
	$this->sendBack($msg);
	if($pass != '')
	{
		$this->sendBack($msg_lock);
	}
}

return $id;

?>