<!DOCTYPE html >
<html>
<head>
<?php 
GNAssetHelper::init(array(
	'image'		=> 'img',
	'css'		=> 'css',
	'script'	=> 'js'
));
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php GNAssetHelper::setBase('justlook');?>
<?php GNAssetHelper::cssFile('reset');?>
<?php GNAssetHelper::cssFile('common');?>
<?php GNAssetHelper::cssFile('jl-jui');?>

<?php
GNAssetHelper::cssFile('jquery.rating'); 
GNAssetHelper::cssFile('jlbd.message');
GNAssetHelper::cssFile('jlbd.dialog');
GNAssetHelper::cssFile('jlbd.notify');

GNAssetHelper::scriptFile('jlbd', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jlbd.message', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jlbd.dialog', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jlbd.notify', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jquery.tmpl.min', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jquery.cookies.2.2.0.min', CClientScript::POS_HEAD);

GNAssetHelper::setBase('application.modules.reviews.assets');
GNAssetHelper::scriptFile('jlbd.rating', CClientScript::POS_HEAD);

?>

	
</head>
<body>
<?php $this->renderPartial('//common/jlap-rating');?>
<?php echo $content;?>
</body>
</html>
