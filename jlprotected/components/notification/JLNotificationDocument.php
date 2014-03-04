<?php
class JLNotificationDocument extends EMongoDocument
{
	public $receiver_id;
	public $type;
	public $data;
	public $created;
	public $read = 0;
	public $notifier_id;
	public $isClicked = 1;
	public $extraContent = "";
	public $action;

	// This has to be defined in every model, this is same as with standard Yii ActiveRecord
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// This method is required!
	public function getCollectionName()
	{
		return 'notifications';
	}

	public function markRead($strUserID) {
		$modifier = new EMongoModifier();
		// replace field1 value with 'new value'
		$modifier->addModifier('read', 'set', 1);
		
		// prepare search to find documents
		$criteria = new EMongoCriteria();
		$criteria->addCond('receiver_id','==', $strUserID);
		$criteria->addCond('read','==', 0);
		$criteria->addCond('type','!=', 'application.components.notification.renderer.ZoneRequestFriendNotification');
		
		// update all matched documents using the modifiers
		$status = self::model()->updateAll($modifier, $criteria);
		return $status;
	}

	/**
	 * This method is used to delete request friend notifications
	 */
	public function deleteRequestFriendNotifications($strReceiverId, $strNotifierId)
	{
		$criteria = new EMongoCriteria();
		$criteria->addCond('receiver_id', '==', $strReceiverId);
		$criteria->addCond('notifier_id', '==', $strNotifierId);
		$criteria->addCond('type', '==', 'application.components.notification.renderer.ZoneRequestFriendNotification');
		$status = self::model()->deleteAll($criteria);
		return $status;
	}

	/**
	 * This method is used to mark read request friend notofications
	 */
	public function markReadRequestFriendNotifications($strUserID)
	{
		$modifier = new EMongoModifier();
		$modifier->addModifier('read', 'set', 1);

		// prepare search to find documents
		$criteria = new EMongoCriteria();
		$criteria->addCond('receiver_id','==', $strUserID);
		$criteria->addCond('read','==', 0);
		$criteria->addCond('type','==', 'application.components.notification.renderer.ZoneRequestFriendNotification');

		// update all matched documents using the modifiers
		$status = self::model()->updateAll($modifier, $criteria);
		return $status;
	}

	public function deleteItem($id) {
		
	}
}