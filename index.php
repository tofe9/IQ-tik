<?php
require_once './application/Connection.php';
/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
	$system_path = './application/system';
/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 * For more info please see the user guide:
 *
 *
 * NO TRAILING SLASH!
 */
	$application_folder = 'application';
/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system directory
define('BASEPATH', $system_path);
// UPDATE 
$fien_update = 'update.php';
if (file_exists($fien_update)) {
	require($fien_update);
}


//-- Homepage
	$page = 'home';
//--
	if (isset($_GET['url'])) {
		$page = $_GET['url'];
	}
//--
	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG
	}
//--
if (is_dir($application_folder)) {
	//--
	$load->true_eden_panel = false;
	//--
	if (file_exists("./pages/$page/index.php")) {
		require_once("./pages/$page/index.php");
	}
	if (empty($load->content)) {
	   require_once("./application/includes/error_system/404.php");
	}
	#--
	//-- View
	$final_content = PHP_LoadPage('open_theme', array(
		'CONTAINER_TITLE' 		=> mb_substr($load->title, 0, 400, "UTF-8"),
		'CONTAINER_NAME' 		=> $config['name_site'],
		'CONTAINER_KEYWORDS' 	=> empty($load->keywords)?$load->config->keyword:$load->keywords,
		'CONTAINER_CONTENT' 	=> $load->content,
		'CONTAINER_DESC' 		=> mb_substr($load->description, 0, 400, "UTF-8"),
		'CONTAINER_IMAGE' 		=> empty($load->image_og)?$config['theme_url'].'/img/image_meta.png':$load->image_og,
		'CONTAINER_URL' 		=> mb_substr($load->actual_link, 0, 400, "UTF-8"),
		'MAIN_URL' 				=> $load->actual_link,
		'HEADER_LAYOUT' 		=> '',
		'ADS_ONE_CODE' 			=> htmlspecialchars_decode($load->config->ads_one),
		'ADS_TWO_CODE' 			=> htmlspecialchars_decode($load->config->ads_two),
		'EXTRA_TOP' 			=> ($load->true_eden_panel)?PHP_LoadPage('template/eden_themes/head_link'):PHP_LoadPage('extra-top/index'),
		'EXTRA_BOTTOM' 			=> ($load->true_eden_panel)?PHP_LoadPage('template/eden_themes/bottom'):PHP_LoadPage('extra-bottom/index'),
		'FOOTER_LAYOUT' 		=> '',
		'INCLUDE_HEADER' 		=> PHP_LoadPage('template/header',array(
			'DATA_FACEBOOK' 		=> ($load->config->facebook == null) ? '' : '<li><a href="'.$load->config->facebook.'"><span><i class="icon_red_i_facebook fab fa-facebook-square"></i> facebook</span></a></li>' ,
			'DATA_TWITTER' 			=> ($load->config->twitter == null) ? '' : '<li><a href="'.$load->config->twitter.'"><span><i class="icon_red_i_twitter fab fa-twitter-square"></i> twitter</span></a></li>' ,
			'DATA_EMAIL' 			=> ($load->config->email_web == null) ? '' : '<li><span><i class="icon_red_i_mail fas fa-envelope-square"></i> Contact Us</span></li>' ,
			'ME_USER_ID' 			=> ''
		)),
		'INCLUDE_FOOTER' 		=> PHP_LoadPage('template/footer',array()),
			'NAME_SITE' 			=> PHP_Secure($load->config->name).' ',
			'DATA_YEAR' 			=> date('Y')
	));
	echo $final_content;
}else{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
	exit(3); // EXIT_CONFIG
} 
$db->disconnect();
unset($load);
ob_flush();
?>