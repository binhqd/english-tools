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
<?php Yii::app()->jlbd->register(); // Register JLBD Library ?>
<?php GNAssetHelper::setBase('myzone_v1');?>
<?php
if (empty($this->pageTitle)) 
	$this->pageTitle = "MyZone";

?>
<title><?php echo $this->pageTitle?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />

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
GNAssetHelper::cssFile('jscrollpane-custom');
GNAssetHelper::cssFile('tipsy');
GNAssetHelper::cssFile('makerpage-objectnode');
GNAssetHelper::cssFile('makerpage-objectnode-rightlc');
GNAssetHelper::cssFile('pagelet-stream-head-storycontent');
GNAssetHelper::cssFile('pagelet-stream-setting-streamstory');
GNAssetHelper::cssFile('magnific-popup');
GNAssetHelper::cssFile('media-queries');
GNAssetHelper::cssFile('custom.common');
GNAssetHelper::cssFile('css3-progress-bar');
GNAssetHelper::cssFile('pagelet-stream');
GNAssetHelper::cssFile('pagelet-stream-comment-box');
GNAssetHelper::cssFile('interests-select');
GNAssetHelper::cssFile('jquery.alerts');


// ----------- JS File ---------------------
GNAssetHelper::scriptFile('jquery.easing.1.3.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('expanding', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.autosize-min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.mousewheel.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.touchSwipe.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.carouFredSel-6.2.0-packed', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.jscrollpane.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.cookies.2.2.0.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.tipsy', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.alerts', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('jquery.magnific-popup.min', CClientScript::POS_HEAD);
GNAssetHelper::scriptFile('zone.popup', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.nicescroll', CClientScript::POS_END);
GNAssetHelper::scriptFile('jquery.placeholder.min', CClientScript::POS_END);
GNAssetHelper::scriptFile('zone', CClientScript::POS_BEGIN);
GNAssetHelper::scriptFile('jquery.tmpl.min', CClientScript::POS_BEGIN);
GNAssetHelper::scriptFile('common', CClientScript::POS_END);

$this->widget('ext.timeago.JTimeAgo', array(
	'selector' => ' .timeago',
));

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
	var CDNUrl = '<?php echo Yii::app()->params['AWS']['CDN']?>';
	var activities = [];
	var urlAmazone = "<?php echo ZoneRouter::CDNUrl('/');?>";
	$().ready(function(e){
		
	});
	
	function loadArticles(activities) {
		if (activities.length > 0) {
			$.post(homeURL + '/articles/api/realtime', {data: activities}, function(res) {
				$("#articleSelector").prepend(res);
				$(".fade-item-article").fadeIn(1000);
			});
			activities = [];
		}
	}
	
</script>
</head>
<body>
	<?php
	$this->widget('ext.backtotop.BackToTop',array(
		'text'=>'Scroll to Top',
		'autoShow'=>true
	));
	?>
	<div class="wd-wrapper ptloc" id='pageWrapper'>
		<?php $this->renderPartial('//common/top-header');?>
		<?php echo $content;?>
		<!-- footer content -->
		<?php $this->renderPartial('//common/footer');?>
		
		<!-- footer content .end-->
		
		<?php 
		if(currentUser()->isGuest) :
		GNAssetHelper::scriptFile('common-home', CClientScript::POS_HEAD);
		?>
			<script>
			$().ready(function(e){
				$('.wd-open-popup').magnificPopup({
					tClose: 'Close (Esc)',closeBtnInside:false
				});
			});
			</script>
			
		<?php
			$this->widget('widgets.user.FormLogin');
			$this->widget('widgets.user.FormResgister');
		else :
			
			$this->widget('widgets.user.FormChangePassword');
		endif;
		?>
	</div>
	<!-- Start Script -->
	
	
<?php
GNAssetHelper::setBase('myzone_v1');
GNAssetHelper::cssFile('popup-content');
GNAssetHelper::cssFile('main-form');
GNAssetHelper::cssFile('uniform.default');
GNAssetHelper::cssFile('uniform-default-custom');
GNAssetHelper::scriptFile('jquery.uniform.min', CClientScript::POS_HEAD);
?>
<script language="javascript" src="<?php echo Yii::app()->params['notificationServer']?>/socket.io/socket.io.js"></script>
</body>
</html>
