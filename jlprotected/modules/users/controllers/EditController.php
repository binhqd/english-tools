<?php

class EditController extends GNController
{
	public function allowedActions()
	{
		return '*';
	}
	
	public function actions() {
		return array(
			'change-avatar'	=> array(
				'class'=> 'application.modules.users.actions.ZoneChangeAvatarAction',
				'model'=> array(
					'class'	=> 'application.modules.users.models.ZoneUserAvatar',
				),
				'fieldName'		=> 'image',
				'uploadPath'	=> 'upload/user-photos/'
			)
		);
	}
	
	public function actionInfo(){
		
		$user = GNUser::model()->findByEmail(currentUser()->email);
		$userProfile = $user->profile;
		
		if (!empty($_POST['GNUser']) || !empty($_POST['GNUserProfile'])) {
			//get data
			
			$user->attributes = $_POST['ZoneUser'];
			$user->displayname = GNUser::displayNameMyZone($user->firstname, $user->lastname);
			
			$user->firstname = ucwords($user->firstname);
			$user->firstname = ucfirst(substr($user->firstname,0,1))."". substr($user->firstname,1,strlen($user->firstname));
			
			if (empty($user->username)) {
				$username = Sluggable::slug($user->email);
				$username = preg_replace("/@/", '.', $username);
				$username = preg_replace("/(\.[a-z0-9]+)$/", '', $username);
				
				$user->username = $username;
			}
			
			if (empty($userProfile)) { // User does not profile => create profile
				$userProfile = new GNUserProfile;
				$createProfile = $userProfile->createProfile($user->id);
				if (!$createProfile){
					jsonOut(array(
						'error'		=> true,
						'message'	=> 'Cannot create user profile',
					));
				}
			}
			
			// $image = $_POST['GNUserProfile']['image'];
			// unset($_POST['GNUserProfile']['image']);
			
			$userProfile->attributes = $_POST['GNUserProfile'];
			// dump($userProfile->attributes);
			// $userProfile->image = $image;
			
			// Check validate user and userProfile
			try {
				$valid = $user->validate() && $userProfile->validate();
			} catch (Exception $ex) {
				
				if (Yii::app()->request->isAjaxRequest ) {
					jsonOut(array(
						'error'		=> true,
						'message'	=> $ex->getMessage(),
				
					));
				} else {
					// todo
				}
			}

			if ($valid) {
				$transaction = $user->dbConnection->beginTransaction();
				try {
					
					
					if (!$user->save()){
						jsonOut(array(
							'error'		=> true,
							'message'	=> 'Cannot save user information',
						));
					}
						

					
					
						
					if (!$userProfile->save()){
						jsonOut(array(
							'error'	=> true,
							'message'	=> 'Cannot save user profile information',
						));
					}
						

						
					// Commit transaction
					$transaction->commit();
					
					
					
					
					$user->updateState(true, false);

					
					if (Yii::app()->request->isAjaxRequest) {
					
						
						jsonOut(array(
							'error'	=> false,
							'message'	=> UsersModule::t('Your information has been saved'),
							'user'=>$user->attributes,
							'profile'=>$userProfile->attributes,
						));
					} else {

					}
				} catch (Exception $ex) {
					// Rollback transaction
					$transaction->rollback();
					if (Yii::app()->request->isAjaxRequest ) {
						jsonOut(array(
						'error'	=> true,
						'message'	=> UsersModule::t($ex->getMessage()),
						));
					} else {
						
					}
				}
			} else {
				if ($this->isJsonRequest) {
					jsonOut(array(
						'error'	=> true,
						'message'		=> UsersModule::t('Your information is invalid'),
						'user_errors'	=> $user->errors,
						'profile_errors' => $userProfile->errors,
					));
				} else {
					
				}
			}
			
			if (empty($userProfile)) {
				// User does not profile => create profile
				$userProfile = GNUserProfile::model();
			}
			
		}
		
		
	}
	
