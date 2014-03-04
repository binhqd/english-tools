<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'Member',
	));
	$this->widget('zii.widgets.CMenu', array(
		'items'=>array(
			array('label'=>'Change Email', 'url'=>array('/user/profile/changeemail')),
			array('label'=>'Create new website', 'url'=>array('/sites/create')),
		),
		'htmlOptions'=>array('class'=>'operations'),
	));
	
	// -----------------
	Yii::import('application.modules.sites.models.JLSite');
	$arrUserSites = JLSite::model()->findAllByAttributes(array(
		'user_id'	=> Yii::app()->user->id
	));
	
	$siteMenuItems = array();
	foreach ($arrUserSites as $item) {
		$siteMenuItems[] = array('label'=> $item->site_name, 'url'=>'http://' . JLTL_EDIT_DOMAIN . JLRouter::createUrl('/' . currentUser()->displayname . '/' . $item->site_alias));
	}
	
	$this->widget('zii.widgets.CMenu', array(
		'items'=> $siteMenuItems,
		'htmlOptions'=>array('class'=>'operations'),
	));
	$this->endWidget();
?>