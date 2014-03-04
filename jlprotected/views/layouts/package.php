<!DOCTYPE html >
<html >
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
	GNAssetHelper::cssFile('list-new');
	GNAssetHelper::cssFile('business-package-layout');
	GNAssetHelper::cssFile('jquery.sort.by');
	GNAssetHelper::cssFile('min-map');
	GNAssetHelper::cssFile('top-menu');
	GNAssetHelper::cssFile('top-menu-more');
	GNAssetHelper::cssFile("fix-top-menu-dashboard");
	GNAssetHelper::cssFile('your-location-search');
	GNAssetHelper::cssFile('search-list-news-aside');
	GNAssetHelper::cssFile('rating-status-number-overwrite');
	GNAssetHelper::cssFile('search-list-news-aside');
	GNAssetHelper::cssFile('jquery.rating');
	GNAssetHelper::cssFile('basic-biz-infor');
	GNAssetHelper::cssFile('tooltip.ie.fix');
	GNAssetHelper::cssFile('bt-wrapper-tooltip');
	GNAssetHelper::cssFile('add-favourites-popup');
	GNAssetHelper::cssFile('bt-big-2');
	GNAssetHelper::cssFile('jldb-favourites-form');
	GNAssetHelper::cssFile('link-action');
	GNAssetHelper::cssFile('link-extra');
	GNAssetHelper::cssFile('announcement-list');
	GNAssetHelper::cssFile('announcement-violet');
	GNAssetHelper::cssFile('announcement-biz');
	GNAssetHelper::cssFile('paging-control-biz');
	GNAssetHelper::cssFile('announcement-pink');
	GNAssetHelper::cssFile('buz-attribute-list');
	GNAssetHelper::cssFile('feature-flash-biz-detail');
	GNAssetHelper::cssFile('information-content');
	GNAssetHelper::cssFile('show-action-user');
	GNAssetHelper::cssFile('user-view-mode');
	GNAssetHelper::cssFile('user-start-point');
	GNAssetHelper::cssFile('action-on-user');
	GNAssetHelper::cssFile('content-review');
	GNAssetHelper::cssFile('rating-helpful');
	GNAssetHelper::cssFile('db-note');
	GNAssetHelper::cssFile('button-big');
	GNAssetHelper::cssFile('button-big-6');
	GNAssetHelper::cssFile('jquery.fancybox-1.3.4');
	GNAssetHelper::cssFile('popup-public');
	GNAssetHelper::cssFile('jlbd.form.basic');
	
	GNAssetHelper::cssFile('bt-small');
	GNAssetHelper::cssFile('edit-biz-platium');
	GNAssetHelper::cssFile('custome-package');
	GNAssetHelper::cssFile('bus-aside-link');
	GNAssetHelper::cssFile('jl-popup-package');
	GNAssetHelper::cssFile('jlbd.message');
	GNAssetHelper::cssFile('jlbd.dialog');
	GNAssetHelper::cssFile('jlbd.notify');
	GNAssetHelper::cssFile('jl-alert-bootraps');
	GNAssetHelper::cssFile('home-page');
	GNAssetHelper::cssFile('fix-top-menu-dashboard');
	GNAssetHelper::cssFile('tipTip');
	
	GNAssetHelper::scriptFile('jlbd', CClientScript::POS_BEGIN);
	GNAssetHelper::scriptFile('jlbd.message', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.dialog', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.notify', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.fancybox-1.3.4.pack', CClientScript::POS_HEAD);
	GNAssetHelper::scriptFile('jquery.tipTip.minified', CClientScript::POS_END);
	
	GNAssetHelper::scriptFile('jquery.em', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.scrollIntoView', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.popup.user', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jl-common-business', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jquery.sort.by', CClientScript::POS_END);
	GNAssetHelper::scriptFile('jlbd.share');
	GNAssetHelper::setBase('application.modules.user.assets');
	GNAssetHelper::scriptFile('jlbd.user', CClientScript::POS_BEGIN);
	
	?>

	<!--[if lte IE 6]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie6.css";</style>
	<![endif]-->
	<!--[if IE 7]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie7.css";</style>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl;?>/justlook/js/json2.js"></script>
	<![endif]-->
	<!--[if IE 8]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie8.css";</style>
	<![endif]-->
	<!--[if IE 9]>
		<style type="text/css" media="all">@import "<?php echo Yii::app()->baseUrl;?>/justlook/css/ie9.css";</style>
	<![endif]-->
</head>
<body id="package_layout">

	<?php echo $content;?>
<?php if (!currentUser()->isGuest):?>
<script language="javascript" src="<?php echo Yii::app()->params['notificationServer']?>/socket.io/socket.io.js"></script>
<?php endif;?>
</body>
</html>
