<?php
/**
 * Widget is used to display Top Notification
 *
 * @author Thanh Huy
 * @version 1.0
 * @created 2012-03-08 3:32:20 PM
 */
class ZoneTopNotification extends CWidget
{
	private $baseScriptUrl;
	public $count = 0;
	public $countRequestFriend = 0;
	public function init()
	{
		parent::init();
		
		// get new notifications
		Yii::import('application.components.notification.JLNotificationReader');
		$this->count = JLNotificationReader::countNotifications(currentUser()->hexID);
		$this->countRequestFriend = JLNotificationReader::countRequestFriendNotifications(currentUser()->hexID);
	}

	public function run()
	{
		GNAssetHelper::init(array(
				'image'		=> 'img',
				'css'		=> 'css',
				'script'	=> 'js',
		));
		
		GNAssetHelper::setBase('myzone_v1');
		
		GNAssetHelper::scriptFile('myzone.notification', CClientScript::POS_END);
		
		if (!currentUser()->isGuest) {
			$this->render('jlbd-top-notification', array(
				
			));
		}
	}
}