<?php
class GNObject extends GNActiveRecord
{
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'core_objects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('description', 'safe'),
		);
	}
	
	public function behaviors()
	{
		return array(
			'slug'	=> array(
				'class' => 'greennet.modules.object.components.behaviors.SluggableBehavior',
				'name'	=> 'name',
			),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'profile' => array(self::HAS_ONE, 'GNUserProfile', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => UsersModule::t('ID'),
			'name' => UsersModule::t('Name'),
			'alias' => UsersModule::t('Alias'),
			'description' => UsersModule::t('Description'),
			'created' => UsersModule::t('Created')
		);
	}
}