<?php
/**
 * This widget is used to render form change password
 * @author huytbt <huytbt@gmail.com>
 * @version 1.0
 * @created 2013-07-15 03:56 PM
 */
class FormChangePassword extends GNWidget
{
	public $isPopup = true;
	/**
	 * This method is used to run widget
	 */
	public function run()
	{
		Yii::import('greennet.modules.users.models.GNChangePasswordForm');

		$hasCreatedPassword = true;
		Yii::import('greennet.modules.social.models.GNLinkedAccount');
		$linkedAccount = GNLinkedAccount::model()->findByAttributes(array('user_id'=>currentUser()->id));
		if (!empty($linkedAccount)) {
			$hasCreatedPassword = $linkedAccount->has_created_password == 1;
		}

		if ($hasCreatedPassword)
			$model = new GNChangePasswordForm('fullchange');
		else
			$model = new GNChangePasswordForm;

		$this->render('change_password',array(
			'model'				=> $model,
			'isPopup'				=> $this->isPopup,
			'hasCreatedPassword'=> $hasCreatedPassword,
		));
	}
}