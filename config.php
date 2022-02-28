<?php

// +------------------------------------------------------------------------+
// | @author_email: game123727@gmail.com   
// +------------------------------------------------------------------------+
// | Videoit - Proudly created with PHP.
// | Copyright (c) 2020 Videoit. All rights reserved.
// +------------------------------------------------------------------------+
/*
Any doubt or failure in the system takes a capture and sends the creator in support
*/

header("Location:install.php");

ob_start();
#----> Host name
$dbhost			= 'localhost';
#----> Batabase name
$dbdatabase		= ''; 
#----> User of the DB
$dbuser			= '';
#----> Password of the DB
$dbpassword		= ''; 

// URL web
$site_url = '';

?>