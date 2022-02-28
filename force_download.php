<?php
	require_once './application/Connection.php';
	
	function sanitize_filename($string, $type = 'zip'){
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
	
	// Remote Download Class
	class Remote_files{
		
		// Private Fields
		private static $_converter;
		private static $_curlResource;
		private static $_percentVidDownloaded = 0;
		private static $_fsize;
		private static $_downloaded;
		private static $_chunkCount = 0;
		private static $_prevChunkCount = 0;
		private static $_isChunkedDload;
		
		#region Public Methods
		public static function Init(VideoConverter $converter){
			self::$_converter = $converter;
		}		
		
		public static function ChunkedDownload(array $vars){
			extract($vars); 
		 
			//self::$_isChunkedDload = true;			
			$converter = '';
			$vHost = '';
			$dloadUrls = $urls;
			$dloadUrls = (!is_array($dloadUrls)) ? array($dloadUrls) : $dloadUrls;
			foreach ($dloadUrls as $urlKey => $dloadUrl)
			{ 
				 
				$dloadUrlInfo = self::CheckDownloadUrl($dloadUrl, $referer);
				$dloadUrl = (!empty($dloadUrlInfo['redirectUrl'])) ? $dloadUrlInfo['redirectUrl'] : $dloadUrl;
				if ($dloadUrlInfo['isValid'])
				{
					self::$_fsize = $dloadUrlInfo['filesize'];
					$chunkEnd = $chunkSize = 1000000;  // 1 MB in bytes
					$numTries = $count = $chunkStart = 0;
					if (is_file($filename)) unlink($filename);
					$file = fopen($filename.'.'.$formats, 'a');
					self::$_curlResource = $ch = curl_init();				
					while (self::$_fsize >= $chunkStart){
						
						//curl_setopt($ch, CURLOPT_FILE, $file);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch, CURLOPT_URL, $dloadUrl);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						 
						curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); 
						curl_setopt($ch, CURLOPT_REFERER, $referer);
						curl_setopt($ch, CURLOPT_NOPROGRESS, false);
						curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'LegacyUpdateVideoDownloadProgress');
						curl_setopt($ch, CURLOPT_BUFFERSIZE, $chunkSize); 
						curl_setopt($ch, CURLOPT_RANGE, $chunkStart.'-'.$chunkEnd);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);			
						curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.19 (KHTML, like Gecko) Ubuntu/12.04 Chromium/18.0.1025.168 Chrome/18.0.1025.168 Safari/535.19');
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						 
						$output = curl_exec($ch);
						$curlInfo = curl_getinfo($ch);
						if ((curl_errno($ch) != 0 || $curlInfo['http_code'] != "206") && $numTries < 10){
							$numTries++;
							continue;
						}	
						$numTries 	= 0;
						fwrite($file, $output);
						$chunkStart += $chunkSize;
						$chunkStart += ($count == 0) ? 1 : 0;
						$chunkEnd 	+= $chunkSize;
						self::$_chunkCount = ++$count;	
					}
					
					curl_close($ch);
					fclose($file);	
					self::$_prevChunkCount = self::$_chunkCount = 0;
					
					//-->
					$context_options = array(
							"ssl" => array(
								"verify_peer" => false,
								"verify_peer_name" => false,
							),
						);
	
					switch ($formats) {
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
					//-->
					
					header("Cache-Control: public");
					header("Content-Description: File Transfer");
					header('Content-Disposition: attachment; filename="' . sanitize_filename($headers_title, $formats) . '"'); //-- id with the name of the file
					header("Content-Type: $type charset=utf-8");
					header("Content-Transfer-Encoding: binary");
					header('Expires: 0');
					header('Pragma: no-cache');
					if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
					}
					//-->
					$size_file = filesize($filename);
					if ($size_file > 0) {
						header('Content-Length: ' . $size_file);
					}
					ob_clean();
					ob_end_flush();
					
					readfile($filename.'.'.$formats, "", stream_context_create($context_options));
					exit;
					
				}
				/*if (is_file($filename[$urlKey])) echo "is file: " . $filename[$urlKey] . "<br>";*/
			}		
		}
		
		#region Private "Helper" Methods
		private static function CheckDownloadUrl($url, $referer = '')
		{
			$retVal = array();
	 	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_REFERER, $referer);
			curl_setopt($ch, CURLOPT_NOBODY, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.19 (KHTML, like Gecko) Ubuntu/12.04 Chromium/18.0.1025.168 Chrome/18.0.1025.168 Safari/535.19');
					
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			 			
			$headers = curl_exec($ch);
			if (curl_errno($ch) == 0){
				$info = curl_getinfo($ch);
				//die(print_r($info));
				$retVal['filesize'] = (int)$info['download_content_length'];

				$retVal['isValid'] = 200;
				 
			}
			curl_close($ch);
			return $retVal;
		}		
		
		private static function UpdateVideoDownloadProgress($curlResource, $downloadSize, $downloaded, $uploadSize, $uploaded)
		{
			$httpCode = curl_getinfo($curlResource, CURLINFO_HTTP_CODE);
			if ($httpCode == "200" && $downloadSize > 0)
			{
				$percent = round($downloaded / $downloadSize, 2) * 100;
				if ($percent > self::$_percentVidDownloaded)
				{
					self::$_percentVidDownloaded++;
					 
				}
			}
		}
		
		private static function UpdateVideoChunkDownloadProgress($curlResource, $downloadSize, $downloaded, $uploadSize, $uploaded)
		{
			$httpCode = curl_getinfo($curlResource, CURLINFO_HTTP_CODE);
			if ($httpCode == "206" && $downloadSize > 0 && self::$_chunkCount != self::$_prevChunkCount)
			{
				self::$_prevChunkCount++;
				self::$_downloaded += $downloadSize;
				$percent = round(self::$_downloaded / self::$_fsize, 2) * 100;				
				if ($percent > self::$_percentVidDownloaded)
				{
					self::$_percentVidDownloaded++;
					 
				}
			}
		}		
		
		// Deprecated - May be removed in future versions!
		private static function LegacyUpdateVideoDownloadProgress($downloadSize, $downloaded, $uploadSize, $uploaded)
		{
			if (self::$_isChunkedDload)
			{
				self::UpdateVideoChunkDownloadProgress(self::$_curlResource, $downloadSize, $downloaded, $uploadSize, $uploaded);
			}
			else
			{
				self::UpdateVideoDownloadProgress(self::$_curlResource, $downloadSize, $downloaded, $uploadSize, $uploaded);
			}
		}
		#endregion
	}
	
	if (empty($_REQUEST['type_format']) OR empty($_REQUEST['url_video']) OR empty($_REQUEST['referer']) OR empty($_REQUEST['title'])){
		header("Location: " . PHP_Link('404'));
		exit();
	} else {

		$headers_url 			= PHP_DatesCrypt('decrypt', $_REQUEST["url_video"]);//-- id with the video link
	 
		$formats 				= $_REQUEST["type_format"];
		
		$headers_title 			= PHP_DatesCrypt('decrypt', str_replace(" ", "_", $_REQUEST["title"]));
		$referer 				= PHP_DatesCrypt('decrypt', $_REQUEST["referer"]);
		
		$time 					= time() + 1500;
		$in 					= 'time_{'.$time.'}_'.PHP_GetKey(5,8);
		
		$urls 					= $headers_url; 
		$filename			 	= 'download_file/'.$in;
		$referer 				= $referer;
		$extractor 				= '--';
		$vidCount 				= -1;
		$vidInfo 				= 3;
		$ffmpegOutput 			= array();
		$tries 					= 0;
		$dloadVars 				= compact('extractor', 'vidInfo', 'urls', 'headers_title', 'formats', 'referer', 'vidCount', 'filename', 'tries', 'ffmpegOutput');
		Remote_files::ChunkedDownload($dloadVars);
	
	}