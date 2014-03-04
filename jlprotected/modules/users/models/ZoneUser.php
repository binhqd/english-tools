<?php
class ZoneUser extends GNCoreUser {
	/**
	 * Returns the static model of the specified AR class.
	 * @param $className
	 * @return GNUser the static model class
	 */
	private static $_countPhotos = array();
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function behaviors() {
		$cacheBehavior = array(
			'cache'	=> array(
				'class'		=> 'greennet.components.cache.memcache.GNMemcacheBehavior',
				'prefix'	=> 'user_'
			)
		);
	
		return CMap::mergeArray(parent::behaviors(), $cacheBehavior);
	}
	
	public function relations()
	{
		$parents = parent::relations();
		unset($parents['profile']);
		
		return @CMap::mergeArray(
			$parents,
			array(
				'property'=>array(self::HAS_MANY, 'ZoneUserPropertiesTmp', 'user_id'),
			)
		);
	}
	
	public function getProfile() {
		$profile = GNUserProfile::model()->find('user_id=:user_id', array(
			':user_id'	=> $this->id
		));
		
		if (empty($profile)) {
			if (!currentUser()->isGuest) {
				$profile = GNUserProfile::model()->createProfile(currentUser()->id);
			} else {
				$profile = GNUserProfile::model();
			}
		}
		
		return $profile;
	}

	public function createUser($arrInformation, $className=__CLASS__) {
		$user = parent::createUser($arrInformation, $className);
		
		// Code tiếp
	}
	/**
	 * (non-PHPdoc)
	 * @see GNUser::findByUsername()
	 */
	public function findByUsername($strUsername) {
		if (empty($strUsername)) return null;
	
		// TODO: Need to change email by username
		$user = $this->find('username=:username', array(
			':username' => $strUsername,
		));
	
		if (!empty($user)) $user->setExtraInfo();
	
		return $user;
	}
	
	public function getNode() {
		Yii::import('application.modules.zone.models.*');
		$objUser = ZoneInstance::initNode($this->hexID);
		
		// If node doesn't existed, re-create node
		if (empty($objUser)) {
			$objUser = $this->createNode();
		}
		
		return $objUser;
	}
	
	public function createNode() {
		Yii::import('application.modules.zone.models.*');
		//watch($this);
		$userID = $this->hexID;
		$displayname = $this->displayname;
		$email = $this->email;
		$birthday = isset($this->profile) ? date("Y/m/d", strtotime($this->profile->birth)) : date("Y/m/d");

		$data = array(
			'name' 		=> $displayname,
			'zone_id'	=> $userID
		);
		$item = array ( 
			'/common/topic/description' => $displayname,
			'/people/user/email'		=> $email,
			'/people/user/username'		=> $displayname,
			// TODO: Need to update user birthday
			'/people/person/date_of_birth'	=> $birthday, // huytbt modified: update birthday
		);
	
		$node = ZoneType::initNode('/people/user')->saveNode($data, $item);
		return $node;
	}
	public static function displayNameMyZone($firstname, $lastname) {
		$firstname = ucwords($firstname);
		$displayname = ucfirst(substr($firstname,0,1))."". substr($firstname,1,strlen($firstname)). " " . strtoupper(substr($lastname, 0, 1)) . ".";
		return $displayname;
	}
	/**
	 * This method check user is available
	 * Author: thinhpq
	 */
	public static function isUser($binUserId = null){
		$result = GNUser::model()->findByPk($binUserId);
		if(!empty($result)) return true;
		else return false;
	}
	
	public function countPhotos($binUserID = null) {
		if (!isset($binUserID)) $binUserID = $this->id;
		$strUserID = IDHelper::uuidFromBinary($binUserID, true);
		
		if (isset(self::$_countPhotos[$strUserID])) return self::$_countPhotos[$strUserID];
		
		Yii::import('application.modules.resources.models.ZoneResourceImage');
		Yii::import('application.modules.resources.models.ZoneImagePoster');
		
		$strUserID = IDHelper::uuidFromBinary($binUserID, true);
		$command = Yii::app()->db->createCommand()
		->select('count(*)')
		->from(ZoneResourceImage::model()->tableName() . " as own_images")
		->join(ZoneImagePoster::model()->tableName()." as holder", "holder.image_id=own_images.id and own_images.invalid=0")
		->where('(holder.holder_id=:ownerID and own_images.object_id != null) or own_images.object_id=:object_id');
		//->order('own_images.created asc, own_images.microtime asc')
		//->limit(25);
		
		$command->bindValues(array(
			':ownerID'		=> $binUserID,
			':object_id'	=> $strUserID,
		));
		
		$count = $command->queryScalar();
		
		// count profile pictures
		$profilePicturesCount = ZoneUserAvatar::model()->getTotal($strUserID);
		
		$count += $profilePicturesCount;
		// cache into heap
		self::$_countPhotos[$strUserID] = $count;
		return $count;
	}
	
