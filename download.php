<?php
	require_once './application/Connection.php';
	require_once './application/system/function_security.php'; 
	set_time_limit(0);
	ini_set("zlib.output_compression", "Off");
//-->	
	function PHP_clear_string($data){
		$data = stripslashes(trim($data));
		$data = strip_tags($data);
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}

	function PHP_xss_clean($data){
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}
	
	function sanitize_filename($string, $type = 'mp4'){
		$string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
		if (empty(trim($string, ' -'))) {
			$name = generate_string();
		} else {
			$name = $string;
		}
		if ($type == NULL) {
			$file_name = $name . ".mp4";
		}else{
			$file_name = $name . "." . $type;
		}
		
		return str_replace(array("\r", "\n"), "", $string = utf8_decode(mb_substr($file_name, 0, 1000, "UTF-8")));
	}

	function generate_string($length = 10){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	

	//-- with the base64() function we use it to avoid errors of special carat	
	$headers_url 	= PHP_DatesCrypt('decrypt', $_REQUEST["url_video"]);//-- id with the video link
	$headers_title 	= str_replace(" ", "_", $_REQUEST["title"]);//-- id with the name of the video	
	$Formats 		= $_REQUEST["type_format"];
	$size_file 		= $_REQUEST["size_file"];
	

	//-- here ends the name of the video with the format
	$fileName = PHP_clear_string(PHP_xss_clean($headers_title));
	$fileName = html_entity_decode($fileName, ENT_QUOTES, "UTF-8");
	$fileName = utf8_encode($fileName);
	
	$context_options = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );
//-->
	switch ($Formats) {
		case 'mp3':
			$type = 'audio/mpeg';
			break;
		case 'ogg':
			$type = 'audio/ogg';
			break;
		case 'oga':
			$type = 'audio/ogg';
			break;
		case 'm4a':
			$type = 'audio/mp4';
			break;
		case 'm4v':
			$type = 'video/mp4';
			break;
		case 'mp4':
			$type = 'video/mp4';
			break;
		case 'webm':
			$type = 'video/webm';
			break;
		case 'ogv':
			$type = 'video/ogg';
		case 'jpg':
			$type = 'image/jpeg';
			break;
		case 'jpeg':
			$type = 'image/jpeg';
			break;
		case 'png':
			$type = 'image/png';
			break;
		case 'gif':
			$type = 'image/gif';
			break;
	} 
 
	//-- Define headers
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header('Content-Disposition: attachment; filename="' . sanitize_filename($fileName, $Formats) . '"');
	header("Content-Type: $type charset=utf-8");
	header("Content-Transfer-Encoding: binary");
	header('Expires: 0');
	header('Pragma: no-cache');
	if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
	}
	//-->
	if ($size_file > 0) {
		header('Content-Length: ' . $size_file);
	}
	ob_clean();
	ob_end_flush();
	readfile($headers_url, "", stream_context_create($context_options));
	exit;
	
?>
