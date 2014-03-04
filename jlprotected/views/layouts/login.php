<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
GNAssetHelper::$useCache = Yii::app()->params['cacheClientScript'];
GNAssetHelper::init(array(
	'image'		=> 'img',
	'css'		=> 'css',
	'script'	=> 'js'
));

?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery-ui'); ?>
<?php 
GNAssetHelper::setBase('justlook');
GNAssetHelper::setPriority(100);
GNAssetHelper::scriptFile('jlbd', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jlbd.message', CClientScript::POS_END);
GNAssetHelper::scriptFile('jlbd.dialog', CClientScript::POS_END);
GNAssetHelper::scriptFile('jlbd.notify', CClientScript::POS_END);

GNAssetHelper::cssFile('jquery.fancybox-1.3.4');

GNAssetHelper::scriptFile('jlbd.popup.user', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.fancybox-1.3.4.pack', CClientScript::POS_HEAD);
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Yii::app()->params->sitename; ?> - <?php echo Yii::t("justlook", "Login"); ?></title>
</head>
<body>
	<?php echo $content; ?>
</body>
</html>