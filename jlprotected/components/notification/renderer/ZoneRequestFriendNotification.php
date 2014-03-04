<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class ZoneRequestFriendNotification extends JLNotificationRenderer
{
	public function render(&$data)
	{
		$notifier = ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($data['notifier_id']));
		if (empty($notifier)) return null;
		if(empty($data['type'])) return null;
		switch ($data['type']) {
			case "requestFriend":
				$data['defaultLink'] = GNRouter::createUrl('/friends/list/pendings');
				return "<a href='".GNRouter::createUrl("/profile/" . $notifier->username)."'>{$notifier->displayname}</a> wants to be your friend";
				break;
			case "acceptFriend":
				$data['defaultLink'] = GNRouter::createUrl("/friends/list");
				return "<a href='".GNRouter::createUrl("/profile/" . $notifier->username)."'>{$notifier->displayname}</a> accepted your friend request";
				break;
		}
		
	} 
}