<?php
Yii::import('greennet.modules.users.models.*');
class LoginController extends GNController
{
	const TYPE_LOGIN_SUCCESS = 1;
	const TYPE_VALIDATE_FAILURE = 2;
	const TYPE_USER_PASS_INCORRECT = 3;
	
	
	public $layout = "//layouts/master/homepage";
	public function allowedActions()
	{
		return '*';
	}
	// public function actions(){
		// return array(
			
			// 'index'	=> array(
				// 'class'			=> 'greennet.modules.users.actions.login.GNLoginAction',
				// 'viewFile'	=> 'application.modules.users.views.login.login',
			// ),

		// );
	// }

	public function actionIndex()
	{
	
		$model = new ZoneLoginForm();
		
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='userLoginForm')
        {
			
			echo CActiveForm::validate($model);
			Yii::app()->end();
        }
				
		if (isset($_POST['ZoneLoginForm'])) // Check Post Form
		{

			$model->attributes = $_POST['ZoneLoginForm'];
			
			if ($model->validate()) // Validate form login
			{

				$login = $model->user->forceLogin($model->rememberMe);
				
				if ($login) {
					if (Yii::app()->request->isAjaxRequest) {
						
					} else {
						
						$this->redirect(GNRouter::createUrl('/landingpage'));
					}
				}
			} else {
				
			}
			
		} 
		$this->render('login',array(
			'model'=>$model
		));
	}
	

}