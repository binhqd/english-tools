<?php
Yii::import('application.modules.vocabulary.models.*');
class SiteController extends GNController
{
	public $layout = "//../views/themes/bootstrap/views/layouts/main";
	/**
	 * This method is used to allow action
	 * @return string
	 */
	public function allowedActions()
	{
		return '*';
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->order = 'firstname asc';
		
		$users = GNUser::model()->findAll($criteria);
		
		$this->render('index', compact('users'));
	}
	
	public function actionListDataset() {
		$id = Yii::app()->request->getParam('id');
		
		$records = UserData::model()->getData(IDHelper::uuidToBinary($id));
		
		$this->render('list', compact('records', 'users'));
	}
	
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = "//layouts/master/myzone";
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionRating() {
		$arr = array(
			'title'			=> "Day la tin tuc",
			'description'	=> "Day la noi dung description",
			'rating'		=> 3
		);
	
		$this->render('rating', array(
			'article'	=> $arr
		));
	}
	
}