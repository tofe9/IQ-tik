<?php
	header_remove('Server');
	header("Content-type: application/json");
	require_once './application/Connection.php';

	$response_data     	= array();
	$api_key       		= (!empty($_GET['key'])) ? PHP_Secure($_GET['key']) : '';
	$api_password      	= (!empty($_GET['password'])) ? PHP_Secure($_GET['password']) : '';
	$api_url       		= (!empty($_GET['url'])) ? PHP_Secure($_GET['url']) : '';
 
	if($api_url){ 
		if($api_key == $options_launcher['crypt_password'] && $api_password == $options_launcher['crypt_secret_key']){
		
			$get_data_video = array();		
			$get_data_audio = array();		
			$get_data_image = array();		
			
			$CODE['URL_EMBED']				= PHP_Secure(urldecode($api_url));
			$CODE['URL_EMBED_SHARE']		= true;
			include './upload_ajax/search_data.php';	
			if($video_data['STATUS'] == 200){
				//--> Video
				foreach ($CODE['URLS_VIDEO_DATA'] as $indice => $Data_media) {
					$get_data_video[] = array (
											'url' 		=> $Data_media[0]['url'],
											'quality' 	=> $Data_media[0]['quality'],
											'format' 	=> $Data_media[0]['format'],
											'size' 		=> PHP_Data_file_size($Data_media[0]['size'])
										);
				}
				//--> Audio
				foreach ($CODE['URLS_AUDIO_DATA'] as $indice => $Data_media) {
					$get_data_audio[] = array (
											'url' 		=> $Data_media[0]['url'],
											'quality' 	=> $Data_media[0]['quality'],
											'format' 	=> $Data_media[0]['format'],
											'size' 		=> PHP_Data_file_size($Data_media[0]['size'])
										);
				}
				//--> Image
				foreach ($CODE['URLS_LIST_DATA'] as $indice => $Data_media) {
					$get_data_image[] = array (
											'url' 		=> $Data_media[0]['url'],
											'quality' 	=> $Data_media[0]['quality'],
											'format' 	=> $Data_media[0]['format'],
											'size' 		=> PHP_Data_file_size($Data_media[0]['size'])
										);
				}			
				
				$response_data       = array(
					'api_status'     	=> '200',
					'share_id'     		=> $CODE['LIST_SOCIAL_MEDIA'],
					'origial_url'     	=> $api_url,
					'source'     		=> $CODE['NAME_PLUGIN_DATA'],
					'data'         => array(
						'title' 	=> (empty($CODE['TITLE_DATA']))?'NULL':$CODE['TITLE_DATA'],
						'thumbnail' => (empty($CODE['THUMBNAIL_DATA']))?'NULL':$CODE['THUMBNAIL_DATA'],
						'video'   	=> $get_data_video,
						'audio' 	=> $get_data_audio,
						'image' 	=> $get_data_image
					)
				);
			}else{
				$response_data       = array(
					'api_status'     => '400',
					'errors'         => array(
											'error_text'   	=> 'empty url'
										)
				);
			}	
		}else{
			$response_data      = array(
				'api_status'    => '400',
				'errors'       	=> array(
										'error_text'   		=> 'Wrong server key'
									)
			);
		}
	}else{
		$response_data       = array(
			'api_status'     => '404',
			'errors'         => array(
									'error_text'   	=> 'Bad Request, Invalid or missing parameter'
								)
		);
	}
    
	echo json_encode($response_data, JSON_PRETTY_PRINT);
	exit();

	$db->disconnect();
	unset($load);
?>