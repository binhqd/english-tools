<?php
class LikeAlbumWidget extends GNWidget {
	public $binAlbumID;
	public $activity;
	public function run() {
		
		// continue
		$strAlbumID = IDHelper::uuidFromBinary($this->binAlbumID, true);
		
		$viewPath = 'application.views.common.activity.like_album';

		Yii::import('application.modules.resources.models.*');
			
		$album = ZoneResourceAlbum::model()->find('id=:aid', array(
			':aid'	=> $this->binAlbumID
		));
		
		$userLike = ZoneUser::model()->getUserInfo($this->activity->user_id);
		
		$images = $album->images;
		
		
		
		$this->render($viewPath, compact('album', 'images','userLike'));
	}
}