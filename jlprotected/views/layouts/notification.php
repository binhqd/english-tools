<!DOCTYPE html>
<html>
<head>
<?php 
GNAssetHelper::init(array(
'image'		=> 'img',
'css'		=> 'css',
'script'	=> 'js',
));
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php GNAssetHelper::setBase('myzone_v1');?>
<?php
if (empty($this->pageTitle)) 
	$this->pageTitle = "MyZone";

?>
<title><?php echo $this->pageTitle?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="<?php echo ZoneRouter::createUrl("/favicon.ico")?>" type="image/x-icon" />

<?php 
GNAssetHelper::setPriority(100);
GNAssetHelper::cssFile('reset');
GNAssetHelper::cssFile('common');

// ----------------- profile -------------
GNAssetHelper::cssFile('profile-user-view-layout');
GNAssetHelper::cssFile('nav');
GNAssetHelper::cssFile('md-header');
GNAssetHelper::cssFile('header-search');
GNAssetHelper::cssFile('setting-header');
GNAssetHelper::cssFile('jewelcontainer');
GNAssetHelper::cssFile('bottom-header');
GNAssetHelper::cssFile('user-interaction-status');
GNAssetHelper::cssFile('list-1');
GNAssetHelper::cssFile('for-mobile');
GNAssetHelper::cssFile('mutual-friends');
GNAssetHelper::cssFile('information-list');
GNAssetHelper::cssFile('list-2');
GNAssetHelper::cssFile('list-3');
GNAssetHelper::cssFile('list-4');
GNAssetHelper::cssFile('topleft-person');
GNAssetHelper::cssFile('gallery-1');
GNAssetHelper::cssFile('pagelet-stream');
GNAssetHelper::cssFile('pagelet-stream-post');
GNAssetHelper::cssFile('action-more-button');
GNAssetHelper::cssFile('orange-action-more-bt');
GNAssetHelper::cssFile('search-activities');
GNAssetHelper::cssFile('topsearch-pagelet-form');
GNAssetHelper::cssFile('userconnected');
GNAssetHelper::cssFile('stream-gallery-51');
GNAssetHelper::cssFile('footer');
GNAssetHelper::cssFile('jquery.jscrollpane');
GNAssetHelper::cssFile('tipsy');
GNAssetHelper::cssFile('makerpage-objectnode');
GNAssetHelper::cssFile('makerpage-objectnode-rightlc');
GNAssetHelper::cssFile('pagelet-stream-head-storycontent');
GNAssetHelper::cssFile('pagelet-stream-setting-streamstory');
GNAssetHelper::cssFile('magnific-popup');
GNAssetHelper::cssFile('media-queries');
GNAssetHelper::cssFile('custom.common');


// ----------- JS File ---------------------
GNAssetHelper::scriptFile('jlbd', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jlbd.user', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jquery.tmpl.min', CClientScript::POS_HEAD);

GNAssetHelper::scriptFile('jquery.easing.1.3.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.autosize-min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.mousewheel.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.touchSwipe.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.carouFredSel-6.2.0-packed', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.jscrollpane.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.tipsy', CClientScript::POS_END);

GNAssetHelper::scriptFile('common', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.magnific-popup.min', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('zone.popup', CClientScript::POS_END);
GNAssetHelper::scriptFile('myzone.notification', CClientScript::POS_END);

?>
<!--[if lte IE 6]>
		<link href="/myzone_v1/css/ie6.css" media="screen" rel="stylesheet" type="text/css"/>
	<![endif]-->
<!--[if IE 7]>
		<link href="/myzone_v1/css/ie7.css" media="screen" rel="stylesheet" type="text/css"/>
	<![endif]-->
<!--[if IE 8]>
		<link href="/myzone_v1/css/ie7.css" media="screen" rel="stylesheet" type="text/css"/>
	<![endif]-->
<!--[if IE 9]>
		<link href="/myzone_v1/css/ie9.css" media="screen" rel="stylesheet" type="text/css"/>
	<![endif]-->
<!--[if lt IE 9]>
		<script src="/myzone_v1/js/css3-mediaqueries.js" type="text/javascript""></script>
	<![endif]-->
	<script>
		var activities = [];
	</script>
</head>
<body>
	<div class="wd-wrapper">
		<?php $this->renderPartial('//common/top-header');?>
		<?php echo $content;?>
		<!-- footer content -->
		<div id="wd-footer">
			<div class="wd-center">
				<div class="wd-left-footer">
					<p>Copyright &copy;2013 YouLook</p>
					<ul class="wd-footer-menu">
						<li class="bdlno pl0"><a href="#">Terms &amp; Conditions</a></li>
						<li><a href="#">Privacy &amp; Acceptable Use Policy</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">About</a></li>
					</ul>
				</div>
				<div class="wd-right-footer">
					<ul class="wd-share-nw">
						<li><a href="#" class="wd-face">facebook</a></li>
						<li><a href="#" class="wd-twiter">twiter</a></li>
						<li><a href="#" class="wd-rss">rss</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- footer content .end-->
	</div>
	<!-- Start Script -->
	
	
<?php
	if(currentUser()->isGuest) {
		GNAssetHelper::cssFile('popup-content');
		GNAssetHelper::cssFile('main-form');
?>
	<script>
	$().ready(function(e){
		$('.wd-open-popup').magnificPopup({
			tClose: 'Close (Esc)',closeBtnInside:true
		});
	});
	</script>
	
<?php
		$this->widget('widgets.user.FormLogin');
		$this->widget('widgets.user.FormResgister');
		
	}
?>
<script language="javascript" src="<?php echo Yii::app()->params['notificationServer']?>/socket.io/socket.io.js"></script>
</body>
</html>