	public function makeDefaultAvatar() {
		$webroot = Yii::getPathOfAlias("jlwebroot");
		$file = "{$webroot}/upload/user-photos/{$this->hexID}/34c4b2bc8fd7e7d7bee31d375bd109d8.jpg";
		
		$md5 = '';//md5_file($file);
		
		$avatars = ZoneUserAvatar::model()->getAvatars(strtolower($this->hexID), 1);
		if (empty($avatars) || !isset($avatars[0])) {
// 			// check if they have another image
// 			$command = Yii::app()->db->createCommand()
// 			->select('hex(own_images.id) as id, image, album_id, object_id')
// 			->from(ZoneResourceImage::model()->tableName() . " as own_images")
// 			->join(ZoneImagePoster::model()->tableName()." as holder", "holder.image_id=own_images.id")
// 			->where("(((holder.holder_id=:ownerID and own_images.object_id != null) or own_images.object_id=:object_id)) and own_images.invalid=0")
// 			->order('own_images.created desc, own_images.microtime desc')
// 			->limit(1);
				
// 			$command->bindValues(array(
// 				':ownerID'			=> $this->id,
// 				':object_id'		=> $this->hexID
// 			));
			
// 			$resource = $command->queryRow();
// 			if (!empty($resource)) {
// 				$arrAvatar = ZoneResourceImage::model()->get(strtolower($resource['id']));
// 				if (empty($arrAvatar)) {
// 					watch("Don't have any photo");
// 					return;
// 				} else {
// 					$avatar = "{$webroot}/upload/gallery/{$arrAvatar['photo']['album_id']}/{$arrAvatar['photo']['image']}";
// 					if (!is_file($avatar)) {
// 						$model = ZoneResouceImage::model()->find("id=0x{$avatars[0]['photo']['id']}");
// 						//watch($avatars[0]);
// 						$model->delete();
// 						//watch ("{$avatar} doesn't existed in the server. Removed");
// 						return;
// 					}
// 					$filemd5 = md5_file($avatar);
					
// 					if ($filemd5 == $md5) {
// 						// Xóa file này
// 						ZoneUserAvatar::model()->deleteAll("id=0x{$avatars[0]['photo']['id']}");
// 						ZoneUserAvatar::model()->deleteCache($avatars[0]['photo']['id']);
						
// 						@unlink("{$webroot}/upload/user-photos/{$avatars[0]['photo']['image']}");
// 						return;
// 					}
						
// 					//watch($avatars[0]);
// 					$this->avatar = $avatars[0]['photo']['image'];
					
// 					$photo = ZoneUserAvatar::model()->find("id=0x{$avatars[0]['photo']['id']}");
// 					$photo->created = date("Y-m-d H:i:s");
// 					$photo->save();
// 				}
// 			} else {
// 				watch("Don't have any photo");
// 				return;
// 			}
			return;
		} else if (!empty($avatars) && isset($avatars[0])) {
			$avatar = "{$webroot}/upload/user-photos/{$this->hexID}/{$avatars[0]['photo']['image']}";
			if (!is_file($avatar)) {
				$model = ZoneUserAvatar::model()->find("id=0x{$avatars[0]['photo']['id']}");
				watch($avatars[0]);
				$model->delete();
				watch ("{$avatar} doesn't existed in the server. Removed");
				return;
			}
			$filemd5 = md5_file($avatar);
			
			if ($filemd5 == $md5) {
				// Xóa file này
				ZoneUserAvatar::model()->deleteAll("id=0x{$avatars[0]['photo']['id']}");
				ZoneUserAvatar::model()->deleteCache($avatars[0]['photo']['id']);
				
				@unlink("{$webroot}/upload/user-photos/{$avatars[0]['photo']['image']}");
				return;
			}
				
			//watch($avatars[0]);
			$this->avatar = $avatars[0]['photo']['image'];
			
			$photo = ZoneUserAvatar::model()->find("id=0x{$avatars[0]['photo']['id']}");
			$photo->created = date("Y-m-d H:i:s");
			$photo->save();
		} else {
			watch("{$this->displayname} don't have any profile image");
		}
	}
	
}
class GNUser extends ZoneUser {

}