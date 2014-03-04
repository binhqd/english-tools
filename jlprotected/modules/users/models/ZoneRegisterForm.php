<?php

class ZoneRegisterForm extends CFormModel
{
	public $firstname;
	public $lastname;
	public $password;
	public $confirmPassword;
	public $confirmEmail;
	public $email;
	public $location;
	public $daybirth;
	public $monthbirth;
	public $yearbirth;
	public $birth;
	
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param $className
	 * @return GNUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function rules()
	{
		return array(
			// array('email, confirmEmail', 'email'),
			array('email', 'email'),
			array('email', 'required'),
			// array('email, confirmEmail', 'required'),
			// array('confirmEmail', 'compare','compareAttribute'=>'email'),
			array('email', 'greennet.modules.users.components.validators.CheckEmailExistingValidator'),
			array('password,confirmPassword', 'required'),
			array('confirmPassword','compare','compareAttribute'=>'password'),
			array('firstname, lastname', 'required'),
			array('firstname', 'length', 'max'=>30),
			array('lastname', 'length', 'max'=>20),
			// array('firstname', 'greennet.modules.users.components.validators.FirstnameValidator'),
			// array('lastname', 'greennet.modules.users.components.validators.LastnameValidator'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'firstname' => UsersModule::t('First Name'),
			'lastname' => UsersModule::t('Last Name'),
			'password' => UsersModule::t('Password'),
			'confirmPassword' => UsersModule::t('Confirm Password'),
			'confirmEmail' => UsersModule::t('Confirm Email'),
			'email' => UsersModule::t('Email'),
		);
	}
	public static function getYears(){
		$years = array(0=>'Year');
		for($i=date("Y"); $i>=1901; $i--) $years[$i] = $i;
		return $years;
	}
	public static function getDays(){
		$days = array(0=>'Day');
		for($i=1; $i<=31; $i++) $days[count($days)] = $i;
		return $days;
	}
	public static function getMonths(){
		$months = array(0=>'Month');
		for($i=1; $i<=12; $i++) $months[$i] = date("F", strtotime( date( 'Y-'.$i.'-01' )));
		return $months;
	}
	public static function getLocations(){
		$nodes = ZoneInstanceRender::search(null,300,0,array(
			"/location/country"=>'*'
		));
		$results = array();
		foreach ($nodes as $node) {
			$results[$node['zone_id']] = $node['name'];
		}
		array_multisort($results);
		return $results;
	}
}