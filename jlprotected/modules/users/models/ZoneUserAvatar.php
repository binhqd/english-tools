<?php
Yii::import('greennet.modules.gallery.models.GNGalleryItem');
Yii::import('greennet.modules.gallery.components.IPhotoItem');
class ZoneUserAvatar extends GNGalleryItem implements IPhotoItem {
	public $prefix = "avatar_";
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param $className
	 * @return GNUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getName() {
		return __CLASS__;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zone_user_avatars';
	}
	
	public function getTotal($objectID = null) {
		return $this->countPhotos($objectID);
	}
	
	/**
	 * Override default $user->poster in GNGalleryItem
	 * @return GNUser object
	 */
	public function getPoster() {
		$id = str_replace($this->prefix, "", $this->object_id);
		return ZoneUser::model()->getUserInfo(IDHelper::uuidToBinary($id));
	}
	
	public function getAvatars($strObjectID, $limit = 5, $offset = 0) {
		$avatars = parent::getPhotos($strObjectID, $limit, $offset);
		
		return $avatars;
	}
	
	public function cleanUp($uploader = null) {
		$attributes = $this->attributes;
		$albumID = $this->albumID;
	
		$this->delete();
	
		// also remove all likes
		ZoneLike::model()->removeAllByObjectID($attributes['id']);
	
		// also remove all comment
		ZoneComment::model()->removeAllByObjectID($attributes['id']);
	
		// Also remove related activities
	
		// Remove physical image
	
		// Remove image from cloud
		$info['s3Path'] = "/upload/user-photos/{$albumID}/";
		$info['filename'] = $attributes['image'];
	
		$uploader->remove($info);
	}
}