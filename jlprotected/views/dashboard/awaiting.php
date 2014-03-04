<?php
    $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Awating',
    ));
    $this->widget('zii.widgets.CMenu', array(
        'items'=>array(
            array('label'=>'User Manager', 'url'=>array('index')),
            array('label'=>'Rights Manager', 'url'=>array('index')),
        ),
        'htmlOptions'=>array('class'=>'operations'),
    ));
    $this->endWidget();
?>