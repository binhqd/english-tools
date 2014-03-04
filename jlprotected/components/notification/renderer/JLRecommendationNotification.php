<?php 
Yii::import("application.components.notification.renderer.JLNotificationRenderer");
class JLRecommendationNotification extends JLNotificationRenderer
{
	public function render(&$data)
	{
		// $notifier = JLUser::model()->getUserInfo(IDHelper::uuidToBinary($data['notifier_id']));
		Yii::import('application.modules.recommendations.models.JLRecommendation');
		$recommend = JLRecommendation::model()->findByPk(IDHelper::uuidToBinary($data['recommend_id']));
		if (empty($recommend)) return null;
		$data['defaultLink'] = JLRouter::createUrl("/recommendations/friends/list");
		if ($recommend) return $recommend->toString();
		
	} 
}