	/*public function actionChangeAvatar(){
		// jsonOut($this->isJsonRequest);
		if (!empty($_FILES)) {
			$user = currentUser();
			$userProfile = $user->profile;
			
			$uri = Yii::app()->baseUrl.'/upload/user-photos/fill/193-193/' . $user->hexID;
			
			
			if ($userProfile->image != null) {
				$modelZoneUserAvatar = new ZoneUserAvatar;
				$modelZoneUserAvatar->image = $userProfile->image;
				$modelZoneUserAvatar->object_id = $modelZoneUserAvatar->prefix.currentUser()->hexID;
				$modelZoneUserAvatar->created = date("Y-m-d H:i:s");
				if(file_exists("upload/user-photos/".currentUser()->hexID."/".$userProfile->image)){
					$imagesize  = @getimagesize("http://".$_SERVER["SERVER_NAME"]."/upload/user-photos/".currentUser()->hexID."/" . $user->profile->image);
					if(!empty($imagesize[0]) && !empty($imagesize[1])){
						$modelZoneUserAvatar->ratio = $imagesize[0]/$imagesize[1];
					}
				}
				$modelZoneUserAvatar->save();
			}
			
			$file = CUploadedFile::getInstanceByName('image');
			$ext = $file->extensionName;
			$filename	= md5(uniqid());
			$newFile = "{$filename}.{$ext}";
			
			// Do your business ... save on file system for example,
			// and/or do some db operations for example
			$path = Yii::app()->baseUrl.'upload/user-photos/'.currentUser()->hexID;
			
			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}
			$filePath	= "{$path}/{$newFile}";
			$file->saveAs($path."/".$newFile);
			
			$userProfile->image = $newFile;
			if($userProfile->validate()){

				if($userProfile->save()){
					$user->updateState(true, false);
					jsonOut(array(
						'error'=>false,
						'uri'=>$uri."/".$newFile,
						'file'=>$newFile
					));
					
				}else{
					$errors  = $userProfile->getErrors();
					list ($field, $_errors) = each ($errors);
					
					jsonOut(array(
						'error'=>true,
						'message'=>$_errors[0]
					));
				}
			}else{
				$errors  = $userProfile->getErrors();
				list ($field, $_errors) = each ($errors);
				jsonOut(array(
					'error'=>true,
					'message'=>$_errors[0]
				));
			}
			
		}else{
			jsonOut(array(
				'error'=>true
			));
		}
	}*/
	public function actionInfomation(){

		if(!empty($_POST)){
			
			if(currentUser()->isGuest) ajaxOut(array(
				'error'=>true
			));
		
			// dump($_POST);
			$objNode = ZoneInstanceRender::get(currentUser()->hexID);
			$Manager = new ZoneInstanceManager('/people/user');
			$properties = $Manager->properties();
			$items = array();
			foreach($properties as $key=>$property){
				if(!is_numeric( @key($property) )){
					// if(strtolower($property['label']) != "description"){
						$tmpLabel = strtolower($property['label']);
						$tmpLabel = str_replace(" ","",$tmpLabel);
						$tmpLabel = str_replace("-","",$tmpLabel);
						$tmpLabel = str_replace(",","",$tmpLabel);
						
						$items[$key][] = $_POST['ZoneInfomationForm'.currentUser()->hexID][$tmpLabel];
						// dump($_POST,false);
						// dump($tmpLabel,false);
						// dump($key,false);
						// dump($property);
					// }
				}
			}
			$data = array(
				'zone_id'=>$objNode->zone_id,
				'name'=>currentUser()->displayname
			);
			if(!empty($items['/people/user/username'])){
				$items['/people/user/username'] = currentUser()->displayname;
			}
			// dump($items,false);
			// dump(currentUser()->displayname,FALSE);
			// dump($objNode->zone_id,FALSE);
			// dump(currentUser()->hexID,FALSE);
			// dump($data);
			$Manager->save($data,$items,$_POST['token']);
			
			
			$attributes = $_POST['ZoneInfomationForm'.currentUser()->hexID];

			$results = $Manager->values($objNode);

			if(yii::app()->request->isAjaxRequest){
				jsonOut(array(
					'error'=>false,
					'attributes'=>$attributes,
					'valueSummary'=>$attributes['description'],
					'token'=>!empty($results['token']) ? $results['token'] : "",
				));
			}else{
				Yii::app()->jlbd->dialog->notify(array(
					'error'		=> false,
					'type'		=> 'success',
					'autoHide'	=> true,
					'message'	=> 'The has been saved infomation successfully.',
				));
				$this->redirect('/profile');
			}
		}else{
			jsonOut(array(
				'error'=>true
			));
		}
	}
	
