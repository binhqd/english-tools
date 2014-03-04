<?php
    $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Admin',
    ));
    $this->widget('zii.widgets.CMenu', array(
        'items'=>array(
            array('label'=>'User Manager', 'url'=>array('/user/admin')),
        ),
        'htmlOptions'=>array('class'=>'operations'),
    ));
    $this->endWidget();
?>