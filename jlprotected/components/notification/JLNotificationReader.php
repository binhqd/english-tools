<?php
class JLNotificationReader extends CComponent
{
	public static function countNotifications($strUserID)
	{
		Yii::import('application.components.notification.JLNotificationDocument');
		$criteria = array(
			'conditions'	=> array(
				'receiver_id'	=> array("==" => $strUserID),
				'read'			=> array("==" => 0),
				'type'			=> array("!=" => 'application.components.notification.renderer.ZoneRequestFriendNotification'),
			)
		);

		//debug($criteria);
		$criteria = new EMongoCriteria($criteria);
		$count = JLNotificationDocument::model()->count($criteria);
		return $count;
	}

	public static function getNotifications($strUserID, $limit = 8 , $offset=0)
	{
		Yii::import('application.components.notification.JLNotificationDocument');
		$criteria = array(
			'conditions'	=> array(
				'receiver_id'	=> array("==" => $strUserID),
				//'isVisible'		=> array("!=" => false),
				'type'			=> array("!=" => 'application.components.notification.renderer.ZoneRequestFriendNotification'),
			),
			'sort'			=> array(
				"read"			=> EMongoCriteria::SORT_ASC,
				"isClicked"		=> EMongoCriteria::SORT_ASC,
				"created"		=> EMongoCriteria::SORT_DESC
			),
			'limit'			=> $limit,
			'offset'	=> $offset
		);
		if($limit==0){
			unset($criteria['limit']);
		}

		//debug($criteria);
		$criteria = new EMongoCriteria($criteria);
		$notifications = JLNotificationDocument::model()->findAll($criteria);
		return $notifications;
	}

	/**
	 * This method is used to count notifications request friend
	 */
	public static function countRequestFriendNotifications($strUserID)
	{
		Yii::import('application.components.notification.JLNotificationDocument');
		$criteria = array(
			'conditions'	=> array(
				'receiver_id'	=> array("==" => $strUserID),
				'read'			=> array("==" => 0),
				'type'			=> array("==" => 'application.components.notification.renderer.ZoneRequestFriendNotification'),
			),
		);

		//debug($criteria);
		$criteria = new EMongoCriteria($criteria);
		$count = JLNotificationDocument::model()->count($criteria);
		return $count;
	}

	/**
	 * This method is used to get request friend notifications
	 */
	public static function getRequestFriendNotifications($strUserID, $limit = 8)
	{
		Yii::import('application.components.notification.JLNotificationDocument');
		$criteria = array(
			'conditions'	=> array(
				'receiver_id'	=> array("==" => $strUserID),
				'type'			=> array("==" => 'application.components.notification.renderer.ZoneRequestFriendNotification'),
			),
			'sort'			=> array(
				"read"			=> EMongoCriteria::SORT_ASC,
				"isClicked"		=> EMongoCriteria::SORT_ASC,
				"created"		=> EMongoCriteria::SORT_DESC
			),
			'limit'			=> $limit
		);
		if($limit==0){
			unset($criteria['limit']);
		}

		$criteria = new EMongoCriteria($criteria);
		$notifications = JLNotificationDocument::model()->findAll($criteria);
		return $notifications;
	}
}