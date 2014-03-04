<?php
Yii::import('greennet.modules.users.controllers.GNProfileController');
class ProfileController extends GNProfileController {
	public $layout = "//../views/themes/bootstrap/views/layouts/main";
	public $defaultAction = "wall";
	public function actions(){
		return CMap::mergeArray(parent::actions(), array(
			
		));
	}
	
}