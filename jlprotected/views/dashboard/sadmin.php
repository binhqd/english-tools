<?php
    $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Super Administrator',
    ));
    $this->widget('zii.widgets.CMenu', array(
        'items'=>array(
            array('label'=>'User Manager', 'url'=>array('/user/admin')),
            array('label'=>'Rights Assignments', 'url'=>array('/rights/assignment/view')),
            array('label'=>'Rights Permissions', 'url'=>array('/rights/authItem/permissions')),
            array('label'=>'Rights Roles', 'url'=>array('/rights/authItem/roles')),
            array('label'=>'Rights Tasks', 'url'=>array('/rights/authItem/tasks')),
            array('label'=>'Rights Operations', 'url'=>array('/rights/authItem/operations')),
            
            array('label'=>'Tpl Category Manager', 'url'=>array('/admin/tplcategory')),
            array('label'=>'Theme Manager', 'url'=>array('/admin/theme')),
            array('label'=>'Templates Manager', 'url'=>array('/admin/template')),
            array('label'=>'Default Layout Manager', 'url'=>array('/admin/defaultlayout')),
            array('label'=>'Default Page Manager', 'url'=>array('/admin/defaultpage')),
            array('label'=>'Default Section Manager', 'url'=>array('/admin/defaultsection')),
            array('label'=>'Default Module Manager', 'url'=>array('/admin/defaultmodule')),
        ),
        'htmlOptions'=>array('class'=>'operations'),
    ));
    $this->endWidget();
?>