	/**
	 * This action used save sumary for user node
	 * Author: thinhpq
	 **/
	public function actionSumary(){
		if(!empty($_POST)){
			if(currentUser()->isGuest) ajaxOut(array(
				'error'=>true
			));
			
			$user = GNUser::model()->findByEmail(currentUser()->email);
			if(empty($user)){
				ajaxOut(array(
					'error'=>true,
					'message'=>'Invalid information'
				));
			}
			$this->actionInfomation();
			
		}else{
			jsonOut(array(
				'error'=>true
			));
		}
	}
	/**
	 * This action used save other properties for user node
	 * Author: thinhpq
	 **/
	public function actionProp(){
		if(!empty($_POST)){
			if(currentUser()->isGuest) ajaxOut(array(
				'error'=>true
			));
			$objNode = ZoneInstanceRender::get(currentUser()->hexID);
			$data = array(
				'zone_id'=>$objNode->zone_id,
				'name'=>currentUser()->displayname
			);
			
			$constructs = @CJSON::decode($_POST['constructs']);
			if(is_array($constructs)){
				if(!empty($constructs[1]) && !empty($constructs[2])){
					$tmpNameType  = null;
					if(!empty($constructs[0]['name'])) {
						$tmpNameType = $constructs[0]['name'];
						$tmpNameType = str_replace("/","",$tmpNameType);
					}
					$strNamePost = 'ZonePropertiesForm'.$tmpNameType."".currentUser()->hexID;
					
					$model = new $strNamePost;
					$model->attributes = $_POST[$strNamePost];
					if(!$model->validate()){
						if(isset($_POST['ajax']) && $_POST['ajax']==="frmZoneOtherForm{$strNamePost}") {
							echo CActiveForm::validate($model);
							Yii::app()->end();
						}
					}
					

					$items = array();
					foreach($constructs[2] as $key=>$value){
						
						$tmpLabel = strtolower($value['label']);
						$tmpLabel = str_replace(" ","",$tmpLabel);
						$tmpLabel = str_replace(",","",$tmpLabel);
						$tmpLabel = str_replace("-","",$tmpLabel);
						
						// dump($tmpLabel,false);
						if(!empty($_POST[$strNamePost])){
							if(!empty($_POST[$strNamePost][$tmpLabel])){
								$items[$key] = array(0=>$_POST[$strNamePost][$tmpLabel]);
							}else{
								$items[$key] = array();
							}
							// dump($_POST[$strNamePost],false);
						}else{
							$items[$key] = array();
						}
						
						
					}
					
					/**
					 * Check data assign for $item before save
					 **/
					if(!empty($items) && !empty($data) ){
						$item[$constructs[0]['name']] = array($items);
						// dump($constructs,false);
						// dump($_POST,false);
						// dump($item,false);
						// dump($data);
						
						$Manager = new ZoneInstanceManager('/people/user');
						
						$Manager->save($data,$item,!empty($_POST['token']) ? $_POST['token'] : "");
						$results = $Manager->values($objNode);
						ajaxOut(array(
							'error'=>false,
							'results'=>$results['value'][$constructs[0]['name']][count($results['value'][$constructs[0]['name']]) - 1],
							'token'=>!empty($results['token']) ? $results['token'] : "",
						));
					}else{
						jsonOut(array(
							'error'=>true,
							'message'=>'Item & data is empty.'
						));
					}
					
				}else{
					jsonOut(array(
						'error'=>true,
						'message'=>'Wrong symbols.'
					));
				}
				
			}else{
				jsonOut(array(
					'error'=>true,
					'message'=>'Contructs data failer.'
				));
			}
			
			
		}else{
			jsonOut(array(
				'error'=>true
			));
		}
	}
	public function actionRenderProp(){
		if(!empty($_POST)){
			$this->renderPartial('item-prop',array(
				'valueNodeProp'=>$_POST['data'],
				'type'=>$_POST['type'],
			));
		}
	}
	public static function actionRefreshStateUser(){
		
		if(!currentUser()->isGuest){
			$user = GNUser::model()->findByEmail(currentUser()->email);
			$user->updateState(true, false);
		}
	}
}