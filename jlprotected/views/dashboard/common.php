<?php
    $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Common',
    ));
    $this->widget('zii.widgets.CMenu', array(
        'items'=>array(
            array('label'=>'View Profile', 'url'=>array('/user/profile/view')),
            array('label'=>'Update Profile', 'url'=>array('/user/profile/update')),
            array('label'=>'Change Password', 'url'=>array('/user/profile/changepassword')),
            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout')),
        ),
        'htmlOptions'=>array('class'=>'operations'),
    ));
    $this->endWidget();
?>