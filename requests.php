<?php
require_once './application/Connection.php';
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
error_reporting(E_ALL);
$data_load      = array();
$errors   		= array();
$type        	= '';
$second       	= '';
$upload        	= (!empty($_GET['upload'])) ? PHP_Secure($_GET['upload']) : '';	 
$pages 			= array('process_graphics');
	
	if (in_array($upload, $pages)) {
		$file = PHP_Secure($_GET['upload']);
		if (file_exists("./upload_ajax/$file.php")) {
			require "./upload_ajax/$file.php";
		}
	}else{	
		//--> token
		$matchToken 	= PHP_matchToken('mailer'); 
		if(true){
			 
			if (!empty($_GET['second'])) {
				$second = PHP_Secure($_GET['second']);
			}
			if (!empty($_GET['upload'])) {
				$file 	= PHP_Secure($_GET['upload']);
				if (file_exists("./upload_ajax/$file.php")) {
					require "./upload_ajax/$file.php";
				} else if (file_exists("./application/plugins/$file.php")) {
					require "./application/plugins/$file.php";
				} else {
					$data_load = array('error' => 404, 'error_message' => 'type not found');
				}
			}
		}else{
			$data_load['status']  = 203;
			$data_load['message'] = 'error token';
		}
		
		$data_load['token_web']  = PHP_fetchToken('mailer');
		
		header('Content-Type: application/json');		 
		echo json_encode($data_load);
		exit();
	}
?>
 