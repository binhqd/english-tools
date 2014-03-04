<?php
class GNRequestHandler {
	const COOKIE_NAME = 'jl_locale';
	const COOKIE_DEVICE_NAME = 'jl_device';
	public static function LocaleHandler() {
		// gán locale là ngôn ngữ mặc định (en)
		$locale = Yii::app()->language;

		$cookies = Yii::app()->request->cookies;
		
		// Nếu cookie language tồn tại, lấy thông tin locale
		if (isset($cookies[self::COOKIE_NAME])) {
			$locale = $cookies[self::COOKIE_NAME]->value;
			
			// Nếu locale không phù hợp thì lấy locale mặc định của hệ thống, đồng thời lưu lại trạng thái
			if (!self::_checkAvailable($locale)) {
				self::_saveCookie($locale);
			}
			
		} else { // Nếu cookie language không tồn tại, lưu thông tin locale vào cookie
			self::_saveCookie($locale);
		}
		
		Yii::app()->language = $locale;
	}
	
	public static function checkDevice() {
		$cookies = Yii::app()->request->cookies;
		
		// Nếu cookie language tồn tại, lấy thông tin locale
		if (isset($cookies[self::COOKIE_DEVICE_NAME])) {
			$device = $cookies[self::COOKIE_DEVICE_NAME]->value;
			
		} else { // Nếu cookie không tồn tại, lưu thông tin locale vào cookie
			// ----------------------------------------------------
			$mobile_browser = '0';
			
			if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
				$mobile_browser++;
			}
			
			if ((isset($_SERVER['HTTP_ACCEPT']) && strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
				$mobile_browser++;
			}
			
			$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
			$mobile_agents = array(
				'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
				'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
				'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
				'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
				'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
				'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
				'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
				'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
				'wapr','webc','winw','winw','xda ','xda-');
			
			if (in_array($mobile_ua,$mobile_agents)) {
				$mobile_browser++;
			}
			
			if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'OperaMini') > 0) {
				$mobile_browser++;
			}
			
			if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
				$mobile_browser = 0;
			}
			if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iemobile')>0) {
				$mobile_browser++;
			}
			if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),' ppc;')>0) {
				$mobile_browser++;
			}
			
			$device = 'pc';
			if ($mobile_browser > 0) {
				// do something
				$device = 'not-pc'; 
			}
			
			$cookie = new CHttpCookie(self::COOKIE_DEVICE_NAME, $device);
			$cookie->expire = time()+60*60*24*180; 
			$cookie->domain = Yii::app()->session->cookieParams['domain'];
	
			Yii::app()->request->cookies[self::COOKIE_DEVICE_NAME] = $cookie;
		}
		
		Yii::app()->params->device = array(
			'type'	=> $device
		);
	}
	
	public static function switchLanguage($newLocale) {
		self::_saveCookie($newLocale, false);
	}
	
	/**
	 * 
	 * Phương thức được sử dụng để lưu cookie cho locale
	 * @param unknown_type $locale
	 * @param unknown_type $isChecked
	 */
	private static function _saveCookie($locale, $isChecked = true) {
		if (!$isChecked && !self::_checkAvailable($locale)) {
			$locale = Yii::app()->language;
		}
		
		if (isset(Yii::app()->request->cookies[self::COOKIE_NAME]))
			unset(Yii::app()->request->cookies[self::COOKIE_NAME]);
		
		$cookie = new CHttpCookie(self::COOKIE_NAME, $locale);
		$cookie->expire = time()+60*60*24*180; 
		$cookie->domain = Yii::app()->session->cookieParams['domain'];

		Yii::app()->request->cookies[self::COOKIE_NAME] = $cookie;
	}
	
	/**
	 * 
	 * Phương thức được sử dụng để kiểm tra language có phù hợp với các ngôn ngữ được hỗ trợ của hệ thống hay không
	 * @param $locale
	 */
	private static function _checkAvailable($locale) {
		// TODO: Check if locale is available
		return true;
	}
}