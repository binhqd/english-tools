<?php
class GetWordController extends GNController {
	public $layout = "//../views/themes/bootstrap/views/layouts/main";
	/**
	 * This method is used to allow action
	 * @return string
	 */
	public function allowedActions()
	{
		return '*';
	}
	
	public function actionGetAudio() {
		$word = Yii::app()->request->getParam('word');
		$word = trim($word);
		
		$filePath = Yii::getPathOfAlias("jlwebroot") . "/data/{$word}.mp3";
		if (file_exists($filePath)) {
			header('Content-type: audio/mpeg');
			echo file_get_contents($filePath);
		} else {
			
			
			$url = 'http://translate.google.com/translate_tts?ie=UTF-8&q='.urlencode($word).'&tl=en&total=1&idx=0&textlen='.strlen($word).'&client=t';
			
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			curl_setopt( $ch, CURLOPT_URL, $url );
	// 		curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
	// 		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
			curl_setopt( $ch, CURLOPT_ENCODING, "" );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	// 		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
	// 		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
	// 		curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
			curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
			$content = curl_exec( $ch );
			$response = curl_getinfo( $ch );
			
			file_put_contents(Yii::getPathOfAlias("jlwebroot") . "/data/{$word}.mp3", $content);
			curl_close ( $ch );
			
			header('Content-type: audio/mpeg');
			echo $content;
		}
	}
}