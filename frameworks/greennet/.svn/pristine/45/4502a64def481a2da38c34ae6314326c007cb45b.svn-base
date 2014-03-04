<?php
/**
 * 
 * @author BinhQD
 *
 */
class GNFormModel extends CFormModel {
	
	public function handleErrors() {
		$errors = $this->errors;
	
		if (!empty($errors)) {
			list($index, $error) = each($errors);
			if (!empty($error)) {
				throw new Exception($error[0]);
			} else {
				$msg = "Error occurs while validating on ".get_class($this).". Please try again or contact our Administrator for more support.";
				Yii::log($msg, CLogger::LEVEL_ERROR, 'Unidentified error');
				throw new Exception($msg);
			}
		}
	}
	
	public function afterValidate($event = null) {
		parent::afterValidate($event);
		$this->handleErrors();
	}
}