	<meta charset="UTF-8">
	<title>Videoit | Installation</title>
	<link rel="shortcut icon" type="image/png" href="./install/favicon.png"/>
	<link type="text/css" rel="stylesheet" href="./install/style_i.css?=1">
	<script type="text/javascript" src="./install/jquery.min.js"></script> 
	<header class="header_index">
	</header>
<?php
	require_once ("launcher.php");
	$plugin_action = 'eula';
	$pages_array = array(
						'admin_save',
						'tems',
						'installation',
						'upload',
						'info',
						'admin'
					);
	if (!empty($_GET['action'])) {
		if (in_array($_GET['action'], $pages_array)) {
			$plugin_action = $_GET['action'];
		}
	}

				$name_script 		= 'Videoit';
				$version 			= 'Version:'.$options_launcher['script_version'];
				$cURL 				= true;
				$php 				= true;
				$gd 				= true;
				$disabled 			= false;
				$mysqli 			= true;
				$is_writable 		= true;
				$mbstring 			= true;
				$is_htaccess 		= true;
				$is_mod_rewrite 	= true;
				$is_sql 			= true;
				$zip 				= true;
				$allow_url_fopen 	= true;
				$exif_read_data 	= true;
				if (!function_exists('curl_init')) {
					$cURL 			= false;
					$disabled 		= true;
				}
				if (!function_exists('mysqli_connect')) {
					$mysqli 		= false;
					$disabled 		= true;
				}
				if (!extension_loaded('mbstring')) {
					$mbstring 		= false;
					$disabled 		= true;
				}
				if (!extension_loaded('gd') && !function_exists('gd_info')) {
					$gd 			= false;
					$disabled 		= true;
				}
				if (!version_compare(PHP_VERSION, '7.0.0', '>=')) {
					$php 			= false;
					$disabled 		= true;
				}
				if (!is_writable('config.php')) {
					$is_writable 	= false;
					$disabled 		= true;
				}
				if (!file_exists('.htaccess')) {
					$is_htaccess 	= false;
					$disabled 		= true;
				}
				if (!file_exists('db.sql')) {
					$is_sql 		= false;
					$disabled 		= true;
				}
				if (!extension_loaded('zip')) {
					$zip 			= false;
					$disabled 		= true;
				}
				if(!ini_get('allow_url_fopen') ) {
					$allow_url_fopen= false;
					$disabled 		= true;
				}
				//-->
	switch ($plugin_action) {
 
		case 'admin_save':
			require_once './application/Connection.php';
			PHP_Admin_Data('24','UPDATE',PHP_Secure($_POST['email']));
			PHP_Admin_Data('25','UPDATE',sha1(PHP_Secure($_POST['password'])));
			$rename = 'plugins_'.PHP_GetKey(15,25);
			rename('plugins', $rename);
			$launcher_data = array(
				'script_version'		=> $version,
				'plugins_dir'			=> $rename,
				'crypt_secret_key'		=> 'user_'.PHP_GetKey(10,18),
				'crypt_password'		=> PHP_GetKey(15,20).time(),
				'email_admin_recovery'	=> PHP_Secure($_POST['email_admin_recovery'])
			);
			ADMIN_Launcher_Options($launcher_data);
?>
	<meta http-equiv="Refresh" content="8;url=./">
	<center>
		<p class="wall_info_p">the information is being processed</p>
	</center>
<?php						
		break;
		case 'admin':
 			include('./install/steps/step_5.php');		 
		break;
		case 'upload':
			include('./install/steps/step_4.php');
		break;					
		case 'installation':
			include('./install/steps/step_3.php');
		break;	
		case 'info':
 			include('./install/steps/step_2.php');	
		break;
		case 'tems':
 			include('./install/steps/step_1.php');	
		break;
		default:
			include('./install/steps/step_0.php');
		break;
	}	
?> 
<style type="text/css">
    button:disabled {
		color: #fff !important;
		background: #d8d8d8;
		border: 1px solid #949494;
    }
</style>
<script type="text/javascript">
function SubmitButton() {
    $('button').attr('disabled', true);
    $('button').text('Please wait..');
    $('form').on('submit');
}
    (function($) {
        $('#agree').change(function() {
            if($(this).is(":checked")) {
                $('#next-terms').attr('disabled', false);
            } else {
            	$('#next-terms').attr('disabled', true);
            }       
        });
    })(jQuery);
</script>