<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class JLReviewNotification extends JLNotificationRenderer {
	public function render(&$data) {
		$reviewer = JLUser::model()->getUserInfo(IDHelper::uuidToBinary($data['reviewer_id']));
		if (empty($reviewer)) return null;
		$biz = JLBusiness::model()->getInfo($data['biz_id']);
		
		$data['defaultLink'] = JLRouter::createUrl("/business/" . $biz['alias']);
		return "<a href='".JLRouter::createUrl("/default?u=" . $reviewer->hexID)."'>{$reviewer->username}</a> wrote new review to your business (<a href='".JLRouter::createUrl("/business/" . $biz['alias'])."'>{$biz['name']}</a>)";
	} 
}