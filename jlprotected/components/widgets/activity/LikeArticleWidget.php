<?php
class LikeArticleWidget extends GNWidget {
	
	public $activity;
	public function run() {
		
		// continue
		
		$viewPath = 'application.views.common.activity.like_article';

			
		$article = ZoneArticle::model()->findByPk($this->activity->object_id);
		if (!empty($article)) {
			$userLike = ZoneUser::model()->getUserInfo($this->activity->user_id);
			$this->render($viewPath, compact('article','userLike'));
		}
	}
}