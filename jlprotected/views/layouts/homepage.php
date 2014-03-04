<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php 
	GNAssetHelper::init(array(
		'image'		=> 'img',
		'css'		=> 'css',
		'script'	=> 'js',
	));
	?>
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php 
	GNAssetHelper::setBase('justlook');
	GNAssetHelper::setPriority(100);
	GNAssetHelper::cssFile('reset');
	GNAssetHelper::cssFile('fonts/UTMAlterGothicRegular');
	GNAssetHelper::cssFile('common');
	GNAssetHelper::cssFile('common-more');
	GNAssetHelper::cssFile('common.home');
    GNAssetHelper::cssFile('common.home.activiti');
	GNAssetHelper::cssFile('jquery.sort.by');
	GNAssetHelper::cssFile('jquery.rating');
	GNAssetHelper::cssFile('bt-big-2');
	GNAssetHelper::cssFile('jlbd.message');
	GNAssetHelper::cssFile('jlbd.dialog');
	GNAssetHelper::cssFile('jlbd.notify');
	GNAssetHelper::cssFile('jl-alert-bootraps');
	GNAssetHelper::cssFile('top-list-city');
	// -- JS Files -- //
    /** placeholder **/
    GNAssetHelper::scriptFile('jquery.watermark', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd', CClientScript::POS_HEAD);
	GNAssetHelper::scriptFile('jlbd.message', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.dialog', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.notify', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.cookies.2.2.0.min', CClientScript::POS_HEAD);
	
	GNAssetHelper::scriptFile('jlbd.inflector', CClientScript::POS_END);
	
	GNAssetHelper::scriptFile("jquery.sort.by", CClientScript::POS_END);
	
	?>
	
	<?php
	GNAssetHelper::setBase('application.modules.user.assets');
	GNAssetHelper::scriptFile('jlbd.user', CClientScript::POS_HEAD);
	?>
	
	<!--[if lte IE 6]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie6.css";</style>
	<![endif]-->
	<!--[if IE 7]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie7.css";</style>
	<![endif]-->
	<!--[if IE 8]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie8.css";</style>
	<![endif]-->
	<!--[if IE 9]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie9.css";</style>
	<![endif]-->
</head>
<body>
	<div id="wd-head-container">
	<?php $this->renderPartial('//common/header')?>
	</div>
	<script language="javascript">
	$('#wd-head-container span.ico:eq(0)').addClass('active');
	</script>
	<div class="wd-layout-public-page">
		<?php echo $content;?>
		
		<?php $this->renderPartial('//common/footer')?>
	
	</div>
<?php //$this->renderPartial("//common/user/login");?>

<script language="javascript" src="<?php echo Yii::app()->params['notificationServer']?>/socket.io/socket.io.js"></script>
</body>
</html>
