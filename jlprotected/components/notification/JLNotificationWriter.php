<?php
class JLNotificationWriter extends CComponent {
	private $data = "";
	
	public static function send($strUserID, $notificationType, $data) {
		// Saving data to Mongo database
		Yii::import('application.components.notification.JLNotificationDocument');
		$doc = new JLNotificationDocument();
		
		if (!empty($data['notifier_id'])) {
// 			// if sender is receiver, then return
			if ($data['notifier_id'] == $strUserID) return;
			$doc->notifier_id = $data['notifier_id'];
			$notifier = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['notifier_id']));
		}
		
		$class = Yii::import($notificationType);
		$renderer = new $class;
		$message = $renderer->render($data);
		
		$doc->receiver_id = $strUserID;
		$doc->type = $notificationType;
		$doc->data = $data;
		$doc->created = time();
		$doc->isClicked = 0;
		$doc->action = $data['type'];
		$doc->save();
		//$message = 'test message';
		$out = array(
			'receiver_id'	=> $strUserID,
			'message'		=> $message,
			'read'			=> 0,
			'is_clicked'	=> 0,
// 			'id'			=> $doc->_id->{'$id'}
		);
		
		if (!empty($data['notifier_id'])) {
			$out['notifier'] = array(
				'id'		=> $notifier->hexID,
				'username'	=> $notifier->username,
				'displayname'	=> $notifier->displayname
			);
			
			$out['avatar']	= $notifier->profile->image;
		}
		
		if (!empty($data['defaultLink'])) {
			$out['defaultLink'] = $data['defaultLink'];
		}
		
		if (!empty($data['activity'])) {
			$out['activity'] = $data['activity'];
		}
		
		// test by dongnd
		if (!empty($data['json'])) {
			$out['json'] = $data['json'];
		}
		if (!empty($data['type'])) {
			$out['type'] = $data['type'];
		}
		
		$out['otherInfo'] = $renderer->otherInfo;
		
		// sending notification$
		$url = Yii::app()->params['notificationServer'] . "/sendNotify";
// 		dump(array($out, $url));
		self::_send($url, $out);
	}
	
	public function sendRFC($strUserID, $data) {
		$out = array(
			'receiver_id'	=> $strUserID,
			'data'			=> $data,
			'command'		=> $data["command"]
		);
		
		if (!empty($data['notifier_id'])) {
			// if sender is receiver, then return
// 			if ($data['notifier_id'] == $strUserID) return;
			$notifier = JLUser::model()->getUserInfo(IDHelper::uuidToBinary($data['notifier_id']));
		}
		
		if (!empty($data['notifier_id'])) {
			$out['notifier'] = array(
				'id'		=> $notifier->hexID,
				'username'	=> $notifier->username,
				'displayname'	=> $notifier->displayname
			);
			$out['avatar']	= $notifier->avatar;
		}
		
		// sending notification$
		$url = Yii::app()->params['notificationServer'] . "/sendRFC";
		self::_send($url, $out);
	}
	
	public function push($data) {
		$out = array(
			'data'			=> $data,
			'command'		=> 'push',
			'namespace'		=> $data['namespace']
		);
		
		// sending notification$
		$url = Yii::app()->params['notificationServer'] . "/push";
		self::_send($url, $out);
	}
	
	private function arrToString($arr, $pre = "") {
		$out = "";
		foreach($arr as $key=>$value) { 
			if (is_array($value)) {
				$out .= self::arrToString($value, $key);
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
	private static function _send($url, $data) {
		//$url = "http://{$_SERVER['HTTP_HOST']}:8080/sendNotify";
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$data = http_build_query($data, '', '&');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		
		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);
	}
}