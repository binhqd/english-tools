<!DOCTYPE html >
<html>
<head>
<?php 
GNAssetHelper::init(array(
	'image'		=> 'img',
	'css'		=> 'css',
	'script'	=> 'js'
));
GNAssetHelper::setBase('justlook');
GNAssetHelper::scriptFile('jquery.cookies.2.2.0.min', CClientScript::POS_HEAD);
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>
<body>
<?php echo $content;?>
</body>
</html>