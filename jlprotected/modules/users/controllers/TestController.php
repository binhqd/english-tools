<?php
/**
 * LoginController - This controller is used to contain actions support for login
 *
 * @author Thanh Huy
 * @version 1.0
 * @created 23-Jan-2013 4:59:44 PM
 * @modified 29-Jan-2013 11:09:18 AM
 */
class TestController extends JLController
{

	/**
	 * This action is used to support user login
	 */
	public function actionMigrateUserProfile(){
		
		$userProfile = GNUserProfile::model()->findAll();
		foreach($userProfile as $key=>$profile){
			$profile->location = '51d54e6dfef44c8882ed75d6ac111364';
			$profile->save();
		}
		
	}
	public function actionIndex()
	{
		debug(Yii::app()->controllerMap);
	}

}