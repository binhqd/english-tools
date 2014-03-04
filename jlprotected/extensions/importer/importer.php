<?php
class Importer extends CComponent {
	function postData($url, $postData, $cookie = false) {
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_VERBOSE, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
	    curl_setopt($ch, CURLOPT_URL, $url);
	    if ($cookie) {
	    	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	    }
	    
	    curl_setopt($ch, CURLOPT_POST, true);
	    // same as <input type="file" name="file_box">
	    /*$post = array(
	        "file_box"=>"@/path/to/myfile.jpg",
	    );*/
	    
		
	    $fields_string = self::arrToString($postData);
	    //debug($fields_string);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); 
	    $response = curl_exec($ch);
	    //debug($response);
	    return $response;
	}
	
	function getData($url, $getFields) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		// same as <input type="file" name="file_box">
		/*$post = array(
				"file_box"=>"@/path/to/myfile.jpg",
		);*/
		
		$fields_string = self::arrToString($_REQUEST);
		//debug($fields_string);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		$response = curl_exec($ch);
		 
		return $response;
	}
	
	function arrToString($arr, $pre = "") {
		$out = "";
		foreach($arr as $key=>$value) { 
			if (is_array($value)) {
				$out .= arrToString($value, $key);
			} else {
				if (!empty($pre)) {
					$out .= "{$pre}[{$key}]".'='.urlencode($value).'&'; 
				} else {
					$out .= $key.'='.urlencode($value).'&'; 
				}
			}
		}
		rtrim($out,'&');
		return $out;
	}
}