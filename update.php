<?php 
	 
	$launcher_data = array(
		'script_version' => '1.1.5.0',
	);
	ADMIN_Launcher_Options($launcher_data);
	unlink('update.php');