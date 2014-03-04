<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'Business',
	));
	$this->widget('zii.widgets.CMenu', array(
		'items'=>array(
			array('label'=>'List Site', 'url'=>array('/sites/list')),
			array('label'=>'Create Site', 'url'=>array('/sites/create')),
		),
		'htmlOptions'=>array('class'=>'operations'),
	));
	$this->endWidget();
?>