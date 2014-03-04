<?php
class UserAvatars extends GNWidget {
	public $strUserID;
	public $strUsername;
	
	public function run() {
		$binUserID = IDHelper::uuidToBinary($this->strUserID);
		$avatars = ZoneUserAvatar::model()->getAvatars($this->strUserID, 5);
		
		if (empty($this->strUsername)) {
			$user = ZoneUser::model()->get($this->strUserID);
			if (!empty($user)) {
				$this->strUsername = $user['displayname'];
			}
		}
		
		$count = count($avatars);
		switch ($count) {
			case 1:
				$this->render('avatars/1-image', compact('avatars'));
				break;
			case 2:
				$this->render('avatars/2-images', compact('avatars'));
				break;
			case 3:
				$this->render('avatars/3-images', compact('avatars'));
				break;
			case 4:
				$this->render('avatars/4-images', compact('avatars'));
				break;
			case 5:
				$this->render('avatars/5-images', compact('avatars'));
				break;
		}
	}
}