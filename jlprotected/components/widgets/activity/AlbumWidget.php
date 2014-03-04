<?php
class AlbumWidget extends GNWidget {
	public $binAlbumID;
	public $activity;
	public function run() {
		
		// continue
		
		$strAlbumID = IDHelper::uuidFromBinary($this->binAlbumID, true);
		
		$viewPath = 'application.views.common.activity.album';

		Yii::import('application.modules.resources.models.*');
			
		$album = ZoneResourceAlbum::model()->find('id=:aid', array(
			':aid'	=> $this->binAlbumID
		));
		
		$owner = $album->owner;
		
		$images = $album->images;
		
		$this->render($viewPath, compact('album', 'owner', 'images','activity'));
	}
}