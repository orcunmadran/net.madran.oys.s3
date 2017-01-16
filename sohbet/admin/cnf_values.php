<?php
	define('CONFIG_FILE', INC_DIR . 'config.php');
	
	$cmss = array(
				'aedatingCMS' => 'aeDating 2.0/3.0 (FlashChat is built in to aeDating 3.x)',
				'aedatingCMS2'=> 'aeDating 2.0/3.0 (which only permits access to Gold members)',
				'aedating4CMS'=> 'aeDating 4.0',
				'azdgCMS'     => 'AZDG Dating Lite 2.1.2',
				'cpgNukeCMS'  => 'CPGNuke',
				'datingProCMS'=> 'Dating Pro',
				'e107CMS'     => 'e107 0.617',
				'eMeetingCMS' => 'eMeeting',
				'efriendsCMS497' => 'Alstrasoft E-friends 4.9.7',
				'fusionCMS'   => 'PHP Fusion 4.0.0',
				'fusionCMS2'  => 'PHP Fusion 5.0.1',
				'fusion6CMS'  => 'PHP Fusion 6',
				'geeklogCMS'  => 'GeekLog 1.3.9',
				'joomlaCMS'	  => 'Joomla 1.1',
				'ipbCMS'      => 'Invision Power Board (IPB) 2.0.0',
				'ipbCMS2'     => 'Invision Power Board (IPB) 2.0.3',
				'ipbCMS2'     => 'Invision Power Board (IPB) 2.1.0',
				'lunabyteCMS' => 'LunaByte / Enigma 1.3',
				'mamboCMS'    => 'Mambo 4.5.0',
				'mamboCMS2'   => 'Mambo 4.5.2',
				'mdproCMS'    => 'MD-Pro 1.0.7',
				'moodleCMS'   => 'Moodle',
				'moodle16CMS' => 'Moodle 1.6',
				'moodle17CMS' => 'Moodle 1.7',
				'moodle18CMS' => 'Moodle 1.8',
				'moodle19CMS' => 'Moodle 1.9',
				'osdateCMS'   => 'osDate Dating System',
				'phpBB2CMS'	  => 'phpBB 2.0.10 and above',
				'phpBB2021CMS'	  => 'phpBB 2.0.21 and above',
				'phpBB3CMS'	  => 'phpBB 3.0.B2 and above',
				'phpBB307CMS'	  => 'phpBB 3.0.RC8 and above',
				//'phpNukeModCMS'	=> 'PHP-Nuke 7.3(module version)',
				'phpNukeCMS73'	=> 'PHP-Nuke 7.3',
				'phpNukeCMS76'	=> 'PHP-Nuke 7.6',
				'phpNukeCMS78'	=> 'PHP-Nuke 7.8',
				//'postNukeModCMS'	=> 'PostNuke 0.726-3(module version)',
				'postNukeCMS'	=> 'PostNuke 0.726-3',
				'postNukeCMS0762'	=> 'PostNuke 0.762',
				'smfCMS'	=> 'Simple Machines 1.0',
				'smfCMS2'	=> 'Simple Machines 1.1',
				'ubbCMS'	=> 'UBB.Threads 6.5',
				'ubb70CMS'	=> 'UBB.Threads 7.0',
				'ubb71CMS'	=> 'UBB.Threads 7.1',
				'vbulletin30CMS'=> 'vBulletin 3.0',
				'vbulletin35CMS'=> 'vBulletin 3.5',
				'vbulletin36CMS'=> 'vBulletin 3.6',
				'webDateCMS'    => 'Web Date',
				'wotCMS2'	=> 'WoltLab Burning Board 2.3.4',
				'wowCMS'	=> 'WowBB 1.6.1',
				'wowCMS2'	=> 'WowBB 1.6.2',
				'wowCMS165'	=> 'WowBB 1.6.5',
				'wowCMS170'	=> 'WowBB 1.7',
				'xmbCMS'	=> 'XMB 1.9.1',
				'xoopsCMS'	=> 'Xoops 2.0.7',
				'xoops2016CMS'	=> 'Xoops 2.0.16',
				'phpkitCMS' => 'phpkit 1.6.1',
				'MyBBCMS'	=> 'MyBB 1.0',
				'easysiteCMS' => 'EasySite 3.2.5',
				'SBDatingCMS' => 'Softbiz Dating',
				'phpFox108' => 'phpFox 1.0.8',
				'phpFox11' => 'phpFox 1.1',
				'inspirations31CMS'   => 'Inspirations 3.1',
				'drupalCMS' => 'Drupal',
	);
	
	$value['listOrder']= array('Alphabetical, A to Z', 'Order by entry to room', 'Mods & Admins first, then A to Z', 'Mods & Admins first, then by entry', 'Order by user status', 'Mods & Admins first, then by user status');	
	$value['CMSsystem'] = $cmss;
	$value['CMSsystem'] = array_merge(array('statelessCMS'=>'Stateless CMS (free for all
									users)'),array('defaultCMS'=>'Default CMS'),$cmss);
	$value['anchor'] = range(-1,12);
	$value['window'] = array('_self','_blank','_parent','_top');
	$value['defaultSkin'] = $GLOBALS['fc_config']['skin'];
	$value['defaultTheme'] = array_flip( array_keys($GLOBALS['fc_config']['themes']) );	
	foreach( $value['defaultTheme'] as $k=>$v)
	{
		$value['defaultTheme'][$k] = $k;
	}
		
	$value['alignment'] = array('top','left','center','right');
	$value['text_type'] = array('text','password');	
	
	//--greate array of language$GLOBALS['fc_config']['themes']
	foreach($GLOBALS['fc_config']['languages'] as $k=>$v)
		$value['defaultLanguage'][$k] = $v['name'];
	
	
?>